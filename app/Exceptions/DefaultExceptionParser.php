<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

final class DefaultExceptionParser
{
    use ResponseTrait;

    public static function make(): self
    {
        return new self();
    }

    public function renderable(): Closure
    {
        return fn (Throwable $exception, $request): JsonResponse => $this->render($exception, $request);
    }

    public function render(Throwable $e, Request $request): JsonResponse
    {
        $errorCode = $e->getCode();

        if (! in_array($errorCode, [
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_UNAUTHORIZED,
            Response::HTTP_FORBIDDEN,
            Response::HTTP_NOT_ACCEPTABLE,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            Response::HTTP_NOT_FOUND,
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ])) {
            $errorCode = Response::HTTP_BAD_REQUEST;
        }

        switch (true) {
            case $e instanceof ModelNotFoundException:
                return $this->error('Record not found', Response::HTTP_NOT_FOUND);
            case $e instanceof NotFoundHttpException:
                return $this->error('Not found', Response::HTTP_NOT_FOUND);
            case $e instanceof ValidationException:
                /** @var Validator $validator */
                $validator = $e->validator;

                return $this->error(
                    implode(', ', $validator->messages()->all()),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            default:
                if (App::isProduction()) {
                    return $this->error('Server error', Response::HTTP_INTERNAL_SERVER_ERROR);
                }

                return $this->error($e->getMessage(), $errorCode);
        }
    }
}

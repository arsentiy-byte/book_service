# The default environment file
ENVIRONMENT_FILE=$(shell pwd)/.env

# The default project directory
PROJECT_DIRECTORY=$(shell pwd)

start:
	- docker-compose -f docker-compose.yml up -d

stop:
	- docker-compose -f docker-compose.yml stop

kill:
	- docker-compose -f docker-compose.yml kill

build-containers:
	- docker-compose -f docker-compose.yml up -d --build

restart:
	- docker-compose -f docker-compose.yml up -d --force-recreate

build-project: restart composer-install check-env
	- docker-compose -f docker-compose.yml exec -T book_service php artisan key:generate
	- docker-compose -f docker-compose.yml exec -T book_service php artisan migrate
	- docker-compose -f docker-compose.yml exec -T book_service php artisan optimize:clear
	- docker-compose -f docker-compose.yml exec -T book_service php artisan optimize

composer-install:
	- docker-compose -f docker-compose.yml exec -T book_service composer install

optimize:
	- docker-compose -f docker-compose.yml exec -T book_service php artisan optimize

clean:
	- docker-compose -f docker-compose.yml exec -T book_service php artisan optimize:clear

clean-dependencies:
	- rm -rf vendor

migrate:
	- docker-compose -f docker-compose.yml exec -T book_service php artisan migrate

php-fixer:
	- docker-compose -f docker-compose.yml exec -T book_service vendor/bin/php-cs-fixer fix

swagger:
	- docker-compose -f docker-compose.yml exec -T book_service php artisan l5-swagger:generate

npm-install:
	- docker-compose -f docker-compose.yml exec -T book_service npm install

npm-build:
	- docker-compose -f docker-compose.yml exec -T book_service npm run production

check-env:
ifeq (,$(wildcard ./.env))
	cp .env.example .env
endif

FROM php:8.1-fpm

COPY composer.lock composer.json /var/www/app/

WORKDIR /var/www/app/

RUN apt-get update && apt-get install --yes --force-yes \
    build-essential \
    libpng-dev \
    libaio1 \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl \
    g++ \
    libicu-dev \
    libpq-dev \
    lftp \
    wget \
    zlib1g-dev \
    openconnect \
    supervisor \
    libbz2-dev \
    cron \
    libc-client-dev \
    libkrb5-dev \
    libxml2-dev \
    libgd-dev \
    libmcrypt-dev \
    bzip2 \
    libtidy-dev \
    libcurl4-openssl-dev \
    libz-dev \
    libmemcached-dev \
    libxslt-dev \
    nodejs npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -LsS https://codeception.com/codecept.phar -o /usr/local/bin/codecept && chmod a+x /usr/local/bin/codecept

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install bz2
RUN docker-php-ext-install calendar
RUN docker-php-ext-install dba
RUN docker-php-ext-install exif
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-install gettext
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-install imap
RUN docker-php-ext-install intl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install soap
RUN docker-php-ext-install tidy
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install xsl
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-configure hash --with-mhash
RUN docker-php-ext-install sockets
RUN docker-php-ext-install opcache
RUN docker-php-ext-install pcntl

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY /docker/php.ini $PHP_INI_DIR/conf.d/
COPY . /var/www/app

RUN chown -R www-data:www-data \
        /var/www/app/storage/ \
        /var/www/app/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

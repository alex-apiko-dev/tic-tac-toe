ARG BASE_IMAGE
FROM php:8.0.3-fpm-alpine3.13 as base

RUN apk add --no-cache \
        acl \
        file \
        unzip \
        gettext \
        git \
        jq \
        supervisor \
        dcron \
    ; \
    apk add --upgrade jq

RUN set -eux; \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        coreutils \
        freetype-dev \
        icu-dev \
        libjpeg-turbo-dev \
        libtool \
        libwebp-dev \
        libzip-dev \
        sqlite-dev \
    ; \
    \
    docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-webp=/usr/include --with-freetype=/usr/include/; \
    docker-php-ext-install -j$(nproc) \
        bcmath \
        exif \
        gd \
        intl \
        pdo_mysql \
        zip \
        pdo_sqlite \
    ; \
    pecl install \
        apcu-5.1.17 \
        redis-5.3.2 \
        xdebug-3.0.0 \
    ; \
    pecl clear-cache; \
    docker-php-ext-enable \
        apcu \
        opcache \
        redis \
        pdo_sqlite \
        xdebug \
    ; \
    \
    runDeps="$( \
        scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
            | tr ',' '\n' \
            | sort -u \
            | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
    )"; \
    apk add --no-cache --virtual .laravelapp-phpexts-rundeps $runDeps; \
    \
    apk del .build-deps; \
    \
    apk add --no-cache \
                xvfb \
                ttf-freefont ttf-dejavu ttf-droid ttf-freefont ttf-liberation ttf-ubuntu-font-family fontconfig \
                 wkhtmltopdf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY .deploy/config/php-fpm/php.ini /usr/local/etc/php/php.ini

WORKDIR /application

COPY . ./

RUN set -eux;
RUN mkdir -p storage/logs storage/framework bootstrap/cache;
RUN COMPOSER_PROCESS_TIMEOUT=2000 composer install --prefer-dist --no-progress --optimize-autoloader;
RUN composer clear-cache;
RUN chown -R www-data:www-data /application

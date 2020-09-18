FROM php:7.4-fpm-alpine

RUN apk update \
    && apk add --no-cache curl g++ make autoconf \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug
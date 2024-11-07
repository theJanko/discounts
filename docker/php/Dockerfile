FROM php:8.3-fpm

RUN apt update && apt install -y \
        zip \
        bash \
        git \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        curl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
        zip \
        pdo \
        pgsql \
        pdo_pgsql \
        intl \
    && docker-php-ext-enable intl

RUN docker-php-ext-install opcache \
    && docker-php-ext-enable opcache

RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
        echo 'opcache.enable_cli=1'; \
    } > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN { \
        echo 'short_open_tag=off'; \
    } > /usr/local/etc/php/conf.d/disable-short-tags.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/vhosts/discounts

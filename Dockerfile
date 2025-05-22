FROM php:8.4.3-fpm


# Установка зависимостей и расширений PHP
RUN apt-get update && apt-get install -qq --no-install-recommends \
    git \
    curl \
    libmcrypt-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libbz2-dev \
    libzip-dev \
    libpq-dev \
    libldap2-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo_pgsql pdo_mysql bcmath bz2 ldap gd pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Установим intl
RUN apt-get update && \
    apt-get install -y libicu-dev && \
    docker-php-ext-install intl

# Установка Composer
RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs
# Установка Xdebug и включение его
RUN if ! php -m | grep -q 'xdebug'; then pecl install xdebug; fi \
    && docker-php-ext-enable xdebug

# Установка Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"

# Изменение прав доступа для www-data
RUN chown -R www-data:www-data /var/www

ENV TZ=Asia/Almaty

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Копирование php.ini в контейнер
COPY docker/app/php/php.ini /usr/local/etc/php/

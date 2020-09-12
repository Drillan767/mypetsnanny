FROM php:latest

RUN apt-get update -y && apt-get install -y curl openssl zip unzip git libonig-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mbstring
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get update && apt-get install -y nodejs

RUN docker-php-ext-install mysqli pdo pdo_mysql json

RUN useradd -ms /bin/bash mpn

WORKDIR /app
RUN chmod -R 777 /app
COPY --chown=mpn:mpn . /app
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8080
EXPOSE 8080

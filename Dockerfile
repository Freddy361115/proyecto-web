FROM php:7.4-apache

########ENVIRONMENT########
ENV CONTAINER_ROLE app

ARG APP_ENV
ENV APP_ENV $APP_ENV
# Example key so you don't have to generate one inside
ENV APP_KEY false
ENV APP_DEBUG 'true'
ENV DEBUGBAR_ENABLED false
ENV APP_URL http://local.mentores.com:6080

ENV DB_HOST db
ENV DB_PORT 3306
ENV DB_DATABASE 'mentores'
ENV DB_USERNAME 'mentores'
ENV DB_PASSWORD 'hi7Azoph5y'

ENV CACHE_DRIVER redis
ENV SESSION_DRIVER redis
ENV QUEUE_CONNECTION redis

ENV REDIS_HOST redis
ENV REDIS_PASSWORD null
ENV REDIS_PORT 6379


# Google Recaptcha
ENV NOCAPTCHA_SITEKEY null
ENV NOCAPTCHA_SECRET null


# MAIL - uses "ses" in live
ENV MAIL_MAILER smtp
# PROD
ENV AWS_ACCESS_KEY_ID null
ENV AWS_SECRET_ACCESS_KEY null
ENV AWS_DEFAULT_REGION "us-east-1"
# LOCAL
ENV MAIL_HOST smtp.mailtrap.io
ENV MAIL_PORT 2525
ENV MAIL_ENCRYPTION tls
# Create your own and add it to .env
ENV MAIL_USERNAME null
ENV MAIL_PASSWORD null
ENV MAIL_FROM_ADDRESS "no-reply@grupomentores.com"



########END-ENVIRONMENT########

# Libcrypt and Laravel Requirements
RUN apt-get update && apt-get install -y curl
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN apt-get install -y \
    locales nodejs netcat redis default-mysql-client libxml2-dev libzip-dev zip unzip build-essential \
    zlib1g-dev libicu-dev g++ libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev --no-install-recommends && \
    # rm -r /var/lib/apt/lists/* && \
    sed -i 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    sed -i 's/# es_MX.UTF-8 UTF-8/es_MX.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl gd tokenizer pcntl pdo_mysql xml zip soap

# Installing supervisor service and creating directories for copy supervisor configurations
RUN apt-get -y install supervisor && mkdir -p /var/log/supervisor && mkdir -p /etc/supervisor/conf.d

#change timezone
RUN ln -sf /usr/share/zoneinfo/America/Guatemala /etc/localtime

# Redis client for PHP
RUN docker-php-source extract && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    docker-php-source delete

RUN a2enmod rewrite
RUN a2ensite default-ssl
RUN a2enmod ssl

COPY ./docker /var/www/html/docker
RUN cp -rf /var/www/html/docker/000-default.conf /etc/apache2/sites-enabled/000-default.conf \
    && cp -rf /var/www/html/docker/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf \
    && cp -rf /var/www/html/docker/php.ini /usr/local/etc/php/php.ini \
    && cp -rf /var/www/html/docker/cacert.pem /etc/ssl/certs/cacert.pem \
    && cp -rf /var/www/html/docker/ibizdevelopers.key /etc/ssl/certs/ibizdevelopers.key \
    && cp -rf /var/www/html/docker/ibizdevelopers.pem /etc/ssl/certs/ibizdevelopers.pem \
    && cp -rf /var/www/html/docker/start.sh /usr/local/bin/start \
    && cp -rf /var/www/html/docker/horizon.conf /etc/supervisor/conf.d/horizon.conf \
    && cp -rf /var/www/html/docker/entrypoint.sh /usr/local/bin/entrypoint \
    && chmod a+x /usr/local/bin/entrypoint \
    && chmod u+x /usr/local/bin/start

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

# Composer and copy codebase
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html
# Instead of copy then "RUN chown -R www-data:www-data /var/www/html"

# TEMP - https://github.com/laravel/telescope/issues/620
ENV TELESCOPE_ENABLED false

# Config files to setup composer and NPM
# RUN chmod u+x docker/setup.sh &&
RUN chmod u+x docker/setup-local.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/entrypoint"]
CMD ["/usr/local/bin/start"]

FROM php:7.4-apache
ARG BUILD_ENV
ARG SYMFONY_ENV
ENV BUILD_ENV=$BUILD_ENV
ENV SYMFONY_ENV=$SYMFONY_ENV
ENV SSH_PASSWD "root:Docker!"
# PHP extensions
ENV APCU_VERSION 5.1.17
RUN echo $SYMFONY_ENV
RUN echo $BUILD_ENV
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
#        libicu52 \
        zlib1g \
        libpng-dev \
        libicu-dev \
        zlib1g-dev \
        libxrender1 \
        libfontconfig1 \
        libx11-dev \
        libxext-dev \
	openssh-server \
        libevent-dev \
        libssl-dev \
        nano \
        cron \
        wkhtmltopdf \
        libqt5core5a \
        librabbitmq-dev \
        libzip-dev \
        supervisor \
    && echo "$SSH_PASSWD" | chpasswd \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
        intl \
#        mbstring \
        pdo_mysql \
        zip \
        bcmath \
        gd \
        sockets \
        pcntl \
	sysvsem \
    && apt-get purge -y --auto-remove $buildDeps
RUN pecl install \
        apcu-$APCU_VERSION \
        amqp \
	&& pecl install event-2.4.2 \
    && docker-php-ext-enable --ini-name 20-sockets.ini sockets \
    && docker-php-ext-enable --ini-name 05-opcache.ini opcache \
    && docker-php-ext-enable --ini-name zz-event.ini event \
    && docker-php-ext-enable --ini-name 20-apcu.ini apcu \
    && docker-php-ext-enable --ini-name bcmath.ini bcmath \
    && docker-php-ext-enable --ini-name pcntl.ini pcntl \
    && docker-php-ext-enable --ini-name gd.ini gd \
    && docker-php-ext-enable amqp

# Apache config
RUN a2enmod rewrite
ADD docker_conf/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# PHP config
ADD docker_conf/php/php.ini /usr/local/etc/php/php.ini

# Install Git
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git curl gnupg -yq \
   && rm -rf /var/lib/apt/lists/*

#RUN pecl install xdebug-2.5.5 && docker-php-ext-enable xdebug

# Add the application
ADD . /app
WORKDIR /app

# Fix permissions (useful if the host is Windows)
RUN chmod +x docker_conf/composer.sh docker_conf/start.sh docker_conf/apache/start_safe_perms

RUN cp .env.${BUILD_ENV}.dist .env.local

# add supervisor
RUN mkdir -p /var/log/supervisor
COPY --chown=root:root ./docker_conf/script/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install composer
RUN ./docker_conf/composer.sh \
    && mv composer.phar /usr/bin/composer 
#    && composer global require "hirak/prestissimo"
RUN \
    # Remove var directory if it's accidentally included
    (rm -rf var || true) \
    # Create the var sub-directories
    && mkdir -p var/cache \
    && chown -Rf www-data:www-data /app \
    # Install dependencies
    && export APP_ENV=prod \
    && su - www-data -s /bin/bash -c  'cd /app && composer install --prefer-dist --no-scripts --no-dev --no-progress --no-suggest --optimize-autoloader --classmap-authoritative' \
    # Fixes permissions issues in non-dev mode
    && su -w www-data -s /bin/bash -c 'cd /app && php bin/console cache:clear'

# RUN php bin/console doctrine:migrations:migrate -n
RUN composer install --prefer-dist --no-progress --no-suggest
RUN chown -Rf www-data:www-data /app/var/
#ssh access
#COPY sshd_config /etc/ssh/
#COPY docker/crontab/crontab /etc/cron.d/.
#RUN chmod 0644 /etc/cron.d/crontab
#RUN crontab /etc/cron.d/crontab
#CMD ["/usr/bin/supervisord"]
EXPOSE 80 22
CMD ["/app/docker_conf/start.sh"]

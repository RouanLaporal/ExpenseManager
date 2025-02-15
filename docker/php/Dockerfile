# syntax=docker/dockerfile:1.7-labs
FROM bitnami/php-fpm:latest

# set main params
ARG BUILD_ARGUMENT_ENV=dev
ENV ENV=$BUILD_ARGUMENT_ENV
ENV APP_HOME /var/www/html
ARG HOST_UID=1000
ARG HOST_GID=1000
ENV USERNAME=www-data
ARG INSIDE_DOCKER_CONTAINER=1
ENV INSIDE_DOCKER_CONTAINER=$INSIDE_DOCKER_CONTAINER
ARG XDEBUG_CONFIG=main
ENV XDEBUG_CONFIG=$XDEBUG_CONFIG
ARG XDEBUG_VERSION=3.4.1
ENV XDEBUG_VERSION=$XDEBUG_VERSION
ENV PHP_CS_FIXER_IGNORE_ENV=1

# check environment
RUN if [ "$BUILD_ARGUMENT_ENV" = "default" ]; then echo "Set BUILD_ARGUMENT_ENV in docker build-args like --build-arg BUILD_ARGUMENT_ENV=dev" && exit 2; \
    elif [ "$BUILD_ARGUMENT_ENV" = "dev" ]; then echo "Building development environment."; \
    elif [ "$BUILD_ARGUMENT_ENV" = "test" ]; then echo "Building test environment."; \
    elif [ "$BUILD_ARGUMENT_ENV" = "staging" ]; then echo "Building staging environment."; \
    elif [ "$BUILD_ARGUMENT_ENV" = "prod" ]; then echo "Building production environment."; \
    else echo "Set correct BUILD_ARGUMENT_ENV in docker build-args like --build-arg BUILD_ARGUMENT_ENV=dev. Available choices are dev,test,staging,prod." && exit 2; \
    fi

# install all the dependencies and enable PHP modules
RUN apt-get update && apt-get install -y \
    gnupg \
    g++ \
    procps \
    openssl \
    git \
    unzip \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg-dev \
    libicu-dev  \
    libonig-dev \
    libxslt1-dev \
    acl 

WORKDIR /var/www
COPY . /var/www
# create document root, fix permissions for www-data user and change owner to www-data
# RUN mkdir -p $APP_HOME/public && \
#     mkdir -p /home/$USERNAME && chown $USERNAME:$USERNAME /home/$USERNAME \
#     && usermod -o -u $HOST_UID $USERNAME -d /home/$USERNAME \
#     && groupmod -o -g $HOST_GID $USERNAME \
#     && chown -R ${USERNAME}:${USERNAME} $APP_HOME

# # put php config for Symfony
# COPY ./docker/$BUILD_ARGUMENT_ENV/www.conf /usr/local/etc/php-fpm.d/www.conf
# COPY ./docker/$BUILD_ARGUMENT_ENV/php.ini /usr/local/etc/php/php.ini

# # install Xdebug in case dev/test environment
# COPY ./docker/general/do_we_need_xdebug.sh /tmp/
# COPY ./docker/dev/xdebug-${XDEBUG_CONFIG}.ini /tmp/xdebug.ini
# RUN chmod u+x /tmp/do_we_need_xdebug.sh && /tmp/do_we_need_xdebug.sh

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY composer.* /var/www/
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader
# RUN chmod +x /usr/bin/composer
# ENV COMPOSER_ALLOW_SUPERUSER 1

# # Enable Composer autocompletion
# RUN composer completion bash > /etc/bash_completion.d/composer

# # add supervisor
# RUN mkdir -p /var/log/supervisor
# COPY --chown=root:root ./docker/general/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# COPY --chown=root:crontab ./docker/general/cron /var/spool/cron/crontabs/root
# RUN chmod 0600 /var/spool/cron/crontabs/root

# set working directory

# Install symfony
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


EXPOSE 9000

# USER ${USERNAME}

# # Add necessary stuff to bash autocomplete
# RUN echo 'source /usr/share/bash-completion/bash_completion' >> /home/${USERNAME}/.bashrc \
#     && echo 'alias console="/var/www/html/bin/console"' >> /home/${USERNAME}/.bashrc

# # copy fish configs
# COPY --chown=${USERNAME}:${USERNAME} ./docker/fish/completions/ /home/${USERNAME}/.config/fish/completions/
# COPY --chown=${USERNAME}:${USERNAME} ./docker/fish/functions/ /home/${USERNAME}/.config/fish/functions/
# COPY --chown=${USERNAME}:${USERNAME} ./docker/fish/config.fish /home/${USERNAME}/.config/fish/config.fish

# # copy source files
# COPY --chown=${USERNAME}:${USERNAME} . $APP_HOME/

# # install all PHP dependencies
# RUN if [ "$BUILD_ARGUMENT_ENV" = "dev" ] || [ "$BUILD_ARGUMENT_ENV" = "test" ]; then COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-interaction --no-progress; \
#     else export APP_ENV=$BUILD_ARGUMENT_ENV && COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-interaction --no-progress --no-dev; \
#     fi

# # create cached config file .env.local.php in case staging/prod environment
# RUN if [ "$BUILD_ARGUMENT_ENV" = "staging" ] || [ "$BUILD_ARGUMENT_ENV" = "prod" ]; then composer dump-env $BUILD_ARGUMENT_ENV; \
#     fi

# USER root
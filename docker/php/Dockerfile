FROM ubuntu:jammy

ENV TERM=linux

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

ARG USER_ID=1000
ARG USER=php
ARG COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update \
    && apt-get install -y --no-install-recommends gnupg \
            wget \
            ca-certificates \
            lsb-release \
            apt-transport-https \
            software-properties-common \
            ca-certificates \
            curl \
            unzip \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ondrej-php.list \
    && apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php-apcu \
        php-apcu-bc \
        php-xdebug \
        php-imagick \
        php8.3\
        php8.3-fpm \
        php8.3-cli \
        php8.3-gd \
        php8.3-curl \
        php8.3-mbstring \
        php8.3-opcache \
        php8.3-readline \
        php8.3-xml \
        php8.3-zip \
        php8.3-mysql \
        php8.3-pgsql \
        php8.3-bcmath \
        php8.3-intl \
        git \
        vim \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer clear-cache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* ~/.composer


#RUN chgrp -R www-data /srv/app/logsstorage
#RUN chmod -R ug+rwx /srv/app/storage

RUN update-alternatives --set php /usr/bin/php8.3

RUN useradd -s /bin/bash -u ${USER_ID} ${USER}

CMD ["sh", "-c", "/usr/sbin/php-fpm8.3", "-O" ]

EXPOSE 9000

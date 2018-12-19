FROM php:7.2.13-fpm-stretch

RUN docker-php-ext-install mysqli 

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    && docker-php-ext-install iconv mcrypt \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip 
    # && apt install zip unzip php7.2-zip

RUN apt-get update && \
    apt-get -y --no-install-recommends install git && \
    php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer  && \
    rm -rf /var/lib/apt/lists/* 

ADD ./code /code
RUN cd /code && \
    composer install --no-dev
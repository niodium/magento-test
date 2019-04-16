FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    cron \
    git \
    gzip \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libxslt1-dev \
    lsof \
    mysql-client \
    vim \
    zip

RUN docker-php-ext-configure \
    gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install \
    bcmath \
    calendar \
    exif \
    gettext \
    mysqli \
    pcntl \
    pdo_mysql \
    sockets \
    gd \
    intl \
    opcache \
    soap \
    xsl \
    wddx \
    zip

RUN pecl channel-update pecl.php.net \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && sed -i -e 's/^zend_extension/\;zend_extension/g' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get install -y libssh2-1-dev \
    && pecl install ssh2-1.1.2 \
    && docker-php-ext-enable ssh2

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo 'memory_limit = 2G\n\
max_execution_time = 1800\n\
zlib.output_compression = On' >> /usr/local/etc/php/php.ini

WORKDIR /var/www/html

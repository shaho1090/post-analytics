FROM php:8.4-fpm

# Arguments
ARG USER_ID=1000
ARG GROUP_ID=1000

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt/lists/*

# PHP Extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    bcmath \
    intl \
    zip \
    pcntl \
    gd

# Redis Extension
RUN pecl install redis \
    && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create application user
RUN groupadd -g ${GROUP_ID} wstuser && \
    useradd -u ${USER_ID} -g wstuser -m wstuser

WORKDIR /var/www/html

# Switch user
USER wstuser

EXPOSE 9000

CMD ["php-fpm"]

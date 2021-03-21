FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gnupg

# Installing Jitsi Meet
RUN wget https://download.jitsi.org/jitsi-key.gpg.key && apt-key add jitsi-key.gpg.key && rm jitsi-key.gpg.key
RUN echo 'deb https://download.jitsi.org stable/' >/tmp/jitsi.list && cp /tmp/jitsi.list /etc/apt/sources.list.d/ && rm /tmp/jitsi.list
RUN apt-get update && apt-get install jitsi-meet

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user

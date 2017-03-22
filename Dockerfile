FROM php:7.1.2-cli

# Install Composer and its dependencies
RUN \
    apt-get update && \
    apt-get install git zip unzip -y && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    chown 1000 /usr/bin/composer


COPY . /var/www/html/

RUN \
    cp /var/www/html/app/config/parameters.yml.dist /var/www/html/app/config/parameters_dev.yml && \
    mkdir -p /var/www/html/var && \
    mkdir -p /var/www/html/vendor && \
    chown 1000:1000 -R /var/www/html/

USER 1000

RUN \
    cd /var/www/html && \
    composer install

VOLUME /var/www/html

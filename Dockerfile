FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        unzip \
        curl \
    && docker-php-ext-install -j"$(nproc)" mbstring intl opcache zip mysqli pdo_mysql \
    && for module in mpm_event mpm_worker; do \
        if [ -e "/etc/apache2/mods-enabled/${module}.load" ]; then a2dismod "$module"; fi; \
    done \
    && a2enmod mpm_prefork rewrite headers expires \
    && [ "$(apache2ctl -M 2>/dev/null | grep -Ec '^[[:space:]]*mpm_(event|worker|prefork)_module')" -eq 1 ] \
    && apache2ctl configtest \
    && a2dissite 000-default.conf \
    && rm -rf /var/lib/apt/lists/*

ENV APP_ENV=production \
    SUBMISSION_DATA_DIR=/tmp/sukabumi-data

WORKDIR /var/www/html

COPY docker/apache-vhost.conf /etc/apache2/sites-available/sukabumi.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/sukabumi-production.ini
COPY docker/entrypoint.sh /usr/local/bin/render-entrypoint

COPY . /var/www/html/
COPY data /opt/app/seed-data

RUN a2ensite sukabumi.conf \
    && chmod +x /usr/local/bin/render-entrypoint \
    && mkdir -p /tmp/sukabumi-data \
    && chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /tmp/sukabumi-data \
    && chmod 0750 /tmp/sukabumi-data

EXPOSE 10000

CMD ["/usr/local/bin/render-entrypoint"]

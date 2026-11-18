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
        if [ -e "/etc/apache2/mods-enabled/${module}.load" ] \
            || [ -L "/etc/apache2/mods-enabled/${module}.load" ] \
            || [ -e "/etc/apache2/mods-enabled/${module}.conf" ] \
            || [ -L "/etc/apache2/mods-enabled/${module}.conf" ]; then \
            a2dismod "$module"; \
        fi; \
    done \
    && a2enmod mpm_prefork rewrite headers expires \
    && a2dissite 000-default.conf \
    && enabled_mpm_loads="$(find /etc/apache2/mods-enabled -maxdepth 1 -type l -name 'mpm_*.load' -printf '%f\n' | sort)" \
    && printf 'Enabled MPM load symlinks: %s\n' "$enabled_mpm_loads" \
    && [ "$enabled_mpm_loads" = "mpm_prefork.load" ] \
    && for module in mpm_event mpm_worker; do \
        for suffix in load conf; do \
            module_file="/etc/apache2/mods-enabled/${module}.${suffix}"; \
            if [ -e "$module_file" ] || [ -L "$module_file" ]; then \
                echo "Conflicting Apache module remains enabled: $module_file" >&2; \
                exit 1; \
            fi; \
        done; \
    done \
    && apache_modules="$(apache2ctl -M 2>&1)" \
    && printf '%s\n' "$apache_modules" \
    && [ "$(printf '%s\n' "$apache_modules" | grep -Ec '^[[:space:]]*mpm_[[:alnum:]_]+_module')" -eq 1 ] \
    && printf '%s\n' "$apache_modules" | grep -q 'mpm_prefork_module (shared)' \
    && printf '%s\n' "$apache_modules" | grep -q 'php_module (shared)' \
    && apache2ctl configtest \
    && rm -rf /var/lib/apt/lists/*

ENV APP_ENV=production \
    SUBMISSION_DATA_DIR=/tmp/sukabumi-data

WORKDIR /var/www/html

COPY docker/apache-vhost.conf /etc/apache2/sites-available/sukabumi.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/sukabumi-production.ini
COPY docker/entrypoint.sh /usr/local/bin/render-entrypoint

COPY . /var/www/html/
COPY data /opt/app/seed-data

RUN chmod +x /usr/local/bin/render-entrypoint \
    && mkdir -p /tmp/sukabumi-data \
    && chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /tmp/sukabumi-data \
    && chmod 0750 /tmp/sukabumi-data

EXPOSE 10000

CMD ["/usr/local/bin/render-entrypoint"]

#!/bin/sh
set -eu

PORT="${PORT:-10000}"

printf "Listen %s\n" "$PORT" > /etc/apache2/ports.conf
sed "s/<VirtualHost \*:10000>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/sukabumi.conf \
    > /etc/apache2/sites-enabled/sukabumi.conf

mkdir -p /var/www/html/data

# A Render disk is mounted empty on first use. Seed the existing JSON structure
# once, while preserving submissions that have already been written to the disk.
for file in letters.json complaints.json; do
    if [ ! -f "/var/www/html/data/$file" ]; then
        if [ -f "/opt/app/seed-data/$file" ]; then
            cp "/opt/app/seed-data/$file" "/var/www/html/data/$file"
        else
            printf '[]\n' > "/var/www/html/data/$file"
        fi
    fi
done

chown -R www-data:www-data /var/www/html/data
chmod 0750 /var/www/html/data
chmod 0660 /var/www/html/data/*.json

# Render provides HTTPS at the edge. PHP can use this for secure session cookies.
if [ "${RENDER:-}" = "true" ] || [ -n "${RENDER_EXTERNAL_HOSTNAME:-}" ]; then
    printf "\nsession.cookie_secure=1\n" > /usr/local/etc/php/conf.d/sukabumi-cookies.ini
else
    rm -f /usr/local/etc/php/conf.d/sukabumi-cookies.ini
fi

exec apache2-foreground

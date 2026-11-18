#!/bin/sh
set -eu

PORT="${PORT:-10000}"

printf "Listen %s\n" "$PORT" > /etc/apache2/ports.conf
VHOST_PATH=/etc/apache2/sites-enabled/sukabumi.conf
sed "s/<VirtualHost \*:10000>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/sukabumi.conf \
    > "${VHOST_PATH}.tmp"
mv "${VHOST_PATH}.tmp" "$VHOST_PATH"
if [ -e /etc/apache2/mods-enabled/mpm_event.load ] || [ -L /etc/apache2/mods-enabled/mpm_event.load ]; then
    a2dismod mpm_event
fi
if [ -e /etc/apache2/mods-enabled/mpm_worker.load ] || [ -L /etc/apache2/mods-enabled/mpm_worker.load ]; then
    a2dismod mpm_worker
fi
a2enmod mpm_prefork
apache2ctl configtest

DATA_DIR="${SUBMISSION_DATA_DIR:-/tmp/sukabumi-data}"
mkdir -p "$DATA_DIR"

# Seed the existing JSON structure on each new container instance. The free
# Render container filesystem is temporary and records disappear on restart or redeploy.
for file in letters.json complaints.json; do
    if [ ! -f "$DATA_DIR/$file" ]; then
        if [ -f "/opt/app/seed-data/$file" ]; then
            cp "/opt/app/seed-data/$file" "$DATA_DIR/$file"
        else
            printf '[]\n' > "$DATA_DIR/$file"
        fi
    fi
done

chown -R www-data:www-data "$DATA_DIR"
chmod 0750 "$DATA_DIR"
chmod 0660 "$DATA_DIR"/*.json

# Render provides HTTPS at the edge. PHP can use this for secure session cookies.
if [ "${RENDER:-}" = "true" ] || [ -n "${RENDER_EXTERNAL_HOSTNAME:-}" ]; then
    printf "\nsession.cookie_secure=1\n" > /usr/local/etc/php/conf.d/sukabumi-cookies.ini
else
    rm -f /usr/local/etc/php/conf.d/sukabumi-cookies.ini
fi

exec apache2-foreground

# Tour And Travel Touch — free persistent hosting (Render, Docker)
# Render free web service: sleeps when idle, wakes on request. Code/data persist via GitHub + Neon.
FROM php:8.2-apache

# Postgres + MySQL drivers (Neon = pgsql; local/InfinityFree fallback = mysql)
RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Apache: serve project root, allow .htaccess, listen on Render's $PORT
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf 2>/dev/null || true \
    && printf '<Directory /var/www/html>\n\tAllowOverride All\n\tRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/app.conf \
    && a2enconf app

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

EXPOSE 10000
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-10000}/g\" /etc/apache2/ports.conf && sed -i \"s/:80>/:${PORT:-10000}>/g\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]

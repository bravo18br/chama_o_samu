FROM php:8.2.20-apache
LABEL Author="Christoffer"
WORKDIR /
ENV TZ=America/Sao_Paulo

RUN apt-get update && apt-get install -y \
    locales \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    gh \
    nano \
    certbot \
    python3-certbot-apache \
    && localedef -i pt_BR -c -f UTF-8 -A /usr/share/locale/locale.alias pt_BR.UTF-8 \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip bcmath \
    && a2enmod rewrite ssl \
    && apt-get clean

ENV LANG pt_BR.utf8
COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY .env /root/.env
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY entrypoint.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
EXPOSE 443

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]

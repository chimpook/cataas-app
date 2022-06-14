ARG PHP_VERSION

FROM php:${PHP_VERSION}-apache

ENV TZ=Europe/Warsaw

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
	echo $TZ > /etc/timezone && \
	echo "date.timezone = $TZ" > $PHP_INI_DIR/conf.d/timezone.ini

RUN apt-get update \
	&& apt-get install -y \
		zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev \
		libzip-dev git wget \
		--no-install-recommends


RUN pecl install -o -f xdebug && \
	rm -rf /tmp/pear
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install -j$(nproc) zip gd

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www

CMD ["apache2-foreground"]


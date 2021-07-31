FROM php:8.0.6-fpm

RUN apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
	software-properties-common \
	&& apt-get update \
	&& DEBIAN_FRONTEND=noninteractive apt-get install -y \
	libfreetype6-dev \
	libicu-dev \
    libssl-dev \
	libjpeg62-turbo-dev \
	libmcrypt-dev \
	libedit-dev \
	libedit2 \
	libxslt1-dev \
	apt-utils \
	gnupg \
	git \
	vim \
	npm \
	wget \
	curl \
	lynx \
	psmisc \
	unzip \
	tar \
	bash-completion \
	libzip-dev \
	&& apt-get clean

RUN docker-php-ext-configure \
  	gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
  	docker-php-ext-install \
  	pdo_mysql

# Install SASS
RUN npm install -g sass

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
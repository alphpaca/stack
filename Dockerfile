ARG PHP_VERSION=8.3

FROM php:${PHP_VERSION}-cli as base

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_HOME=/.composer

RUN mkdir /.composer

COPY .docker/php/php.ini "$PHP_INI_DIR/"
COPY .docker/php/xdebug.ini "$PHP_INI_DIR/conf.d/"
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir /workspace && \
    apt-get update && \
    apt-get install -y git wget && \
    apt-get clean cache && \
    install-php-extensions ast intl pdo pdo_mysql pdo_pgsql xsl zip

WORKDIR /workspace

CMD ["tail", "-f", "/dev/null"]

FROM base as dev

COPY .docker/.zshrc /root/.zshrc
COPY .docker/.p10k.zsh /root/.p10k.zsh

RUN install-php-extensions xdebug

RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.2.0/zsh-in-docker.sh)"

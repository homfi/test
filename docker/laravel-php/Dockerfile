FROM debian:bookworm

WORKDIR /var/www/html
ARG APP_IMAGE
ENV DEBIAN_FRONTEND=noninteractive
ENV PHP=8.3
ENV TZ=Europe/Warsaw
ENV NVM_DIR=/bin/nvm

RUN ln -snf /usr/share/zoneinfo/"$TZ" /etc/localtime && echo "$TZ" > /etc/timezone

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y unzip curl wget bash git zip lsb-release ca-certificates apt-transport-https \
    software-properties-common gnupg2 gnupg gosu supervisor libcap2-bin libpng-dev netcat-openbsd \
    default-mysql-client && apt-get clean

RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
RUN apt-get update && apt-get upgrade -y

RUN apt-get install -y php${PHP} php${PHP}-fpm php${PHP}-grpc php${PHP}-gd php${PHP}-intl \
    php${PHP}-xdebug php${PHP}-redis php${PHP}-zip php${PHP}-xsl php${PHP}-mysql php${PHP}-protobuf \
    php${PHP}-curl php${PHP}-mbstring php${PHP}-xml php${PHP}-bcmath php${PHP}-readline \
    php${PHP}-msgpack php${PHP}-igbinary php${PHP}-imagick && apt-get clean

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod a+x /usr/local/bin/composer

RUN rm /bin/sh && ln -s /bin/bash /bin/sh
RUN mkdir /bin/nvm
RUN if [ ! -d "/run/php" ]; then mkdir /run/php; fi

SHELL ["/bin/bash", "--login", "-c"]
RUN wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/master/install.sh | bash
RUN nvm install v18
RUN ln -s `which npm` /bin/npm
RUN ln -s `which node` /bin/node

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupadd --force -g 1000 sail
RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY wait-for /usr/local/bin/wait-for
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/${PHP}/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/wait-for

ENTRYPOINT ["start-container"]

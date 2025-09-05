FROM ubuntu:22.04

RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    software-properties-common curl zip unzip git

RUN add-apt-repository ppa:ondrej/php -y && \
    apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php8.1 php8.1-cli php8.1-mbstring php8.1-xml php8.1-bcmath php8.1-curl php8.1-sqlite3 composer

WORKDIR /workspace

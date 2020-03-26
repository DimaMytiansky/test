FROM php:7.4

RUN apt-get update && apt-get install -y git

RUN echo -e "short_open_tag=Off \nerror_reporting=E_ALL \n" >> /usr/local/etc/php/php.ini
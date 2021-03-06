FROM cn007b/debian:buster

MAINTAINER V. Kovpak <cn007b@gmail.com>

RUN apt-get update \
    && apt-get install -y memcached \
    && sed -i 's/127.0.0.1/0.0.0.0/' /etc/memcached.conf

ENTRYPOINT service memcached start && tail -f /var/log/memcached.log

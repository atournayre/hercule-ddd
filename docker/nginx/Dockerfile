FROM alpine:3.10

LABEL maintainer="Merle David <d.merle@aroban.com>"

RUN apk add --update nginx
RUN rm -rf /var/cache/apk/* && rm -rf /tmp/*

ADD nginx.conf /etc/nginx/
ADD hercule.conf /etc/nginx/conf.d/hercule.conf
RUN echo "upstream php-upstream { server php:9001; }" > /etc/nginx/conf.d/upstream.conf

RUN adduser -D -g 'www' www \
    && chown -R www:www /var/www

EXPOSE 80

CMD ["nginx"]
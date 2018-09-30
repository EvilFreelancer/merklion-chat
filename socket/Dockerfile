FROM alpine:3.8

ENV REDIS_HOST=redis
ENV REDIS_PORT=6379

WORKDIR /opt
ADD [".", "/opt"]
RUN apk add --update --no-cache nodejs npm \
 && npm install

EXPOSE 8080
ENTRYPOINT ["npm", "run", "start"]

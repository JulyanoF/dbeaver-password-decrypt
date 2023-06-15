FROM php:8.2-apache-buster

RUN apt update && apt install openssl

COPY . .
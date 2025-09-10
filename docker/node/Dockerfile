FROM node:20-alpine

WORKDIR /var/www

# Instala dependências
COPY package*.json ./
RUN npm install

# Build
COPY . .

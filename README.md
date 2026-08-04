## Runtime  

# Laravel v 12.12.2 
# PHP 8.2.12 
# Composer 2.9.5 

## Testing tools

# Codesniffer (squizlabs/php_codesniffer)
# PHPLint (overtrue/phplint)


## Infrastructure 

# Vnet with Internet gateway
# Private Subnet (MySQL Database Server)
# Public Subnet  (VM(Nginx container, Laravel API container))

## MySQL Server

# Username: sohaib_usermanagementapi
# Password: Abc123456 

## Commands

# docker compose -f docker-compose.dev.yaml up -d --build
# docker compose -f docker-compose.dev.yaml down
# docker compose -f docker-compose.prod.yaml up -d --build
# docker compose -f docker-compose.prod.yaml down

## .env variables

# APP_ENV=production
# APP_KEY=base64:oXiVsVByUgaUV/+JUgulcI6K0LBP7d75gXyQLwT/fTc=

# MYSQL_ATTR_SSL_CA=/etc/ssl/certs/ca-certificates.crt

# DB_CONNECTION=mysql
# DB_HOST=user-management-db.mysql.database.azure.com
# DB_PORT=3306
# DB_DATABASE=user_management_api
# DB_USERNAME=sohaib_usermanagementapi
# DB_PASSWORD=Abc123456 
# DB_SSLMODE=require

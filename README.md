# Magebit test

Magebit test is a web application

## Installation

Use docker and docker-compose to run app

```bash
docker-compose up -d
```
Compile default stylesheet

```bash
docker-compose exec app /bin/bash

sass View/frontend/css/style.scss media/css/style.css
```
Import database (Outside of container)

```bash
cat magebit.sql | docker exec -i db /usr/bin/mysql -u root --password=password123 magebit
```
## Usage

Use route /?page=index for main page, example: localhost/?page=index

Use route /?page=admin for admin page, example: localhost/?page=admin
# KU New Year 2566
> งานขอบคุณบุคลากร มหาวิทยาลัยเกษตรศาสตร์

# Versions
* 0.0.5
  * First Deploy

# Development setup

## install composer dependencies
``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

## config .env
```bash
cp .env.example .env
```

## alias sail
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail' 
```

## Build container with sail
```bash
sail up -d
```

## SetUP
```bash
sail artisan key:generate
```

## Executing Node / NPM Commands
```bash
sail npm install
sail npm run watch-poll
```

## Migration
```bash
sail artisan migrate
```
## migrate and seed
```bash
sail artisan migrate --seed
```

# Command

* Employee Importer
  * add file `employee.csv` in storage/app/data
  * `sail artisan employee:import <employee.csv>`
* Test Send Email
  * `sail artisan email:send <email>`
  * Command will find email in table employees and send email with link of QR Code
* MQTT Publisher
  * `sail artisan mqtt:publish <topic> <message>`
  * use `kunewyear2566` as `<topic>`

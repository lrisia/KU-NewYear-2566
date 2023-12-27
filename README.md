# KU New Year 2566

> งานขอบคุณบุคลากร มหาวิทยาลัยเกษตรศาสตร์

## Versions
* 2.0.12
  * changes from last meeting
  * separate random from video
  * use redis to manage showing page
  * change video
* 2.0.10
  * search from redis
  * use redis as data cache 
* 2.0.6
  * staff can add new employee
* 2.0.5
  * change typo of halal
* 2.0.2
  * Newyear 2023 version
* 1.0.0
* 0.2.1
  * change some processes from requirement
* 0.1.6
  * entrance and prize
* 0.1.5
  * stop registration before 21 Dec
* 0.1.4
  * import extra employee
* 0.1.3
  * staff view registration stats by organization
* 0.1.2
  * fix invalidate email format
* 0.1.1
  * paginate data with iteration counter
* 0.1.0
  * show registered employee in search result of registration
* 0.0.6
  * First Deploy

## Development setup

### install composer dependencies

``` bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

### config .env

```bash
cp .env.example .env
```

### alias sail

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail' 
```

### Build container with sail

```bash
sail up -d
```

### SetUP

```bash
sail artisan key:generate
```

### Executing Node / NPM Commands

```bash
sail npm install
sail npm run watch-poll
```

### Migration

```bash
sail artisan migrate
```

### migrate and seed

```bash
sail artisan migrate --seed
```

## Command

* Employee Importer
  * add file `employee.csv` in storage/app/data
  * `sail artisan employee:import <employee.csv>`
* Test Send Email
  * `sail artisan email:send <email>`
  * Command will find email in table employees and send email with link of QR Code
* MQTT Publisher
  * `sail artisan mqtt:publish <topic> <message>`
  * use `kunewyear2566` as `<topic>`
* Draw prize
  * `sail artisan prize:draw <prize_id>`
  * Command will draw a prize with given id

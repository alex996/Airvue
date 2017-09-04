# Airvue

> Trip Builder with Laravel 5.5 / Vue.js 2.4

## Installation

``` bash
# 1. Clone the repo
git clone https://github.com/alex996/Airvue /path/to/airvue
cd /path/to/airvue

# 2. Install Composer dependencies
composer install

# 3. Create and configure the .env file
cp .env.example .env
vim .env

# 4. Migrate and seed the database
php artisan migrate --seed

# 5. Serve on localhost:8000
php artisan serve

#6. (Optional) Run the test suite
phpunit
```

## API Endpoints

```
+----------+-----------------------------------+-----------------------+---------+-------------------------+
| Method   | URI                               | Name                  | Action  | Query String Params     |
+----------+-----------------------------------+-----------------------+---------+-------------------------+
| GET|HEAD | api/airports                      | airports.index        | Index	 | name, city, country     |
| GET|HEAD | api/airports/{airport}            | airports.show         | Show    | n/a				  	   |
| GET|HEAD | api/flights                       | flights.index         | Index   | from, to, date, airline |
| GET|HEAD | api/flights/{flight}              | flights.show          | Show    | n/a                     |
| POST     | api/trips                         | trips.store           | Store   | n/a                     |
| GET|HEAD | api/trips/{trip}                  | trips.show            | Show    | n/a                     |
| DELETE   | api/trips/{trip}                  | trips.destroy         | Destroy | n/a                     |
| GET|HEAD | api/trips/{trip}/flights          | trips.flights.index   | Index   | n/a                     |
| POST     | api/trips/{trip}/flights/{flight} | trips.flights.store   | Store   | n/a                     |
| DELETE   | api/trips/{trip}/flights/{flight} | trips.flights.destroy | Destroy | n/a                     |
+----------+-----------------------------------+-----------------------+---------+-------------------------+
```

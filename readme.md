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

## Documentation

### API Endpoints

```
+----------+-----------------------------------+-------------+-----------------------+---------+-------------------------+
| Method   | URI                               | URI Param   | Name                  | Action  | Query String Params     |
+----------+-----------------------------------+-------------|-----------------------+---------+-------------------------+
| GET|HEAD | api/airports                      | n/a         | airports.index        | Index   | name, city, country     |
| GET|HEAD | api/airports/{airport}            | icao        | airports.show         | Show    | n/a                     |
| GET|HEAD | api/flights                       | n/a         | flights.index         | Index   | from, to, date, airline |
| GET|HEAD | api/flights/{flight}              | number      | flights.show          | Show    | n/a                     |
| POST     | api/trips                         | n/a         | trips.store           | Store   | n/a                     |
| GET|HEAD | api/trips/{trip}                  | uid         | trips.show            | Show    | n/a                     |
| DELETE   | api/trips/{trip}                  | uid         | trips.destroy         | Destroy | n/a                     |
| GET|HEAD | api/trips/{trip}/flights          | uid         | trips.flights.index   | Index   | n/a                     |
| POST     | api/trips/{trip}/flights/{flight} | uid, number | trips.flights.store   | Store   | n/a                     |
| DELETE   | api/trips/{trip}/flights/{flight} | uid, number | trips.flights.destroy | Destroy | n/a                     |
+----------+-----------------------------------+-------------|-----------------------+---------+-------------------------+
```

### Example Requests

> Note: it's recommended to set `Content-Type` and `Accept` headers to `application/json`.

```
# List all airports in Paris, France in alphabetical order
GET /api/airports?city=Paris&country=FR

# List Air Canada flights from Montreal to Toronto on Sep. 8 (Note, 'CA' is optional)
GET /api/flights?from=Montreal,CA&to=Toronto,CA&airline=Air Canada&date=2017-09-08

# Make a new trip with no flights
POST /api/trips

# Add flight number 'U9FD21' to the trip with uid of '59adcea256903'
POST /api/trips/59adcea256903/flights/U9FD21

# List all flights for a trip with uid of '59adcea256903'
GET /api/trips/59adcea256903/flights

# Remove flight number 'U9FD21' from the trip with uid of '59adcea256903'
DELETE /api/trips/59adcea256903/flights/U9FD21

# Remove trip with uid of '59adcea256903' and all of its flights
DELETE /api/trips/59adcea256903
```

# Airvue

> Trip Builder with Laravel 5.5 / Vue.js 2.4

## Installation

1) Clone the repo:

```bash
git clone https://github.com/alex996/Airvue /path/to/airvue
cd /path/to/airvue
```

2) Install Composer dependencies:

```bash
composer install
```

3) Create and configure the .env file:

```bash
cp .env.example .env
vim .env
```

4) Generate an application key:

```bash
php artisan key:generate
```

5) Migrate and seed the database:

```bash
php artisan migrate --seed
```

6). (Optional) Serve on localhost:8000:

```bash
php artisan serve
```

## Documentation

### API Endpoints

``` bash
+----------+-----------------------------------+-----------------------+---------+-------------------------+
| Method   | URI                               | Name                  | Action  | Query String Params     |
+----------+-----------------------------------+-----------------------+---------+-------------------------+
| GET|HEAD | api/airports                      | airports.index        | Index   | name, city, country     |
| GET|HEAD | api/airports/{airport}            | airports.show         | Show    | n/a                     |
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

### Example Requests

> **Note**: it's recommended to set `Content-Type` and `Accept` headers to `application/json`.

``` bash
# List all airports in Paris, France in alphabetical order
GET /api/airports?city=Paris&country=FR

# List Air Canada flights from Montreal to Toronto on Sep. 8 (Note, 'CA' is optional)
GET /api/flights?from=Montreal,CA&to=Toronto,CA&airline=Air Canada&date=2017-09-08

# Make a new trip with no flights
POST /api/trips

# Add flight number 'U9FD21' to the trip with uid of '59adcea256903'
POST /api/trips/59adcea256903/flights/U9FD21

# List all flights for the trip with uid of '59adcea256903'
GET /api/trips/59adcea256903/flights

# Remove flight number 'U9FD21' from the trip with uid of '59adcea256903'
DELETE /api/trips/59adcea256903/flights/U9FD21

# Remove the trip with uid of '59adcea256903' and all of its flights
DELETE /api/trips/59adcea256903
```

## Testing

> **Note**: please make sure that the SQLite driver (`php_pdo_sqlite.dll`) is enabled.

The project features integration and unit tests for the core functionalities:

``` bash
# Run the test suite
phpunit
```
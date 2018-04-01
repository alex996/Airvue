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
    vi .env
    ```

4) Generate an application key:

    ```bash
    php artisan key:generate
    ```

5) Migrate and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6) (*Optional*) Serve on localhost:8000:

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


* List all airports in Paris, France in alphabetical order

    ``` bash
    GET /api/airports?city=Paris&country=FR
    ```

* List Air Canada flights from Montreal to Toronto on Sep. 8 (Note, `CA` is optional)

    ```bash
    GET /api/flights?from=Montreal,%20CA&to=Toronto,%20CA&airline=Air%20Canada&date=2017-09-08
    ```

* Make a new trip with no flights

    ```bash
    POST /api/trips
    ```

* Add flight number 'U9FD21' to the trip with uid of '59adcea256903'

    ```bash
    POST /api/trips/59adcea256903/flights/U9FD21
    ```

* List all flights for the trip with uid of '59adcea256903'

    ```bash
    GET /api/trips/59adcea256903/flights
    ```

* Remove flight number 'U9FD21' from the trip with uid of '59adcea256903'

    ```bash
    DELETE /api/trips/59adcea256903/flights/U9FD21
    ```

* Remove the trip with uid of '59adcea256903' and all of its flights

    ```bash
    DELETE /api/trips/59adcea256903
    ```

## Testing

> **Note**: please make sure that the SQLite driver (`php_pdo_sqlite.dll`) is enabled.

The project features integration and unit tests for the core functionalities:

``` bash
# Run the test suite
phpunit
```

## Notes

### Database Seeding

When you run `php artisan migrate --seed`, Laravel will run two seeder classes:

* `AirportsTableSeeder` - reads data from `airports.json` and batch-inserts airport records in chunks of 1000;
* `FlightsTableSeeder` - reads data from `airlines.json` and batch-inserts flight records in chunks of 1000.

Given that there are 28k+ airport records, it would be impractical to generate flights for every possible geo location. Instead, for demonstration purposes, `FlightsTableSeeder` generates random flights for the *10 biggest Canadian cities* with departure dates ranging between *now* and *one month from now* in the future.

### JSON Data Store

Two external sources were used as static data stores:

* [mwgg/Airports](https://github.com/mwgg/Airports) - JSON database of the real-world airports;
* [SkyTrax](http://www.worldairlineawards.com/awards/world_airline_rating.html) - the World's Top 100 Airlines in 2017 list.

The two json files are already included under `/storage/app/aviation`.

# distroless-php Laravel Example

This is an example of a Laravel application running on `distroless-php`.

## Usage

```bash
$ docker compose build --pull
$ docker compose up
```

and open `http://localhost:8931` in your browser.

if you need check the connection to the services, open `http://localhost:8931/test-connections` in your browser.

### CLI

```bash
$ docker compose run cli
$ php artisan app:test-connections
Testing database connections...
- database connection mysql is OK
- database connection pgsql is OK
- database connection sqlite is OK
Testing redis connections...
- redis connection default is OK
- redis connection cache is OK
```

# phpdotenv
phpdotenv is a php environment config classs

## Usage

The `.env` file, eg:
```
name = app

[app]
debug = "true"
trace = "false"

[database]
hostname = 127.0.0.1
database = test
username = abc
password = 123456
hostport = 3306
```

The file `index.php`, eg:
```
Dotenv\Dotenv::load(__DIR__ . "/.env");
```

The config file, eg:
```
define("APP_NAME", Dotenv\Dotenv::get("name"));

define("APP_DEBUG", Dotenv\Dotenv::get("app.debug"));
define("APP_TRACE", Dotenv\Dotenv::get("app.trace"));

$database_config = [
    "hostname" => Dotenv\Dotenv::get("database.hostname"),
    "database" => Dotenv\Dotenv::get("database.database"),
    "username" => Dotenv\Dotenv::get("database.username"),
    "password" => Dotenv\Dotenv::get("database.password"),
    "hostport" => Dotenv\Dotenv::get("database.hostport"),
];
```

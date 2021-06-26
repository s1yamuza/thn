# THN Test Backend Default

[![Generic badge](https://img.shields.io/badge/stable-1.2.0-blue)](https://github.com/s1yamuza/thn)
[![Generic badge](https://img.shields.io/badge/PHP-7.4-purple)](https://github.com/s1yamuza/thn)
[![Generic badge](https://img.shields.io/badge/coverage-100%-green)](https://github.com/s1yamuza/thn)

## Steps to run app

Clone the repository and execute
```
make build
```

After that, just execute
```
make up
```

Your app will be running on 127.0.0.1:80. If you want to run it with a host, just add it to your host file
```
127.0.0.1       local.thn.com
```

If you need to clear cache:
```
make clear-cache
```

## Testing purporses

Run unit tests
```
make test
```

Run unit tests and generate coverage report
```
make test-coverage
```
## Author
Sergio Yamuza Álvarez

# Hirable

Lightweight application for HR manager. Allows users to publish own positions with customizable content and
to recruit candidates on those positions.

## Installation

1. create own `.env` file based on example in the repository.

2. install dependencies using command bellow.

```
composer install
```

3. trigger the app installation command which migrates the DB tables and seeds default data.

```
php artisan app:install
```

4. install CSS and JS dependencies

```
npm install
```

5. bundle CSS and JS files

```
npm run dev
```

6. enjoy 🎉

## Testing

To run tests run the command bellow.

```
php artisan test
```

## Code quality checks

### Larastan (PHPStan)

```
composer run phpstan
```

### PHPLint
```
composer run phplint
```

### PHP CodeSniffer

```
composer run phpcs
```
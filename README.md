# Laravel Repository and Service creator

Simple repository and service file creator for laravel 5+.

[![Latest Version](https://img.shields.io/github/release/Gustavo-RF/repository-create?style=flat-square)](https://github.com/Gustavo-RF/repository-create/releases)
[![Stars](https://img.shields.io/github/stars/Gustavo-RF/repository-create?style=flat-square)](https://github.com/Gustavo-RF/repository-create/stargazers)
[![Total Downloads](https://img.shields.io/packagist/dt/gustavorf/repo-create?style=flat-square)](https://packagist.org/packages/gustavorf/repo-create)


## Installation

Using [composer](https://getcomposer.com):

```bash
composer require gustavorf/repo-create --dev
```

## Laravel version

Laravel 5.5+ supports auto discover for service providers. If your laravel version is 5.4 or lower, you have to add this line inside providers array in `config/app.php`

```php
  'providers' => [
  
    ...
  
    GustavoRF\RepoCreate\RepoCreateServiceProvider::class,
  
  ],
```


## Usage

Open your terminal in your project root and type:

```bash
php artisan repository:create MyRepository
```

This command will create a new Repository Class inside app/Repositories. If app/Repositories folder doesn't exists, it will be created as well.

You can also send a model name using --model option:

```bash
php artisan repository:create MyRepository --model=MyModel
```

This command set MyModel usage in MyRepository class. If MyModel doesn't exists, it will be created.


Similarly, you can create services:

```bash
php artisan service:create MyService
```

```bash
php artisan service:create MyService --model=MyModel
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


## License
[MIT](https://choosealicense.com/licenses/mit/)

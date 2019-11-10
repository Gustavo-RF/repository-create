# Laravel Repository and Service creator

Simple repository and service file creator.

## Installation

Using [composer](https://getcomposer.com):

```bash
composer require gustavorf/repo-create --dev
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

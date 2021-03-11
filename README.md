# Compress laravel logs to a zip file

This package allows you to compress or zip laravel logs with just one command.

## Installation

This package can be used in Laravel 5.5 or higher.

You can install the package via composer:

```bash
composer require ndarproj/laravel-logzip
```

## Usage / Command

To compress all .log files inside the storage/logs folder run:
```bash
php artisan log:zip
```

## Schedule log compression with PM2

Install [pm2](https://github.com/Unitech/pm2) with NPM. You can download NPM [HERE](https://nodejs.org/en/download/)
```bash
npm install pm2 -g
```
Download this [FILE](https://github.com/ndarproj/laravel-logzip/blob/main/logzip.config.js) and place it inside your laravel root folder or create a new file and copy this code
```js
module.exports = {
	apps: [
		{
			name: 'log-zip',
			interpreter: 'php',
			script: 'artisan',
			args: 'log:zip',
			watch: false,
			cron: '0 * * * *', // this would zip your logs hourly
			autorestart: false,
		}
	]
};
```
Update cron field to change the schedule. Reference: https://crontab.guru

To run pm2
```bash
pm2 start logzip.config.js 
#if you created your own file
pm2 start <filename>
```

## Configuration

If you need to change the name or allow deletion after compression, you can modify the config file.

You can publish config file with:

```bash
php artisan vendor:publish --provider="Ndarproj\\Logzip\\LogzipServiceProvider" --tag=config
```
This is the contents of the published config/rotate.php config file:

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Filename
    |--------------------------------------------------------------------------
    |
    | This option defines what should be the compressed logs output filename.
    |
    */
    'log_zip_filename' => 'laravel',

    /*
    |--------------------------------------------------------------------------
    | Compression Enable
    |--------------------------------------------------------------------------
    |
    | This option defines if the logs must be compressed.
    | set value to false to disable
    */
    'log_compress_files' => true,

    /*
    |--------------------------------------------------------------------------
    | Delete Enable
    |--------------------------------------------------------------------------
    |
    | This option defines if the logs should be deleted after being compressed.
    | set value to true to enable
    */
    'log_delete' => true,
];
```

## Contributing

Any contributions are welcome.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

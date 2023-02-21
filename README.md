# WH Mailer

## Installation

You can install the package via composer:

```bash
composer require lalitwebhopers/wh-mailer
```

## Usage

### Add the following code to file "app/config/services.php"

```php
'whmailer' => [
  'url' => env('WHMAILER_URL'),
  'key' => env('WHMAILER_API_KEY')
],
```

### Update the following code to file "app/config/mail.php"

```php
'default' => env('MAIL_MAILER', 'whmailer'),
```

### Add the following code to file "app/config/mail.php"
add the following code inside 'mailers' array.
```php
'whmailer' => [
  'transport' => 'whmailer',
],
```

### Update the file ".env"

```php
MAIL_MAILER='whmailer'
WHMAILER_URL='http://netmail.whdev.in:5000/api/mailer/send-text'
WHMAILER_API_KEY='Your API Key provided by WHMailer'
```

### Update the file "app/config/app.php"
inside 'providers' array comment the default 'MailServiceProvider' & add 'WHMailerServiceProvider'.

```php
'providers' => [
 ...
 // Illuminate\Mail\MailServiceProvider::class,
 Lalitwebhopers\WhMailer\WhMailerServiceProvider::class,
 ...
]
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email lalit.webhopers@gmail.com instead of using the issue tracker.

## Credits

-   [Lalit Kumar](https://github.com/lalitwebhopers)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

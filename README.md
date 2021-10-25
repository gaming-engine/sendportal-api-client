# SendPortal.IO API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gaming-engine/sendportal-api-client.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/sendportal-api-client)
[![Total Downloads](https://img.shields.io/packagist/dt/gaming-engine/sendportal-api-client.svg?style=flat-square)](https://packagist.org/packages/gaming-engine/sendportal-api-client)
![GitHub Actions](https://github.com/gaming-engine/sendportal-api-client/actions/workflows/main.yml/badge.svg)

A simple wrapper around the SendPortal.IO Version 2 API.

## Installation

You can install the package via composer:

```bash
composer require gaming-engine/sendportal-api-client
```

## Usage

This library is best used with a dependency injection library however, it is possible to instantiate is without the use
of one.

You have access to several clients one for each type of endpoint that the API provides. The

The clients are as follows:

* `GamingEngine\SendPortalAPI\Clients\CampaignClient`
* `GamingEngine\SendPortalAPI\Clients\SubscriberClient`
* `GamingEngine\SendPortalAPI\Clients\SubscriberTagClient`
* `GamingEngine\SendPortalAPI\Clients\TagClient`
* `GamingEngine\SendPortalAPI\Clients\TagSubscriberClient`
* `GamingEngine\SendPortalAPI\Clients\TemplateClient`

For more details about the request parameters for the API please refer to
the [documentation](https://sendportal.io/docs/v2/api/introduction).

### Retrieval

```php
use GamingEngine\SendPortalAPI\Clients\ApiClient;
use GamingEngine\SendPortalAPI\Clients\CampaignClient;
use GamingEngine\SendPortalAPI\Http\GuzzleHttpClient;
use GamingEngine\SendPortalAPI\Models\Configuration;
use GuzzleHttp\Client;

require_once './vendor/autoload.php';

$apiClient = new ApiClient(
    new Configuration('https://sendportal.domain.tld', 'bearer-token'),
    new GuzzleHttpClient(
        new Client()
    )
);

$specific = new CampaignClient($apiClient);

var_dump($specific->retrieve());
```

### Create/Update

```php
use GamingEngine\SendPortalAPI\Clients\ApiClient;
use GamingEngine\SendPortalAPI\Clients\CampaignClient;
use GamingEngine\SendPortalAPI\DataTransfer\CampaignDTO;
use GamingEngine\SendPortalAPI\Http\GuzzleHttpClient;
use GamingEngine\SendPortalAPI\Models\Configuration;
use GuzzleHttp\Client;

require_once './vendor/autoload.php';

$apiClient = new ApiClient(
    new Configuration('https://sendportal.domain.tld', 'bearer-token'),
    new GuzzleHttpClient(
        new Client()
    )
);

$specific = new CampaignClient($apiClient);
$dto = new CampaignDTO([
    'name' => 'Hello',
    // All fields
]);

// Provides the newly created campaign
var_dump($specific->create($dto));

// Provides the newly updated campaign
var_dump($specific->update(2, $dto));
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email awjudd@gmail.com instead of using the issue tracker.

## Credits

- [Andrew Judd](https://github.com/gaming-engine)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Data Coder

### A flexible data coder for encoding and decoding formats like JSON, YAML, and more.

---

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sunrise-php/coder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/coder/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sunrise-php/coder/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sunrise-php/coder/?branch=master)
[![Total Downloads](https://poser.pugx.org/sunrise/coder/downloads?format=flat)](https://packagist.org/packages/sunrise/coder)

## Installation

```bash
composer require sunrise/coder
```

## How to use

### Quick start

```php
use Sunrise\Coder\CodecManager;
use Sunrise\Coder\Codec\JsonCodec;
use Sunrise\Coder\Dictionary\MediaType;

$codecManager = new CodecManager(codecs: [
    new JsonCodec(),
]);

// Encoding result: {"foo": "bar"}
$codecManager->encode(MediaType::JSON, ['foo' => 'bar']);

// Decoding result: ['foo' => 'bar']
$codecManager->decode(MediaType::JSON, '{"foo": "bar"}');
```

### PHP-DI definitions

```php
use DI\ContainerBuilder;
use Sunrise\Coder\CodecManagerInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinition(__DIR__ . '/../vendor/sunrise/coder/resources/definitions/coder.php');
$containerBuilder->addDefinition(__DIR__ . '/../vendor/sunrise/coder/resources/definitions/codecs/json_codec.php');

$container = $containerBuilder->build();

// See above for usage examples.
$codecManager = $container->get(CodecManagerInterface::class);
```

## Tests

```bash
composer test
```

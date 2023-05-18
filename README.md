# This is tiktoken-php (yethee/tiktoken) wrapper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mis3085/tiktoken-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mis3085/tiktoken-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mis3085/tiktoken-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mis3085/tiktoken-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mis3085/tiktoken-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mis3085/tiktoken-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mis3085/tiktoken-for-laravel.svg?style=flat-square)](https://packagist.org/packages/mis3085/tiktoken-for-laravel)

Use the "tiktoken-php" package to encode a string to tokens, decode tokens to a string or calculate token usage for OpenAI models in Laravel.

## Installation

You can install the package via composer:

```bash
composer require mis3085/tiktoken-for-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="tiktoken-for-laravel-config"
```

This is the contents of the published config file:

```php
return [
    // Cache folder for vocab files
    'cache_dir' => storage_path('framework/cache/tiktoken'),

    /**
     * The default encoder
     * cl100k_base: gpt-4, gpt-3.5-turbo, text-embedding-ada-002
     * p50k_base: Codex models, text-davinci-002, text-davinci-003
     * r50k_base: text-davinci-001
     */
    'default_encoder' => 'cl100k_base',
];
```

## Usage

```php
use Mis3085\Tiktoken\Facades\Tiktoken;
// or
use Tiktoken;

// Use the default encoder: cl100k_base
Tiktoken::encode('this is a test');
// [ 576, 374, 264, 1296 ]

Tiktoken::encode('測試');
// [ 35086, 105, 50520, 99 ]

// Count tokens
Tiktoken::count('測試');
// 4

// Truncate a string to the specified length of tokens
Tiktoken::limit('this is a test', 2);
// this is
Tiktoken::limit('測試', 2);
// 測
Tiktoken::limit('測試', 1);
// EMPTY STRING

// Decode
Tiktoken::decode([ 35086, 105, 50520, 99 ]);
// 測試

// Change encoder in runtime
Tiktoken::setEncoder('p50k_base');
Tiktoken::encode('this is a test');
// [ 5661, 318, 257, 1332 ]

Tiktoken::setEncoder('p50k_base')->encode('測試');
// [ 162, 116, 105, 164, 102, 99 ]

Tiktoken::setEncoderForModel('text-davinci-003')->encode('測試');
// [ 162, 116, 105, 164, 102, 99 ]
```

## Testing

```bash
composer test
```

## Credits

- [yethee/tiktoken-php](https://github.com/yethee/tiktoken-php)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

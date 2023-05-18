<?php

namespace Mis3085\Tiktoken\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array encode(string $text)
 * @method static int count(string $text)
 * @method static string decode(array $tokens)
 * @method static string limit(string $text, int $limit)
 * @method static static setEncoder(string $encoder)
 * @method static static setEncoderForModel(string $model)
 * @method static static useDefaultEncoder()
 *
 * @see \Mis3085\Tiktoken\Tiktoken
 */
class Tiktoken extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mis3085\Tiktoken\Tiktoken::class;
    }
}

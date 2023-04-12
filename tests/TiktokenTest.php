<?php

use Mis3085\Tiktoken\Facades\Tiktoken;

dataset('cl100k_base', [
    ['this is a test', [576, 374, 264, 1296]],
    ['測試', [35086, 105, 50520, 99]],
]);

dataset('p50k_base', [
    ['this is a test', [5661, 318, 257, 1332]],
    ['測試', [162, 116, 105, 164, 102, 99]],
]);

it('can encode a string to tokens', function (string $text, array $tokens) {
    $results = Tiktoken::encode($text);

    expect($results)->toBe($tokens);
})->with('cl100k_base');

it('can decode tokens to a string', function (string $text, array $tokens) {
    $result = Tiktoken::decode($tokens);

    expect($result)->toBe($text);
})->with('cl100k_base');

it('can count token usage of a string', function (string $text, array $tokens) {
    $results = Tiktoken::count($text);

    expect($results)->toBe(count($tokens));
})->with('cl100k_base');

it('can change encoder and then encode base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoder('p50k_base');

    $results = Tiktoken::encode($text);
    expect($results)->toBe($tokens);
})->with('p50k_base');

it('can change encoder and then count tokens base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoder('p50k_base');

    $result = Tiktoken::count($text);
    expect($result)->toBe(count($tokens));
})->with('p50k_base');

it('can change encoder and then decode tokens base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoder('p50k_base');

    $result = Tiktoken::decode($tokens);
    expect($result)->toBe($text);
})->with('p50k_base');

it('can change encoder for AI model and then encode base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoderForModel('text-davinci-003');

    $results = Tiktoken::encode($text);
    expect($results)->toBe($tokens);
})->with('p50k_base');

it('can change encoder for AI model and then count tokens base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoderForModel('text-davinci-003');

    $result = Tiktoken::count($text);
    expect($result)->toBe(count($tokens));
})->with('p50k_base');

it('can change encoder for AI model and then decode tokens base on it', function (string $text, array $tokens) {
    Tiktoken::setEncoderForModel('text-davinci-003');

    $result = Tiktoken::decode($tokens);
    expect($result)->toBe($text);
})->with('p50k_base');

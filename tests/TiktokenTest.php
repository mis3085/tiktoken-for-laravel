<?php

use Mis3085\Tiktoken\Facades\Tiktoken;

dataset('cl100k_base', [
    ['this is a test', [576, 374, 264, 1296]],
    ['測試', [35086, 105, 50520, 99]],
    ['これはテストです', [85701, 15682, 57933, 71634, 38641]],
]);

dataset('p50k_base', [
    ['this is a test', [5661, 318, 257, 1332]],
    ['測試', [162, 116, 105, 164, 102, 99]],
    ['これはテストです', [46036, 39258, 31676, 24336, 43302, 30640, 33623]],
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

it('can limit token usage of a string', function (string $text, array $tokens) {
    $limit = floor(count($tokens) / 2);
    $newText = Tiktoken::limit($text, $limit);
    $newTokens = Tiktoken::encode($newText);

    expect(count($newTokens))->toBeLessThanOrEqual($limit);
    expect(mb_check_encoding($newText, 'UTF-8'))->toBeTrue();
    expect(mb_strpos($text, $newText))->toBe(0);
    expect(array_intersect($tokens, $newTokens))->toBe($newTokens);
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

it('can change encoder for AI model and then limit token usage of a string', function (string $text, array $tokens) {
    Tiktoken::setEncoderForModel('text-davinci-003');

    $limit = floor(count($tokens) / 2);
    $newText = Tiktoken::limit($text, $limit);
    $newTokens = Tiktoken::encode($newText);

    expect(count($newTokens))->toBeLessThanOrEqual($limit);
    expect(mb_check_encoding($newText, 'UTF-8'))->toBeTrue();
    expect(mb_strpos($text, $newText))->toBe(0);
    expect(array_intersect($tokens, $newTokens))->toBe($newTokens);
})->with('p50k_base');

<?php

namespace Mis3085\Tiktoken;

use Illuminate\Support\Traits\Macroable;
use Yethee\Tiktoken\Encoder;
use Yethee\Tiktoken\EncoderProvider;

class Tiktoken
{
    use Macroable;

    /**
     * @var Encoder
     */
    protected $encoder;

    public function __construct(
        protected EncoderProvider $encoderProvider,
        protected string $defaultEncoder = 'cl100k_base'
    ) {
        $this->useDefaultEncoder();
    }

    public function useDefaultEncoder(): static
    {
        $this->setEncoder($this->defaultEncoder);

        return $this;
    }

    public function setEncoderForModel(string $model): static
    {
        $this->encoder = $this->encoderProvider->getForModel($model);

        return $this;
    }

    public function setEncoder(string $encoder): static
    {
        $this->encoder = $this->encoderProvider->get($encoder);

        return $this;
    }

    public function encode(string $text): array
    {
        return $this->encoder->encode($text);
    }

    public function count(string $text): int
    {
        return count($this->encoder->encode($text));
    }

    public function decode(array $tokens): string
    {
        return $this->encoder->decode($tokens);
    }
}

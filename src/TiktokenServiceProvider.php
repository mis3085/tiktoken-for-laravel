<?php

namespace Mis3085\Tiktoken;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Yethee\Tiktoken\EncoderProvider;

class TiktokenServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tiktoken-for-laravel')
            ->hasConfigFile('tiktoken');
    }

    public function packageRegistered()
    {
        $this->app->singleton(Tiktoken::class, function () {
            $provider = new EncoderProvider();
            $provider->setVocabCache(config('tiktoken.cache_dir'));

            return new Tiktoken($provider, config('tiktoken.default_encoder'));
        });
    }
}

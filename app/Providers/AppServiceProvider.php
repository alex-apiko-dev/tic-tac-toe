<?php

namespace App\Providers;

use App\Adapters\Config\Config as ConfigAdapter;
use App\Adapters\Config\Contracts\Config;
use App\Adapters\Container\Container as ContainerAdapter;
use App\Adapters\Container\Contracts\Container;
use App\Adapters\DataBase\DataBase as DataBaseAdapter;
use App\Adapters\DataBase\Contracts\DataBase;
use App\Adapters\Request\Contracts\Request;
use App\Adapters\Request\Request as RequestAdapter;
use App\Adapters\Response\Contracts\ResponseProvider;
use App\Adapters\Response\ResponseProvider as ResponseAdapter;
use App\Adapters\Translator\Contracts\Translator;
use App\Adapters\Translator\Translator as TranslatorAdapter;
use App\Transformer\FractalTransformer;
use App\Transformer\Contracts\Transformer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Config::class, ConfigAdapter::class);
        $this->app->bind(Container::class, ContainerAdapter::class);
        $this->app->bind(DataBase::class, DataBaseAdapter::class);
        $this->app->bind(ResponseProvider::class, ResponseAdapter::class);
        $this->app->bind(Transformer::class, FractalTransformer::class);
        $this->app->bind(Request::class, RequestAdapter::class);
        $this->app->bind(Translator::class, TranslatorAdapter::class);
    }

    public function boot()
    {
    }
}

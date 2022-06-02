<?php

namespace Quarterloop\MixedContentTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Quarterloop\MixedContentTile\Commands\FetchMixedContentCommand;

class MixedContentTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchMixedContentCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-mixed-content-tile'),
        ], 'dashboard-mixed-content-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-mixed-content-tile');

        Livewire::component('mixed-content-tile', MixedContentTileComponent::class);
    }
}

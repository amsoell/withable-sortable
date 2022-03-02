<?php

namespace Amsoell\WithableSortable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class WithableSortableServiceProvider extends ServiceProvider
{
    public function boot(Request $request)
    {
        Builder::macro('sortable', function ($default = null, $direction = null) use ($request) {
            $sort_parameter = config('withable-sortable.sortable.parameter');
            $sort_default = config('withable-sortable.sortable.default_attribute');
            $direction_parameter = config('withable-sortable.sortable.direction_parameter');
            $direction_default = config('withable-sortable.sortable.default_direction');

            /** @var Builder $this * */
            return $this->orderBy(
                $request->input($sort_parameter, $default ?: $sort_default),
                $request->input($direction_parameter, $direction ?: $direction_default)
            );
        });

        Builder::macro('withable', function ($with = []) use ($request) {
            $with_parameter = config('withable-sortable.withable.parameter');
            /** @var Builder $this * */
            $this->with(Arr::wrap($with));

            $this->with(Arr::wrap($request->input($with_parameter)));

            return $this;
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'withable-sortable');
    }
}

<?php

namespace Vannyvann\Formgroup;

use Illuminate\Support\ServiceProvider;
use Form;
use Vannyvann\Formgroup\ParamParser;

class FormgroupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/formgroup.php' => config_path('formgroup.php'),
            __DIR__.'/views' => resource_path('views/vendor/formgroup'),
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'formgroup');

        $groups = config('formgroup.groups');

        if(is_array($groups)){
            foreach ($groups as $group_name => $group ) {
                foreach ($group['components'] as $name => $options) {

                    $method_name = $group['config']['prefix'] . $name;
                    Form::component($method_name, $options['view'], [
                        'params',
                        'errors' => null,
                        'options' => $options,
                        'config' => $group['config']
                    ]);
                }
            }
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}

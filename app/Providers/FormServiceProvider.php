<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;


class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes' => []]);

         Form::component('modalSeek', 'components.form.modalSeek', ['value' => null, 'form_id_field', 'form_description_field', 'model', 'description_column', 'adc_call' , 'attributes' => []]);

         Form::component('select2', 'components.form.select2', ['name', 'value' => null, 'model', 'description_column', 'is_multiple', 'attributes' => []]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

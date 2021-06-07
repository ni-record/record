<?php

namespace ni\record\Providers ;
use NI\record\Commands\InstallRecord;


use Illuminate\Support\ServiceProvider;
class RecordServiceProvider extends ServiceProvider
{
    public function boot() {
    
    }

    public function register(){
        $this->app->singleton('install.record', function ($app) {
            return new InstallRecord();
        });
   
        $this->commands(['install.record']);
    }
}

?>
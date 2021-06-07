<?php
namespace ni\record\Commands ;

use Illuminate\Console\Command;

class InstallRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Record Screen Video And Audio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $location =  base_path('routes/web.php');
        $openFile = fopen($location, 'a');
        $stringData = "
        Route::group(['prefix'=>'screen'],function(){

        Route::get('view-record','RecordController@index')->name('record.video');
        Route::post('/save','RecordController@Store');
        });
        ";
        fwrite($openFile, $stringData);
        fclose($openFile);

        $assetJs =base_path('public/video.js') ;
        $getJS = file_get_contents('vendor/ni/record/src/Stubs/assets/video.stub');
//        file_put_contents($assetJs, $getJS, FILE_APPEND);
        $openJs = fopen($assetJs,'a');
        fwrite($openJs,$getJS) ;
        fclose($openJs);


        $controller = base_path('app/Http/Controllers/RecordController.php');

        $getController = file_get_contents('vendor/ni/record/src/Stubs/Controller/record.stub');

        $openController  = fopen($controller,'a');
        fwrite($openController,$getController);
        fclose($openController);


        $view = base_path('resources/views/record.blade.php');

        $getView = file_get_contents('vendor/ni/record/src/Stubs/resources/views/record.stub');

        $openView  = fopen($view,'a');
        fwrite($openView,$getView);
        fclose($openView);
    }
}

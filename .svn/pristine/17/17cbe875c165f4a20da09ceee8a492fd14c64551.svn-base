<?php

namespace Sts\PleafCore\Providers;

use Illuminate\Support\ServiceProvider;
use Sts\PleafCore\Commands;
use Log;
use Sts\PleafCore\DefaultSessionUtil;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;

class PackageServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Sts\PleafCore\Commands\CreateBf',
        'Sts\PleafCore\Commands\CreateBasicBf',
        'Sts\PleafCore\Commands\CreateBt',
        'Sts\PleafCore\Commands\CreateModel',
        'Sts\PleafCore\Commands\CreateController',
        'Sts\PleafCore\Commands\CreatePackage',
        'Sts\PleafCore\Commands\CheckInOut',
        'Sts\PleafCore\Commands\GenerateDocument',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Log::info("PleafCore Service Provider activated");

        require __DIR__ . '/../routes.php';
        require __DIR__ . '/../define.php';
        require __DIR__ . '/../blade-extending.php';
        require __DIR__ . '/../custom-validation-rules.php';
        require __DIR__ . '/../lang/validation.php';

        // $this->loadAutoloader(base_path('packages'));

        // Load views
        Log::info("[pleaf-core] Loading views...");
        $this->loadViewsFrom(__DIR__.'/../views', 'pleaf-core');

        // Publish assets
        $this->publishes(
            [
                __DIR__.'/../assets/telerik' => public_path('sts/pleaf-core'),
                __DIR__.'/../assets/default.css' => public_path('css/default.css')
            ], 'pleaf-core');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Log::info("[pleaf-core] Register commands");
        $this->registerCommands();

    }

    private function registerCommands(){
        $this->commands($this->commands);
    }



    /**
     * Require composer's autoload file the packages.
     *
     * @return void
     **/
    protected function loadAutoloader($path)
    {
        $finder = new Finder;
        $files = new Filesystem;
 
        $autoloads = $finder->in($path)->files()->name('autoload.php')->depth('<= 3')->followLinks();
 
        foreach ($autoloads as $file)
        {
            Log::info("Autoload: " . $file->getRealPath());
            $files->requireOnce($file->getRealPath());
        }
    }
}

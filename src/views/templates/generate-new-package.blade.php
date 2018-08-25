namespace {{ $namespace }};

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
    */
    public function boot()
    {
        //
        require __DIR__ . '/../routes.php';

        // Load views
        $this->loadViewsFrom(__DIR__.'/../views', '{{ $name_package }}');

        // Publish assets
        $this->publishes([
        __DIR__.'/../assets' => public_path('sts/{{ $name_package }}')
        ], '{{ $name_package }}');

        // Publish config
        $this->publishes([
        __DIR__.'/../config/pleaf_config.php' => config_path('pleaf_config.php'),
        ], 'pleaf-config');

        // Publish to public folder
        $this->publishes([
        __DIR__.'/../public' => public_path(),
        ], 'pleaf-public');
    }

    /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {

    }
}

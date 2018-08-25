<?php
/**
 * Created by PhpStorm.
 * @author: Widana <widananurazis@gmail.com>
 * Date: 06/04/16
 */

namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class CreatePackage extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:create-package {name?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a New Packages';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){

        $interactive = $this->option("interactive");

        do {

            if($interactive){

                $name_package = $this->ask("What New Name Package ?");

                $namespace = $this->ask("What Namespace Provider ?");

                $location = $this->ask("Where location package ?");

                if($this->confirm("Are you sure [y/N]")){
                    break;
                }
            }

            if(is_null($name_package)){
                $this->error("Name Package is required");
                return;
            }

            if(is_null($namespace)){
                $this->error("Namespace is required");
                return;
            }

            if(is_null($location)){
                $this->error("Name Location is required");
                return;
            }

        } while(true);

        // create name package directory
        $tmp = [
             "tmp_loc"        => ("$location/$name_package"),
             "tmp_loc_src"    => ("$location/$name_package/src"),
             "tmp_loc_assets" => ("$location/$name_package/src/assets"),
             "tmp_loc_assets_js" => ("$location/$name_package/src/assets/js"),
             "tmp_loc_bo"     => ("$location/$name_package/src/BusinessObjects"),
             "tmp_loc_cnf"    => ("$location/$name_package/src/config"),
             "tmp_loc_ctrl"   => ("$location/$name_package/src/Controllers"),
             "tmp_loc_mdl"    => ("$location/$name_package/src/Model"),
             "tmp_loc_prvoid" => ("$location/$name_package/src/Providers"),
             "tmp_loc_pbl"   => ("$location/$name_package/src/public"),
             "tmp_loc_img"   => ("$location/$name_package/src/public/img"),
             "tmp_loc_vws"   => ("$location/$name_package/src/views"),
        ];

        // create name filename
        $tmp_templates = [[
            "path"       => (''.$tmp["tmp_loc_prvoid"].'/'.'PackageServiceProvider.php'),
            "templates"  => view("pleaf-core::templates/generate-new-package",
                [
                    "name_package" => $name_package,
                    "namespace"    => $namespace
                ])
        ],[
            "path"        => (''.$tmp["tmp_loc_src"].'/'.'routes.php'),
            "templates"   => view("pleaf-core::templates/routes"),
        ]];

        if(!file_exists($tmp["tmp_loc"])){

            $this->info("Name Package $name_package has successfully generated. !!!");

            if(count($tmp) > 0){
                foreach($tmp as $key=>$value){
                    mkdir($value);
                    $this->info("$value has successfully generated. !!!");
                }
            }

            if(count($tmp_templates) > 0){
                foreach($tmp_templates as $key=>$value){
                    $this->generateFile($value["path"],$value["templates"]->render());
                    $this->info(''.$value["path"].' has successfully generated. !!!');
                }
            }

            $this->info("Please Added composer.json section autoload . !!!");

        } else {
            $this->error("File Already exists.");
            return;
        }
    }

    private function generateFile ($path, $content){
        $f = fopen($path, "w");
        fwrite($f,"<?php\n\n");
        fwrite($f, $content);
        fclose($f);
    }
}
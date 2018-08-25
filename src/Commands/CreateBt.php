<?php
/**
 * Created by PhpStorm.
 * @author: Widana <widananurazis@gmail.com>
 * Date: 06/04/16
 */

namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class CreateBt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:create-bt {name?} {namespace?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Business Transaction';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $interactive = $this->option("interactive");

        do {

            if($interactive){

                $lastInput = $this->getLastInput();

                $defaultName = "";
                $defaultNamespace = "";
                $defaultLocation = "";

                if(isset($lastInput['create-bt']) && is_array($lastInput['create-bt'])){
                    $defaultName = $lastInput["create-bt"]["name"];
                    $defaultNamespace = $lastInput["create-bt"]["namespace"];
                    $defaultLocation = $lastInput["create-bt"]["location"];
                }

                $name = $this->ask("What is BT Name [$defaultName] ?");

                if($this->confirm("Use last namespace [$defaultNamespace] [y/N]")){
                    $namespace = $defaultNamespace;
                } else {
                    $namespace = $this->ask("What is namespace ?");

                }

                if($this->confirm("Use last location [$defaultLocation] [y/N]")){
                    $location = $defaultLocation;
                } else {
                    $location = $this->ask("Where the output folder ?");

                }

                $this->line("Creating business function");
                $this->info("Name: $name");
                $this->info("Namespace: $namespace");
                $this->info("Location: $location");

                if($this->confirm("Are you sure [y/N]")){
                    break;
                }
            } else {

                $name = $this->argument("name");
                $namespace = $this->argument("namespace");
                $location = $this->argument("location");

                if($name == NULL){
                    $this->error('Name is required');
                    return;
                }
                if($namespace == NULL){
                    $this->error('Namespace is required');
                    return;
                }
                if($location == NULL){
                    $this->error('Location is required');
                    return;
                }

            }
        } while(true);

//         Save last input
        $lastInput['create-bt'] = [
            "name" => $name,
            "namespace" => $namespace,
            "location" => $location
        ];
        $this->updateLastInput( $lastInput );

        $view = view("pleaf-core::templates/create-bt",[
            "namespace" => $namespace,
            "name" => $name
        ]);

        $path = "$location/$name.php";
        $generate = false;

        if(file_exists($path)){
            $this->error("File already exists.");
            if($this->confirm("Overwrite? [y|N]")){
                $generate = true;

            }
        } else {
            $generate = true;
        }

        if($generate){
            $this->generateFile($path, $view->render());
            $this->info("Business Transaction has successfully generated");
            $this->info("File: $path");
        }
    }

    private function getLastInput(){
        // If not exists, initialize empty array
        if(!file_exists(_PLEAF_COMMANDS)){
            $empty = array();
            $f = fopen(_PLEAF_COMMANDS,"w");
            fwrite($f, serialize($empty));
            fclose($f);
        }

        $f = fopen(_PLEAF_COMMANDS,"r");
        $content = fread($f, filesize(_PLEAF_COMMANDS));
        fclose($f);

        return unserialize($content);
    }

    private function updateLastInput( $content ){
        $f = fopen(_PLEAF_COMMANDS,"w");
        fwrite($f, serialize($content));
        fclose($f);
    }

    private function generateFile($path, $content){
    	$f = fopen($path, "w");
    	fwrite($f,"<?php\n\n");
    	fwrite($f, $content);
    	fclose($f);
    }

}

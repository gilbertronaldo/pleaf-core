<?php
/**
 * Created by PhpStorm.
 * @author: Widana <widananurazis@gmail.com>
 * Date: 06/04/16
 */

namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:create-model {name?} {author?} {namespace?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Model';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $interactive = $this->option('interactive');

        do {

            if($interactive){

                $defaultName = "";
                $defaultNamespace = "";
                $defaultAuthor = "";
                $defaultLocation = "";

                $lastInput = $this->getLastInput();

                if(isset($lastInput["create-model"]) && is_array($lastInput["create-model"])){
                    $defaultName = $lastInput["create-model"]["name"];
                    $defaultNamespace = $lastInput["create-model"]["namespace"];
                    $defaultAuthor = $lastInput["create-model"]["author"];
                    $defaultLocation = $lastInput["create-model"]["location"];
                }

                $name = $this->ask("What is Model Name [$defaultName] ?");

                if($this->confirm("Use last namespace [$defaultNamespace] [y/N]")){
                    $namespace = $defaultNamespace;
                } else {
                    $namespace = $this->ask("What is namespace ?");

                }

                if($this->confirm("Use last location [$defaultLocation] [y/N]")){
                    $location = $defaultLocation;
                } else {
                    $location = $this->ask("What is location ?");

                }

                if($this->confirm("Use last author [$defaultAuthor] [y/N]")){
                    $author = $defaultAuthor;
                } else {
                    $author = $this->ask("What is author ?");

                }

                if($this->confirm("Are you sure [y/N]")){
                    break;
                }

            } else {
                $name = $this->argument("name");
                $namespace = $this->argument("namespace");
                $author = $this->argument("author");
                $location = $this->argument("location");

                if($name == NULL){
                    $this->error('Name is required');
                    return;
                }
                if($author == NULL){
                    $this->error('Author is required');
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

        $lastInput['create-model'] = [
            "name" => $name,
            "author" => $author,
            "namespace" => $namespace,
            "location" => $location
        ];

        $this->updateLastInput($lastInput);

        $path = "$location/$name.php";
        $generate = false;

        $view =  view("pleaf-core::templates/create-model",[
            "name" => $name,
            "author" => $author,
            "namespace" => $namespace,
            "location" => $location
        ]);

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
            $this->info("Business Model has successfully generated");
            $this->info("File: $path");
        }

    }

    private function generateFile($path, $content){
        $f = fopen($path, "w");
        fwrite($f,"<?php\n\n");
        fwrite($f, $content);
        fclose($f);
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
}

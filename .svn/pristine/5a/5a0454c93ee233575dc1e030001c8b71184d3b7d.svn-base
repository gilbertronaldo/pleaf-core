<?php
/**
 * Created by PhpStorm.
 * @author: Widana <widananurazis@gmail.com>
 * Date: 12/04/16
 */

namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Sts\PleafCommon\BO\GetTenantList;
use \zpt\anno\Annotations;
use \zpt\anno\AnnotationFactory;
use ReflectionClass;

class GenerateDocument extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:generate-doc {namespace?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Generate Doc BF/BT.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){

        $interactive = $this->option("interactive");

        do {

            if($interactive){

                $lasInput = $this->getLastInput();

                $defaultNamespace = "";
                $defaultLocation = "";

                if(isset($lasInput["generate-document"]) && is_array($lasInput["generate-document"])){
                    $defaultNamespace = $lasInput["generate-document"]["namespace"];
                    $defaultLocation = $lasInput["generate-document"]["location"];
                }

                if(isset($defaultNamespace) && $this->confirm("What is namespace [$defaultNamespace] [y/N]")){
                    $namespace = $defaultNamespace;

                } else {
                    $namespace  = $this->ask("What is namespace ?");
                }

                if(isset($defaultLocation) && $this->confirm("What is location BO [$defaultLocation] [y/N]")){
                    $location  = $defaultLocation;

                } else {
                    $location  = $this->ask("Where is location BO ?");

                }

                $outputFolder = substr(app_path(),0,-3);
                $folderConcat = "$outputFolder/docs";

                if(!file_exists($folderConcat)){
                    mkdir($folderConcat);
                }

                $fileIndex = substr($location,0,-16)."/index.html";

                $filename2 = [];
                foreach (glob("$location/*.php") as $file) {

                    $filename = basename($file, '.php');
                    $filename2[] = $filename;

                }

                $filenameBfBt = [];
                foreach (glob("$location/*.php") as $file) {

                    $filename = basename($file, '.php');
                    $class = $namespace.$filename;
                    $pathToFile = $outputFolder."/docs/".$filename.'.html';

                    $annotations = new Annotations(new ReflectionClass(new $class()));

                    $filenameBfBt[] = $filename;
                    // Rendering view
                    $view = view("pleaf-core::templates/generate-doc",
                        [
                            "nameBfBt"    => $filename,
                            "annotations" => $annotations,
                            "filename"   => $filename2
                        ]);

                    $this->generateFile($pathToFile, $view->render());

                }

                // Rendering view
                $index = view("pleaf-core::templates/index",
                    [
                        "filename"    => $filenameBfBt
                    ]);

                $this->generateFile($fileIndex, $index->render());

            } else {
                    $namespace = $this->argument("namespace");
                    $location = $this->argument("location");
            }


            if(is_null($namespace)){
                $this->error('Namespace is required.');
                return;
            }

            if(is_null($location)){
                $this->error('Location is required.');
                return;
            }

            if($this->confirm("Are you sure [y/N] ?")){
                break;
            }

        } while(true);

        // Save last input
        $lastInput['generate-document'] = [
            "namespace" => $namespace,
            "location" => $location,
        ];
        $this->updateLastInput( $lastInput );

    }

    private function generateFile($path,$content){
        $f = fopen($path, "w");
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
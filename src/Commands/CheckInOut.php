<?php
/**
 * Created by PhpStorm.
 * @author: Widana <widananurazis@gmail.com>
 * Date: 06/04/16
 */

namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use \zpt\anno\Annotations;
use \zpt\anno\AnnotationFactory;
use ReflectionClass;

class CheckInOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:check-info-inout {namespace?} {location?} {--interactive=true}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Annotation in BF/BT';


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
     * @return mixed
     */
    public function handle()
    {

        $interactive = $this->option('interactive');

        do {

            if($interactive) {

                $lasInput = $this->getLastInput();

                $defaultNamespace = "";
                $defaultLocation = "";

                if(isset($lasInput["check-info-inout"]) && is_array($lasInput["check-info-inout"])){
                    $defaultNamespace = $lasInput["check-info-inout"]["namespace"];
                    $defaultLocation = $lasInput["check-info-inout"]["location"];

                }

                if(isset($defaultNamespace) && $this->confirm("What is namespace [$defaultNamespace] [y/N] ?")){
                    $namespace = $defaultNamespace;
                } else {
                    $namespace = $this->ask("What is namespace ?");
                }

                if(isset($defaultLocation) && $this->confirm("What is location BO [$defaultLocation] [y/N] ?")){
                    $path = realpath($defaultLocation);
                } else {
                    $path = realpath($this->ask("Where is Location BO ?"));
                }

                if (file_exists($path)) {

                    $this->pathToFileBO($path,$namespace);

                } else {
                    $this->error("FAIL Location can not be found.");
                    return;
                }
            } else {

                $namespace = $this->argument("namespace");
                $path      = $this->argument("location");

            }

            if(is_null($namespace)){
                $this->error('Namespace is required.');
                return;
            }

            if(is_null($path)){
                $this->error('Location is required.');
                return;
            }

            if($this->confirm("Are you sure [y/N] ?")){
                break;
            }

        } while(true);

            // Save last input
            $lastInput['check-info-inout'] = [
                "namespace" => $namespace,
                "location" => $path
            ];
            $this->updateLastInput( $lastInput );

    }

    private function pathToFileBO($path,$namespace){


        foreach (glob("$path/*.php") as $file)
        {
            $class = basename($file, '.php');
            $classpath = ($namespace.$class);

            $annotations = new Annotations(new ReflectionClass(new $classpath()));

            if(isset($annotations['in'])){
                if(count($annotations['in']) == 1){
                    $this->error("FAIL $classpath @infoIn must be filled.");
                }
                $this->info("OK $classpath @infoIn.");
            } else {
                $this->error("FAIL $classpath there is no @infoIn.");
            }
            if(isset($annotations['out'])) {
                if(count($annotations['out']) == 1){
                    $this->error("FAIL $classpath @infoOut must be filled.");
                }
                $this->info("OK $classpath @infoOut.");
            } else {
                $this->error("FAIL $classpath there is no @infoOut.");

            }
            $this->info("\n");
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

}

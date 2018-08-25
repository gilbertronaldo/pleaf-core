<?php
///**
// * Created by PhpStorm.
// * @author: Widana <widananurazis@gmail.com>
// * Date: 12/04/16
// */
//
//namespace Sts\PleafCore\Commands;
//
//use Illuminate\Console\Command;
//use \zpt\anno\Annotations;
//use \zpt\anno\AnnotationFactory;
//use ReflectionClass;
//
//class GenerateDocument extends Command {
//    /**
//     * The name and signature of the console command.
//     *
//     * @var string
//     */
//    protected $signature = 'pleaf:generate-doc {namespace?} {location?} {--interactive=true}';
//
//    /**
//     * The console command description.
//     *
//     * @var string
//     */
//    protected $description = 'Create a Generate Doc BF/BT.';
//
//    /**
//     * Execute the console command.
//     *
//     * @return mixed
//     */
//    public function handle(){
//
//        $interactive = $this->option("interactive");
//
//        do {
//
//            if($interactive){
//
//                $lasInput = $this->getLastInput();
//
//                $defaultNamespace = "";
//                $defaultLocation = "";
//
//                if(isset($lasInput["generate-document"]) && is_array($lasInput["generate-document"])){
//                    $defaultNamespace = $lasInput["generate-document"]["namespace"];
//                    $defaultLocation = $lasInput["generate-document"]["location"];
//                }
//
//                if(isset($defaultNamespace) && $this->confirm("What is namespace [$defaultNamespace] [y/N]")){
//                    $namespace = $defaultNamespace;
//
//                } else {
//                    $namespace  = $this->ask("What is namespace ?");
//                }
//
//                if(isset($defaultLocation) && $this->confirm("What is location BO [$defaultLocation] [y/N]")){
//                    $location  = $defaultLocation;
//
//                } else {
//                    $location  = $this->ask("Where is location BO ?");
//
//                }
//
//                $outputFolder = substr(app_path(),0,-3);
//                $folderConcat = "$outputFolder/docs";
//
//                if(!file_exists($folderConcat)){
//                    mkdir($folderConcat);
//                }
//
//                $fileIndex = fopen(substr($location,0,-16)."/index.html","w");
//
//                foreach (glob("$location/*.php") as $file) {
//
//                    $filename = basename($file, '.php');
//                    $class = $namespace.$filename;
//                    $pathToFile = $outputFolder."/docs/".$filename.'.html';
//                    $fileOpen = fopen("$pathToFile","w");
//
//                    if(file_exists($pathToFile)){
//
//                        $annotations = new Annotations(new ReflectionClass(new $class()));
//
//                        if(isset($annotations['in'])){
//                            if(count($annotations['in']) != 1){
//                                fwrite($fileOpen, "Info In\n <br>");
//                                fwrite($fileOpen, "<ul>");
//
//                                foreach($annotations['in'] AS $value){
//                                    fwrite($fileOpen, "<li>");
//                                    fwrite($fileOpen, "$value\n");
//                                    fwrite($fileOpen, "</li>");
//                                }
//
//                                fwrite($fileOpen, "</ul>");
//                            }
//                        }
//
//                        fwrite($fileOpen, "<br>");
//
//                        if(isset($annotations['out'])){
//                            if(count($annotations['in']) != 1){
//                                fwrite($fileOpen, "Info Out\n <br>");
//                                fwrite($fileOpen, "<ul>");
//
//                                foreach($annotations['out'] AS $value) {
//                                    fwrite($fileOpen, "<li>");
//                                    fwrite($fileOpen, "$value\n");
//                                    fwrite($fileOpen, "</li>");
//                                }
//
//                                fwrite($fileOpen, "</ul>");
//                            }
//                        }
//
//                        fwrite($fileIndex,"<a href='../../../../docs/$filename.html'> $filename</a> \n <br> ");
//                    }
//                }
//
//                } else {
//                    $namespace = $this->argument("namespace");
//                    $location = $this->argument("location");
//            }
//
//
//            if(is_null($namespace)){
//                $this->error('Namespace is required.');
//                return;
//            }
//
//            if(is_null($location)){
//                $this->error('Location is required.');
//                return;
//            }
//
//            if($this->confirm("Are you sure [y/N] ?")){
//                break;
//            }
//
//        } while(true);
//
//        // Save last input
//        $lastInput['generate-document'] = [
//            "namespace" => $namespace,
//            "location" => $location,
//        ];
//        $this->updateLastInput( $lastInput );
//
//    }
//
//    private function getLastInput(){
//        // If not exists, initialize empty array
//        if(!file_exists(_PLEAF_COMMANDS)){
//            $empty = array();
//            $f = fopen(_PLEAF_COMMANDS,"w");
//            fwrite($f, serialize($empty));
//            fclose($f);
//        }
//
//        $f = fopen(_PLEAF_COMMANDS,"r");
//        $content = fread($f, filesize(_PLEAF_COMMANDS));
//        fclose($f);
//
//        return unserialize($content);
//    }
//
//    private function updateLastInput( $content ){
//        $f = fopen(_PLEAF_COMMANDS,"w");
//        fwrite($f, serialize($content));
//        fclose($f);
//    }
//
//}
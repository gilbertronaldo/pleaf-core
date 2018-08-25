<?php
namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use camelCase;

class CreateBasicBf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:create-basic-bf {name?} {namespace?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Basic Business Function';

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
	            // Ask arguments
	            $lastInput = $this->getLastInput();

	            $defaultBfType = '';
                $defaultModel = '';
                $defaultNamespace = '';
                $defaultAuthor = '';
                $defaultLocation = '';
                $defaultIndex = '';

	            if(isset($lastInput['create-basic-bf']) && is_array($lastInput['create-basic-bf'])){
                    $defaultBfType = $lastInput['create-basic-bf']['type'];
                    $defaultIndex = $lastInput['create-basic-bf']['index'];
	            	$defaultModel = $lastInput['create-basic-bf']['model'];
                    $defaultNamespace = $lastInput['create-basic-bf']['namespace'];
                    $defaultNamespaceBo = $lastInput['create-basic-bf']['namespaceBo'];
                    $defaultAuthor = $lastInput['create-basic-bf']['author'];
	            	$defaultLocation = $lastInput['create-basic-bf']['location'];
	            }

	            $type = $this->ask("Option list : \n 1. FindById, IsExistById, ValExistById\n 2.FindByIndex, IsExistByIndex, ValExistByIndex\n\nChoose BF type (1/2) ? ", $defaultBfType);

                if($type != 1 && $type !=2) {
                    $this->error('Please choose 1 or 2');
                    return;
                }

                if($type == 2) {
                    if(isset($defaultIndex) && !is_null($defaultIndex) && $this->confirm("Use last Index ($defaultIndex) [y/N] ?")){
                            $index = $defaultIndex;
                    } else {
                            $index = $this->ask("Please input your index ? ");
                    }
                }

            	if(isset($defaultModel) && $this->confirm("Use last models ($defaultModel) [y/N] ?")){
	            		$model = $defaultModel;
            	} else {
	            		$model = $this->ask("What is the model name ? ");
            	}

                if(isset($defaultModel) && $this->confirm("Use last namespace Model ($defaultNamespace) [y/N] ?")){
                    $namespaceModel = $defaultNamespace;
                } else {
                    $namespaceModel = $this->ask("What is the namespace Model ? ");
                }

                if(isset($defaultNamespaceBo) && $this->confirm("Use last namespace Business Object ($defaultNamespaceBo) [y/N] ?")){
                    $namespaceBo = $defaultNamespaceBo;
                } else {
                    $namespaceBo = $this->ask("What is the namespace Business Object ? ");
                }

                if (!class_exists("$namespaceModel\\".$model)) {
                    $this->error('Model '.$model.' Does not exists');
                    return;
                } else {

                    if ($type == 1) {
                        $modelClassName = "$namespaceModel\\".$model;
                        $objModel = new $modelClassName();
                        if ($this->confirm("Use id by primary key (".$objModel->getKeyName().") [y/N] ?")) {
                            $primaryKey = $objModel->getKeyName();
                        } else {
                            $primaryKey = $this->ask("Please insert your table id ");
                        }
                    }
                }

                if(isset($defaultAuthor) && $this->confirm("Use last author ($defaultAuthor) [y/N] ?")){
                        $author = $defaultAuthor;
                } else {
                        $author = $this->ask("Please input your name ? ");
                }

            	if(isset($defaultModel) && $this->confirm("Use last folder location ($defaultLocation) [y/N] ?")){
	            		$location = $defaultLocation;
            	} else {
                		$location = $this->ask("Where the output folder ? ");
	           	}

	        } else {
                $type = $this->argument('type');
                $model = $this->argument('model');
                $index = $this->argument('index');
                $namespaceModel = $this->argument('namespace');
                $namespaceBo = $this->argument('namespaceBo');
                $author = $this->argument('author');
	            $location = $this->argument('location');
	        }

	        if($type == NULL){
	            $this->error('Type BF is required');
	            return;
	        } else if($type != 1 && $type !=2) {
                $this->error('Please choose 1 or 2');
                return;
            }
            if($type == 2 && $index == NULL){
                $this->error('Index is required');
                return;
            }
            if($model == NULL){
                $this->error('Model is required');
                return;
            }

            if($namespaceModel == NULL){
                $this->error('Namespace Model is required');
                return;
            }

            if($namespaceBo == NULL){
                $this->error('Namespace Business Object is required');
                return;
            }

            if($author == NULL){
                $this->error('Author is required');
                return;
            }
	        if($location == NULL){
	            $this->error('Location is required');
	            return;
	        }

	        $this->line("Creating basic business function");

            if ($type == 1) {
	        $this->info("Name: Find".$model."ById, Is".$model."ById, Val".$model."ById");
            } else if ($type == 2) {
            $this->info("Name: Find".$model."ByIndex, Is".$model."ByIndex, Val".$model."ByIndex");
            }
            $this->info("Model: $model");
            $this->info("Namespace: $namespaceBo");
            $this->info("Author: $author");
	        $this->info("Location: $location");

	        if($this->confirm("Are you sure [y/N] ?")){
	            break;
	        }
        }while(true);



        // Save last input
        $lastInput['create-basic-bf'] = [
                                    "type" => $type,
                                    "model" => $model,
                                    "index" => (isset($index))?$index:NULL,
                                    "namespace" => $namespaceModel,
                                    "namespaceBo" => $namespaceBo,
                                    "author" => $author,
                                    "location" => $location
                                   ];
		$this->updateLastInput( $lastInput );

        if ($type == 1) {
            $basicBf = [
                "Find".$model."ById",
                "Is".$model."ById",
                "Val".$model."ById"
                ];
            $bfType = "Id";
            $param = $primaryKey;

            $paramKeyValue = $this->generateParamKeyValue($primaryKey, "id");
            $condition = $this->generateCondition($primaryKey, "id");

        } else if ($type == 2) {
            $basicBf = [
                "Find".$model."ByIndex",
                "Is".$model."ByIndex",
                "Val".$model."ByIndex"
                ];
            $bfType = "Index";

            $strReplace = preg_replace('/\s+/S', "", $index);
            $param = str_replace(",",".\", \". $","$strReplace");

            $paramKeyValue = $this->generateParamKeyValue($index, "index");

            $condition = $this->generateCondition($index, "index");
        }

        foreach ($basicBf as $name) {

            if ($name == "Find".$model."ById" || $name == "Find".$model."ByIndex") {
                $template = "pleaf-core::templates/create-basic-bf-find";
            } else if ($name == "Is".$model."ById" || $name == "Is".$model."ByIndex") {
                $template = "pleaf-core::templates/create-basic-bf-is";
            } else if ($name == "Val".$model."ById" || $name == "Val".$model."ByIndex") {
                $template = "pleaf-core::templates/create-basic-bf-val";
            }

            // Rendering view
            $view = view($template,
            	 [
                    "name" => $name,
                    "author" => $author,
                    "date" => date('l, j F Y h:i:s A'),
                    "namespace" => $namespaceBo,
                    "paramKeyValue" => $paramKeyValue,
            	 	"varOutput" => strtolower($model),
            	 	"varOutputIndex" => lcfirst($model),
                    "model" => $model,
                    "condition" => $condition,
                    "modelForMessage" => ucfirst(str_replace('_', ' ', snake_case($model))),
                    "bfType" => $bfType,
                    "param" => '$'.$param
            	 ]);

            // Set the path
            $path = "$location/$name.php";
            $generate = false;

            if(file_exists($path)){
            	$this->error('File already exists');
    			if ($this->confirm('Overwrite? [y|N]')) {
    	    		$generate = true;
    			}
            } else {
            	$generate = true;
            }

            // Generate the file
            if($generate){
            	$this->generateFile($path, $view->render());
                $this->info("Basic Business function has successfully generated");
                $this->info("File: $path");
            }
        }
    }

    private function generateParamKeyValue($paramKeyValue, $type) {

        $result = "";

        if (strtolower($type) == "id"){
            $result = '$'.$paramKeyValue.' = $dto["'.$paramKeyValue.'"]; ';
        } else if (strtolower($type) == "index") {

            $index = preg_replace('/\s+/S', "", $paramKeyValue);
            $arrayIndex = explode(",",$index);

            foreach ($arrayIndex as $value) {
                $result = $result."$".$value.' = $dto["'.$value."\"]; \n\t\t";
            }

        }

        return $result;
    }

    private function generateCondition($paramKeyValue, $type) {

        $result = "";

        if (strtolower($type) == "id"){
            $result = 'where("'.$paramKeyValue.'", $'.$paramKeyValue.')->';
        } else if (strtolower($type) == "index") {

            $index = preg_replace('/\s+/S', "", $paramKeyValue);
            $arrayIndex = explode(",",$index);

            foreach ($arrayIndex as $value) {
                $result = $result.'where("'.$value.'", $'.$value.')->';
            }

        }

        return $result;
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

    private function generateFile ($path, $content){
    	$f = fopen($path, "w");
    	fwrite($f,"<?php\n\n");
    	fwrite($f, $content);
    	fclose($f);
    }
}

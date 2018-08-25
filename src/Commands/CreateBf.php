<?php
namespace Sts\PleafCore\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;


class CreateBf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pleaf:create-bf {name?} {namespace?} {location?} {--interactive=true}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Business Function';

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
	            
	            $defaultName = '';
	            $defaultNamespace = '';
	            $defaultLocation = '';

	            if(isset($lastInput['create-bf']) && is_array($lastInput['create-bf'])){
	            	$defaultName = $lastInput['create-bf']['name'];
	            	$defaultNamespace = $lastInput['create-bf']['namespace'];
	            	$defaultLocation = $lastInput['create-bf']['location'];
	            }

	            $name = $this->ask("What is BF name [$defaultName] ? ");

            	if($this->confirm("Use last namespace ($defaultNamespace) [y/N] ?")){
	            		$namespace = $defaultNamespace;
            	} else {
	            		$namespace = $this->ask("What is the namespace ? ");		
            	}	
            	if($this->confirm("Use last folder location ($defaultLocation) [y/N] ?")){
	            		$location = $defaultLocation;
            	} else {
                		$location = $this->ask("Where the output folder ? ");
	           	}

	        } else {
	            $name = $this->argument('name');
	            $namespace = $this->argument('namespace');
	            $location = $this->argument('location');
	        }

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

	        $this->line("Creating business function");
	        $this->info("Name: $name");
	        $this->info("Namespace: $namespace");
	        $this->info("Location: $location");

	        if($this->confirm("Are you sure [y/N] ?")){
	            break;
	        }
        }while(true);



        // Save last input
        $lastInput['create-bf'] = [ 
                                    "name" => $name,
                                    "namespace" => $namespace,
                                    "location" => $location
                                   ];
		$this->updateLastInput( $lastInput );



        // Rendering view
        $view = view("pleaf-core::templates/create-bf",
        	 [
        	 	"name" => $name,
        	 	"namespace" => $namespace,
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
            $this->info("Business function has successfully generated");
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

    private function generateFile ($path, $content){
    	$f = fopen($path, "w");
    	fwrite($f,"<?php\n\n");
    	fwrite($f, $content);
    	fclose($f);
    }
}

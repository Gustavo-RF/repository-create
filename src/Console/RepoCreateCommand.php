<?php

namespace GustavoRF\RepoCreate\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class RepoCreateCommand extends Command
{
	protected $namespace = 'App\\Repositories';
	protected $modelNamespace = 'App\\';

	protected $signature = 'repository:create {fullpath : The name of the class} {--model= : Create a model}';

	/**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository file inside app/Repositories';

	public function __construct(Filesystem $files)
	{
		parent::__construct();

		$this->files = $files;
	}

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
		$filename = trim($this->argument('fullpath'));

		if($this->option('model')) {
			$this->handleModel($this->option('model'));
		}

		$exploded = explode('/', $filename);

		$namespace = trim(implode('\\', array_slice($exploded, 0, -1)), '\\');
		$fullpath = str_replace('\\','/',$namespace);
		$classname = array_slice($exploded,-1);

		if($namespace != "") $this->namespace .='\\'.$namespace;
		
		if (!is_dir('app/Repositories/'.$fullpath)) {
			mkdir('app/Repositories/'.$fullpath, 0777, true);
		}

		$this->files->put('app/Repositories/'.$fullpath.'/'.$classname[0].'.php', $this->buildClass($classname[0]));
		$this->info('Repository created successfully.');
	}

	protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceModel($stub, $this->modelNamespace)->replaceClass($stub, $name);
        
	}

	protected function getStub()
    {
        return __DIR__.'/stubs/repo.stub';
	}
	
	protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace'],
            [$this->namespace],
            $stub
        );

        return $this;
	}

	protected function replaceModel(&$stub, $name)
    {
		if($this->option('model')) {
			$stub = str_replace(
				['use DummyModel'],
				['use '.$name],
				$stub
			);
		}
		else {
			$stub = str_replace(
				['use DummyModel;'],
				[''],
				$stub
			);
		}

        return $this;
	}
	
	protected function replaceClass($stub, $name)
    {
        return str_replace('DummyClass', $name, $stub);
	}
	
	protected function handleModel($model) {
		$this->call('make:model',[
			'name' => "{$model}",
		]);

		$this->modelNamespace .= str_replace('/','\\',$model);
	}
}
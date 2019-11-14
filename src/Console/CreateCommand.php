<?php

namespace GustavoRF\RepoCreate\Console;

use Illuminate\Console\GeneratorCommand;

abstract class CreateCommandClass extends GeneratorCommand
{
	protected $modelNamespace = 'App\\';
	protected $className;

    public function handle()
    {
		$filename = trim($this->argument('fullpath'));

		if($this->files->exists($this->directoryPath.'/'.$filename.'.php')) {
			$this->error($this->type.' already exists!');
			return false;
		}

		$this->splitNamespace();

		if (!is_dir($this->directoryPath)) {
			mkdir($this->directoryPath, 0777, true);
		}

		if($this->option('model')) {
			$this->handleModel($this->option('model'));
		}

		$this->files->put($this->directoryPath.'/'.$this->className.'.php', $this->buildClass($this->className));
		$this->info('Repository created successfully.');
	}
	
	/**
	 * Split namespace and class name from given filename option
	 * 
	 * @return void
	 */
	protected function splitNamespace()
	{
		$filename = trim($this->argument('fullpath'));
		$exploded = explode('/', $filename);

		$namespace = trim(implode('\\', array_slice($exploded, 0, -1)), '\\');
		$this->className = array_slice($exploded,-1)[0];

		$this->directoryPath .= str_replace('\\','/',$namespace);

		if($namespace != "") $this->namespace .='\\'.$namespace;
	}

	/**
	 * Handle option --model, calling laravel make:model
	 * 
	 * @return void
	 */
	protected function handleModel($model) {
		$this->call('make:model',[
			'name' => "{$model}",
		]);

		$this->modelNamespace .= str_replace('/','\\',$model);
	}

	/**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
	protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceModel($stub, $this->modelNamespace)->replaceClass($stub, $name);
	}
	
	/**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
	protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(['DummyNamespace'],[$this->namespace],$stub);

        return $this;
	}

	/**
     * Replace the class name for the given stub, if has options --model
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
	protected function replaceModel(&$stub, $name)
    {
		if($this->option('model')) {
			$stub = str_replace(['use DummyModel'],['use '.$name],$stub);
		}
		else {
			$stub = str_replace(['use DummyModel;'],[''],$stub);
		}

        return $this;
	}
	
	/**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
	protected function replaceClass($stub, $name)
    {
        return str_replace('DummyClass', $name, $stub);
	}
}
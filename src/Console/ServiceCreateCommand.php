<?php

namespace GustavoRF\RepoCreate\Console;

class ServiceCreateCommand extends CreateCommandClass
{
    /**
	 * Repository root path
	 * 
	 * @var string
	 */
	protected $namespace = 'App\\Services';

	/**
	 * Command signature
	 * 
	 * @var string
	 */
	protected $signature = 'service:create {fullpath : The name of the class} {--model= : Create a model}';

	/**
	 * Command description
	 * 
	 * @var string
	 */
	protected $description = 'Create a service file inside app/Services';

	/**
	 * File type used in parent class
	 * 
	 * @var string
	 */
	protected $type = 'Service';

	/**
	 * Root directory
	 * 
	 * @var string
	 */
	protected $directoryPath = 'app/Services/';

	/**
     * Get the stub file for the generator.
     *
     * @return string
     */
	protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
	}
}
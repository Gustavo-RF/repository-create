<?php

namespace GustavoRF\RepoCreate\Console;

class RepoCreateCommand extends CreateCommandClass
{
	/**
	 * Repository root path
	 * 
	 * @var string
	 */
	protected $namespace = 'App\\Repositories';

	/**
	 * Command signature
	 * 
	 * @var string
	 */
	protected $signature = 'repository:create {fullpath : The name of the class} {--model= : Create a model}';

	/**
	 * Command description
	 * 
	 * @var string
	 */
	protected $description = 'Create a repository file inside app/Repositories';

	/**
	 * File type used in parent class
	 * 
	 * @var string
	 */
	protected $type = 'Repository';

	/**
	 * Root directory
	 * 
	 * @var string
	 */
	protected $directoryPath = 'app/Repositories/';

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
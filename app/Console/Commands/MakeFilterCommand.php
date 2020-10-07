<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeFilterCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:filter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model filter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'BaseFilter';

    /**
     * @return string
     */
    protected function getStub()
    {
        return app_path('Console/Stubs/filter.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Filters';
    }
}

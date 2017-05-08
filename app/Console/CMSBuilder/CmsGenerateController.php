<?php

namespace App\Console\Commands\CMSBuilder;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CmsGenerateController extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:generate:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new resource controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers\Admin';
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $crudName = strtolower($this->option('crud-name'));
        $crudNameCap = $this->option('crud-name');
        $crudNamePlural = str_plural(strtolower($crudName));
        $crudNamePluralCap = str_plural($crudNameCap);
        $crudNameSingular = str_singular($crudName);

        $filePathDeclarations = $this->option('file-path-declarations');
        $filePathValues = $this->option('file-path-values');
        $fileSaveFunctionality = $this->option('file-save-functionality');

        $relationshipDataFetchers = $this->option('relationship-data-fetchers');;
        $relationshipDataIncludes = $this->option('relationship-data-includes');;

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceCrudName($stub, $crudName)
            ->replaceCrudNameCap($stub, $crudNameCap)
            ->replaceCrudNamePlural($stub, $crudNamePlural)
            ->replaceCrudNamePluralCap($stub, $crudNamePluralCap)
            ->replaceCrudNameSingular($stub, $crudNameSingular)
            ->replaceFilePathDeclarations($stub, $filePathDeclarations)
            ->replaceFilePathValues($stub, $filePathValues)
            ->replaceFileSaveFunctionality($stub, $fileSaveFunctionality)
            ->replaceRelationshipDataFetchers($stub, $relationshipDataFetchers)
            ->replaceRelationshipDataIncludes($stub, $relationshipDataIncludes)
            ->replaceClass($stub, $name);
    }

    /**
     * Replace the crudName for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceCrudName(&$stub, $crudName)
    {
        $stub = str_replace(
            '{{crudName}}', $crudName, $stub
        );

        return $this;
    }

    /**
     * Replace the crudNameCap for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceCrudNameCap(&$stub, $crudNameCap)
    {
        $stub = str_replace(
            '{{crudNameCap}}', $crudNameCap, $stub
        );

        return $this;
    }

    /**
     * Replace the crudNamePlural for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceCrudNamePlural(&$stub, $crudNamePlural)
    {
        $stub = str_replace(
            '{{crudNamePlural}}', $crudNamePlural, $stub
        );

        return $this;
    }

    /**
     * Replace the crudNamePluralCap for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceCrudNamePluralCap(&$stub, $crudNamePluralCap)
    {
        $stub = str_replace(
            '{{crudNamePluralCap}}', $crudNamePluralCap, $stub
        );

        return $this;
    }

    /**
     * Replace the crudNameSingular for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceCrudNameSingular(&$stub, $crudNameSingular)
    {
        $stub = str_replace(
            '{{crudNameSingular}}', $crudNameSingular, $stub
        );

        return $this;
    }

    /**
     * Replace the filePathDeclarations for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceFilePathDeclarations(&$stub, $filePathDeclarations)
    {
        $stub = str_replace(
            '{{filePathDeclarations}}', $filePathDeclarations, $stub
        );

        return $this;
    }

    /**
     * Replace the filePathValues for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceFilePathValues(&$stub, $filePathValues)
    {
        $stub = str_replace(
            '{{filePathValues}}', $filePathValues, $stub
        );

        return $this;
    }

    protected function replaceFileSaveFunctionality(&$stub, $fileSaveFunctionality)
    {
        $stub = str_replace(
            '{{fileSaveFunctionality}}', $fileSaveFunctionality, $stub
        );

        return $this;
    }

    protected function replaceRelationshipDataFetchers(&$stub, $relationshipDataFetchers)
    {
        $stub = str_replace(
            '{{relationshipDataFetchers}}', $relationshipDataFetchers, $stub
        );

        return $this;
    }

    protected function replaceRelationshipDataIncludes(&$stub, $relationshipDataIncludes)
    {
        $stub = str_replace(
            '{{relationshipDataIncludes}}', $relationshipDataIncludes, $stub
        );

        return $this;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['crud-name', null, InputOption::VALUE_REQUIRED, 'The crud name.', null],
            ['file-path-declarations', null, InputOption::VALUE_REQUIRED, 'The file path variable declarations.', null],
            ['file-path-values', null, InputOption::VALUE_REQUIRED, 'The file path values.', null],
            ['file-save-functionality', null, InputOption::VALUE_REQUIRED, 'The file save functions.', null],
            ['relationship-data-fetchers', null, InputOption::VALUE_REQUIRED, 'The relationship data fetcher functions.', null],
            ['relationship-data-includes', null, InputOption::VALUE_REQUIRED, 'The relationship data include functions.', null],
        ];
    }
}

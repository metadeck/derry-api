<?php

namespace App\Console\Commands\CMSBuilder;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CmsGenerateMigration extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cms:generate:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/migration.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);
        $datePrefix = date('Y_m_d_His');
        return database_path('/migrations/') . $datePrefix . '_create_' . $name . '_table.php';
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
        $tableName = strtolower($this->getNameInput());

        $className = 'Create' . ucwords($this->getNameInput()) . 'Table';

        if(strpos($className, '_') !== true){
            $pieces  = explode('_', $tableName);
            $newname = implode('', $pieces);

            $className = 'Create' . ucwords($newname) . 'Table';
        }

        $schema = $this->option('schema');
        $fields = explode(',', $schema);

        $data = array();
        $x = 0;
        foreach ($fields as $field) {
            $array = explode(':', $field);
            $data[$x]['name'] = trim($array[0]);
            $data[$x]['type'] = trim($array[1]);
            $x++;
        }

        $schemaFields = '';
        foreach ($data as $item) {
            if ($item['type'] == 'string' || $item['type'] == 'file') {
                $schemaFields .= "\$table->string('" . $item['name'] . "');\n\t\t\t";
            } elseif ($item['type'] == 'text') {
                $schemaFields .= "\$table->text('" . $item['name'] . "');\n\t\t\t";
            } elseif ($item['type'] == 'integer') {
                $schemaFields .= "\$table->integer('" . $item['name'] . "');\n\t\t\t";
            } elseif ($item['type'] == 'date') {
                $schemaFields .= "\$table->timestamp('" . $item['name'] . "');\n\t\t\t";
            } elseif ($item['type'] == 'decimal') {
                $schemaFields .= "\$table->decimal('" . $item['name'] . "');\n\t\t\t";
            } elseif ($item['type'] == 'boolean') {
                $schemaFields .= "\$table->boolean('" . $item['name'] . "');\n\t\t\t";
            } else {
                $schemaFields .= "\$table->string('" . $item['name'] . "');\n\t\t\t";
            }
        }

        $schemaUp = "
            Schema::create('" . $tableName . "', function(Blueprint \$table)
            {
            \t\$table->increments('id');
            \t" . $schemaFields . "
            \t\$table->timestamps();
            });
            ";

        $schemaDown = "Schema::drop('" . $tableName . "');";
        return $this->replaceSchemaUp($stub, $schemaUp)->replaceSchemaDown($stub, $schemaDown)->replaceClass($stub, $className);
    }

    /**
     * Replace the schema_up for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceSchemaUp(&$stub, $schemaUp)
    {
        $stub = str_replace(
            '{{schema_up}}', $schemaUp, $stub
        );

        return $this;
    }

    /**
     * Replace the schema_down for the given stub.
     *
     * @param  string  $stub
     * @return $this
     */
    protected function replaceSchemaDown(&$stub, $schemaDown)
    {
        $stub = str_replace(
            '{{schema_down}}', $schemaDown, $stub
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
            ['schema', null, InputOption::VALUE_REQUIRED, 'The schema name.', null],
        ];
    }
}

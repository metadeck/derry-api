<?php

namespace App\Console\Commands\CMSBuilder;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CmsFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:json {jsonfile} {--all} {--controller} {--migration} {--model} {--view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a cms from a json file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jsonFile = __DIR__ . '/' . $this->argument('jsonfile');

        if(file_exists($jsonFile)){
            // read in cms.json
            $strJson = file_get_contents($jsonFile);
            $arrJson = json_decode($strJson);

            $options = $this->option();

            // loop over cmsItems array building array of fields/types
            foreach($arrJson->cms as $cmsItem) {

                if ($options["all"]) {

                    $this->info("Building migrations, models, views and controllers ...");
                    $this->buildMigration($cmsItem);
                    $this->buildModel($cmsItem);
                    $this->buildController($cmsItem);
                    $this->buildViews($cmsItem);
                    $this->updateRoutes($cmsItem);

                } else {

                    $addRoutes = false;

                    if ($options["controller"]) {
                        $this->info("Building controllers ...");
                        $this->buildController($cmsItem);
                        $addRoutes = true;
                    }

                    if ($options["migration"]) {
                        $this->info("Building migrations ...");
                        $this->buildMigration($cmsItem);
                    }

                    if ($options["model"]) {
                        $this->info("Building models ...");
                        $this->buildModel($cmsItem);
                    }

                    if ($options["view"]) {
                        $this->info("Building views ...");
                        $this->buildViews($cmsItem);
                        $addRoutes = true;
                    }

                    if($addRoutes){
                        $this->updateRoutes($cmsItem);
                    }
                }
            }

        } else {
            $this->error('Could not locate json file : ' . $jsonFile);
        }
    }

    private function buildMigration($cmsItem){
        //build the base model table
        $this->call('cms:generate:migration', ['name' => str_plural(strtolower($cmsItem->name)), '--schema' => implode(", ", $cmsItem->fields)]);

        //build related tables if relationship exists and field is set
        if(isset($cmsItem->relationships) && count($cmsItem->relationships) > 0 && is_array($cmsItem->relationships)) {
            foreach ($cmsItem->relationships as $relationship) {

                //belongs to many - create lookup table
                if($relationship->type == "belongsToMany"){
                    //check if we need to build a table. Only build linking table if fields is set
                    if(isset($relationship->fields)){
                        $base_table = strtolower($cmsItem->name);
                        $related_table = strtolower($relationship->name);
                        $result = strcasecmp($base_table, $related_table);
                        if($result <= 0){
                            $relation_table_name = $base_table . '_' . $related_table;
                        } else {
                            $relation_table_name = $related_table . '_' . $base_table;
                        }
                        $this->info("Table Name $relation_table_name");
                        $this->call('cms:generate:migration', ['name' => $relation_table_name, '--schema' => implode(", ", $relationship->fields)]);
                    }
                }
            }
        }

        //build attachale table if attachables value is set
        if(isset($cmsItem->attachables) && count($cmsItem->attachables) > 0 && is_array($cmsItem->attachables)) {
            $lc_model_name = strtolower($cmsItem->name);
            $tablename = $lc_model_name . "_attachables";
            $fields = $lc_model_name . "_id:integer, " . $lc_model_name . "_attachable_id:integer, " . $lc_model_name . "_attachable_type:string";

            $this->info("Table Name $tablename");
            $this->call('cms:generate:migration', ['name' => $tablename, '--schema' => $fields]);
        }
    }


    private function buildModel($cmsItem){

        $fieldnames = [];
        foreach ($cmsItem->fields as $value) {
            $fieldnames[] = preg_replace("/(.*?):(.*)/", "$1", trim($value));
        }
        $fieldnames_csv = implode("', '", $fieldnames);
        $fillable = "['";
        $fillable .= $fieldnames_csv;
        $fillable .= "']";

        $relationshipString = "";
        if(isset($cmsItem->relationships) && count($cmsItem->relationships) > 0 && is_array($cmsItem->relationships)){
            foreach($cmsItem->relationships as $relationship){
                $functionName = str_plural(strtolower($relationship->name));    //categories
                $relationshipFunctionName = $relationship->type;                //belongsToMany
                $relatedClass = $relationship->name;                            //Category

                $relationshipString .= "\n\tpublic function $functionName() { \n\t\treturn \$this->$relationshipFunctionName($relatedClass::class);\n\t}";
            }
        }

        $this->call('cms:generate:model', ['name' => $cmsItem->name, '--fillable' => $fillable, '--relationships' => $relationshipString]);
    }

    private function buildController($cmsItem){

        $filePathDeclarations = "";
        $filePathValues = "";
        $fileSaveOperations = "";

        $relationshipDataFetchers = "";
        $relationshipDataIncludes = "";

        foreach ($cmsItem->fields as $value) {
            $fieldName = preg_replace("/(.*?):(.*)/", "$1", trim($value));
            $fieldType = preg_replace("/(.*?):(.*)/", "$2", trim($value));
            if($fieldType == 'file'){
                $filePathDeclarations .= "private \$" . $fieldName . "FilePath;\n\t";
                $filePathValues .= "\$this->" . $fieldName . "FilePath = '/cms/" . strtolower($cmsItem->name) . "/$fieldName';";
                $fileSaveOperations .= "
                    if(\$request->file('$fieldName')){
                        \$uploaded_image_fname = \$this->formatFilename(\$request->file('$fieldName')->getClientOriginalName());
                        \$request->file('$fieldName')->move(public_path() . \$this->" . $fieldName . "FilePath, \$uploaded_image_fname);
                        $".strtolower($cmsItem->name)."->$fieldName = \$this->" . $fieldName . "FilePath . '/' . \$uploaded_image_fname;
                        $".strtolower($cmsItem->name)."->save();
                    }
                ";

                //need to create the directories if files are present
                if(!is_dir(public_path('cms'))){
                    mkdir(public_path('cms'));
                    chmod(public_path('cms'), 0775);
                }
                if(!is_dir(public_path('cms/' . strtolower($cmsItem->name)))){
                    mkdir(public_path('cms/' . strtolower($cmsItem->name)));
                    chmod(public_path('cms/' . strtolower($cmsItem->name)), 0775);
                }
                if(!is_dir(public_path('cms/' . strtolower($cmsItem->name) . '/' . $fieldName))){
                    mkdir(public_path('cms/' . strtolower($cmsItem->name) . '/' . $fieldName));
                    chmod(public_path('cms/' . strtolower($cmsItem->name) . '/' . $fieldName), 0775);
                }

            }
        }

        if(isset($cmsItem->relationships) && count($cmsItem->relationships) > 0 && is_array($cmsItem->relationships)){
            foreach($cmsItem->relationships as $relationship){
                if($relationship->type == 'belongsTo'){
                    $variableName = str_plural(strtolower($relationship->name));    //artists
                    $relatedClass = $relationship->name;                            //Artist
                    $relatedDisplayColumn = isset($relationship->displayColumn) ? $relationship->displayColumn : 'name';
                    $relationshipDataFetchers .= "\n\t\t\$".$variableName." = ".$relatedClass."::lists('".$relatedDisplayColumn."', 'id');";
                    $relationshipDataIncludes .= "->with('".$variableName."',\$".$variableName.")";
                }
            }
        }

        $this->call('cms:generate:controller', [
            'name' => 'Admin' . $cmsItem->name . 'Controller',
            '--crud-name' => $cmsItem->name,
            '--file-path-declarations' => $filePathDeclarations,
            '--file-path-values' => $filePathValues,
            '--file-save-functionality' => $fileSaveOperations,
            '--relationship-data-fetchers' => $relationshipDataFetchers,
            '--relationship-data-includes' => $relationshipDataIncludes,
        ]);
    }

    private function buildViews($cmsItem)
    {
        $fields = [];
        $relationships = [];
        if(isset($cmsItem->relationships) && count($cmsItem->relationships) > 0 && is_array($cmsItem->relationships)) {
            foreach ($cmsItem->relationships as $relationship) {
                $relationships[$relationship->type] = $relationship->name;
            }
        }
        //dd($relationships);
        //dd($cmsItem->fields);
        foreach ($cmsItem->fields as $fieldString) {
            $found = false;
            $name = explode(':', $fieldString)[0];
            $type = explode(':', $fieldString)[1];
            foreach ($relationships as $relationshipType => $relationshipName) {
                if($relationshipType == 'belongsTo'){
                    if(strtolower($relationshipName) . "_id" == $name){
                        $fields[] = $name . ':select';
                        $found = true;
                        break;
                    }
                }
            }
            if(!$found){
                $fields[] = $name . ':' .$type;
            }
        }

        //dd($fields);

        $this->call('cms:generate:view', ['name' => $cmsItem->name, 'fields' => implode(", ", $fields)]);
    }

    private function updateRoutes($cmsItem)
    {
        // Updating the Http/routes.php file
        $routeFile = app_path('Http/routes.php');
        $isAdded = File::append($routeFile, "\nRoute::resource('admin/" . strtolower($cmsItem->name) . "', 'Admin\\Admin" . $cmsItem->name . "Controller');");
        if ($isAdded) {
            $this->info('Crud/Resource route added to ' . $routeFile);
        } else {
            $this->info('Unable to add the route to ' . $routeFile);
        }
    }

}

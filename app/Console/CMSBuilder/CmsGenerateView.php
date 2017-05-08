<?php

namespace App\Console\Commands\CMSBuilder;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CmsGenerateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:generate:view {name} {fields}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * The path to the views folder for this CMS item
     *
     * @var string
     */
    private $viewsPath;

    /**
     * Formatted array containing all fields to add
     *
     * @var array
     */
    private $formFields = [];

    /**
     * Variations of the class name to be used in different scenarios
     */
    private $cmsName;
    private $cmsNameCap;
    private $cmsNameSingular;
    private $cmsNameSingularCap;
    private $cmsNamePlural;
    private $cmsNamePluralCap;



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
        //set all variables to be used for the class name
        $this->cmsName = strtolower($this->argument('name'));
        $this->cmsNameCap = ucwords($this->cmsName);
        $this->cmsNameSingular = str_singular($this->cmsName);
        $this->cmsNameSingularCap = ucwords($this->cmsNameSingular);
        $this->cmsNamePlural = str_plural($this->cmsName);
        $this->cmsNamePluralCap = ucwords($this->cmsNamePlural);

        //build form fields array
        $fields = $this->argument('fields');

        $this->info("Name arg : " . $this->cmsName);
        $this->info("Fields arg : " . $fields);

        $fieldsArray = explode(',', $fields);
        $x = 0;
        //reset the form fields array
        $this->formFields = [];
        foreach ($fieldsArray as $item) {
            $array = explode(':', $item);
            $this->formFields[$x]['name'] = trim($array[0]);
            $this->formFields[$x]['type'] = trim($array[1]);
            $x++;
        }

        //Create the views folder
        $this->buildViewDirectories();

        //Build index file
        $this->buildIndexFile();

        //Build partial form
        $this->buildPartialForm();

        //Build add form container
        $this->buildCreateFile();

        //Build edit form container
        $this->buildEditFile();

        //Add the link to the admin panel
        $this->addCmsLink();

    }

    private function buildViewDirectories()
    {
        $viewDirectory = base_path('resources/views/admin/');
        if (!is_dir($viewDirectory)) {
            mkdir($viewDirectory);
        }
        $this->viewsPath = $viewDirectory . $this->cmsName . '/';
        if (!is_dir($this->viewsPath)) {
            mkdir($this->viewsPath);
        }
    }

    private function buildIndexFile()
    {
        $tableHeadingHtml = '';
        $tableBodyRowsHtml = '';
        $i = 0;
        foreach ($this->formFields as $key => $value) {
            //only add the first 3 columns to the table view
            if ($i == 3) {
                break;
            }

            $label = ucwords(str_replace('_', ' ', $value['name']));
            $tableHeadingHtml .= "<th>$label</th>";
            $tableBodyRowsHtml .= "<td>{{ \$item->" . $value['name'] . " }}</td>";

            $i++;
        }

        //add the actions
        $tableHeadingHtml .= "<th>Actions</th>";
        $tableBodyRowsHtml .= "<td>
                                <a href='{{ route('admin." . strtolower($this->cmsName) . ".edit', ['" . strtolower($this->cmsName) . "' => \$item->id]) }}'><button type='submit' class='btn btn-primary btn-xs'>Update</button></a> /
                                <button data-delete-id='{{ \$item->id }}' data-delete-url='{{ route('admin." . strtolower($this->cmsName) . ".destroy', ['artist' => \$item->id]) }}' data-item-message='' class='btn btn-danger btn-xs del_cms_item'>Delete</button>
                            </td>";

        // For index.blade.php file
        $indexFile = __DIR__ . '/Stubs/index.stub';
        $newIndexFile = $this->viewsPath . 'index.blade.php';
        if (!copy($indexFile, $newIndexFile)) {
            echo "failed to copy $indexFile...\n";
        } else {
            file_put_contents($newIndexFile, str_replace('%%tableHeadingHtml%%', $tableHeadingHtml, file_get_contents($newIndexFile)));
            file_put_contents($newIndexFile, str_replace('%%tableBodyRowsHtml%%', $tableBodyRowsHtml, file_get_contents($newIndexFile)));
            file_put_contents($newIndexFile, str_replace('%%cmsName%%', $this->cmsName, file_get_contents($newIndexFile)));
            file_put_contents($newIndexFile, str_replace('%%cmsNameCap%%', $this->cmsNameCap, file_get_contents($newIndexFile)));
            file_put_contents($newIndexFile, str_replace('%%cmsNamePlural%%', $this->cmsNamePlural, file_get_contents($newIndexFile)));
            file_put_contents($newIndexFile, str_replace('%%cmsNamePluralCap%%', $this->cmsNamePluralCap, file_get_contents($newIndexFile)));
        }
    }

    private function buildPartialForm()
    {
        $formFieldsHtml = '';
        foreach ($this->formFields as $item) {

            $this->info("Adding " . $item['type']);

            $label = ucwords(strtolower(str_replace('_', ' ', $item['name'])));
            $relationshipNamePlural = "";

            if ($item['type'] == 'string') {
                $stubFile = __DIR__ . '/Stubs/elements/text.stub';
            } elseif ($item['type'] == 'text') {
                $stubFile = __DIR__ . '/Stubs/elements/textarea.stub';
            } elseif ($item['type'] == 'password') {
                $stubFile = __DIR__ . '/Stubs/elements/password.stub';
            } elseif ($item['type'] == 'email') {
                $stubFile = __DIR__ . '/Stubs/elements/email.stub';
            } elseif ($item['type'] == 'file') {
                $stubFile = __DIR__ . '/Stubs/elements/file.stub';
            } elseif ($item['type'] == 'image') {
                $stubFile = __DIR__ . '/Stubs/elements/image.stub';
            } elseif($item['type'] == 'select') {
                $relationshipName = explode('_', $item['name'])[0];
                $relationshipNamePlural = str_plural($relationshipName);
                $label = ucwords($relationshipNamePlural);
                $stubFile = __DIR__ . '/Stubs/elements/select.stub';
            } elseif($item['type'] == 'multiselect') {
                $relationshipName = explode('_', $item['name'])[0];
                $relationshipNamePlural = str_plural($relationshipName);
                $label = ucwords($relationshipNamePlural);
                $stubFile = __DIR__ . '/Stubs/elements/multiselect.stub';
            }else {
                //default to text
                $stubFile = __DIR__ . '/Stubs/elements/text.stub';
            }

            $stubString = file_get_contents($stubFile);
            $stubString = str_replace('%%inputName%%', $item['name'], $stubString);
            $stubString = str_replace('%%inputLabel%%', $label, $stubString);
            $stubString = str_replace('%%relationshipNamePlural%%', $relationshipNamePlural, $stubString);
            $stubString = str_replace('%%cmsNameSingular%%', $this->cmsNameSingular, $stubString);
            $formFieldsHtml .= "\n" . $stubString;
        }

        // create partial for create/edit files
        $partialFile    = __DIR__ . '/Stubs/form_partial.stub';
        $newPartialFile = $this->viewsPath . $this->cmsName .'form_partial.blade.php';
        if (!copy($partialFile, $newPartialFile)) {
            echo "failed to copy $partialFile...\n";
        } else {
            file_put_contents($newPartialFile, str_replace('%%formFieldsHtml%%', $formFieldsHtml, file_get_contents($newPartialFile)));
        }
    }

    private function buildCreateFile()
    {
        $createFile = __DIR__ . '/Stubs/create.stub';
        $newCreateFile = $this->viewsPath . 'create.blade.php';
        if (!copy($createFile, $newCreateFile)) {
            echo "failed to copy $createFile...\n";
        } else {
            file_put_contents($newCreateFile, str_replace('%%cmsName%%', $this->cmsName, file_get_contents($newCreateFile)));
            file_put_contents($newCreateFile, str_replace('%%cmsNameSingularCap%%', $this->cmsNameSingularCap, file_get_contents($newCreateFile)));
        }
    }

    private function buildEditFile()
    {
        $editFile = __DIR__ . '/Stubs/edit.stub';
        $newEditFile = $this->viewsPath . 'edit.blade.php';
        if (!copy($editFile, $newEditFile)) {
            echo "failed to copy $editFile...\n";
        } else {
            file_put_contents($newEditFile, str_replace('%%cmsName%%', $this->cmsName, file_get_contents($newEditFile)));
            file_put_contents($newEditFile, str_replace('%%cmsNameCap%%', $this->cmsNameCap, file_get_contents($newEditFile)));
            file_put_contents($newEditFile, str_replace('%%cmsNameSingular%%', $this->cmsNameSingular, file_get_contents($newEditFile)));
            file_put_contents($newEditFile, str_replace('%%cmsNameSingularCap%%', $this->cmsNameSingularCap, file_get_contents($newEditFile)));
        }
    }

    private function addCmsLink()
    {
        //<li class="active"><a href="#"><i class="fa fa-link"></i><span>Link</span></a></li>
        // Updating the sidebar links
        $linkString = "\n\n<li>\t<a href='{{ route('admin." . $this->cmsName . ".index') }}'><i class='fa fa-link'></i><span>" . $this->cmsNameCap . "</span></a></li>";

        $cmsLinksViewFile = base_path('resources/views/admin/sidebarCmsLinks.blade.php');
        $isAdded = File::append($cmsLinksViewFile, $linkString);
        if ($isAdded) {
            //$this->info('Crud/Resource link added to ' . $cmsLinksViewFile);
        } else {
            //$this->info('Unable to add the link to ' . $cmsLinksViewFile);
        }
    }
}

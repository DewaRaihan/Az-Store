<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class MakeTrait extends Command
{
    protected $signature = 'make:trait {name}';
    protected $description = 'Create a new Trait in app/Traits';

    public function handle()
    {
        $name = $this->argument('name');
        $folder = app_path('Traits');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filePath = $folder.'/'.$name.'.php';

        if (File::exists($filePath)) {
            $this->error("Trait already exists!");
            return;
        }

        $template = "<?php

namespace App\Traits;

trait $name
{
    //
}
";

        File::put($filePath, $template);
        $this->info("Trait [$name] created in app/Traits successfully.");
    }
}

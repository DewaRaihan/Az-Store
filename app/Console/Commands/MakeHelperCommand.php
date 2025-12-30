<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeHelperCommand extends Command
{
    protected $signature = 'make:helper {name}';
    protected $description = 'Create a new helper file';

    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Helpers/{$name}.php");

        if (File::exists($path)) {
            $this->error("Helper {$name} already exists!");
            return;
        }

        File::ensureDirectoryExists(app_path('Helpers'));

        $stub = <<<EOT
        <?php

        if (! function_exists('{$name}')) {
            function {$name}() {
                // TODO: implement helper
            }
        }
        EOT;

        File::put($path, $stub);

        $this->info("Helper created: {$path}");
    }
}

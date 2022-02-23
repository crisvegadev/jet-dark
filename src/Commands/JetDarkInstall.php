<?php

namespace Crisvegadev\JetDark\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class JetDarkInstall extends Command
{
    protected $filesystem;
    protected $stubDir;
    protected $argument;

    protected $signature = 'jet-dark:install {--mode=styles}';
    protected $description = 'Install a dark theme for Jetstream, compile and publish it\'s assets';

    protected $dir = __DIR__ . '/../../resources/views';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function handle()
    {

        // Instance the filesystem
        $this->filesystem = new Filesystem;

        // Only styles
        if($this->option('mode') == 'styles') {

            // Copy assets messages
            $this->line('');
            $this->line('Copying assets...');
            $this->line('');

            // Copy assets
            $this->copyAssets();

            // Final messages
            $this->warn('');
            $this->info('Installation Complete');
            $this->warn('');
            $this->warn('Import the styles in your <info>app.css</info> following the documentation');
            $this->warn('');
            $this->warn('Run: <info>npm install && npm run dev</info> ');
            $this->warn('');

        } else if($this->option('mode') == 'complete') { // Full install
            $this->line('');
            $this->alert('This files will be overwritten, and this cannot be undone.');

            // Warning about overwriting files
            $this->warn('<info> - views/</info>api/* ');
            $this->warn('<info> - views/</info>layouts/* ');
            $this->warn('<info> - views/</info>profile/*');
            $this->warn('<info> - views/</info>teams/* ');
            $this->warn('<info> - views/</info>vendor/jetstream/components/* ');
            $this->warn('<info> - views/</info>dashboard.blade.php ');
            $this->warn('<info> - views/</info>navigation-menu.blade.php ');
            $this->warn('<info> - views/</info>policy.blade.php ');
            $this->warn('<info> - views/</info>terms.blade.php ');
            $this->warn('<info> - views/</info>welcome.blade.php ');

            // Ask for confirmation
            if ($this->confirm('This will delete all views of jetstream. It will Re-Compile this. Do you want to proceed?') == 'yes') {

                // Copying views messages
                $this->line('');
                $this->line('Copying views...');
                $this->line('');

                // Copy views
                $this->generateFiles($this->dir);

                // Copy assets messages
                $this->line('');
                $this->line('Copying assets...');
                $this->line('');

                // Copy assets
                $this->copyAssets();

                // Final messages
                $this->warn('');
                $this->info('Installation Complete');
                $this->warn('');
                $this->warn('Import the styles in your <info>app.css</info> following the documentation');
                $this->warn('');
                $this->warn('Run: <info>npm install && npm run dev</info> ');
                $this->warn('');

                // End
                $this->warn('All done! Enjoy your new dark theme');
            }

            else $this->warn('Installation Aborted, No file was changed');

        }
    }

    /**
     * Copy resources/css/app.css to resources/css/vendor/crisvegadev/jet-dark/app.css
     *
     * @return void
     */
    public function copyAssets()
    {
        $this->filesystem->copyDirectory(__DIR__ . '/../../resources/css', resource_path('css/vendor/crisvegadev/jet-dark'));
    }

    /**
     * Generate files
     *
     * @param string $dir
     * @return void
     */
    public function generateFiles(String $dir)
    {
        // Get all files in the directory
        $files = $this->filesystem->allFiles($dir, false);

        // Loop through the files
        foreach ($files as $file) {
            // Get the file path
            $path = str_replace(__DIR__ . '/../../resources/views', '', $file->getPathname());

            // Validate if the file is within the directory
            // if it is, then replace the file
            if($this->filesystem->exists(resource_path('views'.$path))){

                // Replacing the current file with the new one
                $this->filesystem->copy($file->getPathname(), resource_path('views'.$path), true);
            }else{ // if not, then create the file

                //get the path of folder and remove the file name from it to get the folder path only
                $pathToCreate = str_replace($file->getFilename(), '', resource_path('views'.$path));

                // Create the folder if it doesn't exist
                $this->filesystem->ensureDirectoryExists($pathToCreate);

                // Copy the file to the new location
                $this->filesystem->copy($file->getPathname(), resource_path('views'.$path), true);
            }
            // Show the file that was copied
            $this->warn('Replaced file: <info> views'.$path.'</info>');
        }

    }

}

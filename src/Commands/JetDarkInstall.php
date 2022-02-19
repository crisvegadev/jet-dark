<?php

namespace Crisvegadev\JetDark\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class JetDarkInstall extends Command
{
    protected $filesystem;
    protected $stubDir;
    protected $argument;

    protected $signature = 'jet-dark:install';
    protected $description = 'Install a dark theme for Jetstream, compile and publish it\'s assets';

    public function handle()
    {
        $this->filesystem = new Filesystem;
        (new Filesystem)->ensureDirectoryExists(resource_path('views/vendor/jetstream'));

        if ($this->confirm('This will delete all files in resources/views/vendor/jetstream/. and resources/views/auth It will Re-Compile this. Do you want to proceed?') == 'yes') {

            $dirs = [
                'views/vendor/jetstream/components',
            ];

            $this->generateFiles($dirs);

            $this->line('');
            $this->warn('Running: <info>npm install && npm run dev</info> Please wait...');
            $this->line('');

           exec('npm install && npm run dev');

            $this->warn('');
            $this->info('Installation Complete');
            $this->warn('');

            $this->warn('All done! Enjoy your new dark theme');
        }
        else $this->warn('Installation Aborted, No file was changed');
    }

    public function generateFiles(array $dirs)
    {

        foreach ($dirs as $dir) {

            if ($this->filesystem->exists(resource_path($dir))) {
                $this->filesystem->delete(resource_path($dir));
                $this->warn('Deleted file: <info>' . $dir . '</info>');
            }

            foreach ($this->filesystem->allFiles(__DIR__.'/../../resources/'.$dir) as $file) {
                $this->filesystem->copy($file,  resource_path($dir).'/'.$file->getFilename());
                $this->warn('Copied file: <info>' . $file . '</info>');
            }

        }

    }

}

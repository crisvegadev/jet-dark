
# jet-dark

A Laravel package that add dark theme to Jetstream

## Requirements

  * Laravel
  * Jetstream (livewire)
  * TailwindCSS
    
    

## Installation

* publish the views of jetstream

```bash
  php artisan vendor:publish --tag=jetstream-views
```

* Install with composer

```bash
  composer require crisvegadev/jet-dark
```

## Usage

#### Make a backup of yours views before the execution of this command
If you don't like the theme, you can restore yours views later with yours backup

### ¡WARNING!

This action replaces all files in following directories and this is irreversible:

  - `resources/views/api/*`
  - `resources/views/auth/*`
  - `resources/views/layouts/*`
  - `resources/views/profile/*`
  - `resources/views/teams/*`
  - `resources/views/vendor/jetstream/components/*`
  - `resources/views/dashboard.blade.php`
  - `resources/views/navigation-menu.blade.php`
  - `resources/views/policy.blade.php`
  - `resources/views/terms.blade.php`
  - `resources/views/welcome.blade.php`

After running `composer require crisvegadev/jet-dark` command just run:
```bash
php artisan jet-dark:install
```

And the theme will be applied to jetstream default pages.

## Authors

- [@crisvegadev](https://www.github.com/crisvegadev)


## License

[MIT](https://choosealicense.com/licenses/mit/)

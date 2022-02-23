



# Introduction

jet-dark is a package for Laravel Jetstream that provides a dark theme for the application. 
This package overrides the default files of Jetstream views with custom files that included support for dark mode using tailwindcss.

### Recommended for new projects only.

## Requirements

  * Laravel
  * Jetstream (livewire)
  * TailwindCSS

## Installation

### Complete installation

* publish the views of jetstream

if you don't publish the views of jetstream, jet-dark will create the files automatically.

```bash
  php artisan vendor:publish --tag=jetstream-views
```

* Install with composer

```bash
  composer require crisvegadev/jet-dark
```

#### Make a backup of yours views before the execution of this command
If you don't like the theme, you can restore yours views later with yours backup

### ¡¡WARNING!!

#### This action replaces all files in following directories and this is irreversible
#### Sure not customize views in these directories before execute this command

    - resources/views/api/*
    - resources/views/auth/*
    - resources/views/layouts/*
    - resources/views/profile/*
    - resources/views/teams/*
    - resources/views/vendor/jetstream/components/*
    - resources/views/dashboard.blade.php
    - resources/views/navigation-menu.blade.php
    - resources/views/policy.blade.php
    - resources/views/terms.blade.php
    - resources/views/welcome.blade.php

* After running `composer require crisvegadev/jet-dark` command, just run:
* 
```bash
php artisan jet-dark:install --mode=complete
```

### Styles only

Installing the styles only, you can set manually the classes to your components.

This option is recommended if you conserve the original files of Jetstream views.

`--mode=styles` **is the default option.**

```bash
php artisan jet-dark:install --mode=styles
```

## Usage/Configuration

* import the styles of the theme into your app.css file on resources/css/app.css

```css
  @import 'vendor/crisvegadev/jet-dark/app.css';
  ```

## Authors

- [@crisvegadev](https://www.github.com/crisvegadev)


## License

[MIT](https://choosealicense.com/licenses/mit/)

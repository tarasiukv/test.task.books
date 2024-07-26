# Test task for Grade

## App: catalog of Books

- Test task
    * [What's inside](#What's_inside)
    * [Installation](#installation)
    * [Run project](#run_project)
    * [Issues](#issues)

# What's inside

Contains: 
 - Laravel, Vue.js, vite, Doctrine


# Installation

#### Make sure you are in the directory with the files: `.env` and `composer.json` ####


- Make changes to the `.env` file (add your database)


- Install all dependencies:
  `npm install`


- Install composer:
  `composer install`


- Generate key:
  `php artisan key:generate`


- Run migrate:
  `php artisan doctrine:migrations:migrate`


- Build project:
  `npm run build`

<a name="run_project"></a>
## Run project

Run server. For run use command:

    php artisan serve

Also there has to be run workers:

    php artisan queue:work

For build all front code run php artisan command

    npm run build

<a name="rerun_project"></a>


# Issues

1. If you have error like this `('/test.task.books/.env'): Failed to open stream: No such file or directory`

Rename `.env.example` to `.env`

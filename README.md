# Organizer

## Download and Installation

To begin using this project, choose one of the following options to get started:

* Clone the repo: `git clone https://gitlab.com/Gantyuk/organizer_laravel`
* [Fork, Clone, or Download on Bitbucket](https://gitlab.com/Gantyuk/organizer_laravel)

After Download, Clone ... you need to do this command `composer update`, then add the `.env`-file and config them, run `php artisan migrate`, `php artisan storage:link`

In order to add an administrator to the project do it  :
* `php artisan tinker`;
* ` $admin = new App\Admin`;
* `$admin->name = "Admin name"`;
* `$admin->email = "adminemail@mail.com"`;
* `$admin->password = Hash::make('password')`;
* `$admin->job_title = "admin"`;
* `$admin->save()`.

That's all, run the Laravel project `php artisan serve`,enjoy that project.
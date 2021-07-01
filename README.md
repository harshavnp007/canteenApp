# DS BOJANA

![laravel tests workflow](https://github.com/JustinByrne/Mealing/actions/workflows/laravel_phpunit.yaml/badge.svg) ![GitHub](https://img.shields.io/github/license/JustinByrne/Mealing)

A simple Laravel application to manage the sales in canteen in college.

## Installation

1. Download the latest release
   - `git clone https://github.com/harshavnp007/canteenApp.git`
2. Within the new directory run the following
   1. `composer install`
   2. `cp .env.example .env`
   3. `php artisan key:generate`
   4. `php artisan storage:link`
   5. `php artisan migrate`

During the installation process an admin account is created, this account has all permissions by default and any new ones as they are created.

email: `admin@example.com`<br>
password: `password`

> It is advised that these details are changed straight after installation.

## New registrations

New users can register into the system and book the meals from the canteen.

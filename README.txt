# Symfony Project

Basic Symfony project setup.

## Requirements

- PHP >= 8.1
- Composer
- Symfony CLI (optional but recommended)
- Web server (Apache/Nginx) or Symfony built-in server
- Database (e.g., MySQL or PostgreSQL)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/your/repo.git
cd repo

    Install dependencies:

composer install

    Copy the environment configuration file:

cp .env .env.local

    Configure your database connection in .env.local:

DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0"

    Replace db_user, db_password, and db_name with your actual database credentials.

    Create the database (if it doesn't already exist):

php bin/console doctrine:database:create

    Run database migrations:

php bin/console doctrine:migrations:migrate

    (Optional) Load data fixtures:

php bin/console doctrine:fixtures:load

Running the Project

Using Symfony's built-in server:

symfony server:start

Or with PHP:

php -S 127.0.0.1:8000 -t public

# Laravel Application with Laravel Sail

This is a Laravel application developed using Laravel Sail for local development. Laravel Sail provides a simple Docker-powered local development environment for Laravel projects.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Database Management](#database-management)
-   [Laravel Telescope](#laravel-telescope)
-   [Running Tests](#running-tests)
-   [Architecture](#architecture)
-   [Deployment Process for Production](#deployment-process-for-production)
-   [.env Configuration](#env-configuration)
-   [Using Laravel Sail with WSL2](#using-laravel-sail-with-wsl2)
-   [Docker Commands](#docker-commands)
-   [Contributing](#contributing)
-   [License](#license)

## Requirements

-   Docker Desktop (for Windows and macOS users)
-   Docker Engine and Docker Compose (for Linux users)
-   Laravel Sail
-   Laravel Telescope

## Installation

1. Clone the repository:

```
git clone <repository_url>
cd <project_directory>
```

2. Install Laravel Sail globally (if not already installed):

```
composer global require laravel/sail
```

3. Copy the `.env.example` file to `.env`:

```
cp .env.example .env
```

4. Install dependencies using Composer:

```
./vendor/bin/sail composer install
```

5. Generate an application key:

```
./vendor/bin/sail artisan key:generate
```

6. Seed the database with mock data:

```
./vendor/bin/sail artisan db:seed
```

7. Install and configure Laravel Telescope:

```
./vendor/bin/sail artisan telescope:install
```

## Usage

Start the development server using Docker:

```
./vendor/bin/sail up
```

Visit [http://localhost](http://localhost) in your web browser to view the application.

Stop the development server:

```
./vendor/bin/sail down
```

## Database Management

You can access the database using your preferred database management tool (e.g., phpMyAdmin) via the following URL:

-   [http://localhost:8080](http://localhost:8080)

## Laravel Telescope

Laravel Telescope is a debugging and monitoring tool for Laravel applications. You can access the Telescope dashboard via the following URL:

-   [http://localhost/telescope](http://localhost/telescope)

## Running Tests

To run tests, you can use the following command:

```
./vendor/bin/sail test
```

## Architecture

This Laravel API application follows a simplified architecture pattern, focusing on handling HTTP requests and responses effectively:

-   **Model**: Represents the application's data structures and interacts with the database. Models define the structure of database tables and provide methods for querying and manipulating data.
-   **Controller**: Receives HTTP requests, delegates business logic to services, and returns JSON responses. Controllers serve as the entry point for API endpoints.
-   **Service**: Encapsulates application logic into reusable services. Services are responsible for performing specific tasks or operations, such as processing requests, validating data, and interacting with repositories.
-   **Repository**: Provides an abstraction layer between the application and the database. Repositories handle database operations and allow for better organization and separation of concerns. While repositories might not be as prominent in API-only applications, they can still provide benefits such as code organization and testability.
-   **Tests**: Ensure the reliability and correctness of the application. Tests cover various aspects, including unit tests for individual components (e.g., services, repositories), integration tests for testing interactions between components, and feature tests for testing end-to-end functionality through HTTP requests.

The architecture emphasizes simplicity and efficiency, focusing on delivering API endpoints to clients, handling data manipulation operations, and ensuring the application's reliability through comprehensive testing.

## Deployment Process for Production

To deploy this Laravel application to a production environment, you can follow these general steps:

1. Set up a production server with PHP, MySQL, and any other necessary dependencies.
2. Clone the repository to the production server.
3. Install Composer dependencies:

```
composer install --no-dev
```

4. Configure the `.env` file with production database credentials and other environment-specific settings.
5. Run database migrations:

```
php artisan migrate --force
```

6. Generate an optimized autoloader:

```
composer dump-autoload --optimize
```

7. Generate application key:

```
php artisan key:generate
```

8. Optionally, you may want to configure additional settings for caching, logging, and other production-specific configurations in the `.env` file.

9. Configure your web server (e.g., Nginx, Apache) to serve the Laravel application. Ensure that the server points to the `public` directory of your application.

10. Set appropriate file permissions and ownership for the application files to ensure security and accessibility.

11. Set up a process manager (e.g., Supervisor) to manage your Laravel queue workers and scheduled tasks (if applicable).

12. Configure HTTPS and SSL certificates for secure communication between clients and the server.

13. Monitor the production environment for performance, errors, and security vulnerabilities using tools like Laravel Telescope, New Relic, or Rollbar.

14. Implement continuous integration and continuous deployment (CI/CD) pipelines to automate testing, building, and deploying new changes to production.

15. Regularly update dependencies, apply security patches, and perform maintenance tasks to keep the application secure and up-to-date.

## .env Configuration

Your `.env` file contains environment-specific settings for your Laravel application. Below are the key settings you may need to configure:

```dotenv
APP_NAME=YourAppName
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## Using Laravel Sail with WSL2

If you are using Windows Subsystem for Linux 2 (WSL2), make sure to follow the Docker Desktop for Windows installation instructions for WSL2:

-   [Docker Desktop for Windows with WSL2](https://docs.docker.com/desktop/install/wsl/)

## Docker Commands

For more Docker commands, you can refer to the Laravel Sail documentation:

-   [Laravel Sail Documentation](https://laravel.com/docs/8.x/sail)

## Contributing

Contributions are welcome! Please follow the [contribution guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE).

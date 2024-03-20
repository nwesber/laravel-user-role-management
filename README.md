# Laravel Application with Laravel Sail

This is a Laravel application developed using Laravel Sail for local development. Laravel Sail provides a simple Docker-powered local development environment for Laravel projects.

## Requirements

- Docker Desktop (for Windows and macOS users)
- Docker Engine and Docker Compose (for Linux users)
- Laravel Sail
- Laravel Telescope

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

6. Install and configure Laravel Telescope:
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

- [http://localhost:8080](http://localhost:8080)

## Laravel Telescope

Laravel Telescope is a debugging and monitoring tool for Laravel applications. You can access the Telescope dashboard via the following URL:

- [http://localhost/telescope](http://localhost/telescope)

## Running Tests

To run tests, you can use the following command:
```
./vendor/bin/sail test
```

## Architecture

This Laravel API application follows a simplified architecture pattern, focusing on handling HTTP requests and responses effectively:

- **Model**: Represents the application's data structures and interacts with the database. Models define the structure of database tables and provide methods for querying and manipulating data.
- **Controller**: Receives HTTP requests, delegates business logic to services, and returns JSON responses. Controllers serve as the entry point for API endpoints.
- **Service**: Encapsulates application logic into reusable services. Services are responsible for performing specific tasks or operations, such as processing requests, validating data, and interacting with repositories.
- **Repository**: Provides an abstraction layer between the application and the database. Repositories handle database operations and allow for better organization and separation of concerns. While repositories might not be as prominent in API-only applications, they can still provide benefits such as code organization and testability.
- **Tests**: Ensure the reliability and correctness of the application. Tests cover various aspects, including unit tests for individual components (e.g., services, repositories), integration tests for testing interactions between components, and feature tests for testing end-to-end functionality through HTTP requests.

The architecture emphasizes simplicity and efficiency, focusing on delivering API endpoints to clients, handling data manipulation operations, and ensuring the application's reliability through comprehensive testing.

## Using Laravel Sail with WSL2

If you are using Windows Subsystem for Linux 2 (WSL2), make sure to follow the Docker Desktop for Windows installation instructions for WSL2:

- [Docker Desktop for Windows with WSL2](https://docs.docker.com/desktop/install/wsl/)


## Docker Commands

For more Docker commands, you can refer to the Laravel Sail documentation:

- [Laravel Sail Documentation](https://laravel.com/docs/8.x/sail)

## Contributing

Contributions are welcome! Please follow the [contribution guidelines](CONTRIBUTING.md).

## License

This project is licensed under the [MIT License](LICENSE).

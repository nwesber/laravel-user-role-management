# Laravel Application with Laravel Sail

This is a Laravel application developed using Laravel Sail for local development. Laravel Sail provides a simple Docker-powered local development environment for Laravel projects.

## Requirements

- Docker Desktop (for Windows and macOS users)
- Docker Engine and Docker Compose (for Linux users)
- Laravel Sail

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

## Running Tests

To run tests, you can use the following command:
```
./vendor/bin/sail test
```

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

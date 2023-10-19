## SIS Sepulveda (Backend Side)

<p align="center">
<img src="https://img.shields.io/badge/license-Apache-green" alt="License"></a>
<img src="https://img.shields.io/badge/version-1.0-blue" alt="Version"></a>
<a href="https://zenodo.org/badge/latestdoi/506025421"><img src="https://zenodo.org/badge/506025421.svg" alt="DOI"></a>
</p>

Welcome to the API documentation for SIS Sepulveda (Backend), a comprehensive inventory control software designed for use in
public institutions.

## Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
    - [Clone the Project](#clone-the-project)
    - [Installation](#installation)
    - [Configuration](#configuration)
- [Rate Limiting](#rate-limiting)
- [License](#license)

## Introduction

SIS Sepulveda is an inventory control system designed to streamline inventory management processes in public
institutions.
The API provides a flexible and efficient way to interact with inventory items, manage orders, and handle
user accounts.

## Getting Started

### Clone the Project

To get started, you'll need to clone the SIS Sepulveda repository to your local machine:

```bash
git clone https://github.com/mmartinrm97/api-sepulveda.git

```

## Installation

Navigate to the project directory and install the project dependencies using Composer:

```bash
cd api-sepulveda
composer install
```

## Configuration

After installing the dependencies, create a copy of the .env.example file and rename it to .env:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

Update the .env file with your database and other configuration settings. For example:

```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_test
    DB_USERNAME=root
    DB_PASSWORD=
```

Update the QUEUE_CONNECTION to redis in the .env file

```dotenv
    QUEUE_CONNECTION=redis
```

Generate the JWT Keyy:

```bash
php artisan jwt:secret
```

Start the server. If you use Laragon you dont need to execute this command:
```bash
php artisan serve
```

Start queue worker:
```bash
php artisan queue:work
```


## Rate Limiting
To ensure fair usage of the API, rate limiting is applied. Each API key has a specific rate limit. If you exceed the rate limit, you will receive a 429 Too Many Requests response.

## License

This software is licensed under the Apache License 2.0.

For more information about SIS Sepulveda or to report any issues, please contact our support team at
1470614789@undc.edu.pe


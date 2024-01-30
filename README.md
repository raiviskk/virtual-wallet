# Virtual wallet

A simple virtual wallet application for managing wallets, transactions.

## Table of Contents

- [Features](#features)
- [Getting Started](#getting-started)
   - [Prerequisites](#prerequisites)
   - [Installation](#installation)
- [Usage](#usage)


## Features

- User authentication
- Account creation and management
- Transaction history
- Currency conversion


## Getting Started

### Prerequisites

- PHP 8
- MySql 8
- Composer
- Laravel (assuming it's a Laravel app)

### Installation

1. Clone the repository:

   git clone https://github.com/raiviskk/virtual-wallet.git

2. Install dependencies:

   composer install

3. Set up your environment variables:

   Create a .env file based on .env.example and fill in the required configuration.

4. Initialize the database:

   mysqladmin create wallets2

   php artisan migrate

   php artisan currencies:fetch

   

## Usage

1. php artisan serv

2. Visit http://localhost:8000 in your web browser.



![Screenshot](https://github.com/raiviskk/virtual-wallet/blob/main/demo/Screenshot%201.png)
![Screenshot](https://github.com/raiviskk/virtual-wallet/blob/main/demo/Screenshot%202.png)
![Screenshot](https://github.com/raiviskk/virtual-wallet/blob/main/demo/Screenshot%203.png)
![Screenshot](https://github.com/raiviskk/virtual-wallet/blob/main/demo/Screenshot%204.png)

  
   
   


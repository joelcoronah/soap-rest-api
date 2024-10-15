# Virtual Wallet SOAP Service

This is a SOAP-based service built using Laravel to simulate a virtual wallet system. It handles core operations like customer registration, wallet balance charges, and payment confirmation.

## Endpoints (SOAP)

-   **customer**: Registers a new customer.
-   **chargeBalance**: Charges balance to a customer’s wallet.
-   **checkBalance**: Checks the wallet's balance.
-   **requestPayment**: Requests a payment and generates a 6-digit token sent to the customer’s email.
-   **confirmPayment**: Confirms a payment by validating the session ID and token.

## Requirements

-   PHP 7.4 or later
-   Laravel 8 or later
-   MySQL or MongoDB for database

## Installation

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Configure the `.env` file with your database and email credentials.
4. Migrate the database using: `php artisan migrate`
5. Run the SOAP server using: `php artisan serve`

## SOAP Usage

Use any SOAP client (like SoapUI) to call the following methods:

-   Register a customer by sending **name**, **email**, **document**, and **phone** to `customer`.
-   Charge balance by sending **document**, **phone**, and **amount** to `chargeBalance`.
-   Check balance by sending **document** and **phone** to `checkBalance`.
-   Request payment by sending **document**, **phone**, and **amount** to `requestPayment`.
-   Confirm payment by sending **session_id** and **token** to `confirmPayment`.

## License

MIT License.

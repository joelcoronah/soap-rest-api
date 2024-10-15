# Virtual Wallet Bridge API (REST)

This is a Node.js and Express-based bridge API that interacts with a SOAP service to simulate a virtual wallet system.

## Endpoints

- **GET /test**: Simple dump test.
- **POST /api/customer**: Registers a new customer.
- **POST /api/transaction/charge-balance**: Charges balance to a customer’s wallet.
- **POST /api/wallet/check-balance**: Checks the wallet's balance.
- **POST /api/transaction/request-payment**: Requests a payment, generates a token.
- **POST /api/transaction/confirm-payment**: Confirms a payment by validating the session ID and token.

## Requirements

- Node.js (v18 or later)
- Express.js
- SOAP service for handling database interactions

## Installation

1. Clone the repository.
2. Run `npm install` to install dependencies.
3. Create a `.env` file for your environment variables (if needed).
4. To start the API, run: `npm start`

## Usage

Use Postman or any HTTP client to test the following API methods:

- Register a customer by sending **name**, **email**, **document**, and **phone** to `/api/customer`.
- Charge balance by sending **document**, **phone**, and **amount** to `/api/transaction/charge-balance`.
- Check balance by sending **document** and **phone** to `/api/wallet/check-balance`.
- Request payment by sending **document**, **phone**, and **amount** to `/api/transaction/request-payment`.
- Confirm payment by sending **session_id** and **token** to `/api/transaction/confirm-payment`.

## License

MIT License.

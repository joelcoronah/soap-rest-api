# ePayco virtual Wallet System

This project simulates a virtual wallet system, including both REST (Node.js) and SOAP (Laravel) services. The project uses Docker Compose for containerization and orchestration.

## Services

- **MongoDB**: NoSQL database used to store customer and transaction data.
- **Mongo Express**: Web-based MongoDB administration interface for managing the database.
- **SOAP Service**: Laravel-based SOAP service that handles core operations (registration, balance checks, payments, etc.).
- **Nginx**: Acts as a reverse proxy for the SOAP service.

## Requirements

- Docker
- Docker Compose

## Installation

1. Clone the repository.
2. Create a `.env` file in the root directory with the following variables:

```bash
DB_USERNAME=your_mongodb_username
DB_PASSWORD=your_mongodb_password
DB_DATABASE=your_mongodb_database_name
```

3. Run the following command to build and start the services: `docker-compose up --build`

This will spin up the following containers:

- **mongo-db**: MongoDB database listening on port `27017`.
- **mongo-express**: Web interface for MongoDB accessible at `http://localhost:8081`.
- **soap-server**: Laravel SOAP service running on port `9000`.
- **nginx**: Nginx reverse proxy accessible at `http://localhost:4001`, routing requests to the SOAP service.

## How to Start the Services

Once the Docker containers are up, you can interact with:

- **MongoDB** at `localhost:27017` or via **Mongo Express** at `http://localhost:8081`.
- **SOAP API** at `http://localhost:4001` (reverse-proxied by Nginx).

## Volumes

The following volumes are used:

- `db-data`: Persists MongoDB data locally to the `./db-data` directory.

## Networks

All services communicate over the `my-network` Docker network using the bridge driver.

## Usage

You can use Postman, SoapUI, or any other API client to interact with the services via their respective endpoints:

- **MongoDB Admin UI**: `http://localhost:8081` (with authentication as specified in the `.env` file).
- **SOAP Service**: Available at `http://localhost:4001` through the Nginx reverse proxy.

## License

MIT License.

const express = require("express");
const routes = express.Router();

routes.use(express.json());
const { testController } = require("./../controllers/test-controller");

/**
 * @swagger
 * /test:
 *   get:
 *     summary: Returns a simple dump test
 *     responses:
 *       200:
 *         description: A successful response
 *         content:
 *           application/json:
 *             schema:
 *               type: object
 *               properties:
 *                 message:
 *                   type: string
 *                   example: ok!
 */
routes.get("/test", testController);

const { registerCustomer } = require("./../controllers/customer-controller");

/**
 * @swagger
 * /api/customer:
 *   post:
 *     summary: Register a new customer
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/createClient'
 *     responses:
 *       200:
 *         description: Customer created successfully
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/createdClient'
 */
routes.post("/api/customer", registerCustomer);

const { chargeBalance } = require("./../controllers/transactions-controller");

/**
 * @swagger
 * /api/transaction/charge-balance:
 *   post:
 *     summary: Charge balance
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/createTransaction'
 *     responses:
 *       200:
 *         description: Transaction created
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/createdTransaction'
 */
routes.post("/api/transaction/charge-balance", chargeBalance);

const { checkBalance } = require("./../controllers/transactions-controller");

/**
 * @swagger
 * /api/wallet/check-balance:
 *   post:
 *     summary: Check balance
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/checkBalance'
 *     responses:
 *       200:
 *         description: Balance checked
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/checkedBalance'
 */
routes.post("/api/wallet/check-balance", checkBalance);

const { requestPayment } = require("./../controllers/transactions-controller");

/**
 * @swagger
 * /api/transaction/request-payment:
 *   post:
 *     summary: Request a payment
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/requestPayment'
 *     responses:
 *       200:
 *         description: Payment requested
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/requestedPayment'
 */
routes.post("/api/transaction/request-payment", requestPayment);

const { confirmPayment } = require("./../controllers/transactions-controller");

/**
 * @swagger
 * /api/transaction/confirm-payment:
 *   post:
 *     summary: Confirm a payment
 *     requestBody:
 *       required: true
 *       content:
 *         application/json:
 *           schema:
 *             $ref: '#/components/schemas/confirmPayment'
 *     responses:
 *       200:
 *         description: Payment confirmed
 *         content:
 *           application/json:
 *             schema:
 *               $ref: '#/components/schemas/confirmedPayment'
 */
routes.post("/api/transaction/confirm-payment", confirmPayment);

routes.get("*", (req, res) => {
  res.send("Not Found");
});

module.exports = routes;

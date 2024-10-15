const express = require("express");
const routes = express.Router();

routes.use(express.json());
const { testController } = require("./../controllers/test-controller");
routes.get("/test", testController);

const { registerCustomer } = require("./../controllers/customer-controller");
routes.post("/api/customer", registerCustomer);

const { chargeBalance } = require("./../controllers/transactions-controller");
routes.post("/api/transaction/charge-balance", chargeBalance);

const { checkBalance } = require("./../controllers/transactions-controller");
routes.post("/api/wallet/check-balance", checkBalance);

const { requestPayment } = require("./../controllers/transactions-controller");
routes.post("/api/transaction/request-payment", requestPayment);

const { confirmPayment } = require("./../controllers/transactions-controller");
routes.post("/api/transaction/confirm-payment", confirmPayment);

routes.get("*", (req, res) => {
  res.send("Not Found");
});

module.exports = routes;

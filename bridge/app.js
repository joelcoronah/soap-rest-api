require("dotenv").config();
const express = require("express");
const app = express();
const cors = require("cors");
const { specs, swaggerUi } = require("./swaggerConfig");

const routes = require("./routes");

app.use(cors());
app.use("/api-docs", swaggerUi.serve, swaggerUi.setup(specs));
app.use("/", routes);

app.set("port", process.env.PORT || 3002);

app.listen(app.get("port"), () => {
  console.log("server on port", app.get("port"));
});

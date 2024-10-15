const swaggerJsdoc = require("swagger-jsdoc");
const swaggerUi = require("swagger-ui-express");
const swaggerSchemas = require("./swaggerSchemas");

const swaggerOptions = {
  definition: {
    openapi: "3.0.0",
    info: {
      title: "API ePayco Challange Documentation",
      version: "1.0.0",
      description: "Documentation for a Challange Rest and Soap API",
    },
    components: swaggerSchemas.components,
  },
  apis: ["./routes/*.js"],
};

const specs = swaggerJsdoc(swaggerOptions);

module.exports = {
  specs,
  swaggerUi,
};

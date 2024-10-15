module.exports = {
  components: {
    schemas: {
      createClient: {
        type: "object",
        required: ["document", "name", "email", "phone"],
        properties: {
          document: {
            type: "string",
          },
          name: {
            type: "string",
          },
          email: {
            type: "string",
          },
          phone: {
            type: "string",
          },
        },
        example: {
          document: "12345678901",
          name: "John Doe",
          email: "HqGKm@example.com",
          phone: "12345678901",
        },
      },
      createdClient: {
        type: "object",
        properties: {
          success: {
            type: "boolean",
          },
          cod_error: {
            type: "string",
          },
          data: {
            type: "string",
          },
        },
        example: {
          success: true,
          cod_error: "00",
          data: "Customer created successfully",
        },
      },
      createTransaction: {
        type: "object",
        required: ["document", "phone", "amount"],
        properties: {
          document: {
            type: "string",
          },
          amount: {
            type: "string",
          },
          phone: {
            type: "string",
          },
        },
        example: {
          document: "997562405101981",
          phone: "3219069839",
          amount: "999",
        },
      },
      createdTransaction: {
        type: "object",
        properties: {
          success: {
            type: "boolean",
          },
          cod_error: {
            type: "string",
          },
          data: {
            type: "string",
          },
        },
        example: {
          success: true,
          cod_error: "00",
          data: "Balance successfully added, your current balance is $999,00",
        },
      },
      checkBalance: {
        type: "object",
        required: ["document", "phone"],
        properties: {
          document: {
            type: "string",
          },
          phone: {
            type: "string",
          },
        },
        example: {
          document: "1234656",
          phone: "1245633587",
        },
      },
      requestPayment: {
        type: "object",
        required: ["document", "phone"],
        properties: {
          document: {
            type: "string",
          },
          phone: {
            type: "string",
          },
          amount: {
            type: "string",
          },
        },
        example: {
          document: "2446562ww3",
          phone: "4123658745",
          amount: "200",
        },
      },
      checkedBalance: {
        type: "object",
        properties: {
          success: {
            type: "boolean",
          },
          cod_error: {
            type: "string",
          },
          data: {
            type: "string",
          },
        },
        example: {
          success: true,
          cod_error: "00",
          data: "Your current balance is $999,00",
        },
      },
      requestedPayment: {
        type: "object",
        properties: {
          success: {
            type: "boolean",
          },
          cod_error: {
            type: "string",
          },
          data: {
            type: "string",
          },
        },
        example: {
          success: true,
          cod_error: "00",
          data: "To confirm payment, check your email.",
        },
      },
      confirmPayment: {
        type: "object",
        required: ["document", "token", "session_id"],
        properties: {
          document: {
            type: "string",
          },
          token: {
            type: "string",
          },
          session_id: {
            type: "string",
          },
        },
        example: {
          document: "2446562ww3",
          phone: "4123658745",
          amount: "200",
        },
      },
      confirmedPayment: {
        type: "object",
        properties: {
          success: {
            type: "boolean",
          },
          cod_error: {
            type: "string",
          },
          data: {
            type: "string",
          },
        },
        example: {
          success: true,
          cod_error: "00",
          data: "To confirm payment, check your email.",
        },
      },
    },
  },
};

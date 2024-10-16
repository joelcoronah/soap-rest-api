const { getXmlContent } = require("../utils/build-xml");
const { convert } = require("../utils/xmlToJson");
const fetch = (...args) =>
  import("node-fetch").then(({ default: fetch }) => fetch(...args));

const callSoapServer = async (path, method, tag, body) => {
  const xmlContent = getXmlContent(tag, body);

  const url = `${process.env.URL_API}/${path}`;

  const options = {
    method: method,
    headers: {
      "Content-Type": "text/xml",
    },
    body: xmlContent,
    timeout: 15000,
  };

  let response = {
    success: false,
    cod_error: 500,
    message_error: "Error not found.",
    data: [],
  };

  try {
    response = await fetch(url, options).catch((error) => {
      console.log("Error in FETCH", error);
    });
    console.log({ response });
    response = await response.text();
    response = await convert(response);
  } catch (err) {
    console.log("Error", err);
  }

  return response;
};

module.exports = {
  callSoapServer,
};

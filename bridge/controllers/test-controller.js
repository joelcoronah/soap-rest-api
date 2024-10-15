const testController = async (req, res, next) => {
  const response = { message: "ok" };
  res.json(response);
};

module.exports = {
  testController,
};

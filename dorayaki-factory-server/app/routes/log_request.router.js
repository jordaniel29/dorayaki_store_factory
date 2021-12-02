module.exports = (app) => {
	const logRequest = require("../controllers/log_request.controller");
	var router = require("express").Router();

	router.get("/", logRequest.getCountRequest);

	router.post("/", logRequest.create);

	app.use("/log_request", router);
};

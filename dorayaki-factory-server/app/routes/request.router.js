const jwt = require("jsonwebtoken");

function authenticateToken(req, res, next) {
	const fromHeader = req.headers["from"];

	if (fromHeader === "supplier") {
		const authHeader = req.headers["authorization"];
		const token = authHeader && authHeader.split(" ")[1];

		if (token == null) return res.sendStatus(401);

		jwt.verify(token, process.env.ACCESS_TOKEN_SECRET, (err, user) => {
			console.log(err);

			if (err) return res.sendStatus(403);

			req.user = user;

			next();
		});
	} else {
		next();
	}
}

module.exports = (app) => {
	const request = require("../controllers/request.controller");
	var router = require("express").Router();

	router.get("/", authenticateToken, request.getAll);

	router.get("/check", authenticateToken, request.checkRequest);

	router.post("/", authenticateToken, request.create);

	router.put("/", authenticateToken, request.updateRequestByID);

	router.get("/update", authenticateToken, request.updateStoreRequest);

	app.use("/request", router);
};

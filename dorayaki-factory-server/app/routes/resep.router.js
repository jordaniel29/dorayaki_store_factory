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
	const resep = require("../controllers/resep.controller");
	var router = require("express").Router();

	// get all resep
	router.get("/", authenticateToken, resep.getAll);
	//create new resep
	router.post("/", authenticateToken, resep.create);
	// get all dorayaki
	router.get("/dorayaki", authenticateToken, resep.getAllDorayaki);
	//get dorayaki by nama
	router.get("/nama", authenticateToken, resep.getDorayakiByName);

	app.use("/resep", router);
};

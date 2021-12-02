module.exports = (app) => {
	const user = require("../controllers/user.controller");
	var router = require("express").Router();

	//create new user
	router.post("/register", user.create);

	//login user
	router.post("/login", user.logIn);

	app.use("/user", router);
};

const User = require("../models/user.model");
const bcrypt = require("bcrypt");
const jwt = require("jsonwebtoken");

require("dotenv").config();

exports.create = (req, res) => {
	// Validate request
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}

	//create new user
	const createNewUser = async () => {
		try {
			const salt = await bcrypt.genSalt(10);
			const hashedPassword = await bcrypt.hash(req.body.password, salt);
			const newUser = new User({
				username: req.body.username,
				password: hashedPassword,
			});

			const accessToken = jwt.sign(
				req.body.username,
				process.env.ACCESS_TOKEN_SECRET
			);

			User.create(newUser, (err, data) => {
				if (err)
					res.status(500).send({
						message:
							err.message || "Some error occurred while creating the user.",
					});
				else res.send({ success: accessToken });
			});
		} catch (e) {
			console.log(e);
			res.sendStatus(500);
		}
	};

	createNewUser();
};

exports.logIn = (req, res) => {
	User.findDataByUsername(req.body.username, (err, data) => {
		if (err) {
			res.send(`Error not found user with username ${req.body.username}.`);
		} else {
			bcrypt.compare(req.body.password, data.password, (error, match) => {
				if (match) {
					const accessToken = jwt.sign(
						req.body.username,
						process.env.ACCESS_TOKEN_SECRET
					);
					res.send({ success: accessToken });
				} else {
					res.send("Error wrong password");
				}
			});
		}
	});
};

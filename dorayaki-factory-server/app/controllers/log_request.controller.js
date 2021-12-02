const LogRequest = require("../models/log_request.model");

exports.getCountRequest = (req, res) => {
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}
	const newLog = {
		ip: req.headers.ip,
		endpoint: req.headers.endpoint,
	}
	LogRequest.getCountRequest(newLog, (err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while retrieving data.",
			});
		else res.send(data);
	});
};

exports.create = (req, res) => {
	// Validate request
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}
	const newLog = {
		ip: req.body.ip,
		endpoint: req.body.endpoint,
	}
	LogRequest.create(newLog, (err, data) => {
		if (err)
			res.status(500).send({
				message:
					err.message || "Some error occurred while creating the Request.",
			});
		else res.send(data);
	});
};

const Request = require("../models/request.model");

exports.getAll = (req, res) => {
	Request.getAll((err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while retrieving data.",
			});
		else res.send(data);
	});
};

exports.checkRequest = (req, res) => {
	Request.checkRequest((err, data) => {
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

	const newRequest = new Request({
		nama_dorayaki: req.body.nama_dorayaki,
		jumlah_stok: req.body.jumlah_stok,
	});

	Request.create(newRequest, (err, data) => {
		if (err)
			res.status(500).send({
				message:
					err.message || "Some error occurred while creating the Request.",
			});
		else res.send(data);
	});
};

exports.updateRequestByID = (req, res) => {
	// Validate request
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}

	const params = {
		id_request: req.body.id_request,
		status: req.body.status,
	};

	Request.updateRequestByID(params, (err, data) => {
		if (err)
			res.status(500).send({
				message:
					err.message || "Some error occurred while updating the Request.",
			});
		else res.send(data);
	});
};

exports.updateStoreRequest = (req, res) => {
	Request.updateStoreRequest((err, data) => {
		if (err)
			res.status(500).send({
				message:
					err.message || "Some error occurred while updating the Request.",
			});
		else res.send(data);
	});
};

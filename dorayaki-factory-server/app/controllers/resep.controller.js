const Resep = require("../models/resep.model");

exports.getAll = (req, res) => {
	Resep.getAll((err, data) => {
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

	const newResep = new Resep({
		nama_dorayaki: req.body.nama_dorayaki,
		nama_bahan_baku: req.body.nama_bahan_baku,
		jumlah_bahan_baku: req.body.jumlah_bahan_baku,
	});

	Resep.create(newResep, (err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while creating the Resep.",
			});
		else res.send(data);
	});
};

exports.getAllDorayaki = (req, res) => {
	Resep.getAllDorayaki((err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while retrieving data.",
			});
		else res.send(data);
	});
};

exports.getDorayakiByName = (req, res) => {
	// Validate request
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}

	Resep.getDorayakiByName(req.body.nama_dorayaki, (err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while creating the Resep.",
			});
		else res.send(data);
	});
};

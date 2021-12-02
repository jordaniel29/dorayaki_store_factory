const BahanBaku = require("../models/bahan_baku.model");

exports.getAll = (req, res) => {
	BahanBaku.getAll((err, data) => {
		if (err)
			res.status(500).send({
				message: err.message || "Some error occurred while retrieving data.",
			});
		else res.send(data);
	});
};

exports.create = (req, res) => {
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}

	const newbahanBaku = new BahanBaku({
		nama_bahan_baku: req.body.nama_bahan_baku,
		stok: req.body.stok
	});

	BahanBaku.create(newbahanBaku, (err, data) => {
		if (err)
			res.status(500).send({
				message:
					err.message || "Some error occurred while creating the Bahan baku.",
			});
		else res.send(data);
	});
};

exports.updateStokByNama = (req, res) => {
	if (!req.body) {
		res.status(400).send({
			message: "Content can not be empty!",
		});
	}

	BahanBaku.updateStokByNama(new BahanBaku(req.body), (err, data) => {
		if (err) {
			if (err.kind === "not_found") {
				res.status(404).send({
					message: `Not found bahan baku with name ${req.params.nama_bahan_baku}.`,
				});
			} else {
				res.status(500).send({
					message:
						"Error updating bahan baku with name " + req.params.nama_bahan_baku,
				});
			}
		} else res.send(data);
	});
};

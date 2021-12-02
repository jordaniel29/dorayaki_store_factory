const sql = require("./db.js");

const BahanBaku = function(bahanBaku) {
	this.nama_bahan_baku = bahanBaku.nama_bahan_baku;
	this.stok = bahanBaku.stok;
};

BahanBaku.getAll = (result) => {
	let query = "SELECT * FROM bahan_baku";

	sql.query(query, (err, res) => {
		if (err) {
			result(err, null);
			console.log("error: ", err);
			return;
		}

		console.log(res);
		result(null, res);
	});
};

BahanBaku.create = (newBahan, result) => {
	sql.query("INSERT INTO bahan_baku SET ?", newBahan, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		console.log("created bahan baku: ", { ...newBahan });
		result(null, { ...newBahan });
	});
};

BahanBaku.updateStokByNama = (bahanBaku, result) => {
	let query = "UPDATE bahan_baku SET stok = ? WHERE nama_bahan_baku = ?";

	sql.query(query, [bahanBaku.stok, bahanBaku.nama_bahan_baku], (err, res) => {
		if (err) {
			result(err, null);
			console.log("error: ", err);
			return;
		}

		if (res.affectedRows == 0) {
			result({ kind: "not_found" }, null);
			return;
		}

		console.log("updated stok: ", { ...bahanBaku });
		result(null, { ...bahanBaku });
	});
};

module.exports = BahanBaku;

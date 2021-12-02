const sql = require("./db.js");

const Resep = function (resep) {
	this.nama_dorayaki = resep.nama_dorayaki;
	this.nama_bahan_baku = resep.nama_bahan_baku;
	this.jumlah_bahan_baku = resep.jumlah_bahan_baku;
};

Resep.getAll = (result) => {
	let query = "SELECT * FROM resep order by nama_dorayaki, nama_bahan_baku";

	sql.query(query, (err, res) => {
		if (err) {
			result(null, err);
			console.log("error: ", err);
			return;
		}
		console.log(res);
		result(null, res);
	});
};

Resep.create = (newResep, result) => {
	sql.query("INSERT INTO resep SET ?", newResep, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		console.log("created resep: ", { ...newResep });
		result(null, { ...newResep });
	});
};
Resep.getAllDorayaki = (result) => {
	sql.query("SELECT DISTINCT nama_dorayaki FROM resep", (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}
		console.log(res);
		result(null, res);
	});
};
Resep.getDorayakiByName = (name, result) => {
	"SELECT * FROM resep where nama_dorayaki = ?",
		[name],
		(err, res) => {
			if (err) {
				result(null, err);
				console.log("error: ", err);
				return;
			}
			console.log(res);
			result(null, res);
		};
};

module.exports = Resep;

const sql = require("./db.js");
const nodemailer = require("nodemailer");

const Request = function (request) {
	this.nama_dorayaki = request.nama_dorayaki;
	this.jumlah_stok = request.jumlah_stok;
};

Request.getAll = (result) => {
	let query =
		"SELECT * FROM request order by status, nama_dorayaki, waktu_request";

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

Request.checkRequest = (result) => {
	let query = "SELECT * FROM request where read_by_store=0 order by status";

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

Request.create = (newRequest, result) => {
	sql.query("INSERT INTO request SET ?", newRequest, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		// send email notification
		const transporter = nodemailer.createTransport({
			service: "gmail",
			auth: {
				user: "dorayaki.nodemailer@gmail.com",
				pass: "dorayakiNodemailer123",
			},
		});

		const mailOptions = {
			from: "dorayaki.nodemailer@gmail.com",
			to: "hizkiagenius@gmail.com",
			subject: `New Request Incoming: ${newRequest.jumlah_stok}x ${newRequest.nama_dorayaki}`,
			text: `New Request Incoming: ${newRequest.jumlah_stok}x ${newRequest.nama_dorayaki}`,
		};

		transporter.sendMail(mailOptions, function (error, info) {
			if (error) {
				console.log(`Error: ${error}`);
			} else {
				console.log("Email sent: " + info.response);
			}
		});

		console.log("created request: ", { ...newRequest });
		result(null, { ...newRequest });
	});
};

Request.updateRequestByID = (params, result) => {
	//0 belum update, 1 accepted, 2 rejected
	sql.query(
		"UPDATE request set status =? where id_request = ?",
		[params.status, params.id_request],
		(err, res) => {
			if (err) {
				console.log("error: ", err);
				result(err, null);
				return;
			}

			console.log(res);
			result(null, res);
		}
	);
};

// Request.updateStoreRequest = (result) => {
// 	//Update request apakah sudah dilihat oleh store atau belum
// 	sql.query(
// 		"UPDATE request set read_by_store = 1 where id_request>0 and status!=0 and read_by_store = 0",
// 		(err, res) => {
// 			if (err) {
// 				console.log("error: ", err);
// 				result(err, null);
// 				return;
// 			}

// 			console.log(res);
// 			result(null, res);
// 		}
// 	);
// };

Request.updateStoreRequest = (result) => {
	sql.query(
		"UPDATE request set read_by_store = 1 where id_request>0 and status!=0 and read_by_store = 0",
		(err, res) => {
			if (err) {
				console.log("error: ", err);
				result(null, err);
				return;
			}

			if (res.affectedRows == 0) {
				console.log("no rows affected");
				return;
			}

			console.log("updated request");
			result(null, res);
		}
	);
};

module.exports = Request;

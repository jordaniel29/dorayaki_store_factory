const sql = require("./db.js");

const LogRequest = function (logRequest) {
	this.ip = logRequest.ip;
	this.endpoint = logRequest.endpoint;
};

LogRequest.getCountRequest = (newLog, result) => {
	let query =
		"SELECT COUNT(*) FROM log_request where ip=? and endpoint=? and timestamp >= now() - interval 1 minute";

	sql.query(query, [newLog.ip, newLog.endpoint], (err, res) => {
		if (err) {
			result(err, null);
			console.log("error: ", err);
			return;
		}

		console.log(res);
		result(null, res);
	});
};

LogRequest.create = (newLog, result) => {
	sql.query("INSERT INTO log_request SET ?", newLog, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		console.log("created log_request: ", { ...newLog });
		result(null, { ...newLog });
	});
};

module.exports = LogRequest;
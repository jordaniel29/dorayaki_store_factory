const sql = require("./db.js");

const User = function (user) {
	this.username = user.username;
	this.password = user.password;
};

//method buat register new user
User.create = (newUser, result) => {
	sql.query("INSERT INTO user SET ?", newUser, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		console.log("created user: ", { ...newUser });
		result(null, { ...newUser });
	});
};

//method buat find user by username utk login
User.findDataByUsername = (username, result) => {
	sql.query(`SELECT * FROM user WHERE username = ?`, username, (err, res) => {
		if (err) {
			console.log("error: ", err);
			result(err, null);
			return;
		}

		if (res.length) {
			console.log("found user: ", res[0]);
			result(null, res[0]);
			return;
		}

		//not found
		result({ kind: "not_found" }, null);
	});
};

module.exports = User;

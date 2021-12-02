const express = require("express");
const cors = require("cors");

const app = express();

const PORT = process.env.PORT || 8080;

// enable cors
app.use(cors());

// parse requests of content-type - application/json
app.use(express.json());

// parse requests of content-type - application/x-www-form-urlencoded
app.use(express.urlencoded({ extended: true }));

require("./app/routes/bahan_baku.router")(app);
require("./app/routes/resep.router")(app);
require("./app/routes/user.router")(app);
require("./app/routes/request.router")(app);
require("./app/routes/log_request.router")(app);

app.listen(PORT, () => {
	console.log(`Server is running on port ${PORT}.`);
});

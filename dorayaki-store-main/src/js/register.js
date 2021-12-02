function validateUsername(str) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			if (String(xmlhttp.responseText).includes("unique")) {
				document.getElementById("username").style.borderColor = "green";
				document.getElementById("warning").innerHTML = "";
			} else {
				document.getElementById("username").style.borderColor = "red";
				document.getElementById("warning").innerHTML =
					"Username already exist* please change your username";
			}
		}
	};
	xmlhttp.open("GET", "register.php?q=" + str, true);
	xmlhttp.send();
}

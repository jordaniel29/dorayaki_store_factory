import styles from "./Register.module.css";
import { Link } from "react-router-dom";
import React, { useState } from "react";
import axios from "axios";

const Register = () => {
	const [{ username, password }, createCredentials] = useState({
		username: "",
		password: "",
	});

	const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

		const newUser = {
			username: username,
			password: password,
		};

		console.log(newUser);
		axios
			.post("http://localhost:8080/user/register", newUser)
			.then((res) => {
				console.log(res);
				alert("created new user");
			})
			.catch((err) => {
				console.log(err);
				alert("failed to create new user");
			});

		window.location.href = "/login";
	};

	return (
		<div className={styles.all}>
			<div className={styles.login}>
				<div className={styles.login_internal}>
					<h2>Register</h2>
					<form onSubmit={(event) => handleSubmit(event)}>
						<input
							className={styles.text_field}
							id="username"
							type="text"
							placeholder="Username"
							name="username"
							required
							value={username}
							onChange={(event) =>
								createCredentials({
									username: event.target.value,
									password,
								})
							}
						/>
						<input
							className={styles.text_field}
							type="password"
							placeholder="Password"
							name="password"
							required
							value={password}
							onChange={(event) =>
								createCredentials({
									username,
									password: event.target.value,
								})
							}
						/>
						<p className={styles.warning} id="warning"></p>
						<input
							className={styles.submit_btn}
							type="submit"
							value="Register"
						/>
						<p>
							Already a member? Sign in{" "}
							<Link to="/login" className="nav-link">
								here
							</Link>
						</p>
					</form>
				</div>
			</div>
			<div className={styles.jumbotron}>
				<div className={styles.jumbo_text}>
					<h1>Factory Admin Tools</h1>
					<h4>
						Discover a new world of dorayaki, one you’ve never tasted before,
						with incredibly creamy fillings, soft buns at the best price!
					</h4>
				</div>
				<div className={styles.dorayaki_illustration}></div>
			</div>
		</div>
	);
};

export default Register;

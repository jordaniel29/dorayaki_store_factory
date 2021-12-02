import styles from "./Login.module.css";
import { Link } from "react-router-dom";
import React, { useState } from "react";
import { createCookie } from "../../utils/cookies";
import axios from "axios";

const Login = () => {
	const [{ username, password }, setCredentials] = useState({
		username: "",
		password: "",
	});

	const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
		e.preventDefault();

		const userLogin = {
			username: username,
			password: password,
		};

		console.log(userLogin);
		axios
			.post("http://localhost:8080/user/login", userLogin)
			.then((res) => {
				console.log(res);
				createCookie("token", res.data.success, 60);
				window.location.href = "../requests";
			})
			.catch((err) => console.log(err));
	};
	return (
		<div className={styles.all}>
			<div className={styles.login}>
				<div className={styles.login_internal}>
					<h2>Login</h2>
					<form onSubmit={(event) => handleSubmit(event)}>
						<input
							className={styles.text_field}
							type="text"
							placeholder="Username"
							name="username"
							value={username}
							onChange={(event) =>
								setCredentials({
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
							value={password}
							onChange={(event) =>
								setCredentials({
									username,
									password: event.target.value,
								})
							}
						/>
						<p className={styles.warning}></p>
						<input
							className={styles.submit_btn}
							type="submit"
							value="Login"
							name="login"
						/>
						<p>
							Don't have an account? Register{" "}
							<Link to="/register" className="nav-link">
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

export default Login;

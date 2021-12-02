import axios from "axios";
import { useEffect, useState } from "react";
import styles from "./Requests.module.css";

const Requests = () => {
	const [requests, setRequests] = useState<any[]>();

	const getRequests = () => {
		axios
			.get("http://localhost:8080/request/")
			.then((res) => {
				console.log(res.data);
				setRequests(res.data);
			})
			.catch((err) => console.log(err));
	};

	useEffect(() => {
		getRequests();
	}, []);

	const onStatusClick = (status: number, i: number) => {
		if (requests) {
			const reqBody = [...requests][i];
			reqBody.status = status;
			axios
				.put("http://localhost:8080/request/", reqBody)
				.then((res) => {
					console.log(res);
					getRequests();
				})
				.catch((err) => console.log(err));
		}
	};

	return (
		<div className={styles.all}>
			<h1>Requests</h1>
			<table className={styles.table}>
				<thead>
					<tr>
						<th>ID Request</th>
						<th>Nama Dorayaki</th>
						<th>Jumlah Stok</th>
						<th>Waktu Request</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					{requests &&
						requests.map((request, i) => {
							return (
								<tr key={i}>
									<td>{request.id_request}</td>
									<td>{request.nama_dorayaki}</td>
									<td>{request.jumlah_stok}</td>
									<td>{new Date(request.waktu_request).toLocaleString()}</td>
									{request.status === 0 ? (
										<td>
											<button
												onClick={() => onStatusClick(1, i)}
												className={styles.greenButton}
											>
												Accept
											</button>
											<button
												onClick={() => onStatusClick(2, i)}
												className={styles.redButton}
											>
												Reject
											</button>
										</td>
									) : request.status === 1 ? (
										<td>Accepted</td>
									) : (
										<td>Rejected</td>
									)}
								</tr>
							);
						})}
				</tbody>
			</table>
		</div>
	);
};

export default Requests;

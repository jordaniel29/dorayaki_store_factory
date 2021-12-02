import axios from "axios";
import React, { useEffect, useState } from "react";
import styles from "../../pages/Resep/Resep.module.css";
import { tokenConfig } from "../../utils/authorization";

const ListResep = () => {
	const [listResep, setResep] = useState([
		{ nama: "contoh", bahan_baku: [["gula", 1]] },
	]);
	const [temp, setTemp] = useState(0);

	useEffect(() => {
		setInterval(() => {
			setTemp((prevTemp) => prevTemp + 1);
		}, 5000);
	}, []);

	useEffect(() => {
		getResep();
	}, [temp]);

	const getResep = async () => {
		const tempNamaDorayaki: string[] = [];
		const tempResep = [{ nama: "contoh", bahan_baku: [["gula", 1]] }];
		var indeks = -1;

		// Mengambil resep
		await axios
			.get("http://localhost:8080/resep", tokenConfig)
			.then((response) => {
				tempResep.pop();
				for (var i in response.data) {
					if (!tempNamaDorayaki.includes(response.data[i]["nama_dorayaki"])) {
						indeks += 1;
						tempNamaDorayaki.push(response.data[i]["nama_dorayaki"]);
						tempResep.push({
							nama: response.data[i]["nama_dorayaki"],
							bahan_baku: [],
						});
					}
					tempResep[indeks].bahan_baku.push([
						response.data[i]["nama_bahan_baku"],
						response.data[i]["jumlah_bahan_baku"],
					]);
				}
			});

		// Mengatur state
		setResep(tempResep);
	};

	return (
		<>
			<div className={styles.container}>
				<div className={styles.center}>
					<h1>Resep</h1>
				</div>
				<div className={styles.daftar_resep}>
					<h2>Daftar Resep</h2>
					{listResep.map((resep, i) => {
						return (
							<div key={i} className={styles.item_resep}>
								<h3>{i + 1 + ". " + resep.nama}</h3>
								{resep.bahan_baku.map((bahan, j) => {
									return (
										<div key={j} className={styles.item_bahan}>
											<h4>{bahan[0] + " : " + bahan[1]}</h4>
										</div>
									);
								})}
							</div>
						);
					})}
				</div>
			</div>
		</>
	);
};

export default ListResep;

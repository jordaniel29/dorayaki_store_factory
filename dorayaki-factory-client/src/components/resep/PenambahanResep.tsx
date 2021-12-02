import axios from "axios";
import React, { useEffect, useState } from "react";
import styles from "../../pages/Resep/Resep.module.css";
import { tokenConfig } from "../../utils/authorization";

const PenambahanResep = () => {
	const [listBahan, setListBahan] = useState([["contoh", 0]]);
	const [namaDorayaki, setNamaDorayaki] = useState("");

	const getBahan = async () => {
		const tempBahan = [["contoh", 0]];

		await axios
			.get(`http://localhost:8080/bahan-baku/`, tokenConfig)
			.then((response) => {
				tempBahan.pop();
				for (var i in response.data) {
					tempBahan.push([response.data[i]["nama_bahan_baku"], 0]);
				}
			});

		setListBahan([...tempBahan]);
	};

	const changeJumlah = (e: any, i: number) => {
		const tempBahan = [...listBahan];
		tempBahan[i][1] =
			e.target.value === "-"
				? Number(tempBahan[i][1]) === 0
					? Number(tempBahan[i][1])
					: Number(tempBahan[i][1]) - 1
				: Number(tempBahan[i][1]) + 1;
		setListBahan(tempBahan);
	};

	const handleTambah = (e: any) => {
		listBahan.forEach((bahan) => {
			if (bahan[1] !== 0) {
				const newResep = {
					nama_dorayaki: namaDorayaki,
					nama_bahan_baku: bahan[0],
					jumlah_bahan_baku: bahan[1],
				};
				axios
					.post("http://localhost:8080/resep/", newResep, tokenConfig)
					.then((res) => console.log(res))
					.catch((err) => console.log(err));
			}
		});
	};

	useEffect(() => {
		getBahan();
	}, []);

	return (
		<>
			<div className={styles.container}>
				<h2>Penambahan Resep</h2>
				<div className={styles.form_tambah}>
					<div className={styles.form_input}>
						<h3>Nama Dorayaki</h3>
						<input
							type="text"
							className={styles.text_input}
							name="nama"
							placeholder="Masukkan nama varian dorayaki"
							onChange={(event) => setNamaDorayaki(event.target.value)}
							required
						/>
					</div>
					<div className={styles.form_input}>
						<h3>Bahan Baku</h3>
						{listBahan.map((bahan, i) => {
							return (
								<div key={i} className={styles.list_bahan_resep}>
									<h4>{bahan[0]}</h4>
									<div className={styles.counter}>
										<input
											type="button"
											value="-"
											className={styles.counter_btn}
											onClick={(event) => changeJumlah(event, i)}
										/>
										<input
											type="number"
											name="jumlah"
											className={styles.stok_input}
											value={bahan[1]}
											readOnly
										/>
										<input
											type="button"
											value="+"
											className={styles.counter_btn}
											onClick={(event) => changeJumlah(event, i)}
										/>
									</div>
								</div>
							);
						})}
						<input
							type="submit"
							name="submit"
							value="Tambah"
							className={styles.submit_btn}
							onClick={(event) => handleTambah(event)}
						/>
					</div>
				</div>
			</div>
		</>
	);
};

export default PenambahanResep;

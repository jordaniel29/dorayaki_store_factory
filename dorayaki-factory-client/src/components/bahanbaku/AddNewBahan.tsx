import axios from "axios";
import React, { useState } from "react";
import styles from "../../pages/Resep/Resep.module.css";
import { tokenConfig } from "../../utils/authorization";

const AddNewBahan = () => {
	const [namaBahan, setNamaBahan] = useState<string>("");
	const [jumlah, setJumlah] = useState<number>(0);

	const changeJumlah = (e: any) => {
		if (e.target.value === "-") {
			if (jumlah !== 0) {
				setJumlah(jumlah - 1);
			}
		} else {
			setJumlah(jumlah + 1);
		}
	};

	const handleTambah = (e: any) => {
		if (namaBahan && jumlah !== 0) {
			const newBahanBaku = {
				nama_bahan_baku: namaBahan,
				stok: jumlah,
			};
			axios
				.post("http://localhost:8080/bahan-baku/", newBahanBaku, tokenConfig)
				.then((res) => console.log(res))
				.catch((err) => console.log(err));
		}
	};

	return (
		<>
			<h2>Tambah Bahan Baku</h2>
			<div className={styles.form_tambah}>
				<div className={styles.form_input}>
					<h3>Nama Bahan Baku</h3>
					<input
						type="text"
						name="nama"
						placeholder="Masukkan nama bahan baku"
						value={namaBahan}
						className={styles.text_input}
						onChange={(e: React.ChangeEvent<HTMLInputElement>) => {
							setNamaBahan(e.target.value);
						}}
						required
					/>
				</div>
				<div className={styles.form_input}>
					<h3>Stok</h3>
					<div className={styles.container_stok}>
						<div className={styles.counter}>
							<input
								type="button"
								value="-"
								className={styles.counter_btn}
								onClick={changeJumlah}
							/>
							<input
								type="number"
								name="jumlah"
								className={styles.stok_input}
								min="0"
								value={jumlah}
								readOnly
							/>
							<input
								type="button"
								value="+"
								className={styles.counter_btn}
								onClick={changeJumlah}
							/>
						</div>
					</div>
					<input
						type="submit"
						name="submit"
						value="Tambah"
						className={styles.submit_btn}
						onClick={(event) => handleTambah(event)}
					/>
				</div>
			</div>
		</>
	);
};

export default AddNewBahan;

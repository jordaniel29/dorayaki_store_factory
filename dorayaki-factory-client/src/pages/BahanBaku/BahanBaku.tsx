import axios from "axios";
import { useEffect, useState } from "react";
import AddNewBahan from "../../components/bahanbaku/AddNewBahan";
import { tokenConfig } from "../../utils/authorization";
import styles from "../Resep/Resep.module.css";

const BahanBaku = () => {
	const [bahanList, setBahanList] =
		useState<{ nama_bahan_baku: string; stok: number }[]>();
	const [temp, setTemp] = useState(0);

	useEffect(() => {
		setInterval(() => {
			setTemp((prevTemp) => prevTemp + 1);
		}, 5000);
	}, []);

	useEffect(() => {
		getBahanBaku();
	}, [temp]);

	const getBahanBaku = async () => {
		await axios
			.get("http://localhost:8080/bahan-baku/", tokenConfig)
			.then((res) => {
				setBahanList(res.data);
			})
			.catch((err) => console.log(err));
	};

	useEffect(() => {
		getBahanBaku();
	}, []);

	const postData = (i: number) => {
		if (bahanList) {
			const updatedBahan = {
				nama_bahan_baku: bahanList[i].nama_bahan_baku,
				stok: String(bahanList[i].stok),
			};
			axios
				.put("http://localhost:8080/bahan-baku/", updatedBahan, tokenConfig)
				.then((res) => console.log(res))
				.catch((err) => console.log(err));
		}
	};

	const changeJumlah = (e: any, i: number) => {
		if (bahanList) {
			const tempBahan = [...bahanList];

			if (e.target.value === "+") {
				tempBahan[i].stok += 1;
			} else {
				tempBahan[i].stok -= 1;
			}
			setBahanList(tempBahan);
			postData(i);
		}
	};

	return (
		<div className={styles.all}>
			<div className={styles.container}>
				<div className={styles.center}>
					<h1>Bahan Baku</h1>
				</div>
				<div className={styles.daftar_bahan}>
					<h2>Daftar Bahan Baku</h2>
					{bahanList &&
						bahanList.length !== 0 &&
						bahanList.map((bahan, i) => {
							return (
								<div key={i} className={styles.list_bahan_baku}>
									<h4>
										{i + 1}. {bahan.nama_bahan_baku}
									</h4>
									<div className={styles.counter}>
										<input
											type="button"
											value="-"
											className={styles.counter_btn}
											onClick={(e) => {
												changeJumlah(e, i);
											}}
										/>
										<input
											type="number"
											name="jumlah"
											min="0"
											className={styles.stok_input}
											value={bahan.stok}
											readOnly
										/>
										<input
											type="button"
											value="+"
											className={styles.counter_btn}
											onClick={(e) => {
												changeJumlah(e, i);
											}}
										/>
									</div>
								</div>
							);
						})}
				</div>
				<AddNewBahan />
			</div>
		</div>
	);
};

export default BahanBaku;

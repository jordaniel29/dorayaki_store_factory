import PenambahanResep from "../../components/resep/PenambahanResep";
import ListResep from "../../components/resep/ListResep";
import styles from "./Resep.module.css";

const Resep = () => {
	return (
		<div className={styles.all}>
			<ListResep />
			<PenambahanResep />
		</div>
	);
};

export default Resep;

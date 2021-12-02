import { useLocation, Navigate } from "react-router-dom";
import { getCookieValue } from "../../utils/cookies";

const ProtectedRoute = ({ children }: { children: JSX.Element }) => {
	const isAuthenticated =
		getCookieValue("token") !== undefined &&
		getCookieValue("token") !== "undefined";
	const location = useLocation();

	if (isAuthenticated) {
		return children;
	} else {
		return <Navigate to="/login" state={{ from: location }} />;
	}
};

export default ProtectedRoute;

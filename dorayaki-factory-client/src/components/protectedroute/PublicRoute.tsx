import { useLocation, Navigate } from "react-router-dom";
import { getCookieValue } from "../../utils/cookies";

const PublicRoute = ({ children }: { children: JSX.Element }) => {
	const isAuthenticated =
		getCookieValue("token") !== undefined &&
		getCookieValue("token") !== "undefined";
	const location = useLocation();

	if (isAuthenticated) {
		return <Navigate to="/requests" state={{ from: location }} />;
	} else {
		return children;
	}
};

export default PublicRoute;

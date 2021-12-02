import { getCookieValue } from "./cookies";

export const tokenConfig = {
	headers: {
		Authorization: "Bearer " + getCookieValue("token"),
		From: "supplier",
	},
};

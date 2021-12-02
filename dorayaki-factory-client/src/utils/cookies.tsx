export const createCookie = (name: string, value: string, minutes: number) => {
	let expires = "";
	if (minutes) {
		const date = new Date();
		date.setTime(date.getTime() + minutes * 60 * 1000);
		expires = "; expires=" + date.toUTCString();
	} else {
		expires = "";
	}
	document.cookie = name + "=" + value + expires + "; path=/";
};

export const getCookieValue = (name: string) =>
	document.cookie.match("(^|;)\\s*" + name + "\\s*=\\s*([^;]+)")?.pop() ||
	undefined;

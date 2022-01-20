const header = document.querySelector("header"),
	nav = header.children[2],
	menu = header.children[3];
menu.addEventListener("click", () => {
	if (!nav.classList.contains("opened")) {
		// Closed menu
		nav.classList.add("opened")
	} else nav.classList.remove("opened")
})
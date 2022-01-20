const displayFormError = (title, subtitle) => {
		let formErrorAlert = document.querySelector(".form-error-alert");
		formErrorAlert.children[1].children[0].textContent = title;
		formErrorAlert.children[1].children[1].textContent = subtitle;
		formErrorAlert.style.display = "flex"
	},
	clearFormError = () => {
		try {
			let formErrorAlert = document.querySelector(".form-error-alert");
			formErrorAlert.style.display = "none";
			formErrorAlert.children[1].children[0].textContent = "";
			formErrorAlert.children[1].children[1].textContent = ""
		} catch (e) {}
	}
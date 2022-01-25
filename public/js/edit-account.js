const account = {
		form: document.querySelector("#edit-account-form"),
		required_fields: document.querySelector(".required-fields"),
		get inputs() {return this.form.querySelectorAll(".editable-input-container")},
		get first_name() {return this.inputs[0].lastElementChild.value},
		get last_name() {return this.inputs[1].lastElementChild.value},
		get email() {return this.inputs[2].lastElementChild.value},
		get phone() {return this.inputs[3].lastElementChild.value},
		get password() {return this.inputs[4].lastElementChild.value},
		get address() {return this.inputs[5].lastElementChild.value},
		get post_code() {return this.inputs[6].lastElementChild.value},
		get city() {return this.inputs[7].lastElementChild.value},
		edit: document.querySelector(".open-edit-account-form"),
		get cancel() {return this.form.querySelector(".cancel-changes")},
		get apply() {return this.form.querySelector(".apply-changes")}
	},
	expr = {
		first_name: /^[A-Za-zÀ-ú- ]+$/,
		last_name: /^[A-Za-zÀ-ú- ]+$/,
		email: /^[\w-\.]+@[\w-]+\.[\w-]{2,}$/,
		phone: /^0\d{9}$/,
		password: /^.{8,}$/,
		address: /^[\wÀ-ú- ]+$/,
		post_code: /^\d{5}$/,
		city: /^[A-Za-zÀ-ú- ]+$/
	},
	validation = {
		first_name: false,
		last_name: false,
		email: false,
		phone: false,
		password: false,
		address: false,
		post_code: false,
		city: false
	};
// Edit account informations
account.edit.addEventListener("click", () => {
	// Hide "Edit account" button while modifying account details
	account.edit.style.display = "none";
	// Show required fields info
	account.required_fields.style.display = "block";
	// Show actions section
	account.form.lastElementChild.style.display = "flex";
	// Set inputs editable
	account.inputs.forEach(input => {
		input.lastElementChild.readOnly = false;
		input.classList.add("editable")
	})
});
// Cancel account changes
account.cancel.addEventListener("click", () => {
	// Show "Edit account" button
	account.edit.style.display = "flex";
	// Clear form error container
	clearFormError();
	// Hide required fields info
	account.required_fields.style.display = "none";
	// Hide actions section
	account.form.lastElementChild.style.display = "none";
	account.inputs.forEach(input => {
		input.lastElementChild.readOnly = true;
		input.classList.remove("editable")
	})
});
// Form check-up before submitting
account.form.addEventListener("submit", e => {
	e.preventDefault();
	// Clear form error container
	clearFormError();
	// City check-up
	if (account.city.length > 0 && !expr.city.test(account.city)) {
		// Invalid city
		validation.city = false;
		displayFormError("Champ invalide", "Veuillez renseigner un nom de ville valide.")
	} else validation.city = true;
	// Post code check-up
	if (account.post_code.length > 0 && !expr.post_code.test(account.post_code)) {
		// Invalid post code
		validation.post_code = false;
		displayFormError("Champ invalide", "Veuillez renseigner un code postal valide.")
	} else validation.post_code = true;
	// Address check-up
	if (account.address.length > 0 && !expr.address.test(account.address)) {
		// Invalid address
		validation.address = false;
		displayFormError("Champ invalide", "Veuillez renseigner une adresse postale valide.")
	} else validation.address = true;
	// Password check-up
	if (account.password.length > 0 && !expr.password.test(account.password)) {
		// Weak password
		validation.password = false;
		displayFormError("Mot de passe faible", "Veuillez entrer un mot de passe d'au moins 8 caractères.")
	} else validation.password = true;
	// Phone check-up
	if (account.phone.length > 0 && !expr.phone.test(account.phone)) {
		// Invalid phone
		validation.phone = false;
		displayFormError("Numéro de téléphone invalide", "Les espaces ne sont pas demandés.")
	} else validation.phone = true;
	// Email check-up
	if (account.email.length > 0 && !expr.email.test(account.email)) {
		// Invalid email
		validation.email = false;
		displayFormError("E-mail invalide", "L'e-mail que vous avez rentré est invalide.")
	} else validation.email = true;
	// Last name check-up
	if (account.last_name.length > 0 && !expr.last_name.test(account.last_name)) {
		// Invalid last name
		validation.last_name = false;
		displayFormError("Champ invalide", "Veuillez renseigner une valeur alphabétique dans le nom.")
	} else validation.last_name = true;
	// First name check-up
	if (account.first_name.length > 0 && !expr.first_name.test(account.first_name)) {
		// Invalid first name
		validation.first_name = false;
		displayFormError("Champ invalide", "Veuillez renseigner une valeur alphabétique dans le prénom.")
	} else validation.first_name = true;
	// Last check-up and form submit
	if (
		validation.first_name &&
		validation.last_name &&
		validation.email &&
		validation.phone &&
		validation.password &&
		validation.address &&
		validation.post_code &&
		validation.city
	) {
		// Submit form
		account.form.submit()
	}
})
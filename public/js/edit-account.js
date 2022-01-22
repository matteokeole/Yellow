const editAccountForm = document.querySelector("#edit-account-form"),
	editableInputs = editAccountForm.querySelectorAll(".editable-input-container"),
	openEditAccountForm = document.querySelector(".open-edit-account-form"),
	cancelChanges = editAccountForm.querySelector(".cancel-changes"),
	applyChanges = editAccountForm.querySelector(".apply-changes");
openEditAccountForm.addEventListener("click", () => {
	// Open edit form
	openEditAccountForm.style.display = "none";
	editAccountForm.lastElementChild.style.display = "flex";
	editableInputs.forEach(e => {
		e.lastElementChild.readOnly = false;
		e.classList.add("editable")
	})
});
cancelChanges.addEventListener("click", () => {
	// Cancel changes & close edit form
	openEditAccountForm.style.display = "block";
	editAccountForm.lastElementChild.style.display = "none";
	editableInputs.forEach(e => {
		e.lastElementChild.readOnly = true;
		e.classList.remove("editable")
	})
})
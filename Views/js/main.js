//Registro de alumnos/////////////////////////////
let timeout;
let password = document.getElementById("passwordInput");
let confirmPassword = document.getElementById("verify-password");
let strengthBadge = document.getElementById("strengthDisp");
let passError = document.getElementById("pass-error");
let submitBtn = document.getElementById("btn-submit");

let strongPassword = new RegExp("(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})");
let mediumPassword = new RegExp("((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))");

let errorColor = "#C91D1D";
let mediumColor = "#E8A530";
let strongColor = "#73BD28";

function StrengthChecker(passwordParameter) {
	if (strongPassword.test(passwordParameter)) {
		strengthBadge.style.backgroundColor = strongColor;
		strengthBadge.textContent = "Fuerte";
		confirmPassword.disabled = false;
	} else if (mediumPassword.test(passwordParameter)) {
		strengthBadge.style.backgroundColor = mediumColor;
		strengthBadge.textContent = "Media";
		confirmPassword.disabled = false;
	} else {
		strengthBadge.style.backgroundColor = errorColor;
		strengthBadge.textContent = "Debil";
		confirmPassword.disabled = true;
	}
}

function MatchPassword(firstPass, secondPass) {
	if (firstPass === secondPass) {
		passError.textContent = "";
		submitBtn.disabled = false;
	} else {
		passError.style.color = errorColor;
		passError.textContent = "Las contraseñas no coinciden";
		submitBtn.disabled = true;
	}
}

password.addEventListener("input", () => {
	clearTimeout(timeout);
	timeout = setTimeout(() => StrengthChecker(password.value), 500);
	if (password.value.length !== 0) {
		strengthBadge.classList.remove("visually-hidden");
	} else {
		strengthBadge.classList.add("visually-hidden");
		password.textContent = "";
		confirmPassword.disabled = true;
	}
});

confirmPassword.addEventListener("input", () => {
	clearTimeout(timeout);
	timeout = setTimeout(
		() => MatchPassword(password.value, confirmPassword.value),
		500
	);
});
/////////////////////////////
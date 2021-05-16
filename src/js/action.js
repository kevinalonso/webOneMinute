function proRadio(radioVal){

	if (radioVal.checked) {
		document.getElementById('pro').style.display = 'block';
	}
}

function privRadio(radioVal){

	if (radioVal.checked) {
		document.getElementById('pro').style.display = 'none';
	}
}

function cgvRadio(radioVal){

	if (radioVal.checked) {
		//document.getElementById('payment-button').style.display = 'none';
		document.getElementById("payment-button").className = document.getElementById("payment-button").className.replace('disabled','');
	}
}
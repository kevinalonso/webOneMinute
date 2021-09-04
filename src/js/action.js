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

function sendCodeClick(){

	var code = $("#code").val();

	$.ajax({
	    type: "POST",
	    url: "/oneminute/public/codesend",
	    data: {
		    	code: code
	    	}
		}).done(function(data){

		    if (typeof data.status != "undefined" && data.status != "undefined")
		    {
		        // At this point we know that the status is defined,
		        // so we need to check for its value ("OK" in my case)
		        if (data.status == "OK")
		        {
		            location.href = '/oneminute/public/codeconfirmation';
		        } else if (data.status == "ERROR") {
		        	location.href = '/oneminute/public/errorcode';
		        }
		    }
		});
}
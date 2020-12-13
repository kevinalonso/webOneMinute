function createAnnouncement(){

	var title = $("#title").val();
	var category = $("#category").val();
	var description = $("#desc").val();
	var price = $("#price").val();

	if (typeof title != "undefined" && typeof category != "undefined" && typeof description != "undefined" && typeof price != "undefined" ) {

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/createannouncement",
	    data: {
		    	title: title,
	            category: category,
	            description: description,
	            price: price
	    	}
		})
		.done(function(data){

		    if (typeof data.status != "undefined" && data.status != "undefined")
		    {
		        // At this point we know that the status is defined,
		        // so we need to check for its value ("OK" in my case)
		        if (data.status == "OK")
		        {
		            location.href = '/oneminute/public/account';
		        }
		    }
		});

	} else {
		//Add response her if error
	}
}

function createAccount(){

	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var phone = $("#phone").val();
	var password = $("#password").val();
	var confirm = $("#confirm").val();
	var email = $("#email").val();
	var siret = $("#siret").val();
	var factory = $("#factory").val();
	var address = $("#address").val();
	var cp = $("#cp").val();
	var city = $("#city").val();
	var ispro = false;

	if(document.getElementById('inlineRadio2').checked || document.getElementById('inlineRadio2').checked){
		ispro = ($("#inlineRadio2").val() == "1") ? true : false ;
	}

	if (password == confirm && typeof password != "undefined" && typeof confirm != "undefined") {

		if ( typeof firstname != "undefined" && typeof lastname != "undefined" && typeof phone != "undefined"
		&& typeof password != "undefined" && typeof email != "undefined" && typeof address != "undefined"
		&& typeof cp != "undefined" && typeof city != "undefined") {

			if (ispro == true) {
				if (typeof factory != "undefined") {
					postUser(firstname,lastname,phone,password,email,siret,factory,address,cp,city,ispro);
				} else {
					alert("Merci de saisir le nom de l'entreprise");
					redirectErrorForm();
				}
			}

			postUser(firstname,lastname,phone,password,email,siret,factory,address,cp,city,ispro);

		} else {
			alert("Merci de saisir tous les champs obligatoire *");
			redirectErrorForm();
		}

	} else {
		alert("Vos mot de passe sont différents");
		redirectErrorForm();
	}

}

function postUser(firstname,lastname,phone,password,email,siret,factory,address,cp,city,ispro){
	$.ajax({
	    type: "POST",
	    url: "/oneminute/public/createuser",
	    data: {
		    	firstname: firstname,
	            lastname: lastname,
	            phone: phone,
	            password: password,
	            email: email,
	            siret: siret,
	            factory: factory,
	            address: address,
	            cp: cp,
	            city: city,
	            ispro: ispro
	    	}
	})
	.done(function(data){
		if (data.status == "OK")
        {
            location.href = '/oneminute/public/login';
        }
	});
}

function redirectErrorForm(){
	location.href = '/oneminute/public/accountcreate';
}
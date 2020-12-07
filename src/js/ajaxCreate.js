function createAnnouncement(){

	var title = $("#title").val();
	var category = $("#category").val();
	var description = $("#desc").val();
	var price = $("#price").val();

	if (title !== null && category !== null && description !== null && price !== null ) {

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
	var email = $("#email").val();
	var siret = $("#siret").val();
	var factory = $("#factory").val();
	var address = $("#address").val();
	var cp= $("#cp").val();
	var city = $("#city").val();

	$.ajax({
	    type: "POST",
	    url: "/oneminute/public/accountcreate",
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
	            city: city
	    	}
	})
	.done(function(data){
		if (data.status == "OK")
        {
            location.href = '/oneminute/public/account';
        }
	});


}
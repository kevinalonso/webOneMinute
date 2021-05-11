function updateRib(){
	var iban = $("#iban").val();
	var bic = $("#bic").val();
	var id = $("#id").val();

	if (typeof iban != "undefined" && typeof bic != "undefined"){

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/editbank",
	    data: {
		    	iban: iban,
	            bic: bic,
	            id : id
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
	}
}

function updateAnnouncement(){
	var title = $("#title").val();
	var category = $("#category").val();
	var desc = $("#desc").val();
	var price = $("#price").val();
	var id = $("#id").val();

	if (typeof title != "undefined" && typeof category != "undefined" && typeof desc != "undefined" && typeof price != "undefined" ){

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/editannouncement",
	    data: {
		    	title: title,
	            category: category,
	            desc: desc,
	            price: price,
	            id : id
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
	}
}
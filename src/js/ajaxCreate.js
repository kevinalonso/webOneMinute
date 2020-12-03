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
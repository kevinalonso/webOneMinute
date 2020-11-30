function sendMailClick(){

	var email = $("#email").val();
	var name = $("#name").val();
	var obj = $("#subject").val();
	var msg = $("#message").val();


	$.ajax({
	    type: "POST",
	    url: "/oneminute/public/sendmail",
	    data: {
	    	email: email,
            name: name,
            obj: obj,
            msg: msg
	    }
	})
	.done(function(data){

	    if (typeof data.status != "undefined" && data.status != "undefined")
	    {
	        // At this point we know that the status is defined,
	        // so we need to check for its value ("OK" in my case)
	        if (data.status == "OK")
	        {
	            console.log("mail send success");
	        }
	    }
	});

 	/*$.ajax({
		url:"/oneminute/public/sendmail",  
    	type: "POST",
        dataType: "json",
        data: {
            "email": email,
            "name": name,
            "obj": obj,
            "msg": msg
        },   
       	async:true,
       	success: function(data) {
       		alert(data);
       	},error : function() {  
            alert('Une erreur est survenue pendant l\'envoie du mail');  
        }
    });*/
}
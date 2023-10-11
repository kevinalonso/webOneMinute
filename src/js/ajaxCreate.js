/****************CONST**********************/
var img1base64;
var img2base64;
var img3base64;
var img4base64;
var img5base64;
var img6base64;
var img7base64;
var img8base64;
var img9base64;
/*******************************************/

function createRib(){
	var iban = $("#iban").val();
	var bic = $("#bic").val();

	if (typeof iban != "undefined" && typeof bic != "undefined"){

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/createrib",
	    data: {
		    	iban: iban,
	            bic: bic
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

/************************Preview event****************/
img1.onchange = evt => {
  const [file] = img1.files
  if (file) {
    preview1.src = URL.createObjectURL(file)
  }
}
img2.onchange = evt => {
  const [file] = img2.files
  if (file) {
    preview2.src = URL.createObjectURL(file)
  }
}
img3.onchange = evt => {
  const [file] = img3.files
  if (file) {
    preview3.src = URL.createObjectURL(file)
  }
}
img4.onchange = evt => {
  const [file] = img4.files
  if (file) {
    preview4.src = URL.createObjectURL(file)
  }
}
img5.onchange = evt => {
  const [file] = img5.files
  if (file) {
    preview5.src = URL.createObjectURL(file)
  }
}
img6.onchange = evt => {
  const [file] = img6.files
  if (file) {
    preview6.src = URL.createObjectURL(file)
  }
}
img7.onchange = evt => {
  const [file] = img7.files
  if (file) {
    preview7.src = URL.createObjectURL(file)
  }
}
img8.onchange = evt => {
  const [file] = img8.files
  if (file) {
    preview8.src = URL.createObjectURL(file)
  }
}
img9.onchange = evt => {
  const [file] = img9.files
  if (file) {
    previewç.src = URL.createObjectURL(file)
  }
}

/***************************************************/

/***************Transform img to base 64************/
var indiceCst;
function readFile(indice) {
  
  indiceCst = indice
  if (this.files && this.files[0]) {
    
    var fileReader = new FileReader();
    
    fileReader.addEventListener("load", function(e) {
    	
    	switch (indiceCst.srcElement.id) {
		  case 'img1':
		    img1base64 = e.target.result;
		    break;
		  case 'img2':
		    img2base64 = e.target.result;
		    break;
		    case 'img3':
		    img3base64 = e.target.result;
		    break;
		    case 'img4':
		    img4base64 = e.target.result;
		    break;
		    case 'img5':
		    img5base64 = e.target.result;
		    break;
		    case 'img6':
		    img6base64 = e.target.result;
		    break;
		    case 'img7':
		    img7base64 = e.target.result;
		    break;
		    case 'img8':
		    img8base64 = e.target.result;
		    break;
		    case 'img9':
		    img9base64 = e.target.result;
		    break;
		  default:
		  	console.log("Image not found");
		  	break;
		}
    }); 
    fileReader.readAsDataURL( this.files[0] );
  }
  
}

document.getElementById("img1").addEventListener("change", readFile);
document.getElementById("img2").addEventListener("change", readFile);
document.getElementById("img3").addEventListener("change", readFile);
document.getElementById("img4").addEventListener("change", readFile);
document.getElementById("img5").addEventListener("change", readFile);
document.getElementById("img6").addEventListener("change", readFile);
document.getElementById("img7").addEventListener("change", readFile);
document.getElementById("img8").addEventListener("change", readFile);
document.getElementById("img9").addEventListener("change", readFile);

/**************************************************/

function createAnnouncement(){

	var title = $("#title").val();
	var category = $("#category").val();
	var description = $("#desc").val();
	var price = $("#price").val();
	var city = $("#city").val();


	if (typeof title != "undefined" && typeof category != "undefined" && typeof description != "undefined" && typeof price != "undefined" ) {

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/createannouncement",
	    data: {
		    	title: title,
		    	city: city,
	            category: category,
	            description: description,
	            price: price,
	            img1: img1base64,
	            img2: img2base64,
	            img3: img3base64,
	            img4: img4base64,
	            img5: img5base64,
	            img6: img6base64,
	            img7: img7base64,
	            img8: img8base64,
	            img9: img9base64
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
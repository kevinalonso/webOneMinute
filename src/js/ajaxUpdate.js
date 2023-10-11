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
	var city = $("#city").val();

	if (typeof title != "undefined" && typeof category != "undefined" && typeof desc != "undefined" && typeof price != "undefined" ){

		$.ajax({
	    type: "POST",
	    url: "/oneminute/public/editannouncement",
	    data: {
		    	title: title,
		    	city: city,
	            category: category,
	            desc: desc,
	            price: price,
	            id : id,
	            img1 : img1base64,
	            img2 : img2base64,
	            img3 : img3base64,
	            img4 : img4base64,
	            img5 : img5base64,
	            img6 : img6base64,
	            img7 : img7base64,
	            img8 : img8base64,
	            img9 : img9base64
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
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

function searchCatrgory(){

	var search = $("#search-category").val();
	var idCat = document.querySelector("#search-addon").dataset.categoryId;

	$.ajax({
	    type: "POST",
	    url: "/oneminute/public/search/category/"+idCat,
	    data: {
		    	search: search
	    	}
		}).done(function(data){
			document.open();
			document.write(data.html);
			document.close();
		});

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

/*$('.dropdown').hover(
	function(event){
		var ulWidth = $('.second-menu')[0].offsetWidth;
		var i = 0;
		var height = 0;
		$('.dropdown-menu').each(function(){
			if ( $('.dropdown-menu')[i].offsetHeight > 0) {
				height = $('.dropdown-menu')[i].offsetHeight;
				$('.dropdown-menu')[i].style.width = '100%';
			}
			i = i + 1;
		});
		if (height > 0) {
			height = height + 10;
		}
		$('.add-menu-item')[0].style.height = height.toString()+'px';
	}
)*/
var temp = 0;
var openDropMenu;
$(document).ready(function() 
{
   $('li').click(function(e) 
   {
    	var ulWidth = $('.second-menu')[0].offsetWidth;
		var i = 0;
		var height = 0;
		$('.dropdown-menu').each(function(){
			if ( $('.dropdown-menu')[i].offsetHeight > 0) {			
				$('.dropdown-menu')[i].style.width = 'auto';
				$('.dropdown-menu')[i].style.display = 'block';
				openDropMenu = $('.dropdown-menu')[i];
				height = $('.dropdown-menu')[i].offsetHeight;

				if (temp != i) {
					$('.dropdown-menu')[temp].style.display = 'none';
					$('.dropdown-menu')[temp].style.visibility = 'hidden';
				}
				
				$('.dropdown-menu')[i].style.visibility = 'visible';

				temp = i;
			}
			i = i + 1;
		});

		if (height > 0) {
			height = height + 80;
		}
		$('.add-menu-item')[0].style.height = height.toString()+'px';
   });
});


$( "#menu-item-desk" ).on("click","li.nav-item", function(event){    
    console.log('testing');
});
/*document.addEventListener("click", function(evt) {

	var clickPlace = targetEl = evt.target;
	
});*/
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


var temp = 0;
var openDropMenu;
$(document).ready(function() 
{
   $('ul.second-menu li').click(function(e) 
   {
    	var ulWidth = $('.second-menu')[0].offsetWidth;
		var i = 0;
		var height = 0;
		$('.dropdown-menu').each(function(){
			if ( $('.dropdown-menu')[i].offsetHeight > 0) {			
				$('.dropdown-menu')[i].style.width = '100%';
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
			height = height + 10;
		}
		$('.add-menu-item')[0].style.height = height.toString()+'px';
   });
});
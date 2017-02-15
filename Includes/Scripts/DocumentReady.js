/* ======================================================================================================
   REQUIRED METHODS
======================================================================================================== */

var StickyHeaderFunction = function() {
	
	var scroll = $(window).scrollTop();
    
    if( $(window).width() >= 830 ) {
    	
    	$("#TopNav").show();
	    
	}
	else {

		//$(".TopHeader, #TopNav").hide();
		$("#SwitchForMobile-1").insertAfter("#SwitchForMobile-2");

	}

}


var Testimonials = function() {
	if ($(window).width() < 489) {
	   $(function(){
    
		    var $divs = $(".TestimonialsContent > .Testimonial"),
		        N = $divs.length,
		        C = 0;                   // Current    
		    
		    $divs.hide().eq( C ).show();
		    
		    $("#Next, #Previous").click(function(){
		        $divs.stop().hide().eq( (this.id=='next'? ++C : --C) %N ).show();
		    });
		    
		});
	} else if ($(window).width() > 489){
		$(".Testimonial").show();
	}

}


var Portraits = function() {
	if ($(window).width() < 489) {
	   $(function(){
    
		    var $divs = $(".Portraits > .Portrait"),
		        N = $divs.length,
		        C = 0;                   // Current    
		    
		    $divs.hide().eq( C ).show();
		    
		    $("#Next, #Previous").click(function(){
		        $divs.stop().hide().eq( (this.id=='next'? ++C : --C) %N ).show();
		    });
		    
		});
	} else if ($(window).width() > 489){
		$(".Portrait").show();
	}

}


var TabSwitch = function() {

	if ($(window).width() < 785) {
		$(".SectionTableLounge .FlightsHeader").click(function(){

			var s = $(this).attr("data-show");
			$(".SectionTableLounge table").hide();
			$(".SectionTableLounge .FlightsHeader").removeClass("Selected");
			$(".SectionTableLounge table" + s).show();
			$(".SectionTableLounge .FlightsHeader" + s).addClass("Selected");

		});
	} else if ($(window).width() > 785){
		$(".SectionTableLounge table").show();
	}

}


var Equalheight = function(container) {

    var
        currentTallest 	= 0,
        currentRowStart = 0,
        rowDivs 		= new Array(),
        $el,
        topPosition 	= 0;

    $(container).each(function() {

        $el = $(this);
        $($el).height('auto')
        topPostion = $el.position().top;

        if (currentRowStart 	!= topPostion) {
            for (currentDiv 	= 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length 		= 0; // empty the array
            currentRowStart 	= topPostion;
            currentTallest 		= $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest 		= (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv 		= 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });

}


var LoadContactMap = function() {

	var myLatLng = {lat: 56.3046146, lng:10.6108264};

	var map = new google.maps.Map(document.getElementById('ContactMap'), {
		zoom: 14,
		center: myLatLng,
		scrollwheel: false,
	    navigationControl: false,
	    mapTypeControl: false,
	    scaleControl: false,
	    draggable: false		
	});

	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map
	});

}


var Exclamation = function() {
	
	$('.Exclamation')
		.parent()
		.attr('colspan', 2)
		.css('text-align', 'left')
		.next()
		.remove();

}

var CopyTopBarText = function(Width) {
	
	// Copy the text from top bar and paste it in mobile version
	 
	if(Width < 830) {

		$('#MobileTables a').text($('#ArrivalsDepartures a').text() );
		$('#MobileMap a').text($('#Destinations a').text() );

	}

}



var CheckIE9 = function() {
    
    var Agent = window.navigator.userAgent;
    var Index = Agent.indexOf("MSIE");

    if( Index > 0 || !! navigator.userAgent.match(/Trident.*rv\:11\./) ) {

        var Version = parseInt( Agent.substring( Index + 5, Agent.indexOf ( "." , Index ) ) );

        if( Version == 9 ) {

            return true;

        }
    
    }

    else {

        return false;

    }

}


function CustomURL(Path) {

	switch(location.hostname) {

		case 'localhost':
			return 'http://localhost/aarv2/' + Path;
			break;

		case '178.62.239.170':
			return 'http://178.62.239.170/aarv2/' + Path;
			break;

		default:
			return 'http://aarstaging.vds500.dk/' + Path;
			break;

	}

}



/* ======================================================================================================
   AJAX CALL FOR SEARCH
====================================================================================================== */

var SearchAjax = function(Query) {

	$('.Results').empty();

	$.ajax
		(
			{
				type: 'POST',
				url: CustomURL('search'),
				data: {'Query': Query},

				success: function(Result){

					$('.Results').empty();
	        		
	        		for (I in Result.Response) {

	        			if (Result.Response[I].Title != null) {

	        				$('.Results').append('<a href="' 
	        										+ CustomURL('content/' + Result.Response[I].URL) + '"><li>' 
	        										+ Result.Response[I].Title
	        										+ '<br /><span>' + Result.Response[I].Description.substring(0, 70) 
	        										+ '...</span></li></a>');

	        			}

	        		}
	    		},

	    		error: function(){
	    			console.log('Failed');
	    		}
	    	}
	    );

}




/* ======================================================================================================
   LOAD RESIZE SCROLL
======================================================================================================== */

$(window).on("load resize orientationchange", function(){

	TabSwitch();

	Portraits();

	Testimonials();

	CopyTopBarText($(this).width());	

	if($(this).width() > 830 ) { 
		$('.LanguagePicker').hide();
		$('.DropDown').find('ul').removeClass('OpenDropDown').hide().attr('style', '');
	}

});


$(window).on('load', function(){
	
	if($('#ContactMap').length > 0 ) {
		LoadContactMap();		
	}

	if($('.Exclamation').length > 0) {
		Exclamation();	
	}

	if( CheckIE9() ) {
		$('.BannerContent').addClass('IEFixBannerContent').removeClass('NoAbsolute');
		$('#JutlandBanner').css('minHeight', '0px');
	}

});


$(window).on("load resize scroll", function(){
	
	StickyHeaderFunction();	
	
});


$(window).on('load scroll', function () {

    var ScrollTop = $(window).scrollTop();

    if (ScrollTop > 150) {

        $('.StickyHeader').addClass('NoPadding');

    }
    else {

         $('.StickyHeader').removeClass('NoPadding');

    }

});



/* ======================================================================================================
   FOOTER LINKS
======================================================================================================== */

$(".NavColumn").click(function(){
	
	if ( $(window).width() < 489 ) {

		var s = $(this).attr("data-show");
		$(".NavColumn " + s).slideToggle();
		
	}

});




/* ======================================================================================================
   VIDEO 
======================================================================================================== */

$('video').parent().click(function () {
   
    if($(this).children("video").get(0).paused){
        
        $(this).children("video").get(0).play();
        $(this).children(".playpause").fadeOut();

    }
    else{

       $(this).children("video").get(0).pause();
       $(this).children(".playpause").fadeIn();

    }

});



/* ======================================================================================================
   LANGUAGE SELECTOR 
======================================================================================================== */

$(".ChooseLanguage").click(function(){

	$('.LanguagePicker')
		.slideToggle();

	$(".ChooseLanguage span:nth-child(3)")
		.toggleClass('ChangeArrow');

});




/* ======================================================================================================
   NAVIGATION
======================================================================================================== */

$(".MobileNavBtn").click(function(){

	$(".MobileNavBtn").toggleClass('open');		

	$('#TopNav').toggleClass('ToggleNav');

	$('body').toggleClass('MobileNavIsActive');

});


$('#Facility5').click(function(event) {

	$('#Destinations').trigger('click');
	
});


$('.FacilityBox').click(function(event) {
	
	if( $(this).find('a').attr('href') != undefined) {

		location.href = $(this).find('a').attr('href');
	}

});



var Width = $(window).width(); 
$(window).resize(function() {
    if ($(window).width() != Width) {

    	$('.MenuSearch').blur();

    }; 
    Width = $(window).width();
});


/* ======================================================================================================
   NAVIGATION
======================================================================================================== */

$('.SocialBox').on('click', function() {

	if($(this).find('a').attr('href')) {

		window.open($(this).find('a').attr('href'), '_blank');

	} else {
		$(this).find('a').click();
	}

})

$('.SocialBox a').on('click', function(e) {
	e.stopPropagation();
})



/* ======================================================================================================
   MAP FILTER EVENTS
======================================================================================================== */

// Buttons

$('.Buttons button').on('click', function() {

	Filter 			= $(this).data('filter');
	FilterType 		= $(this).data('filter-type');

	// Loop through all buttons on page (buttons are one option only)
	$('.Buttons button').each(function() {

	    // Where the filter type of clicked button is not equal to filter type of looped button
	    if (FilterType == 'All') {

	    	SampleMap.ResetFilters();

	    } else if (FilterType == $(this).data('filter-type')) {

	    	SampleMap.SetFilter(Filter, $(this).data('filter-type'), true);

	    } else {

	    	SampleMap.SetFilter(Filter, $(this).data('filter-type'), false);

	    }
	});

});

// Checkboxes

$('.Buttons input[type="checkbox"]').on('click', function() {

	SampleMap.SetFilter($(this).data('filter'), $(this).data('filter-type'), $(this).prop('checked'));

});



/* ======================================================================================================
   SEARCH EVENTS
======================================================================================================== */


// On Focus

$('.MenuSearch').on('focus', function() {

	if($(window).width() > 830) {
		$('.Navigation .NavLink ul li a.MenuLink, .Navigation .NavLink ul li.DropDown').
			css({
				'opacity': 0.5, 
				'pointer-events' : 'none', 
				'cursor' : 'default'
			});
	}
	$('.Results').empty();
	$('.Results').show();

})
	

// On Blur

$('.MenuSearch').on('blur', function() {

	setTimeout(function() {

		$('.Navigation .NavLink ul li a.MenuLink, .Navigation .NavLink ul li.DropDown')
			.css({
				'opacity': 1, 
				'pointer-events' : 'all', 
				'cursor' : 'pointer'
			});
		$('.Results').hide();

	}, 300);

});




// Key Events

$('.MenuSearch').on('input', function() {

	if ($(this).val().length >= 3) {

		var Query = $(this).val();

		SearchAjax(Query);

	} else {

		$('.Results').empty();
		
	}

})

$('.TopHeaderLeft').on('click', function() {

	if(! $(this).hasClass('ChooseLanguage')) {
		
		if($(this).find('a').attr('href')) {
			
			window.location.href = $(this).find('a').attr('href');

		}

	}
	
})


// Tab Switch For Arrivals & Departures Table Page

$('.TableLink a').on('click', function() {

	// If MiniCMS is enabled then dont show the ArrivalsDepartures window
	
	if( ! $(this).find('string').attr('contenteditable') ) {

		$('#ArrivalsDepartures').click();

		if ($(this).parent().data('attr') == 'arr'){

			$('.ArrivalsDepartures .FlightsHeader#arr').click();

		}

	}

})


/* ======================================================================================================
   DOCUMENT READY
======================================================================================================== */
var userAgent = navigator.userAgent || navigator.vendor || window.opera;

$(document).ready(function(Event) {
	
	/* ------------------------------------------------------------------------------------------------------
	   SEARCH ARROW KEYS
	------------------------------------------------------------------------------------------------------ */

	$('body').on('keyup', function(e) {

	 	if($('.Results').is(':visible') ){
		    
		    switch(e.which) {

		        case 38: // up
		        	
		        	if( $('.Results a').hasClass('HoverSearchItem') )  {
		        		
		        		var I = $('.Results a.HoverSearchItem').index();
		        		$('.Results a').eq(I).removeClass('HoverSearchItem');
		        		
		        		if( I == 0) {
		        			$('.Results a').eq($('.Results a').length - 1).addClass('HoverSearchItem');
		        		}
		        		else {
		        			$('.Results a').eq(I-1).addClass('HoverSearchItem');
		        		}		        			
		        	
		        	} else {
		        		$('.Results a:last').addClass('HoverSearchItem');	        	
		        	}

		        break;


		        case 40: // down

		        	if( $('.Results a').hasClass('HoverSearchItem') )  {
		        		
		        		var I = $('.Results a.HoverSearchItem').index();
		        		$('.Results a').eq(I).removeClass('HoverSearchItem');
		        		
		        		if( I == ( $('.Results a').length - 1)) {
		        			$('.Results a').eq(0).addClass('HoverSearchItem');
		        		}
		        		else {
		        			$('.Results a').eq(I+1).addClass('HoverSearchItem');
		        		}		        			
		        	
		        	} else {
		        		$('.Results a:first').addClass('HoverSearchItem');	        	
		        	}        		

		        break;
		        
		    }
	 	
	 	}
	    
		$('.Results a').hover(
			
			function() {
				$('.Results a').removeClass('HoverSearchItem');
				$(this).addClass('HoverSearchItem');
			}, 
			function() {
				$(this).removeClass('HoverSearchItem');
			}

		);
	    

	    if(e.keyCode == 13){
	    	
	    	if( $('.Results a.HoverSearchItem').attr('href') != '' && $('.Results a.HoverSearchItem').attr('href') != undefined ) {
	    	
	    		window.location.href = $('.Results a.HoverSearchItem').attr('href');
	    	
	    	}

	    }
	    

	});


	/* ------------------------------------------------------------------------------------------------------
	   TOUCH AND CLICK
	------------------------------------------------------------------------------------------------------ */
	
	// We have to disable hover effect on touch screens

    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
    	$('.Navigation .NavLink .DropDown').removeClass('NonIpad');
        $('.Navigation .NavLink .DropDown:hover > ul, .Navigation .NavLink .DropDown:hover ul').css({'pointer-events': 'none !important'});
    }

    if (/android/i.test(userAgent)) {
    	$('.Navigation .NavLink .DropDown').removeClass('NonIpad');
        $('.Navigation .NavLink .DropDown:hover > ul, .Navigation .NavLink .DropDown:hover ul').css({'pointer-events': 'none !important'});
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
    	$('.Navigation .NavLink .DropDown').removeClass('NonIpad');
        $('.Navigation .NavLink .DropDown:hover > ul, .Navigation .NavLink .DropDown:hover ul').css({'pointer-events': 'none !important'})
    }




	/* ------------------------------------------------------------------------------------------------------
	   DROP DOWN
	------------------------------------------------------------------------------------------------------ */

	$('.DropDown').on('click', function() {	

		if($(window).width() < 830){	

			if( $('.DropDown').find('ul').hasClass('OpenDropDown') )  {				
				$('.DropDown').find('ul').removeClass('OpenDropDown');
			} else {
				$('.DropDown').find('ul').addClass('OpenDropDown');
			}		

		} 


	    if ($(window).width() == 1024 && ( /iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) ) {
	    	
	    	if( $('.DropDown').find('ul').hasClass('OpenDropDown') )  {				
				$('.DropDown').find('ul').removeClass('OpenDropDown');
			} else {
				$('.DropDown').find('ul').addClass('OpenDropDown');
			}	

	    }
		
	});


	/* ------------------------------------------------------------------------------------------------------
	   HOME PAGE SEARCH
	------------------------------------------------------------------------------------------------------ */

	$('#SearchButton').click(function(event) {

		if( $('#SearchBar').length > 0 ) {
			if( $('#SearchBar').val().replace(/[^a-zA-Z ]/g, '') != '' ) {

				window.location = CustomURL('search/' + $('#SearchBar').val().replace(/[^a-zA-Z ]/g, '') );

			}
		}

	});	

	$('body').on('keyup', function(event) {		

		if( $('#SearchBar').length > 0 ) {
			if( $('#SearchBar').val().replace(/[^a-zA-Z ]/g, '') != '' && event.keyCode == 13) {

				window.location = CustomURL('search/' + $('#SearchBar').val().replace(/[^a-zA-Z ]/g, '') );

			}
		}

	});

	/* ------------------------------------------------------------------------------------------------------
	   GOOGLE MAPS ON CMS PAGES
	------------------------------------------------------------------------------------------------------ */
	
	// Apply some styles on google maps which are embedded via CMS

	$('.RowWidth100, .RowWidth60, .RowWidth50, .RowWidth40').each(function() {

		var Src = $(this).find('iframe').attr('src');
		
		// what if we have undefined in src.

		if(Src) {
			
			// Get to know if the src has google word in it
			
			if( Src.match('google') ) {

				$(this)
					.find('iframe')
					.attr({
						'height' : '',
						'width' : ''
					})
					.addClass('CMSGoogleMaps');					

			}

		}
		
	});


});


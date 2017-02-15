/* ======================================================================================================
	TOP HEADER LINKS   
======================================================================================================== */

// Opens Destinations Map

$('#Destinations').on('click', function() {

	if ($('main').is(':visible')) {

		document.body.scrollTop = document.documentElement.scrollTop = 0;

		$('main').hide();

		$('.TableDrop').css({'height': '0', 'overflow': 'hidden'});
		$('.TopHeaderLeft#ArrivalsDepartures').removeClass('Active');
		$('.TopHeaderLeft#Destinations').addClass('Active');

		$('.MapDrop').css({'height': '100%'});
		$('.Filters').removeClass('NoHeight');
		$('.Filters').addClass('FullHeight');

		//$('.NavLink').css({'display': 'none'});
		$('.FooterBar').hide();
		$('.HeaderContent#Destinations').css({'display': 'table'});
		$('.HeaderContent#ArrivalsDepartures').css({'display': 'none'});

		$('.CloseFull').css({'display': 'inline-block'});

	} else {
		$('#GoBack').click();
	}

});


// Opens Arrivals & Departures Table

$('#ArrivalsDepartures').on('click', function() {

	if ($('main').is(':visible')) {

		document.body.scrollTop = document.documentElement.scrollTop = 0;

		$('main').hide();

		$('.TopHeaderLeft#ArrivalsDepartures').addClass('Active');
		$('.TopHeaderLeft#Destinations').removeClass('Active');

		$('.MapDrop').css({'height': '0'});
		$('.Filters').removeClass('FullHeight');
		$('.Filters').addClass('NoHeight');

		$('.TableDrop').css({'height': '100%', 'overflow': 'visible'});

		//$('.NavLink').css({'display': 'none'});
		$('.FooterBar').hide();
		$('.HeaderContent#Destinations').css({'display': 'none'});
		$('.HeaderContent#ArrivalsDepartures').css({'display': 'table'});

		$('.CloseFull').css({'display': 'inline-block'});
	} else {
		$('#GoBack').click();
	}

});

// Close Button Event

$('#GoBack, .CloseFull').on('click', function() {

	$('main').show();

	$('.TopHeaderLeft#ArrivalsDepartures').removeClass('Active');
	$('.TopHeaderLeft#Destinations').removeClass('Active');

	$('.MapDrop').css({'height': '0'});
	$('.Filters').removeClass('FullHeight');
	$('.Filters').addClass('NoHeight');

	$('.TableDrop').css({'height': '0', 'overflow': 'hidden'});

	$('.NavLink').css({'display': 'block'});
	$('.FooterBar').show();
	$('.HeaderContent#Destinations').css({'display': 'none'});
	$('.HeaderContent#ArrivalsDepartures').css({'display': 'none'});

	$('.CloseFull').css({'display': 'none'});

})
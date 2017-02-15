function imgError(image) {
		    image.onerror = "";
		    image.src = " ";
		    return true;
		}

$(window).on('load', function() {
    
    var PrevURL = window.location.search;

    // If URL is null then get the href and check if url contains 'ankomster' then show the second tab

    if(PrevURL == ''){
    	PrevURL = window.location.href;
    }

	if(PrevURL.indexOf('tab2=true') >= 0 || PrevURL.indexOf('ankomster') >= 0) {

    	$('.FlightsHeader#arr').click();

	} else {

    	

	}

})


// $('#GoBack').on('click', function() {

// 	window.history.back();

// })


/* ======================================================================================================
   HEADER TABS
====================================================================================================== */
$(".ArrivalsDepartures .FlightsHeader").on('click', function(){

	var s = $(this).attr("data-show");
	$(".ArrivalsDepartures table").hide();
	$(".FlightsHeader").removeClass("Selected");
	$(".ArrivalsDepartures table" + s).show();
	$(".FlightsHeader" + s).addClass("Selected");

});


/* ======================================================================================================
   TAB SWITCHES
====================================================================================================== */

$('.FlightsHeader#dep').on('click', function() {

	TableAjax('afgange-ankomster/getdep', '#dep');

});

$(window).on('load', function() {

	TableAjax('afgange-ankomster/getdep', '#dep');

});

$('.FlightsHeader#arr').on('click', function() {

	TableAjax('afgange-ankomster/getarr', '#arr');

});



/* ======================================================================================================
   AJAX CALL
====================================================================================================== */

var TableAjax = function(Url, TableId) {

	$.ajax
		(
			{
				type:'POST',
            	dataType:'json',
				url: CustomURL(Url), 

				success: function(Data){
	        		PopulateTable(Data['Response']['Body']['Fly'], TableId);
	    		},

	    		error: function(){
	    			console.log('Failed');
	    		}
	    	}
	    );
}


/* ======================================================================================================
   POPULATE TABLE
====================================================================================================== */

var PopulateTable = function(Info, TableId) {

	// Origin or Destination as header for 4th column 
	// if (TableId == '#arr') {

	// 	var HeadingFour = 'Fra';

	// } else if (TableId == '#dep'){

	// 	var HeadingFour = 'Til';

	// }

	// Which table to edit
	var Table = 'table' + TableId;

	var TableHTML = '<tr>' + $(Table).find('tr').html() + '</tr>';

	// var TableHTML = '<tr>'
	// 				+ '<th></th>'
	// 				+ '<th><string data-mcms-id="Scope:TableDrop:Header1">Dato</string></th>'
	// 				+ '<th>Flyselskab</th>'
	// 				+ '<th>Flynummer</th>'
	// 				+ '<th>' + HeadingFour + '</th>'
	// 				+ '<th>Tidspunkt</th>'
	// 				+ '<th>Bemærkning</th>'
	// 				+ '<th></th>'
	// 				+ '</tr>';

	// For each row
	for (I in Info) {

		// Select logo based on first two digits of Flight code
		var FlightCode = Info[I]['fly_nr'].substring(0, 2);


	    // Location based on if origin or destination
	    if (TableId == '#arr') {

	    	var Location = Info[I]['fra'];

	    } else {

	    	var Location = Info[I]['til'];

	    }

		// Expected time in brackets (if exists)
		if (Info[I]['forventet'] != '' && Info[I]['forventet'] != Info[I]['planlagt']) {

			var Expected = ' <span>(' + Info[I]['forventet'] + ')</span>';

		} else {

			var Expected = '';

		}

		// Status, if it exists
		if (Info[I]['bemærkning'] != '') {

			var Remark = Info[I]['bemærkning'];

		} else {

			var Remark = '-';

		}

		var FormattedDate = Info[I]['dato'].substring(8, 10) + '-' + Info[I]['dato'].substring(5, 7) + '-' + Info[I]['dato'].substring(0, 4);

		var ImgSrc = CustomURL('Includes/Images/SupplierLogos/' + FlightCode + '.png');

    	// HTML of row to be appended
    	TableHTML += '<tr class="VisibleRow">'
    				+ '<td></td>' 
    				+ '<td class="Date" data-value=' + FormattedDate + '>' + FormattedDate + '</td>'
    				+ '<td>' + '<img src="' + ImgSrc + '" onerror="imgError(this);" />' + '</td>'
    				+ '<td>' + Info[I]['fly_nr'] + '</td>'
    				+ '<td class="Location" data-value=' + Location + '>' + Location + '</td>'
    				+ '<td class="Landed" data-value=' + Info[I]['planlagt'] + '>' + Info[I]['planlagt'] + Expected +  '</td>'
    				+ '<td>' + Remark + '</td>'
    				+ '<td></td>'
    				+ '</tr>' ;

    }

    $(Table).empty().append(TableHTML);


    var TableRows = Table + ' tr'

    $(TableRows).each(function() {

    	if ($(this).find('.Date').length > 0 &&
    		$(this).find('.Date').data('value') == $(this).prev().find('.Date').data('value') &&
    		$(this).find('.Location').data('value') == $(this).prev().find('.Location').data('value') &&
    		$(this).find('.Landed').data('value') == $(this).prev().find('.Landed').data('value')) {

    		$(this).hide();

    		var Row = $(this);
    		var PrevRow = $(this).prev();

    		Switch(Row, PrevRow);

    	}

    	DateHTML = '<tr class="DateRow">'
    				+ '<td></td>' 
    				+ '<td></td>'
    				+ '<td></td>'
    				+ '<td>' + $(this).find('.Date').data('value') + '</td>'
    				+ '<td></td>'
    				+ '<td></td>'
    				+ '<td></td>'
    				+ '<td></td>'
    				+ '</tr>' ;

    	if ($(this).find('.Date').data('value') != $(this).prev().find('.Date').data('value')) {
    		$(this).before(DateHTML);
    	}
    	 
    	
    });

    ReDraw();

    function Switch(Row, PrevRow) {

    	setInterval(function() {

    		if(Row.is(':visible')) {
    			Row.hide();
    			PrevRow.show();
    		} else {
    			Row.show();
    			PrevRow.hide();
    		}

    		ReDraw();

    	}, 2000)

    }

    function ReDraw() {
    	$(Table).find('tbody > tr:visible:even').addClass('EvenRow').removeClass('OddRow');
    	$(Table).find('tbody > tr:visible:odd').removeClass('EvenRow').addClass('OddRow');
    }

}
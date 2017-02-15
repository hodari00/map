$(window).on('load', function() {

	FrontPageTableAjax('afgange-ankomster/getdep', '#FrontPageDep');
	FrontPageTableAjax('afgange-ankomster/getarr', '#FrontPageArr');

})


/* ======================================================================================================
   AJAX CALL
====================================================================================================== */

var FrontPageTableAjax = function(Url, TableId) {
	$.ajax
		(
			{
				type:'POST',
            	dataType:'json',
				url: Url, 

				success: function(Data){
	        		PopulateTables(Data['Response']['Body']['Fly'], TableId);
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

var PopulateTables = function(Info, TableId) {

	// Which table to edit
	var Table = 'table' + TableId;

	var TableHTML = '';

	// For each row
	for (I in Info) {

		// Location based on if origin or destination
	    if (TableId == '#FrontPageArr') {

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
		

    	// HTML of row to be appended
    	TableHTML += '<tr>'
    				+ '<td class="Landed" data-value=' + Info[I]['planlagt'] + '>' + Info[I]['planlagt'] + Expected +  '</td>'
    				+ '<td>' + Info[I]['fly_nr'] + '</td>'
    				+ '<td class="Location" data-value=' + Location + '>' + Location + '</td>'
    				+ '</tr>' ;

    }

    $(Table).empty().append(TableHTML);

     var TableRows = Table + ' tr'

    $(TableRows).each(function() {

    	if ($(this).find('.Landed').length > 0 &&
    		$(this).find('.Location').data('value') == $(this).prev().find('.Location').data('value') &&
    		$(this).find('.Landed').data('value') == $(this).prev().find('.Landed').data('value')) {

    		$(this).hide();

    		var Row = $(this);
    		var PrevRow = $(this).prev();

    		Switch(Row, PrevRow);

    	}
    	 
    	
    });

    function Switch(Row, PrevRow) {

    	setInterval(function() {

    		if(Row.is(':visible')) {
    			Row.hide();
    			PrevRow.show();
    		} else {
    			Row.show();
    			PrevRow.hide();
    		}

    	}, 2000)

    }

}
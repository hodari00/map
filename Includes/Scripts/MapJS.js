
var InitializeMap = function(window, document, undefined) {

	// Map
	this.Map;

	// Default Pin icon
	this.PinIcon 		= CustomURL('Includes/Images/pinsmall2.png');

	// Coordinates, Name, and Pin icon of the Hub (central marker)
	this.Hub 			= {lat: 56.307953, lng: 10.626566};
	this.HubName 		= 'Aarhus';
	this.HubPinIcon 	= CustomURL('Includes/Images/pin2.png');
	this.HubAirline 	= 'Århus Charter';
	this.HubButton 		= [
							{

								'MarkerButtonName' : 'Charter',
								'URL' : 'http://www.aarhuscharter.dk'

							}
						];
	this.HubFilters		= {
								'Routes': {
									'Direct': true,
									'Charter': true
								},
								'Seasons': {
									'Summer': true,
									'Winter': true
								}

							};

	// Map options
	this.MyOptions 		= {
					    	zoom: 4,
					    	center: this.Hub,
					    	mapTypeControl: false
				    	  };

    // Customized styles and colors for map
    this.MyStyles 		= [{
						    featureType: 'water',
						    elementType: 'geometry',
						    stylers: [
						    	{ color: '#528cbf' }
						    ]
						  }, {
						    featureType: 'water',
						    elementType: 'labels',
						    stylers: [
						    	{ visibility: 'off' }
						    ]
						  }, {
						    featureType: 'landscape',
						    elementType: 'geometry',
						    stylers: [
						    	{ hue: '#ebebeb' },
						    	{ gamma: 1.4 },
						    	{ saturation: 82 },
						    	{ lightness: 96 }
						    ]
						  }, {
						    featureType: 'all',
						    elementType: 'labels',
						    stylers: [
						    	{ visibility: 'off' }
						    ]
						  }, {
						    featureType: 'poi.park',
						    elementType: 'geometry',
						    stylers: [
						    	{ color: '#ffffff' }
						    ]
						  }];

	// List of Locations
	this.LocationsList;

	// InfoBox
	this.InfoBoxes 		= new InfoBox(this.InfoBoxOptions);

	// CSS styling for InfoBox popup
	this.PopupCSS 		= "background-color: #ffffff; width: 330px;";
	
	// Element containing InfoBox text
	this.BoxText 		= document.createElement("div");

	this.ButtonsRow 	= document.createElement("td");

	this.MarkerFilterType = [];
	this.MarkerFilterValue = [];

	// List of Markers
	this.Markers 		= [];

	// List of Flight paths
	this.FlightPaths 	= [];

	this.Filters 		= {
								'Routes': {
									'Direct': true,
									'Charter': true
								},
								'Seasons': {
									'Summer': true,
									'Winter': true
								}

							};
						

	this.MapLabelFont            = 'Titillium Web';
    this.MapLabelFontSize        = 14;
    this.MapLabelStrokeWeight    = 0;
    this.MapLabelColor           = '#1b355d';

    this.MapLabels 		= [];

    var that 			= this;


	this.Init = function(Map, MyOptions, MyStyles) {

		// Create map with options and styles
		that.Map = new google.maps.Map(document.getElementById('Map'), that.MyOptions);
		that.Map.set('styles', that.MyStyles);

		// Create Hub Marker
		that.CreateHubMarker();

		// Get locations from json file
		that.GetLocations();

	}

	google.maps.event.addDomListener(window, "resize", function() {
		google.maps.event.trigger(that.Map, "resize");
	 	that.Map.setCenter(that.Hub); 
	});

	// Get locations from json file and create markers/flight paths from it
	that.GetLocations = function() {

		$.getJSON(CustomURL('Includes/JsonCoords.json'), function(Data) {

			that.LocationsList = Data;

			var Days = {
				'Mandag': 			1,
				'Tirsdag': 			2,
				'Onsdag': 			4,
				'Torsdag':			8,
				'Fredag': 			16,
				'L&oslash;rdag': 	32,
				'S&oslash;ndag': 	64
			}

			// For each location
			for (I in that.LocationsList) {

				var Weekdays = [];

				// If Weekdays is not null
				if (that.LocationsList[I]['Weekdays'] != null) {

					// For each day of the week
					for (A in Days) {

						// If the Day exists in the Location's weekdays
						if ((that.LocationsList[I]['Weekdays'] & Days[A]) > 0) {

							// Add it to the Weekdays array
							Weekdays.push(' ' + A);

						}

					}

					that.LocationsList[I]['Weekdays'] = Weekdays;

				}
			}

	    })
	    .complete(function() {

	    	// Create polylines
			that.DrawFlightPaths();

			// Create markers for all Locations
			that.CreateAllMarkers();

		});
	}


	that.ResetFilters = function() {

		this.Filters = {
						'Routes': {
							'Direct': true,
							'Charter': true
						},
						'Seasons': {
							'Summer': true,
							'Winter': true
						},
						'Planes': {
							'Airbus': true,
							'Boeing': true
						}

					};

		that.FilterMarkers();
	}


	that.SetFilter = function(Filter, FilterType, FilterValue) {

		// Loop through FilterTypes in Filters array
		for (F in that.Filters[Filter]) {


			// Where FilterType in array matches FilterType from HTML
			if (F == FilterType) {

				// Set new Filter Value
				that.Filters[Filter][F] = FilterValue;

			}

		}

		that.FilterMarkers();

	}

	that.FilterMarkers = function() {

		for ( var Index = 1; Index < that.Markers.length; Index++ ) {

			MarkerFilterLoop:
			// For each filters keys in the Markers array
			for ( K in Object.keys( that.Markers [ Index ].filters ) ) {
				 
				// Marker filter types object
				var MarkersFilterObject = that.Markers[ Index ].filters[ Object.keys( that.Markers[ Index ].filters )[ K ] ];

				// Object with filter types from Filters array
				var FiltersObject = that.Filters [ Object.keys( that.Filters )[ K ] ];

				// For each key in FiltersObject
				for ( L in Object.keys(FiltersObject) ) {

					// If Filter type in Filters array AND Filter type in Markers array are both true
					if ( FiltersObject[ Object.keys( FiltersObject )[ L ]] && MarkersFilterObject[ Object.keys( FiltersObject )[ L ] ] ) {

						// If this is the last filers key in the Marker array, set the marker
						if ( K == Object.keys( that.Markers [ Index ].filters ).length - 1 ) {

							that.Markers[ Index ].setMap( that.Map );
							that.MapLabels[ Index ].setMap( that.Map );
							that.FlightPaths[ Index - 1 ].setMap( that.Map );

						}

						// Break and move on to next filter key in Markers array
						break;

					} else {

						// If this is the last filter type key in the Filters array, remove marker
						if ( L == Object.keys( FiltersObject ).length - 1 ) {

							that.Markers[ Index ].setMap( null );
							that.MapLabels[ Index ].setMap( null );
							that.FlightPaths[ Index - 1 ].setMap( null );

							// Break and move on to next Index in Markers array
							break MarkerFilterLoop;
						}

					}

				}
				
			}

		}

	}

	/**
	 * Add a new marker to map
	 * @param {object} NewLocation  ccordinates of marker
	 * @param {string} LocationName name of marker
	 * @param {string} Icon         path to icon png
	 */
	
	that.AddMarker = function(NewLocation, LocationName, Icon, Airline, Weekdays, Buttons, Filters) {

		var Marker = new google.maps.Marker({
	            position: NewLocation,
	            map: that.Map,
	            title: LocationName,
	            animation: google.maps.Animation.DROP,
		    	icon: {
		    		url: Icon,
		    		anchor: new google.maps.Point(8, 8)
		    	},
		    	filters: Filters
	        });

		var LabelAlign 		= 'center';

		var mapLabel = new MapLabel({
        	text: LocationName.toUpperCase(),
        	position: new google.maps.LatLng(NewLocation),
        	map: that.Map,

        	fontFamily: that.MapLabelFont,
        	fontSize: that.MapLabelFontSize,
        	fontColor: that.MapLabelColor,
        	align: LabelAlign,
        	orientation: LabelAlign,
        	strokeWeight: that.MapLabelStrokeWeight
        });

        // mapLabel.set('position', NewLocation);

		that.Markers.push(Marker);
		that.MapLabels.push(mapLabel);

		// console.log(that.MapLabels);

		that.FilterMarkers();


		// Click event listener for marker
		google.maps.event.addListener(Marker, 'click', function() {

			// Creates InfoBox on click
			that.CreateInfoBox(LocationName, Marker, Airline, Weekdays, Buttons);

		});

		// Click event listener for map
		google.maps.event.addListener(that.Map, 'click', function() {

			if($('.infoBox').is(':visible')) {

				// Clears InfoBox
				that.InfoBoxes.setMap(null);

			}
		});

	}


	// Create Marker for Hub
	that.CreateHubMarker = function() {

		that.AddMarker(that.Hub, that.HubName, that.HubPinIcon, that.HubAirline, null, that.HubButton, that.HubFilters);

	}

	// Loop through all locations in LocationsList and create a marker for each
	that.CreateAllMarkers = function() {
		
		for (var Index = 0; Index < that.LocationsList.length; Index++) {

			that.AddMarker(

				that.LocationsList[Index].position, // position of marker
				that.LocationsList[Index].title, // title of marker
				that.PinIcon, // path to icon
				that.LocationsList[Index].Airline, // Airline carrier
				that.LocationsList[Index].Weekdays, // Weekdays
				that.LocationsList[Index].Buttons, // Buttons
				that.LocationsList[Index].Filters // Filter values

			);

		}
	}

	// Draw polyline between Hub and each Location
	that.DrawFlightPaths = function() {
		for (var Index = 0; Index < that.LocationsList.length; Index++) {

			// Path between Hub coordinates and the Location's coordinates
			FlightPath = [that.Hub, that.LocationsList[Index].position];

			FlightPathLine = new google.maps.Polyline({
	        	path: FlightPath,
	        	geodesic: false,
	        	strokeColor: '#203e64',
	        	strokeOpacity: 1.0,
	        	strokeWeight: 2
	        });

	        // FlightPathLine.setMap(that.Map);

	        that.FlightPaths.push(FlightPathLine);
	        
		}
	}

	/**
	 * When marker is clicked, create InfoBox popup
	 * @param {object} Marker 		marker object
	 * @param {string} LocationName name of marker
	 * @param {string} Airline      airline carrier name
	 */
	that.CreateInfoBox = function(LocationName, Marker, Airline, Weekdays, Buttons) {

		var ButtonsHTML = '';

		$(Buttons).each(function(I) {

        	ButtonsHTML += '<a class="Button" href="'
        						+ Buttons[I]['URL'] 
        						+ '" target="_blank">' 
        						+ Buttons[I]['MarkerButtonName'] 
        						+ '</a>';

        })

        if (Weekdays != null) {

        	var WeekdaysRow = '<tr><td class="BorderBottom">'
                        + '<span style="color: #a8a8a8">Weekdays:</span><br />'
                        + Weekdays
                        + '</td></tr>'

        } else {

        	var WeekdaysRow = '';

        }

		// Creates the information to go in the InfoBox popup
		that.BoxText.innerHTML = '<div class="Headline">' + LocationName + '</div>'
                        + '<table style="width: 100%" class="InfoboxTable">' 
                        + '<tr><td class="BorderBottom">'
                        + '<span style="color: #a8a8a8">Udbyder:</span><br />'
                        + Airline
                        + '</td></tr>'
                        + WeekdaysRow
                        + '<tr class="ButtonsRow"><td>' + ButtonsHTML
                        + '</td></tr></table>';


		// Apply desired CSS to popup
		that.BoxText.style.cssText = that.PopupCSS;

		// InfoBox options
		InfoBoxOptions = {
			content: that.BoxText,
    		disableAutoPan: false,
    		maxWidth: 0,
    		pixelOffset: new google.maps.Size(-140, 0),
    		zIndex: null,
    		boxStyle: {
	        	padding: '0px 0px 0px 0px',
	        	width: '252px',
	        	height: '40px'
	        },
        	closeBoxURL : '',
        	infoBoxClearance: new google.maps.Size(1, 1),
    		isHidden: false,
    		pane: 'floatPane',
    		enableEventPropagation: false
		};

		// Set content for InfoBox
		that.InfoBoxes.setContent(that.BoxText);

		// Open the InfoBox and set to Map at marker's location
		that.InfoBoxes.open(that.Map, Marker);
	}

};

// Initialize
var SampleMap;
google.maps.event.addDomListener(window, 'load', function() {
	SampleMap    = new InitializeMap(window, document);

	SampleMap.Init();
});

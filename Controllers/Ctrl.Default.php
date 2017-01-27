<?php

	final class CtrlDefault extends Controller {

		/* ===========================================================================================================================
			SDK Install  
		=========================================================================================================================== */
		
		/**
		 * Enables to install sdk
		 * 
		 * @access public
		 * @return void  
		 */
		public function SDKInstall ( ) {

			$this -> extension( 'Installer' ) -> Model( 'Installer' ) -> Install( );

		}
		
		

		/* ===========================================================================================================================
			HOME  
		=========================================================================================================================== */
		
		/**
		 * Loads the home view
		 * 
		 * @access public
		 * @return View  
		 */

		public function Home ( ) {

			$View 					= $this -> View( 'Home' );
			
			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> 'Welcome to Aarhus airport website',
					'Keywords'		=> 'Aarhus Airport, Aarhus Airport, Aarhus Airport, Aarhus Airport, Tirstrup, Aarhus Airport, Airport, Major international airport, Jutland Airport, Jutlandia, Airport, Flight departure, flight arrivals, Flights, Arrival, Departure, Airport shuttle, Aarhus, Aarhus, Terminal, Charter, SAS, Ryanair, Sun Air, British Airways, Farnair, Cimber, domestic',
					'Description'	=> 'We are Aarhus airport'
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> 'Velkommen til Århus lufthavnens hjemmeside',
					'Keywords'		=> 'Aarhus Lufthavn, Aarhus Airport, Århus Lufthavn, Århus Airport, Tirstrup, Tirstrup Lufthavn, Lufthavn, Major international airport, Jutland Airport, Jutlandia, Airport, Flyafgang, Flyankomst, Flights, Arrival, Departure, Lufthavnsbus, Aarhus, Århus, Terminal, Charter, SAS, Ryanair, Sun Air, British Airways, Farnair, Cimber, indenrigs',
					'Description'	=> 'Vi er Århus lufthavn'
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);


			// Give a page name so that MiniCMS can access it for manipulation
			
			$View -> Add( 'PageName', 'Home' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );
		
		}


		/* ===========================================================================================================================
			SEARCH
		=========================================================================================================================== */
		
		/**
		 * Search
		 * 
		 * @access public
		 * @return Array  
		 */

		public function Search ( ) {

			$Query 				=  $this -> GetParameter('Query');

			$Search 			= $this -> Model( 'Search' ) -> GetSearchResults( $Query );

	 		return $Search;
		
		}

		

		public function HomePageSearch() {

			$View 					= $this -> View( 'HomePageSearch' );

			// Give a page name so that MiniCMS can access it for manipulation
			
			$View -> Add( 'Title', 'Search Here' );

			$View -> Add( 'PageName', 'HomePageSearch' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}


		/* ===========================================================================================================================
			PRIVATE ELOUNGE  
		=========================================================================================================================== */
		
		/**
		 * Loads the Private Elounge view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function PrivateLounge ( ) {
			
			$View 					= $this -> View( 'PrivateLounge' );


			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);


			// Give a page name so that MiniCMS can access it for manipulation
			
			$View -> Add( 'PageName', 'PrivateLounge' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}



		/* ===========================================================================================================================
			PRESS
		=========================================================================================================================== */
		
		/**
		 * Loads the Press view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Press ( ) {
			
			$View 					= $this -> View( 'Press' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'Press' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}
		

		/* ===========================================================================================================================
			AIRPORT
		=========================================================================================================================== */
		
		/**
		 * Loads the Airport view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Airport ( ) {
			
			$View 					= $this -> View( 'Airport' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'Airport' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}



		/* ===========================================================================================================================
			COMPANIES
		=========================================================================================================================== */
		
		/**
		 * Loads the Company view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Companies ( ) {
			
			$View 					= $this -> View( 'Companies' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'Companies' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}

		
		/* ===========================================================================================================================
			BUSINESS TRAVELLERS
		=========================================================================================================================== */
		
		/**
		 * Loads the Press view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function BusinessTravelers ( ) {
			
			$View 					= $this -> View( 'BusinessTravelers' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation
						
			$View -> Add( 'PageName', 'BusinessTravelers' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}


		
		/* ======================================================================================================
		   Parking 
		======================================================================================================== */

		/**
		 * Loads the parking view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Parking( ) {
			
			$View 					= $this -> View( 'Parking' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'Parking' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}

			

		/* ======================================================================================================
		   BOOK TRAVEL 
		======================================================================================================== */

		/**
		 * Loads the view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function BookTravel( ) {
			
			$View 					= $this -> View( 'BookTravel' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'BookTravel' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}



		/* ======================================================================================================
		   MARKER 
		======================================================================================================== */

		/**
		 * Loads the view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Facilities( ) {
			
			$View 					= $this -> View( 'Facilities' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation
		
			$View -> Add( 'PageName', 'Facilities' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}


		/* ======================================================================================================
		   FIND WAY 
		======================================================================================================== */

		/**
		 * Loads the view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function FindWay( ) {
			
			$View 					= $this -> View( 'FindWay' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation
		
			$View -> Add( 'PageName', 'FindWay' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}
		


		/* ===========================================================================================================================
			CONTACT
		=========================================================================================================================== */

		public function Contact( ){

			$View 					= $this -> View( 'Contact' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			// Give a page name so that MiniCMS can access it for manipulation

			$View -> Add( 'PageName', 'Contact' );

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}



		/* ===========================================================================================================================
			TEKSTSIDE  
		=========================================================================================================================== */
		
		/**
		 * Loads the tekstside view
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function Tekstside ( ) {
			
			$View 					= $this -> View( 'Tekstside' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}


		
		/* ===========================================================================================================================
			MAP  
		=========================================================================================================================== */
		
		/**
		 * Loads the map view
		 * 
		 * @access public
		 * @return View  
		 */

		public function Map ( ) {
			
			$View 					= $this -> View( 'Map' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);			

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}


		/* ===========================================================================================================================
			AFGANGE / ANKOMSTER 
		=========================================================================================================================== */
		
		/**
		 * Loads the departure & arrivals
		 * 
		 * @access public
		 * @return View  
		 */

		public function ArrivalsDepartures ( ) {
			
			$View 					= $this -> View( 'ArrivalsDepartures' );

			/* ------------------------------------------------------------------------------------------------------
			   SEO CONTENT
			------------------------------------------------------------------------------------------------------ */

			if( $_SESSION['Aar.Language'] == 'EN' ) {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];
				
			} else {

				$SEOContent = [
					'Title' 		=> '',
					'Keywords'		=> '',
					'Description'	=> ''
				];

			}

			$View -> Add( 'PageTitle', $SEOContent['Title']);
			$View -> Add( 'PageKeyword', $SEOContent['Keywords']);
			$View -> Add( 'PageDescription', $SEOContent['Description']);

	 		return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

		}

		/* ===========================================================================================================================
			GET ARRIVALS
		=========================================================================================================================== */
		
		/**
		 * Gets Arrivals from XML and converts to JSON
		 * 
		 * @access public
		 * @return Arrivals  
		 */

		public function Arrivals ( ) {

			$Arrivals 			= $this -> Model( 'ArrivalsDepartures' ) -> GetArrivalsTable( );

	 		return $Arrivals;
		}


		/* ===========================================================================================================================
			GET DEPARTURES
		=========================================================================================================================== */
		
		/**
		 * Gets Departures from XML and converts to JSON
		 * 
		 * @access public
		 * @return Departures  
		 */

		public function Departures ( ) {

			$Departures 			= $this -> Model( 'ArrivalsDepartures' ) -> GetDeparturesTable( );

	 		return $Departures;
		}



		/* ===========================================================================================================================
			CMS CONTENT  
		=========================================================================================================================== */
		
		/**
		 * Loads the cms view with matching url attribute.
		 * 
		 * @access public
		 * @return View  
		 */
		
		public function CMSContent ( ) {

			// SEO Contents are automatically added from scope on any cms page

			$URL 					= (string) $this -> GetFromURL(1);		
			$CMSContent   			= $this -> Model('CMS') -> GetPageContent($URL);

					
			// Only show the content if there's content any in the database.
			
			if( $CMSContent ) {
				
				$View 				= $this -> View('Content');
				
				// Give a page name so that MiniCMS can access it for manipulation
				
				if( $URL == 'bus' || $URL == 'lufthavnsbus' ){

					$View -> Add( 'PageName', '#Bus' );

				} 
				else if($URL == 'parking' || $URL == 'parkering'){

					$View -> Add( 'PageName', '#Parking' );
				}

				$View -> Add( 'CMSContent', $CMSContent );

			} 
			
			// Oops! No content present with the URL redirect to 404 page
			
			else {

				header('HTTP/1.0 404 Not Found');
				return $this -> View('ErrorDocument404');

				throw new Exception('Page not found');
				
			}

			return $this -> Model( 'MiniCMS > Translate' ) -> Translate ( $View );

			
		}


	}

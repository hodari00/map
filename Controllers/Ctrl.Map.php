<?php

 	final class CtrlMap extends Controller {


 		/* ===========================================================================================================================
 		   GET DESTINATIONS LIST
 		=========================================================================================================================== */

 		/**
 		 * Loads the content page for edit update and create CMS section
 		 * 
 		 * @access public
 		 * @return View
 		 */
 		
 		public function Map ( ) { 			

 			$View 					= $this -> View( 'MapData' );
 			$Destinations			= $this -> Model( 'MapData' ) -> GetAllDestinations();

 			$View -> Add('Destinations', $Destinations);

 			return $View;
 		
 		}

 		/* ===========================================================================================================================
 		   DESTINATION INFO
 		=========================================================================================================================== */

 		/**
 		 * Loads the content page for edit update and create CMS section
 		 * 
 		 * @access public
 		 * @return View
 		 */
 		
 		public function EditDestination ( ) {

 			$Id 					= $this -> GetFromURL( 1 );

 			$DestinationInfo		= $this -> Model( 'MapData' ) -> GetDestinationInfoById( $Id );
 			$ButtonInfo 			= $this -> Model( 'MapData' ) -> GetButtonInfoById( $Id );

 			$View 					= $this -> View( 'DestinationInfo' );

 			$View -> Add('DestinationInfo', $DestinationInfo );
 			$View -> Add('ButtonInfo', $ButtonInfo );

 			return $View;
 		
 		}


 		/* ===========================================================================================================================
 		   ADD NEW 
 		=========================================================================================================================== */

 		/**
 		 * Inserts new row for new destination
 		 * 
 		 * @access public
 		 * @return array
 		 */
 		
 		public function AddDestination ( ) {

 			$Result = $this -> Model( 'MapData' ) -> AddDestination();

 			return [ 
 				'DestinationId' => $Result 
 			];

 		}


 		/* ===========================================================================================================================
 		   DELETE
 		=========================================================================================================================== */

 		public function DeleteDestination ( ) {

 			$Id 					= $this -> GetParameter( 'Id' );

 			$Result = $this -> Model( 'MapData' ) -> DeleteDestination( $Id );

 		}



 		/* ===========================================================================================================================
 		   UPDATE 
 		=========================================================================================================================== */

 		/**
 		 * Updates a destination's info
 		 * 
 		 * @access public
 		 * @return void
 		 */
 		
 		public function UpdateDestination ( ) {

 			
 			// Call to the update method
 			$Data =  $this -> GetParameter('Data');

 			$Buttons =  $this -> GetParameter('Buttons');

			// ChromePhp::log($Buttons);
			return $this -> Model( 'MapData' ) -> UpdateDestination( $Data, $Buttons );

 		}

 	}
?>
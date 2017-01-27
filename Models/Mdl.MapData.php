<?php

	final class MdlMapData extends Model {

		public function CreateDependencyModel( $Model ) {
        	
        	$Model -> RequestInstance('DBAL');
        	return $Model;

        }


        /* ===========================================================================================================================
		   GET DESTINATION LIST
		=========================================================================================================================== */

		/**
		 * Get the destinations from database
		 *
		 * @access public
		 * @return array Returns all destinations from the DB 
		 */


		public function GetAllDestinations () {

			$Result 	= $this -> With('DBAL') -> Stq(
				
							'SELECT
									*
								
							FROM MapData

							WHERE DestinationName IS NOT NULL'

							);

			return $Result;
		}


		/* ===========================================================================================================================
			GET THE DESTINATION INFO BY ID 
		=========================================================================================================================== */

		/**
		 * Get the destination info by id
		 * 
		 * @access public
		 * @param int $Id takes id of destination
		 * @return array Returns all the destination info/fields
		 */
		
		public function GetDestinationInfoById ($Id) {

			$Result 	= $this -> With('DBAL') ->Stq(

							'SELECT
								*

							FROM
								MapData

							WHERE
								DestinationId = :Id'
							,

							[
								':Id' => (int) $Id
							]
						
						);

		
			return $Result[0];
		}

		/* ======================================================================================================
		   GET BUTTON INFO BY ID
		====================================================================================================== */

		public function GetButtonInfoById ($Id) {

			$Result 	= $this -> With('DBAL') ->Stq(

							'SELECT
								*

							FROM
								MarkerButtons

							WHERE
								DestinationId = :Id'
							,

							[
								':Id' => (int) $Id
							]
						
						);

		
			// ChromePhp::log($Result);
			return $Result;
		}


		/* ===========================================================================================================================
			ADD NEW DESTINATION
		=========================================================================================================================== */
		
		/**
		 * Inserts an empty row to database
		 *
		 * @access public
		 * @throws Exception Raised when new destination not created
		 * @return
		 */

		public function AddDestination( ) {
			
			// Insert a new row to cms content table.
			
			$Result = $this -> With( 'DBAL' ) -> Stq(

						'INSERT INTO 
							MapData 
							(
								RouteDirect, RouteCharter, SeasonSummer, SeasonWinter
							)

						VALUES 
							(
								1, 1, 1, 1
							)'

					);
			
			
			// Retrive the inserted id.
			
			$Id = $this -> With( 'DBAL' ) -> lastInsertId();

			// If no row is created then raise an exception.

			if ( $this -> With('DBAL') -> AffectedRows( ) == 0 ) {

				throw new Exception( 'Destination could not be added' );

            } 
            else {
            	
            	return $Id;

        	}


		}


		/* ===========================================================================================================================
			DELETES DESTINATION
		=========================================================================================================================== */

		/**
		 * Deletes destination from db
		 * @param int $Id Id of destination to be deleted
		 */
		public function DeleteDestination( $Id ) {

			$this -> With( 'DBAL' ) -> Stq (

				'DELETE FROM
					MapData

				WHERE
					DestinationId = :Id'
				,

				[
					':Id' => (int) $Id
				]
			
			);

			/* ======================================================================================================
			   UPDATE JSON FILE
			====================================================================================================== */

			$Json = [];

			$Result 	= $this -> With('DBAL') -> Stq(
				
							'SELECT
									*
								
							FROM MapData

							WHERE DestinationName IS NOT NULL'

							);

			foreach ($Result as $I => $Row) {

				$Object = [
					'position' 	=> [
									'lat' 	=> (double) $Row[ 'Lat' ],
									'lng' 	=> (double) $Row[ 'Lng' ]
					],
					'title'		=> (string) $Row[ 'DestinationName' ],
					'Airline'	=> (string) $Row[ 'Supplier' ],
					'Filters' 	=> [
									'Routes' => [
													'Direct' 	=> (int) $Row[ 'RouteDirect' ] == 1 ? true : false,
													'Charter' 	=> (int) $Row[ 'RouteCharter' ] == 1 ? true : false
									],
									'Seasons' => [
													'Summer'	=> (int) $Row[ 'SeasonSummer' ] == 1 ? true : false,
													'Winter'	=> (int) $Row[ 'SeasonWinter' ] == 1 ? true : false
									]
					],
					'Weekdays' 	=> (int) $Row[ 'Weekdays' ]
				];

				array_push($Json, $Object);

			}

			file_put_contents('../Includes/JsonCoords.json', json_encode($Json));

		}

		/* ===========================================================================================================================
			UPDATES JSON FILE
		=========================================================================================================================== */

		public function UpdateJson() {

			$Json = [];

			$Result 	= $this -> With('DBAL') -> Stq(
				
							'SELECT
									*
								
							FROM MapData

							WHERE DestinationName IS NOT NULL'

							);

			foreach ($Result as $I => $Row) {

				$ButtonResult 	= $this -> With('DBAL') -> Stq(
			
								'SELECT
										MarkerButtonName, URL
									
								FROM MarkerButtons

								WHERE
									DestinationId		= :DestinationId',

								[
									':DestinationId' => (int) $Row['DestinationId']
								]

							);

				$Object = [
					'position' 	=> [
									'lat' 	=> (double) $Row[ 'Lat' ],
									'lng' 	=> (double) $Row[ 'Lng' ]
					],
					'title'		=> (string) $Row[ 'DestinationName' ],
					'Airline'	=> (string) $Row[ 'Supplier' ],
					'Filters' 	=> [
									'Routes' => [
													'Direct' 	=> (int) $Row[ 'RouteDirect' ] == 1 ? true : false,
													'Charter' 	=> (int) $Row[ 'RouteCharter' ] == 1 ? true : false
									],
									'Seasons' => [
													'Summer'	=> (int) $Row[ 'SeasonSummer' ] == 1 ? true : false,
													'Winter'	=> (int) $Row[ 'SeasonWinter' ] == 1 ? true : false
									]
					],
					'Weekdays' 	=> (int) $Row[ 'Weekdays' ],
					'Buttons' 	=> $ButtonResult
				];

				array_push($Json, $Object);

			}
			// ChromePhp::log($Json);

			file_put_contents('../Includes/JsonCoords.json', json_encode($Json));

		}


		/* ===========================================================================================================================
			UPDATES DESTINATION INFO
		=========================================================================================================================== */
		
		/**
		 * Updates destination's info
		 *
		 * @access public
		 * @param
		 * @return
		 */
		
		public function UpdateDestination( $Data, $Buttons ) {
			$this -> With( 'DBAL' ) -> Stq (

				'UPDATE 
					MapData

				SET 
					DestinationName		= :DestinationName,
					RouteDirect 		= :RouteDirect,
					RouteCharter		= :RouteCharter,
					SeasonSummer 		= :SeasonSummer,
					SeasonWinter 		= :SeasonWinter,
					Supplier 			= :Supplier,	
					GoogleMaps 			= :GoogleMaps,
					Lat 				= :Lat,
					Lng 				= :Lng,
					Weekdays 			= :Weekdays

				WHERE 	
					DestinationId		= :DestinationId',

				[
					':DestinationId' 	=> (int) $Data[ 'DestinationId' ],
					':DestinationName'	=> (string) $Data[ 'DestinationName' ],
					':RouteDirect'		=> (int) $Data[ 'RouteDirect' ],
					':RouteCharter'		=> (int) $Data[ 'RouteCharter' ],
					':SeasonSummer'		=> (int) $Data[ 'SeasonSummer' ],
					':SeasonWinter'		=> (int) $Data[ 'SeasonWinter' ],
					':Supplier'			=> (string) $Data[ 'Supplier' ],
					':GoogleMaps'		=> (string) $Data[ 'GoogleMaps' ],
					':Lat' 				=> (double) $Data[ 'Lat' ],
					':Lng' 				=> (double) $Data[ 'Lng' ],
					':Weekdays'			=> (int) $Data[ 'Weekdays' ]
				]
			);

			$this -> With( 'DBAL' ) -> StartTransaction();

			$this -> With( 'DBAL' ) -> Stq (
					'DELETE FROM
						MarkerButtons

					WHERE
						DestinationId 		= :DestinationId',

					[
						':DestinationId' 	=> (int) $Data[ 'DestinationId' ]
					]
					);

			foreach ($Buttons as $B => $Button) {

				$this -> With( 'DBAL' ) -> Stq (

					'INSERT INTO
						MarkerButtons (DestinationId, MarkerButtonName, URL)

						VALUES (:DestinationId, :MarkerButtonName, :URL)',

					[
						':DestinationId' 	=> (int) $Data[ 'DestinationId' ],
						':MarkerButtonName'	=> (string) $Button[ 'MarkerButtonName' ],
						':URL'				=> (string) $Button[ 'URL' ]
					]
				);				
			}



			$this -> With( 'DBAL' ) -> Commit();


			/* ======================================================================================================
			   UPDATE JSON
			====================================================================================================== */

			$Json = [];

			$Result 	= $this -> With('DBAL') -> Stq(
				
							'SELECT
									*
								
							FROM MapData

							WHERE DestinationName IS NOT NULL'

							);

			foreach ($Result as $I => $Row) {

				$ButtonResult 	= $this -> With('DBAL') -> Stq(
			
								'SELECT
										MarkerButtonName, URL
									
								FROM MarkerButtons

								WHERE
									DestinationId		= :DestinationId',

								[
									':DestinationId' => (int) $Row['DestinationId']
								]

							);

				$Object = [
					'position' 	=> [
									'lat' 	=> (double) $Row[ 'Lat' ],
									'lng' 	=> (double) $Row[ 'Lng' ]
					],
					'title'		=> (string) $Row[ 'DestinationName' ],
					'Airline'	=> (string) $Row[ 'Supplier' ],
					'Filters' 	=> [
									'Routes' => [
													'Direct' 	=> (int) $Row[ 'RouteDirect' ] == 1 ? true : false,
													'Charter' 	=> (int) $Row[ 'RouteCharter' ] == 1 ? true : false
									],
									'Seasons' => [
													'Summer'	=> (int) $Row[ 'SeasonSummer' ] == 1 ? true : false,
													'Winter'	=> (int) $Row[ 'SeasonWinter' ] == 1 ? true : false
									]
					],
					'Weekdays' 	=> (int) $Row[ 'Weekdays' ],
					'Buttons' 	=> $ButtonResult
				];

				array_push($Json, $Object);

			}
			ChromePhp::log($Json);

			file_put_contents('../Includes/JsonCoords.json', json_encode($Json));

		}

    }
?>
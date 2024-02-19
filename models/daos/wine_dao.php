<?php
	/* ********************************************************
	 * Responsible for the Item data access *****************
	 * ********************************************************/
	class WineDao {
		protected $database_connection_bo;

		/* ********************************************************
		 * Constructor ********************************************
		 * ********************************************************/
		function __construct($database_connection_bo) {
			$this->database_connection_bo = $database_connection_bo;
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					wines
				SET
					name 				   	 = ?,
					winery 				 	 = ?,
					production_year 	 	 = ?,
					color 					 = ?,
					sweetness 				 = ?,
					origin_country 			 = ?,
					origin_region 			 = ?,
					origin_city 			 = ?,
					type 					 = ?,
					consumption_temperature  = ?,
					bottler 				 = ?,
					bottle_size 			 = ?,
					alcohol_percentage_level = ?,
					ean 					 = ?,
					cork_type 				 = ?,
					is_active 				 = 1,
					created_at				 = NOW(),
					updated_at 				 = NOW()
			";

			try {
				$database_connection = ($this->database_connection_bo)->getConnection();

				$database_connection
					->prepare($query_string)
					->execute(
						(
							array_map(
								function($value) {
									return $value === '' ? NULL : $value;
								},
								$parameters
							)
						)
					)
				;

				return(
					$database_connection->lastInsertId()
				);
			}
			catch(Exception $exception) {
				TavernRaidRequestResponseHelper::addToResponse('errors', $exception->getMessage());
				return false;
			}
		}
		
		public function getList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id           			  AS id,
					MAIN.name         			  AS name,
					MAIN.winery 				  AS winery,
					MAIN.production_year 		  AS production_year,
					MAIN.color 					  AS color,
					MAIN.sweetness 				  AS sweetness,
					MAIN.origin_country 		  AS origin_country,
					MAIN.origin_region 			  AS origin_region,
					MAIN.origin_city 			  AS origin_city,
					MAIN.type 					  AS type,
					MAIN.consumption_temperature  AS consumption_temperature,
					MAIN.bottler 				  AS bottler,
					MAIN.bottle_size 			  AS bottle_size,
					MAIN.alcohol_percentage_level AS alcohol_percentage_level,
					MAIN.ean 					  AS ean,
					MAIN.cork_type 				  AS cork_type,
					MAIN.is_active 				  AS is_active,
					MAIN.created_at 			  AS created_at,
					MAIN.updated_at 			  AS updated_at
				FROM
					wines MAIN
				WHERE
					MAIN.is_active = 1
				ORDER BY
					MAIN.name ASC
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute();
				
				return $statement->fetchAll();
			}
			catch(Exception $exception) {
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());

				return false;
			}
		}
	}
?>
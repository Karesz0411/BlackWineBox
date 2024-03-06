<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class BoxConfigurationDao {
		protected $database_connection_bo;
		protected $do_factory;

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function __construct($database_connection_bo) {
			$this->database_connection_bo = $database_connection_bo;
			$this->do_factory = new DoFactory();
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		
         function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					bwb_wine_attributes
				SET
                    wine_name           = ?,
                    aroma               = ?,
                    flavor              = ?,
                    appearance 		    = ?,
                    alcohol_content     = ?,
                    sweetness           = ?,
                    making_techniques   = ?,
                    ageability          = ?,
                    intensity           = ?,
                    place_of_production = ?,
					is_active           = 1,
					created_at          = NOW(),
					updated_at          = NOW()
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
        
        
        function getAll() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
                SELECT 
                    MAIN.id AS id,
                    MAIN.wine_name AS wine_name,
                    MAIN.aroma AS aroma,
                    MAIN.flavor AS flavor,
                    MAIN.appearance AS appearance,
                    MAIN.alcohol_content AS alcohol_content,
                    MAIN.sweetness AS sweetness,
                    MAIN.making_techniques AS making_techniques,
                    MAIN.ageability AS ageability,
                    MAIN.intensity AS intensity,
                    MAIN.place_of_production AS place_of_production
                FROM
                    16153_theapp.bwb_wine_attributes MAIN
                WHERE
                    MAIN.is_active = 1
                ORDER BY
                    MAIN.wine_name ASC;
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

<?php
	/* ********************************************************
	 * Responsible for the Tavern data access *****************
	 * ********************************************************/
	class TavernDao {
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
		function getList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id AS id,
					MAIN.display_name AS display_name,
					MAIN.company_name AS company_name,
					MAIN.address_country AS address_country,
					MAIN.address_city AS address_city,
					MAIN.address_postal_code AS address_postal_code,
					MAIN.address_street_name AS address_street_name,
					MAIN.address_street_number AS address_street_number,
					MAIN.address_latitude AS address_latitude,
					MAIN.address_longitude AS address_longitude,
					MAIN.opened_at AS opened_at,
					MAIN.closed_at AS closed_at,
					MAIN.phone_number AS phone_number,
					MAIN.email AS email,
					MAIN.website_url AS website_url,
					MAIN.facebook_url AS facebook_url,
					MAIN.owner_user_id AS owner_user_id,
					MAIN.administrator_user_id AS administrator_user_id
				FROM
					taverns MAIN
				WHERE
					MAIN.is_active = 1
				ORDER BY
					MAIN.display_name ASC
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
		
		public function getTavernItemsList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					TAVERN_ITEMS.id         AS id,
					TAVERN_ITEMS.tavern_id  AS tavern_id,
					TAVERN_ITEMS.item_id    AS item_id,
					TAVERN_ITEMS.price      AS price,
					TAVERN_ITEMS.is_active  AS is_active,
					TAVERN_ITEMS.created_at AS created_at,
					TAVERN_ITEMS.updated_at AS updated_at,
					ITEMS.name              AS item_name,
					ITEMS.is_alcoholic      AS item_is_alcoholic
				FROM
					tavern_items TAVERN_ITEMS
					INNER JOIN items ITEMS
						ON TAVERN_ITEMS.item_id = ITEMS.id
				WHERE
					(
						TAVERN_ITEMS.price IS NOT NULL OR
						TAVERN_ITEMS.price <> 0 OR
						TAVERN_ITEMS.price <> ''
					) AND
					TAVERN_ITEMS.is_active = 1
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

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					taverns
				SET
					display_name     	  = ?,
					company_name     	  = ?,
					address_country  	  = ?,
					address_city     	  = ?,					
					address_postal_code   = ?,
					address_street_name   = ?,
					address_street_number = ?,
					address_latitude 	  = ?,
					address_longitude 	  = ?,
					opened_at			  = ?,
					closed_at			  = ?,
					phone_number     	  = ?,
					email    		 	  = ?,
					website_url      	  = ?,
					facebook_url     	  = ?,
					owner_user_id	 	  = ?,
					administrator_user_id = ?,
					is_active        	  = 1,
					created_at       	  = NOW(),
					updated_at       	  = NOW()
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
				UserMessagesHelper::addToMessages(
					$exception,
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				TavernRaidRequestResponseHelper::addToResponse('errors', $exception->getMessage());
				return false;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function deleteTavern($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					taverns
				SET
					is_active  = 0,
					updated_at = NOW()
				WHERE
					id = ?
			";

			try {
				return(
					($this->database_connection_bo)->getConnection()
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
				);
			}
			catch(Exception $exception) {
				//trigger_error('Error: ' . $exception->getMessage());
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());

				return false;
			}
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function isDisplayNameUnique($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					'not_unique' AS 'is_display_name_unique'
				FROM
					taverns MAIN
				WHERE
					MAIN.display_name = ?
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute(
					array_map(
						function($value) {
							return $value === '' ? NULL : $value;
						},
						$parameters
					)
				);
				
				$record = $statement->fetchAll();
				
				return !$record[0]['is_display_name_unique'] == 'not_unique';
			}
			catch(Exception $exception) {
				//trigger_error('Error: ' . $exception->getMessage());
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());

				return false;
			}
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getTavernListByUserId($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id AS id,
					MAIN.display_name AS display_name,
					MAIN.company_name AS company_name,
					MAIN.address_country AS address_country,
					MAIN.address_city AS address_city,
					MAIN.address_postal_code AS address_postal_code,
					MAIN.address_street_name AS address_street_name,
					MAIN.address_street_number AS address_street_number,
					MAIN.address_latitude AS address_latitude,
					MAIN.address_longitude AS address_longitude,
					MAIN.opened_at AS opened_at,
					MAIN.closed_at AS closed_at,
					MAIN.phone_number AS phone_number,
					MAIN.email AS email,
					MAIN.website_url AS website_url,
					MAIN.facebook_url AS facebook_url,
					MAIN.owner_user_id AS owner_user_id,
					MAIN.administrator_user_id AS administrator_user_id
				FROM
					taverns MAIN
				WHERE
					MAIN.is_active = 1 AND
					(
						owner_user_id = ? OR
						administrator_user_id = ?
					)
				ORDER BY
					MAIN.display_name ASC
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute(
					array_map(
						function($value) {
							return $value === '' ? NULL : $value;
						},
						$parameters
					)
				);
				
				return $statement->fetchAll();
			}
			catch(Exception $exception) {
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());

				return false;
			}
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function setTavernItemPrice(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					tavern_items (
						tavern_id,
						item_id,
						price,
						is_active,
						created_at,
						updated_at
					)
				VALUES
					(
						?,
						?,
						?,
						1,
						NOW(),
						NOW()
					)
				ON DUPLICATE KEY UPDATE
					price             = ?,
					updated_at     	  = NOW()
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

				return($database_connection->lastInsertId());
			}
			catch(Exception $exception) {
				UserMessagesHelper::addToMessages(
					$exception,
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				TavernRaidRequestResponseHelper::addToResponse('errors', $exception->getMessage());
				return false;
			}
		}
		
	}
?>

<?php
	/* ********************************************************
	 * Responsible for the Raid data access *****************
	 * ********************************************************/
	class RaidDao {
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
		function getAll() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id AS id,
					MAIN.tavern_id AS tavern_id,
					MAIN.from_datetime AS from_datetime,
					MAIN.to_datetime AS to_datetime,
					MAIN.number_of_user AS number_of_user,
					MAIN.description AS description
				FROM
					raids MAIN
				WHERE
					MAIN.is_active = 1
				ORDER BY
					MAIN.number_of_user ASC
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute();
				
				return $statement->fetchAll();
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
		function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					raids
				SET
					tavern_id	     = ?,
					from_datetime    = ?,
					to_datetime      = ?,
					number_of_user   = ?,					
					description		 = ?,
					is_active        = 1,
					created_at       = NOW(),
					updated_at       = NOW()
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

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function deleteRaid($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					raid
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
		public function getActiveList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					RAIDS.id             AS id,
					RAIDS.id             AS raid_id,
					RAIDS.tavern_id      AS tavern_id,
					RAIDS.from_datetime  AS from_datetime,
					RAIDS.to_datetime    AS to_datetime,
					RAIDS.number_of_user AS number_of_user,
					RAIDS.description    AS description,
					RAIDS.is_active      AS is_active,
					RAIDS.created_at     AS created_at,
					RAIDS.updated_at     AS updated_at,
					TAVERNS.display_name          AS tavern_display_name,
					TAVERNS.address_country       AS tavern_address_country,
					TAVERNS.address_city          AS tavern_address_city,
					TAVERNS.address_postal_code   AS tavern_address_postal_code,
					TAVERNS.address_street_name   AS tavern_address_street_name,
					TAVERNS.address_street_number AS tavern_address_street_number,
					TAVERNS.address_latitude      AS tavern_address_latitude,
					TAVERNS.address_longitude     AS tavern_address_longitude,
					TAVERNS.opened_at             AS tavern_opened_at,
					TAVERNS.closed_at             AS tavern_closed_at
				FROM 
					raids RAIDS
					INNER JOIN taverns TAVERNS
						ON RAIDS.tavern_id = TAVERNS.id
				WHERE
					RAIDS.is_active   = 1 AND
					TAVERNS.is_active = 1
				;
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
		public function getRaidListWithTavernData() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					RAIDS.id AS raid_id,
					RAIDS.number_of_user AS required_number_of_users,
					RAIDS.description AS raid_description,
					TAVERNS.id AS tavern_id,
					TAVERNS.display_name AS tavern_name,
					TAVERNS.address_country AS tavern_country,
					TAVERNS.address_city AS tavern_city,
					TAVERNS.address_postal_code AS tavern_postal_code,
					TAVERNS.address_street_name AS tavern_street_name,
					TAVERNS.address_street_number AS tavern_street_number,
					TAVERNS.address_latitude AS tavern_latitude,
					TAVERNS.address_longitude AS tavern_longitude,
					TAVERNS.website_url AS tavern_website_url
				FROM
					raids RAIDS
					INNER JOIN taverns TAVERNS
						ON RAIDS.tavern_id = TAVERNS.id
				WHERE
					RAIDS.is_active = 1 AND
					TAVERNS.is_active = 1
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
		public function getUserRaidMomentListWithTavernData(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					USER_RAID_MOMENTS.id AS id,
					RAIDS.id AS raid_id,
					RAIDS.number_of_user AS required_number_of_users,
					RAIDS.description AS raid_description,
					TAVERNS.id AS tavern_id,
					TAVERNS.display_name AS tavern_name,
					TAVERNS.address_country AS tavern_country,
					TAVERNS.address_city AS tavern_city,
					TAVERNS.address_postal_code AS tavern_postal_code,
					TAVERNS.address_street_name AS tavern_street_name,
					TAVERNS.address_street_number AS tavern_street_number,
					TAVERNS.address_latitude AS tavern_latitude,
					TAVERNS.address_longitude AS tavern_longitude,
					TAVERNS.website_url AS tavern_website_url
				FROM
					user_raid_moments USER_RAID_MOMENTS
					LEFT JOIN raids RAIDS
						ON USER_RAID_MOMENTS.raid_id = RAIDS.id
					LEFT JOIN taverns TAVERNS
						ON RAIDS.tavern_id = TAVERNS.id
				WHERE
					USER_RAID_MOMENTS.user_id   = ? 
					-- AND
					-- USER_RAID_MOMENTS.is_active = 1 AND
					-- RAIDS.is_active             = 1 AND
					-- TAVERNS.is_active           = 1
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
		public function registerUserForRaid(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					raid_users
				SET
					raid_id			 = ?,
					user_id 		 = ?,
					is_active        = 1,
					created_at       = NOW(),
					updated_at       = NOW()
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

				return $database_connection->lastInsertId();
			}
			catch(Exception $exception) {
				TavernRaidRequestResponseHelper::addToResponse('errors', $exception->getMessage());
			
				UserMessagesHelper::addToMessages(
					$exception->getMessage(),
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);	
				return false;
			}
		}
	}
?>

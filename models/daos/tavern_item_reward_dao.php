<?php
	/* ********************************************************
	 * Responsible for the Tavern_item_reward data access *****************
	 * ********************************************************/
	class TavernItemRewardDao {
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
					MAIN.item_name AS item_name
				FROM
					tavern_item_rewards MAIN
				WHERE
					MAIN.is_active = 1
				ORDER BY
					MAIN.id ASC
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
		function createTavern_item_reward(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					taverns
				SET
					tavern_id  		 = ?,
					tavern_item_name = ?,
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
		function deleteTavern_item_reward($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					tavern_item_rewards
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
		
	}
?>

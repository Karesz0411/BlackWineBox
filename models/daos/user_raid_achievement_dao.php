<?php
	/* ********************************************************
	 * Responsible for the User_raid_achievement data access *****************
	 * ********************************************************/
	class UserRaidAchievementDao {
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
					MAIN.achievement_id AS achievement_id,
					MAIN.user_id AS user_id,
					MAIN.raid_id AS raid_id
				FROM
					user_raid_achievements MAIN
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
		function createUser_raid_achievement(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					user_raid_achievements
				SET
					achievement_id   = ?,
					user_id		     = ?,
					raid_id			 = ?,
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
		function deleteUser_raid_achievement($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					user_raid_achievements
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

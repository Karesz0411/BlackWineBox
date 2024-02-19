<?php
	/* ********************************************************
	 * Responsible for the Achievement data access *****************
	 * ********************************************************/
	class AchievementDao {
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


		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					achievements
				SET
					title			 = ?,
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
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getList() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					title AS title,
					description AS description,
					id AS id,
					is_active AS is_active,
					created_at AS created_at,
					updated_at AS updated_at
				FROM
					achievements
				WHERE 1
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
		public function getByUserId(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					ACHIEVEMENTS.id,
					ACHIEVEMENTS.title,
					ACHIEVEMENTS.description
				FROM
					user_achievements USER_ACHIEVEMENTS
					INNER JOIN achievements ACHIEVEMENTS
						ON USER_ACHIEVEMENTS.achievement_id = ACHIEVEMENTS.id
				WHERE
					USER_ACHIEVEMENTS.user_id = ?
				;
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
	}
?>

<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class UserDao {
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
		function getAll() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id AS id,
					MAIN.name AS name,
					MAIN.birthday_at AS birthday_at
				FROM
					users MAIN
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

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					users
				SET
					nick_name        = ?,
					email            = ?,
					password_hash    = ?,
					birthday_at      = ?,
					is_administrator = 0,
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
		function delete($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					users
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
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());

				return false;
			}
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function isUserNicknameUnique($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					'not_unique' AS 'is_nick_name_unique'
				FROM
					users MAIN
				WHERE
					MAIN.nick_name = ?
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
				
				return !$record[0]['is_nick_name_unique'] == 'not_unique';
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
		function isUserEmailUnique($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					'not_unique' AS 'is_email_unique'
				FROM
					users MAIN
				WHERE
					MAIN.email = ?
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
				
				return !$record[0]['is_email_unique'] == 'not_unique';
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
		function getHash(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT 
					MAIN.id AS id,
					MAIN.password_hash AS password_hash
				FROM 
					users MAIN 
				WHERE 
					MAIN.email = ?
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
				
				return $this->do_factory->get(DoFactory::USER, $statement->fetchAll()[0]);
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
		function getById(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT 
					MAIN.id AS id,
					MAIN.nick_name AS nick_name,
					MAIN.email AS email,
					MAIN.password_hash AS password_hash,
					MAIN.birthday_at AS birthday_at,
					MAIN.birthday_at < DATE_SUB(NOW(), INTERVAL 18 YEAR) AS is_above_legal_drinking_age,
					MAIN.is_administrator AS is_administrator,
					MAIN.is_active AS is_active,
					MAIN.created_at AS created_at,
					MAIN.updated_at AS updated_at
				FROM 
					users MAIN 
				WHERE 
					MAIN.id = ?
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
				
				return new UserDo($statement->fetchAll()[0]);
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
		function getUserListForTavernRegistration() { //TODO: Rename this function, as this is used not solely for just Tavern registration...
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT 
					MAIN.id AS id,
					MAIN.nick_name AS nick_name,
					MAIN.email AS email
				FROM 
					users MAIN 
				WHERE 
					MAIN.is_active = 1
				ORDER BY
					MAIN.nick_name ASC
			";

			try {
				$handler = ($this->database_connection_bo)->getConnection();
				$statement = $handler->prepare($query_string);
				$statement->execute();
				
				$dos = [];
				foreach ($statement->fetchAll() as $record) {
					$dos[] = $this->do_factory->get(DoFactory::USER, $record);
				}
				
				return $dos;
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
		function getUserOrders(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT 
					ORDERS.id              AS id,
					ORDERS.tavern_items_id AS tavern_items_id,
					ORDERS.user_id         AS user_id,
					ORDERS.amount          AS amount,
					ORDERS.status          AS status,
					ORDERS.is_active       AS is_active,
					ORDERS.created_at      AS created_at,
					ORDERS.updated_at      AS updated_at
				FROM 
					orders ORDERS 
				WHERE 
					ORDERS.is_active = 1 AND
					ORDERS.user_id   = ?
				ORDER BY
					ORDERS.created_at DESC
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
				
				$dos = [];
				foreach ($statement->fetchAll() as $record) {
					$dos[] = $this->do_factory->get(DoFactory::ORDER, $record);
				}
				
				return $dos;
			}
			catch(Exception $exception) {
				LogHelper::add('Error: ' . $exception->getMessage());
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());
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
		function registerAchievementForUser(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					user_achievements
				SET
					user_id			 = ?,
					achievement_id   = ?,
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
		function createRaidMomentForUser(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					user_raid_moments
				SET
					user_id			 = ?,
					raid_id          = ?,
					description      = ?,
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

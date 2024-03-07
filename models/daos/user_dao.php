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

		function getUsers() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.name AS name
				FROM
					bwb_users MAIN
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
		function getAll() {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT
					MAIN.id AS id,
					MAIN.name AS name,
					MAIN.birthday_at AS birthday_at
				FROM
					bwb_users MAIN
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
					bwb_users
				SET
					nick_name        = ?,
					email            = ?,
					password_hash    = ?,
					is_admin 		 = 0,
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
				RequestResponseHelper::addToResponse('errors', $exception->getMessage());
				return false;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function delete($parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				UPDATE
					bwb_users
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
					bwb_users MAIN
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
				
				return !isset($record[0]) || !$record[0]['is_nick_name_unique'] == 'not_unique';
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
					bwb_users MAIN
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
				
				return !isset($record[0]) || !$record[0]['is_email_unique'] == 'not_unique';
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
					bwb_users MAIN 
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
					MAIN.is_active AS is_active,
					MAIN.created_at AS created_at,
					MAIN.is_admin AS is_admin,
					MAIN.owned_products AS owned_products,
					MAIN.updated_at AS updated_at
				FROM 
					bwb_users MAIN 
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
		
	}
?>

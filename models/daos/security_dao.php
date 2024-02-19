<?php
	
	class SecurityDao {
		protected $database_connection_bo;

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function __construct($database_connection_bo) {
			$this->database_connection_bo = $database_connection_bo;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function getUserPasswordHashByUserId(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				SELECT 
					id AS id,
					password_hash AS password_hash
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
	}
?>
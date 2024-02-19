<?php
	/* ********************************************************
	 * Responsible for the Order data access *****************
	 * ********************************************************/
	class OrderDao {
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
		function create(array $parameters) {
			$query_string = "/* __CLASS__ __FUNCTION__ __FILE__ __LINE__ */
				INSERT INTO
					orders
				SET
					tavern_items_id   = ?,
					user_id			  = ?,
					amount			  = ?,
					status		      = 'OrderPlaced',
					is_active         = 1,
					created_at        = NOW(),
					updated_at        = NOW()
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
				TavernRaidRequestResponseHelper::addToResponse(
					'errors',
					$exception->getMessage()
				);
				UserMessagesHelper::addToMessages(
					$exception->getMessage(),
					UserMessagesHelper::MESSAGE_LEVEL_MESSAGE
				);
				
				return false;
			}
		}
		
	}
?>

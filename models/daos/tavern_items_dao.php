<?php
	/* ********************************************************
	 * Responsible for the Tavern data access *****************
	 * ********************************************************/
	class TavernItemsDao {
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
					MAIN.id         AS id,
					MAIN.tavern_id  AS tavern_id,
					MAIN.item_id    AS item_id,
					MAIN.price      AS price,
					MAIN.is_active  AS is_active,
					MAIN.created_at AS created_at,
					MAIN.updated_at AS updated_at
				FROM
					tavern_items MAIN
				WHERE
					MAIN.is_active = 1
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

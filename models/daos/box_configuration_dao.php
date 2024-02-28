<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class BoxConfigurationDao {
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
                    MAIN.description AS description
                FROM
                    16153_theapp.box_configurations MAIN
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

		
	}
?>

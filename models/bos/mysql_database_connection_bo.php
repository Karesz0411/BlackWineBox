<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class MysqlDatabaseBo {
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		function getConnection() {
			$host          = 'mariadb11.viacomkft.hu';
			$database_name = '16153_theapp';
			$user_name     = '16153_theapp'; //TODO: Create a secret retrieval process...
			$user_password = 'LyOOiFoEM7giE'; //TODO: Create a secret retrieval process...

			try {
				$connection = new PDO(
					'mysql:host=' . $host . ';dbname=' . $database_name,
					$user_name,
					$user_password
				);
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $exception) {
				throw new Exception('Connection failed: ' . $exception->getMessage());
			}

			return $connection;
		}
	}
?>

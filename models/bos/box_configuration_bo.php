<?php 
	class BoxConfigurationBo {
		
		protected $dao;

		public function __construct() {
			$this->dao = new BoxConfigurationDao(new MysqlDatabaseBo());
		}
		
		public function getAll() {
            $do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getAll();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					"Nincs még feltöltött tárgy!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::BOX_CONFIGURATION, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
<?php 
	class BoxConfigurationsBo {
		
		protected $dao;

		/* ********************************************************
		* ********************************************************
		* ********************************************************/

		public function __construct() {
			$this->dao = new BoxConfigurationsDao(new MysqlDatabaseBo());
		}

		/* ********************************************************
		* ********************************************************
		* ********************************************************/
		
		public function getAll() {
            $do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getAll();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					"Nincs még feltöltött box konfigurációk!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::BOX_CONFIGURATIONS, $record);
				}
			}
			
			return $do_list;
		}

		/* ********************************************************
		* ********************************************************
		* ********************************************************/

		public function create(BoxConfigurationsDo $do) {
			return ($this->dao)->create(
				[
					$do->name,
					$do->description
				]
			);
		}
	}
?>
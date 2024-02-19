<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class TavernItemsBo {

		protected $dao;
	  
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function __construct() {
			$this->dao = new TavernItemsDao(new MysqlDatabaseBo());
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getList();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					UserMessagesHelper::MESSAGE_LEVEL_ERROR,
					'No tavern items registered...'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::TAVERN_ITEMS, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
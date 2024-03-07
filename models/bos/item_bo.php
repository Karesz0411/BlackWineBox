<?php 
	class ItemBo {
		
		protected $dao;

		public function __construct() {
			$this->dao = new ItemDao(new MysqlDatabaseBo());
		}
		
		public function isItemCreateValid(ItemDo $do) {
			return !empty($do->name);
		}
		
		public function create(ItemDo $do) {
			return $this->dao->create([
				$do->name
			]);
		}
		
		public function getList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getList();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					"Nincs még feltöltött tárgy!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::ITEM, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
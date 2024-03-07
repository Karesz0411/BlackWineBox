<?php 
	class WineAttributesBo {
		
		protected $dao;

		public function __construct() {
			$this->dao = new WineAttributesDao(new MysqlDatabaseBo());
		}
		
		public function isWineAttributesCreateValid(WineAttributesDo $do) {
			return !empty($do->wine_name); //TODO: implement check if required
		}
		
		public function create(WineAttributesDo $do) {
			return $this->dao->create([
				$do->wine_name
			]);
		}
		
		public function getList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getList();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					"Nincs még feltöltött bor attribútumok!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::WINE_ATTRIBUTES, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
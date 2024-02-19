<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class AchievementBo {
		
		protected $dao;

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function __construct() {
			$this->dao = new AchievementDao(new MysqlDatabaseBo());
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function isAchievementCreateValid(AchievementDo $do) {
			return !empty($do->title) AND !empty($do->description);
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(AchievementDo $do) {
			return $this->dao->create([
				$do->title,
				$do->description
			]);
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
					'There are no achievements'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::ACHIEVEMENT, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
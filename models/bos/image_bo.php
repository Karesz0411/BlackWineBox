<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class ImageBo {
		
		protected $dao;

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function __construct() {
			//$this->dao = new ImageDao(new MysqlDatabaseBo());
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function isValid(TavernRaidAbstractDo $do) {
			if ($do->id < 1) {
				return false;
			}
			if (empty($do->actor) || $do->actor == '' || $do->actor == ' ') {
				return false;
			}
			
			return true;
		}
	}


?>
<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class RaidBo {
		protected $dao;
		protected $bo_factory;
		
	    /* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function __construct() {
			$this->dao = new RaidDao(new MysqlDatabaseBo());
			$this->bo_factory = new BoFactory();
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function validateRaidStart(RaidDo $do) {
			$tavern_bo = $this->bo_factory->get(BoFactory::TAVERN);
			$is_tavern_registration_valid = true;
			$is_tavern_registrated = false;
			
			if ($do->tavern_id == '') {
				UserMessagesHelper::addToMessages(
					"A \"Tavern ID\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['tavern_id'] = true;
			}
			
			if ($do->from_datetime == '') {
				UserMessagesHelper::addToMessages(
					"A \"From\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['from_datetime'] = true;
			}
			
			if ($do->to_datetime == '') {
				UserMessagesHelper::addToMessages(
					"A \"To\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['to_datetime'] = true;
			}
			
			if ($do->from_datetime != '' AND $do->to_datetime != '' AND $do->from_datetime >= $do->to_datetime) {
				UserMessagesHelper::addToMessages(
					"A raid kezdeti időpontja nem lehet későbbi időpont a raid vége időpontjánál!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			
			if ($do->number_of_user == '') {
				UserMessagesHelper::addToMessages(
					"A \"Number of user\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['number_of_user'] = true;
			}
			
			if (!preg_match("/^[0-9]+$/", $do->number_of_user)) {
				UserMessagesHelper::addToMessages(
					"Nem adható meg nem numerikus érték ebbe a mezőbe!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			
			if ($do->number_of_user <= '0') {
				UserMessagesHelper::addToMessages(
					"Nem adható meg 0 vagy annál kevesebb minimális résztvevő!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			
			if ($do->description == '') {
				UserMessagesHelper::addToMessages(
					"A \"Description\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['description'] = true;
			}
			
			foreach($tavern_bo->getList() as $record) {
				if ($record->id == $do->tavern_id) {
					$is_tavern_registrated = true;
					break;
				}
			}
			
			if (!$is_tavern_registrated) {
				UserMessagesHelper::addToMessages(
					"A megadott azonosító (ID) nem szerepel a regisztrált tavern-ek listájában!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(RaidDo $do) {
			return ($this->dao)->create(
				[
					$do->tavern_id,
					$do->from_datetime,
					$do->to_datetime,
					$do->number_of_user,
					$do->description
				]
			);
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getActiveList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getActiveList();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					UserMessagesHelper::MESSAGE_LEVEL_ERROR,
					'There are no current raids'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::RAID, $record);
				}
			}
			
			return $do_list;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getRaidListWithTavernData() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getRaidListWithTavernData();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					UserMessagesHelper::MESSAGE_LEVEL_ERROR,
					'There are no current raids'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::RAID_TAVERN, $record);
				}
			}
			
			return $do_list;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getUserRaidMomentListWithTavernData($user_id) {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getUserRaidMomentListWithTavernData([$user_id]);
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					UserMessagesHelper::MESSAGE_LEVEL_ERROR,
					'There given user has no raid moments uploaded...'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::USER_RAID_MOMENT, $record);
				}
			}
			
			return $do_list;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function registerUserForRaid($raid_id, $user_id) {
			return $this->dao->registerUserForRaid([$raid_id, $user_id]);
		}
	}
?>
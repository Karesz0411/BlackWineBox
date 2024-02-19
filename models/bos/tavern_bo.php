<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class TavernBo {

		protected $dao;
	  
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function __construct() {
			$this->dao = new TavernDao(new MysqlDatabaseBo());
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function isRegistrationValid(TavernDo $do) {	  
			if ($do->display_name == '') {
				UserMessagesHelper::addToMessages(
					"A \"Vendéglátó egység neve\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['display_name'] = true;
			}

			/*if (!($this->dao->isDisplayNameUnique([$do->display_name]))) { //Vendéglátó egység nevének egyediség vizsgálata
				UserMessagesHelper::addToMessages(
					"Az ön által megadott vendéglátó egység névvel már regisztráltak!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['display_name'] = true;
			}*/

			if ($do->company_name == '') {
				UserMessagesHelper::addToMessages(
					"A \"Tulajdonos / Cég neve\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['company_name'] = true;
			}
			
			if ($do->address_country == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Ország\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['address_country'] = true;
			}

			if ($do->address_city == '') {
				UserMessagesHelper::addToMessages(
					"A \"Város\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['address_city'] = true;
			}

			if ($do->address_postal_code == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Irányítószám\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['address_postal_code'] = true;
			}
			
			if ($do->address_street_name == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Utca név\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['address_street_name'] = true;
			}
			
			if ($do->address_street_number == '') {
				UserMessagesHelper::addToMessages(
					"A \"Házszám\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['address_street_number'] = true;
			}
			
			if ($do->opened_at == '') {
				UserMessagesHelper::addToMessages(
					"A \"Nyitási időpont\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['opened_at'] = true;
			}
			
			if ($do->closed_at == '') {
				UserMessagesHelper::addToMessages(
					"A \"Zárási időpont\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['closed_at'] = true;
			}
			
			if ($do->phone_number == '') {
				UserMessagesHelper::addToMessages(
					"A \"Telefonszám\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['phone_number'] = true;
			}
			
			if ($do->email == '') {
				UserMessagesHelper::addToMessages(
					"Az \"E-mail cím\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['email'] = true;
			}
			
			if (!filter_var($do->email, FILTER_VALIDATE_EMAIL)){
				UserMessagesHelper::addToMessages(
					"Az \"E-mail cím\" mező formailag nem felel meg!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['email'] = true;
			}
			
			if (empty($do->owner_user_id)){
				UserMessagesHelper::addToMessages(
					"A \"Tulajdonos felhasználó azonosító\" kiválasztása kötelező!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['email'] = true;
			}
		}

		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function create(TavernDo $do) {
			return ($this->dao)->create(
				[
					$do->display_name,
					$do->company_name,
					$do->address_country,
					$do->address_city,
					$do->address_postal_code,
					$do->address_street_name,
					$do->address_street_number,
					$do->address_latitude,
					$do->address_longitude,
					$do->opened_at,
					$do->closed_at,
					$do->phone_number,
					$do->email,
					$do->website_url,
					$do->facebook_url,
					$do->owner_user_id,
					$do->administrator_user_id
				]
			);
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			foreach ($this->dao->getList() as $record) {
				$do_list[] = $do_factory->get(DoFactory::TAVERN, $record);
			}
			
			foreach ($this->getTavernItemsList() as $tavern_items_do) {
				foreach ($do_list as &$tavern_do) {
					if ($tavern_do->id === $tavern_items_do->tavern_id) {
						$tavern_do->tavern_items_dos[] = $tavern_items_do;
					}
				}
			}
			
			return $do_list;
		}
		
		public function getTavernItemsList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			foreach ($this->dao->getTavernItemsList() as $record) {
				$do_list[] = $do_factory->get(DoFactory::TAVERN_ITEMS, $record);
			}
			
			return $do_list;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function getListByUserId($user_id) {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getTavernListByUserId(
				[
					$user_id,
					$user_id
				]
			);
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					UserMessagesHelper::MESSAGE_LEVEL_ERROR,
					'User has no Taverns registered'
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::TAVERN, $record);
				}
			}
			
			return $do_list;
		}
		
		/* ********************************************************
		 * ********************************************************
		 * ********************************************************/
		public function setTavernItemPrice(TavernItemsDo $do) {
			return $this->dao->setTavernItemPrice(
				[
					$do->tavern_id,
					$do->item_id,
					$do->price,
					$do->price //We need to set the price twice, as we use ON DUPLICATE KEY UPDATE with this function.
				]
			);
		}
	}
?>
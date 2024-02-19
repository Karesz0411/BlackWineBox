<?php 
	class WineBo {
		
		protected $dao;

		public function __construct() {
			$this->dao = new WineDao(new MysqlDatabaseBo());
		}
		
		public function isWineUploadValid(WineDo $do) {
			
			if ($do->name == '') {
				UserMessagesHelper::addToMessages(
					"A \"Név\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['name'] = true;
			}
			
			if ($do->winery == '') {
				UserMessagesHelper::addToMessages(
					"A \"Borászat\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['winery'] = true;
			}
			
			if ($do->production_year == '') {
				UserMessagesHelper::addToMessages(
					"A \"Palackozási dátum\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['production_year'] = true;
			}
			
			if ($do->color == '') {
				UserMessagesHelper::addToMessages(
					"A \"Szín\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['color'] = true;
			}
			
			if ($do->sweetness == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Édességi faktor\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['sweetness'] = true;
			}
			
			if ($do->origin_country == '') {
				UserMessagesHelper::addToMessages(
					"A \"Származási ország\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['origin_country'] = true;
			}
			
			if ($do->origin_region == '') {
				UserMessagesHelper::addToMessages(
					"A \"Származási régió\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['origin_region'] = true;
			}
			
			if ($do->origin_city == '') {
				UserMessagesHelper::addToMessages(
					"A \"Származási város\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['origin_city'] = true;
			}
			
			if ($do->type == '') {
				UserMessagesHelper::addToMessages(
					"A \"Típus\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['type'] = true;
			}
			
			if ($do->consumption_temperature == '') {
				UserMessagesHelper::addToMessages(
					"A \"Fogyasztási hőmérséklet\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['consumption_temperature'] = true;
			}
			
			if ($do->bottler == '') {
				UserMessagesHelper::addToMessages(
					"A \"Palackozó\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['bottler'] = true;
			}
			
			if ($do->bottle_size == '') {
				UserMessagesHelper::addToMessages(
					"A \"Palack űrtartalma (liter)\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['bottle_size'] = true;
			}
			
			if ($do->alcohol_percentage_level == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Alkoholtartalom (%)\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['alcohol_percentage_level'] = true;
			}
			
			if ($do->ean == '') {
				UserMessagesHelper::addToMessages(
					"Az \"EAN azonosító\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['ean'] = true;
			}
			
			if ($do->alcohol_percentage_level == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Alkoholtartalom (%)\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['alcohol_percentage_level'] = true;
			}
			
			if ($do->cork_type == '') {
				UserMessagesHelper::addToMessages(
					"Az \"Kupakozás típusa\" mező nem lehet üres!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
				
				UserMessagesHelper::$invalid_form_fields['cork_type'] = true;
			}
		}
		
		public function create(WineDo $do) {
			return $this->dao->create([
				$do->name,
				$do->winery,
				$do->production_year,
				$do->color,
				$do->sweetness,
				$do->origin_country,
				$do->origin_region,
				$do->origin_city,
				$do->type,
				$do->consumption_temperature,
				$do->bottler,
				$do->bottle_size,
				$do->alcohol_percentage_level,
				$do->ean,
				$do->cork_type
			]);
		}
		
		public function getList() {
			$do_factory = new DoFactory();
			$do_list = [];
			
			$records = $this->dao->getList();
			
			if (empty($records)) {
				UserMessagesHelper::addToMessages(
					"Nincs még feltöltött bor!",
					UserMessagesHelper::MESSAGE_LEVEL_ERROR
				);
			}
			else {
				foreach ($records as $record) {
					$do_list[] = $do_factory->get(DoFactory::WINE, $record);
				}
			}
			
			return $do_list;
		}
	}
?>
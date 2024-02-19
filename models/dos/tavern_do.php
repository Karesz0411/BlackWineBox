<?php
	/* ********************************************************
	 * ********************************************************
	 * ********************************************************/
	class TavernDo extends TavernRaidImageAbstractDo {
		public $display_name;
		public $company_name;
		public $address_country;
		public $address_city;
		public $address_postal_code;
		public $address_street_name;
		public $address_street_number;
		public $address_latitude;
		public $address_longitude;
		public $opened_at;
		public $closed_at;
		public $phone_number;
		public $email;
		public $website_url;
		public $facebook_url;
		public $owner_user_id;
		public $administrator_user_id;
		
		public $tavern_items_dos = [];
	}
?>
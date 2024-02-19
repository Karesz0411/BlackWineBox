<?php
	
	class DocumentationIndexView extends AbstractView {
		public function displayMobile() {
			header('Content-Type: application/json');
		
			echo json_encode( //TODO: Mit kellene küldeni a mobilosnak? [trisssz]
				UserMessagesHelper::getAllMessages()
			);
		}
		
		public function displayWeb(UserDo $user_do) {
			?>
				
				<?php $this->getWebHeader(); ?>
				
				
					<hr style="clear:both" />
					<h1>Beadandó feladat: Alkalmazások fejlesztése projekt labor I</h1>
					<h2>THE_00143_N_3_G, THE_00143_L_3_G</h2>
					<h3>(2022/2023/2)</h3>
					<ul>
						<li>Antal Béla (GTE1Y4) - Web FrontEnd inegrációs tesztelés</li>
						<li>Bárdos Trisztetn (CUNPO1) - Web FrontEnd fejlesztés</li>
						<li>Fejér Zakariás (RWWF5W) - BackEnd fejlesztés</li>
						<li>Laczkó Lali (W6Y0XZ) - Mobil FrontEnd fejlesztés</li>
						<li>Mihály Károly (VECB52) - BackEnd fejlesztés</li>
						<li>Papp Kevin (BM7SGF) - Adatbázis fejlesztés</li>
						<li>Veres Zoltán (DZAE6I) - Vezető fejlesztő</li>
					</ul>
					<h2>Absztrakt</h2>
					<p>
						A Tokaj-Hegyalja Egyetem keretén belül, a Programtervező Informatikus (PTI)
						hallgatók közös munkát választottak az 
						"Alkalmazások fejlesztése projekt labor I" című gyakorlati tantárgy 
						sikeres elvégzéséhez, melynek teljesítéséhez az alábbi dokumentum szolgál.
					</p>
					<p>
						A THE modern és gyakorlat orientált képzési formályának szemléltetésére 
						a csapat megállapodott, hogy Angol idegen nyelven vezeti le a 
						"Tavern Raid" elnevezésű projekt főbb moduljait, melynek szerves része
						a projekt dokumentáció és a kódbázisok. Csakis bizonyos Magyar 
						nyelvterületre szánt egységek jelennek meg Magyar nyelven.
					</p>
					
				
					<hr style="clear:both" />
					<section id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="#team">The Team</a></li>
							<li><a href="#project">The Project</a></li>
							<li><a href="#application">The Application</a></li>
							<li><a href="#dictionary">Dictionary</a></li>
							<li><a href="#uml">Flow diagrams</a></li>
							<li><a href="#database">Database diagrams</a></li>
							<li><a href="#code">Class diagrams</a></li>
							<li><a href="#test">Integration tests</a></li>
						</ul>
					</section>
				
					<hr style="clear:both" />
					<section id="team">
					<h2>The Team</h2>
					<div >
						<div>
							<h3>CEO</h3>
							<p>Lajos Laczko</p>
							<img alt="Lajos Laczko" src="/tavernraid/images/team/Lajos_Laczko-profile-photo.jpg" />
						</div>

						<hr style="clear:both" />

						<div>
							<h3>CFO</h3>
							<p>Bettina Fitos</p>
							<img alt="Bettina Fitos" src="/tavernraid/images/team/Bettina_Fitos-profile-photo.jpg" />
						</div>
						
						 <div>
							<h3>CMO</h3>
							<p>Zsofia Gilanyi</p>
							<img alt="Zsofia Gilanyi" src="/tavernraid/images/team/Zsofia_Gilanyi-profile-photo.jpg" />
						</div>
						
						<div>
							<h3>CTO</h3>
							<p>Zoltan Veres</p>
							<img alt="Zoltan Veres" src="/tavernraid/images/team/Zoltan-Veres-profile-photo.jfif" />
						</div>

						<hr style="clear:both" />

						<div>
							<h3>FrontEnd Engineer</h3>
							<p>Triszten Bardos</p>
							<img alt="Triszten Bardos" src="/tavernraid/images/team/Triszten_Bardos-profile-photo.jpg" />
						</div>
						<div>
							<h3>FrontEnd QA Tester</h3>
							<p>Bela Antal</p>
							<img alt="Bela Antal" src="/tavernraid/images/team/Bela_Antal-profile-photo.jpg" />
						</div>

						<div>
							<h3>BackEnd Engineer</h3>
							<p>Karoly Mihaly</p>
							<img alt="Triszten Bardos" src="/tavernraid/images/team/Karoly_Mihaly-profile-photo.jpg" />
						</div>
						<div>
							<h3>Junior BackEnd Engineer</h3>
							<p>Zakarias Fejer</p>
							<img alt="Zakarias Fejer" src="/tavernraid/images/team/Zakarias_Fejer-profile-photo.jpg" />
						</div>

						<div>
							<h3>DataBase Engineer</h3>
							<p>Kevin Papp</p>
							<img alt="Kevin Papp" src="/tavernraid/images/team/Kevin_Papp-profile-photo.jpg" />
						</div>
					</div>
					</section>


					<hr style="clear:both" />
					<section id="project">
					<h2>The Project</h2>
					<div>
						<p>
							A MobilePhone Application which makes the pub crawl experience more exciting with:
						</p>
						<ul>
							<li>Loyalty point system</li>
							<li>All sort of event organization</li>
						</ul>

						<hr style="clear:both" />
						<h3>The problem</h3>
						<p>
							In today's world, it is increasingly becoming a problem for pubs/bars, 
							especially those in rural areas, that not enough young people go there, 
							and only a regular crowd frequents them. As a result, their revenue is decreasing, 
							and the rising alcohol prices from time to time only make it 
							more difficult for these establishments to survive.
						</p>

						<hr style="clear:both" />
						<h3>The solution</h3>
						<p>
							Tavern Raid is a mobile application since phones are the devices that people 
							are constantly in contact with, especially the 18-28 age group. Initially, 
							everyone would create their own profile where they could provide certain 
							personal information to help find friends. The application would have a map 
							where the raided hospitality establishments and our friends who check-in 
							there would appear. In addition, there would be several other built-in 
							features that would greatly enhance the experience, and users could collect 
							points that they could redeem for a free drink or a gift/promotion provided 
							by the respective bar. The points would be tied to a specific location, so 
							you could only spend them where you consumed them.
						</p>

						<hr style="clear:both" />
						<h3>The competition</h3>
						<p>
							I found only one similar program, an application called "Beer Buddy", 
							but this app is only used to notify your friends where you are drinking. 
							It is a well-functioning and sophisticated app, but it is not very 
							well-known, partly due to poor advertising.
						</p>

						<hr style="clear:both" />
						<h3>Business model</h3>
						<p>
							A phone application would not require any significant investment initially. 
							If a professional programmer creates the app and a graphic designer 
							creates the design, it would cost approximately 2-3 million forints. 
							Renting a server to serve 1 million users per day would cost between 
							400,000 and 500,000 forints per year. Once the software is developed 
							and running, the average monthly expense would not exceed 100,000 forints, 
							not including taxes. The majority of the revenue would come from the pubs, 
							as they would pay a monthly fee to be included in the app under the contract 
							with the pubs. I would set this fee at 10,000 forints. With 10 pubs, 
							the monthly cost would be covered, and with 100 pubs, the gross income 
							would already generate a profit. The goal is to sign contracts with pubs 
							and, over time, acquire sponsors.
						</p>
					</div>
					</section>
					
					
					<hr style="clear:both" />
					<section id="application">
						<h2>The Application</h2>
						<div>
						
							<hr style="clear:both" />
							<div>
								<h3>Repository</h3>
								<a href="https://github.com/csoko99/TavernRaid_mobile" target="_blank">
									https://github.com/csoko99/TavernRaid_mobile
								</a>
							</div>
							
							<hr style="clear:both" />
							<div class="image_gallery">
								<h3>Screenshots</h3>
								<div class="image">
									<img src="/tavernraid/images/mobile/register_screen.png" />
									<p>Registration screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/register_error.png" />
									<p>Registration error</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/datetime_picker_modal.png" />
									<p>DateTime picker</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/login_screen.png" />
									<p>Login screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/login_error.png" />
									<p>Login error</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/menu_screen.png" />
									<p>Menu screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/newsfeed_screen.png" />
									<p>NewsFeed screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/raid_screen.png" />
									<p>Raid screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/taverns_screen.png" />
									<p>Taverns screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/tavern_screen.png" />
									<p>Tavern screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/profile_screen.png" />
									<p>Profile screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/profile_screen2.png" />
									<p>Another profile screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/achievement_screen.png" />
									<p>Achievements screen</p>
								</div>
								<div class="image">
									<img src="/tavernraid/images/mobile/map_screen.png" />
									<p>Map screen</p>
								</div>
							</div>
						</div>
					</section>


					<hr style="clear:both" />
					<section id="dictionary">
						<h2>Dictionary</h2>
						<div>
							<ul>
								<li>BO - Business Object</li>
								<li>DAO - Data Access Object</li>
								<li>DO - Data Object</li>
								<li>MPA - Mobile Phone Application</li>
								<li>CDN - Content Delivery Network</li>
								<li>BE - BackEnd</li>
								<li>FE - FrontEnd</li>
								<li>DB - DataBase</li>
								<li>CEO - Chief Executive Officer</li>
								<li>CMO - Chief Marketing Officer</li>
								<li>CFO - Chief Finance Officer</li>
								<li>CTO - Chief Technical Officer</li>
							</ul>
						</div>
					</section>


					<hr style="clear:both" />
					<section id="uml">
						<h2>UMLs</h2>

						<hr style="clear:both" />
						<div>
							<h3>Application control logic</h3>
							<img src="/tavernraid/images/uml/application_control_logic.svg" />
						</div>

						<hr style="clear:both" />
						<div>
							<h3>URL request serving and processing in the BackEnd</h3>
							<img src="/tavernraid/images/uml/backend_url_control_logic.svg" />
						</div>

					</section>


					<hr style="clear:both" />
					<section id="database">
						<h2>Database</h2>
						
						<hr style="clear:both" />
						<div>
							<h3>Tool for diagram creation</h3>
							<a 
								href="https://dbdiagram.io/d/643abb736b31947051a59c2c" 
								target="_blank">
								https://dbdiagram.io/d/643abb736b31947051a59c2c
							</a>
							<a 
								href="https://dbdiagram.io/d/6447c6756b319470512a28d0" 
								target="_blank">
								https://dbdiagram.io/d/6447c6756b319470512a28d0
							</a>
						</div>
						
						<hr style="clear:both" />
						<div>
							<h3>Tables and connections diagram</h3>
							<!--https://dbdiagram.io/d/643abb736b31947051a59c2c-->
							<img src="/tavernraid/images/db/Tavern_Raid_db.png" style="width: 100%" />
						</div>
						
						<hr style="clear:both" />
						<h2>Tables and connections wireframe</h2>
				<pre>
Table abstract {
  id integer
  is_active integer
  created_at timestamp
  updated_at timestamp
}

Ref: users.id > abstract.id
Table users {
  id integer [primary key]
  nick_name varchar(256)
  email varchar(256)
  password_hash varchar(256)
  birthday_at datetime
  is_administrator tinyint
}

Ref: user_raid_achievements.id > abstract.id
Ref: user_raid_achievements.user_id > users.id
Ref: user_raid_achievements.raid_id > raids.id
Ref: user_raid_achievements.achievement_id > achievements.id
Table user_raid_achievements {
  id integer [primary key]
  user_id integer
  raid_id integer
  achievement_id integer
}

Ref: user_raid_points.id > abstract.id
Ref: user_raid_points.user_id > users.id
Ref: user_raid_points.raid_id > raids.id
Table user_raid_points {
  id integer [primary key]
  user_id integer
  raid_id integer
  point_value float
}

Ref: taverns.id > abstract.id
Ref: taverns.owner_user_id > users.id
Ref: taverns.administrator_user_id > users.id
Table taverns {
  id integer [primary key]
  display_name varchar(256)
  company_name varchar(256)
  address_country varchar(256)
  address_city varchar(256)
  address_postal_code varchar(256)
  address_street_name varchar(256)
  address_street_number varchar(256)
  address_latitude float
  address_longitude float
  opened_at text
  closed_at text
  phone_number varchar(255)
  email varchar(255)
  website_url varchar(512)
  facebook_url varchar(512)
  owner_user_id integer
  administrator_user_id integer
}

Ref: tavern_items.id > abstract.id
Ref: tavern_items.tavern_id > taverns.id
Table tavern_items {
  id integer [primary key]
  tavern_id integer
  item_name varchar(255)
  item_price float
}

Ref: tavern_item_rewards.id > abstract.id
Ref: tavern_item_rewards.tavern_id > taverns.id
Table tavern_item_rewards {
  id integer [primary key]
  tavern_id integer
  item_name varchar(255)
}

Ref: raids.id > abstract.id
Table raids {
  id integer [primary key]
  tavern_id integer
  from_datetime datetime
  to_datetime datetime
  number_of_user in(10)
  description varchar(255)
}

Ref: raid_users.id > abstract.id
Ref: raid_users.raid_id > raids.id
Ref: raid_users.user_id > users.id
Table raid_users {
  id integer [primary key]
  raid_id integer
  user_id integer
}

Ref: raid_rewards.id > abstract.id
Ref: raid_rewards.raid_id > raids.id
Ref: raid_rewards.tavern_item_rewards_id > tavern_item_rewards.id
Table raid_rewards {
  id integer [primary key]
  raid_id integer
  tavern_item_rewards_id integer
}

Ref: achievements.id > abstract.id
Table achievements {
  id integer [primary key]
  title varchar(255)
  description varchar(255)
}

Ref: orders.id > abstract.id
Ref: orders.tavern_item_id > tavern_items.id
Ref: orders.user_id > users.id
Table orders {
  id integer [primary key]
  tavern_item_id integer
  user_id integer
  status varchar(255)
}

				</pre>
					</section>


					<hr style="clear:both" />
					<section id="code">
						<h2>Code</h2>
						
						<hr style="clear:both" />
						<div>
							<h3>Tool for diagram creation</h3>
							<a href="https://www.planttext.com/" target="_blank">https://www.planttext.com/</a>
						</div>
						
						<div>
							<h3>Class type overview</h3>
							<img
								src="/tavernraid/images/uml/nLJ1Ji904BtlLuo92Mf2-05Di1IZIH5J48zaMaRSs7PXTuiXwB-x2stAKXh5YqssXpTltjkPphIhD4gTfmaxqs-K4gnu937JZ6ck4u9UWag1pt4kCMMiquAhKnu6S5f2gyCM6B_Zt5WF7yVXC0Zw8MoO4VgBz-dk0AN_OEZt0sDjLKhC5wf00E9j.svg"
								style="width: 100%"
							/>
						</div>
						
						
						<div>
							<h3>Data Objects (DOs)</h3>
							<img
								src="/tavernraid/images/uml/dos.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package MODEL { 
    package Dos {
      class AchievementDao{
        public $title;
        public $description;
        public $image_file_name;
      }
      class OrderDao{
        public $tavern_item_id;
        public $user_id;
        public $status;
      }
      class RaidDo{
        public $tavern_id;
        public $from_datetime;
        public $to_datetime;
        public $number_of_user;
        public $description;
      }
      class RaidRewardDo{
        public $raid_id;
        public $tavern_item_reward_id;
      }
      class RaidUserDo{
        public $user_id;
        public $raid_id;
      }
      class TavernDo{
        public $display_name;
        public $comapny_name;
        public $address_country;
        public $address_city;
        public $address_postal_code;
        public $address_street_name;
        public $address_street_number;
        public $address_latitude;
        public $address_longitude;
        public $phone_number;
        public $email;
        public $website_url;
        public $facebook_url;
        public $owner_user_id;
        public $administrator_user_id;
      }
      class TavernItemDo{
        public $tavern_id;
        public $item_name;
        public $item_price;
      }
      class TavernItemRewardDo{
        public $tavern_id;
        public $item_name;
      }
      class TavernraidAbstractDo{
        public $id;
        public $is_active;
        public $created_at;
        public $updated_at;
        function __construct($attributes = null)
      }
      class UserDo{
        public $nick_name;
        public $email;
        public $password;
        public $password_again;
        public $password_hash;
        public $birthday_at;
        public $is_above_legal_drinking_age;
        public $is_administrator;
        public function getAttributeArray()
      }
      class UserRaidAchievementDo{
        public $achievement_id;
        public $user_id;
        public $raid_id;
      }
      class UserRaidPointsDo{
        public $raid_id;
        public $user_id;
        public $point_value;
      }
      class ViewDo {
        public $root_title = 'TavernRaid';
        public $root_link;
        public $titles;
        public $links;
        function __construct(array $titles, array $links)
        public function getPageTitle()
        public function getWebTitle()
      }
      class TavernRaidAbstractDo {
        __construct($attributes = null)
      }
      UserDo <|-- TavernRaidAbstractDo
      class UserDo
      TavernDo <|-- TavernRaidAbstractDo
      class TavernDo
    }
  }

@enduml
							</pre>
						</div>
						
						<hr style="clear:both" />
						<div>
							<h3>Data Access Objects (DAOs)</h3>
							<img
								src="/tavernraid/images/uml/daos.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package MODEL { 
    package Daos {
      class AchievementDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function create(array $parameters)
      }
      class CommonDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getUsers()
        function createUser($parameters)
        function deleteUser($parameters)
      }
      class OrderDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createOrder(array $parameters)
        function deleteOrder($parameters)
      }
      class RaidDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createRaid(array $parameters)
        function deleteRaid($parameters)
      }
      class RaidRewardDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createRaid_reward(array $parameters)
        function deleteRaid_reward($parameters)
      }
      class RaidUserDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createRaid_user(array $parameters)
      }
      class SecurityDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getUserPasswordHashByUserId(array $parameters)
      }
      class TavernDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function create(array $parameters)
        function deleteTavern($parameters)
        function isDisplayNameUnique($parameters)
      }
      class TavernItemDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createTavern_item(array $parameters)
        function deleteTavern_item($parameters)
      }
      class TavernItemRewardDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createTavern_item_reward(array $parameters)
        function deleteTavern_item_reward($parameters)
      }
      class UserDao{
        protected $database_connection_bo;
        protected $do_factory;
        function __construct($database_connection_bo)
        function getAll()
        function create(array $parameters)
        function deleteUser($parameters)
        function isUserNicknameUnique($parameters)
        function isUserEmailUnique($parameters)
        function getHash(array $parameters)
        function getById(array $parameters)
        function getUserListForTavernRegistration()
      }
      class UserRaidAchievementDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createUser_raid_achievement(array $parameters)
        function deleteUser_raid_achievement($parameters)
      }
      class UserRaidPointsDao{
        protected $database_connection_bo;
        function __construct($database_connection_bo)
        function getAll()
        function createUser_raid_point(array $parameters)
        function deleteUser_raid_point($parameters)
      }
    }
  }

@enduml
							</pre>
						</div>
						
						
						<hr style="clear:both" />
						<div>
							<h3>Business Objects (BOs)</h3>
							<img
								src="/tavernraid/images/uml/bos.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package MODEL { 
    package Bos {
      class MysqlDatabaseBo {
        function getConnection()
      }
      class SecurityBo{
      protected $dao;
      public function __construct()
      public function doUserAuthorization()
      }
      class TavernBo {
        protected $dao;
        public function __construct()
        public function isRegistrationValid(TavernDo $do)
        public function create(TavernDo $do)
      }
      class UserBo{ 
        protected $dao;
        public function __construct()
        public function getHashFromPassword(UserDo $do)
        public function getUsers()
        public function isRegistrationValid(UserDo $do)
        public function create(UserDo $do)
        public function isUserEmailUnique($email)
        public function isUserNicknameUnique($nick_name)
        public function doLogin(UserDo $input_do)
        public function getById($id)
        public function getUserForgotPassword(array $parameters)
        public function getUserListForTavernRegistration()
      }
      class AchievementBo {
        protected $dao;
        public function __construct()
        public function isAchievementCreateValid(AchievementDo $do)
        public function create(AchievementDo $do)
      }
      class OrderBo
      class RaidBo
      class RaidRewardBo
      class RaidUserBo
      class TavernItemBo
      class TavernItemRewardBo
      class TavernRaidAbstractBo
      class UserRaidAchievementBo
      class UserRaidPointsBo
    }
  }

@enduml
							</pre>
						</div>
						
						
						<hr style="clear:both" />
						<div>
							<h3>Factories</h3>
							<img
								src="/tavernraid/images/uml/factories.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package MODEL { 
    package factories {
      class BoFactory {
            const USER           = "User";
            const TAVERN      = "Tavern";
            const RAID           = "Raid";
            const ACHIEVEMENT = "Achievement";

        public function get(string $class_name);
      }
      class DaoFactory {
            const USER      = "User";
            const TAVERN = "Tavern";
            const RAID      = "Raid";

        public function get(string $class_name, $attributes = null);
      }
      class DoFactory {
            const USER           = "User";
            const TAVERN      = "Tavern";
            const RAID           = "Raid";
            const VIEW           = "View";
            const ACHIEVEMENT = "Achievement";

        public function get(string $class_name, $attributes = null);
      }
    }
  }

@enduml
							</pre>
						</div>
						
						
						<hr style="clear:both" />
						<div>
							<h3>Helpers</h3>
							<img
								src="/tavernraid/images/uml/helpers.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package MODEL { 
    package helpers {
      class TavernRaidLogHelper{
        public static $log = [];
        public static function add(string $input);
        public static function get();
      }
      class TavernRaidRequestResponseHelper{
        public static $root         = "";
    		public static $path         = "";
    		public static $url_root     = "";
    		public static $request      = [];
    		public static $project_name = "";
    		public static $method       = "";
    		public static $actor_name   = "";
    		public static $actor_action = "";
    		public static $response     = [];
        public static function setBaseResponse();
        public static function addToResponse($name, $value)
      }
      class TavernRaidStringHelper{
        public static function getLink(string $input);
        public static function getUnderScoresReplacedWithSpaces(string $input);
        public static function getSpacesReplacedWithUnderScores(string $input);
        public static function getHumanReadable(string $input);
        public static function getBoNameFromActorLinkSingularName(string $input);
        public static function getActorNameFromIdActorAttributeName(string $input);
        public static function getActorTableNameFromIdActorAttributeName(string $input);
      }
      class UserMessagesHelper{
        const MESSAGE_LEVEL_MESSAGE = "message";
	      const MESSAGE_LEVEL_WARNING = "warning";
      	const MESSAGE_LEVEL_ERROR   = "error";
	
  	    public static $messages = [];
	      public static $warnings = [];
	      public static $errors   = [];
	      
	      public static $invalid_form_fields = [];
	      public static function addToMessages($message, 	$message_level = "default_message");
	      public static function getAllMessages();
      }
  }

@enduml
							</pre>
						</div>
						
						
						<hr style="clear:both" />
						<div>
							<h3>Views</h3>
							<img
								src="/tavernraid/images/uml/views.svg"
								style="width: 100%"
							/>
							<pre>
@startuml
!theme vibrant

title Class Diagram

/' *********************************************
   *********************************************'/
package CONTROLLER {

  /' *********************************************
     *********************************************'/
  package VIEW { 
    class AbstractView {
      public $do;

      function __construct(ViewDo $do);
      public function getWebHeader();
      public function getWebFooter();
    }
    class AchievementCreateView extends AbstractView {
      public function displayMobile();
      public function displayWeb(AchievementDo $achievement_do);
    }
    class DocumentationIndexView extends AbstractView {
      public function displayMobile();
      public function displayWeb(UserDo $user_do);
    }
    class TavernRegistrationView extends AbstractView {
      public function displayMobile();
      public function displayWeb(TavernDo $tavern_do, UserBo $user_bo);
    }
    class UserLoginView extends AbstractView {
      public function displayMobile();
      public function displayWeb(UserDo $user_do);
    }
    class UserProfileView extends AbstractView {
      public function displayMobile(UserDo $user_do);
      public function displayWeb(UserDo $user_do);
    }
    class UserRegistrationView extends AbstractView {
      public function displayMobile();
      public function displayWeb(UserDo $user_do);
    }
  }

@enduml
							</pre>
						</div>
					
					</section>
					
					
					<hr style="clear:both" />
					<section id="test">
						<h2>Integration test / Web FrontEnd test</h2>

						<hr style="clear:both" />
						<div>
							<h3>Repository</h3>
							<a href="https://github.com/ARTidas/TavernRaidIntegrationTest" target="_blank">
								https://github.com/ARTidas/TavernRaidIntegrationTest
							</a>
						</div>

						<hr style="clear:both" />
						<div>
							<h3>Sample</h3>
							<img
								src="/tavernraid/images/test/selenium-integration-test-1.png"
								style="width:100%;"
							/>
						</div>

					</section>
				
				<?php $this->getWebFooter(); ?>
				
			<?php
		}
	}
?>
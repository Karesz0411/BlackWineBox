<?php
	/* ********************************************************
	** ********************************************************
	** ********************************************************/
	class RequestResponseHelper {
		public static $root         = "";
		public static $path         = "";
		public static $url_root     = "";
		public static $request      = [];
		public static $project_name = "";
		public static $method       = "";
		public static $actor_name   = "";
		public static $actor_action = "";
		public static $response     = [];

		/* ********************************************************
		** ********************************************************
		** ********************************************************/
		public static function setBaseResponse() {
			self::$response = [
				'status'       => "OK",
				'path'         => self::$path,
				'url_root'     => self::$url_root,
				'project_name' => self::$project_name,
				'actor_name'   => self::$actor_name,
				'actor_action' => self::$actor_action,
				'errors'       => [],
				'messages'     => [],
			];
		}

		/* ********************************************************
		** ********************************************************
		** ********************************************************/
		public static function addToResponse($name, $value) {
			self::$response[$name][] = $value;
		}
	}
?>

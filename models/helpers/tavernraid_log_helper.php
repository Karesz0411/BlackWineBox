<?php
/* ********************************************************
 * ********************************************************
 * ********************************************************/
Class TavernRaidLogHelper {
  public static $log = [];

  /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
  public static function add(string $input) {
    self::$log[] = $input;
  }

  /* ********************************************************
	 * ********************************************************
	 * ********************************************************/
  public static function get() {
    return self::$log;
  }

}
?>

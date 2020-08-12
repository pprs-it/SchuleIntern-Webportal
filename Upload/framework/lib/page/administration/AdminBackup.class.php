<?php

class AdminBackup extends AbstractPage {

	private $info;
	
	private $adminGroup = 'Webportal_Administrator';
	
	
	public function __construct() {
		die();	
	}

	public function execute() {
	    new errorPage();
	}
	
	private function index() {
	}
	
	public static function hasSettings() {
		return false;
	}
	
	public static function getSettingsDescription() {
		return [];
	}
	
	
	public static function getSiteDisplayName() {
		return 'Backup';
	}
	
	public static function getAdminGroup() {
		return 'Webportal_Backup_Admin';
	}
	
	public static function getAdminMenuIcon() {
		return 'fa fa-download';
	}
	
	public static function getAdminMenuGroupIcon() {
		return 'fa fa-cogs';
	}
	
	public static function getAdminMenuGroup() {
		return 'System';
	}

	public static function siteIsAlwaysActive() {
		return true;
	}
	/**
	 * Überprüft, ob die Seite eine Administration hat.
	 * @return boolean
	 */
	public static function hasAdmin() {
		return true;
	}

    public static function displayAdministration($selfURL) {

			$html = '';

        $directory = '../data/backup';
        $files_json = json_encode(FILE::getFilesInFolder($directory, true, 'zip'));

				// echo '<pre>';
        // print_r($files_json);
				// echo '</pre>';

	
        eval("\$html = \"" . DB::getTPL()->get("administration/backup/list") . "\";");


        return $html;
    }
 
		
}


?>
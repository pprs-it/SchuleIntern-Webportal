<?php

class RestGetKalenderEintrag extends AbstractRest {
	protected $statusCode = 200;

	public function execute($input, $request) {

        $this->setAclGroup($this->aclModuleName());
        $this->acl();
        
		$acl = $this->getAcl();

		if ($acl['rights']['read'] != 1) {
			return [
				'error' => true,
				'msg' => 'Keine Leserechte!'
			];
		}
		if ( $request[1] ) {
			$kalenderIDs = explode('-', $request[1]);
		}

		if ( $request[1] == 'short' || intval($request[1]) == 0  || !$kalenderIDs || count($kalenderIDs) <= 0) {
			return [
				'error' => true,
				'msg' => 'Fehlende Kalender IDs'
			];
		}

		$ret = [];
		$where = '';
		foreach ($kalenderIDs as $value) {
			if (intval($value) > 0) {
				


				$kalender_acl_db = DB::getDB()->query_first("SELECT a.kalenderAcl FROM kalender_allInOne as a 
				WHERE a.kalenderID = ".intval($value) );
				if ($kalender_acl_db['kalenderAcl']) {
					$acl = $this->getAclByID($kalender_acl_db['kalenderAcl'], true);
				} else {
					$acl = $this->getAcl();
				}
				if ($acl['rights']['read'] == 1) {
					
					if ($where != '') { $where .= ' OR '; }
					$where .= 'kalenderID = '. intval($value);

				}

				
			}
		}
		if ($where) {
			$where = ' WHERE ('.$where.') ';
		}

		$result = DB::getDB()->query("SELECT * FROM kalender_allInOne_eintrag ".$where." ORDER BY eintragDatumStart, eintragDatumEnde DESC ");
		while($row = DB::getDB()->fetch_array($result)) {
			
			$createdUser = new user(array('userID' => intval($row['eintragUserID']) ));

			$item = [
				'eintragID' => $row['eintragID'],
				'kalenderID' => $row['kalenderID'],
				'eintragKategorieID' => $row['eintragKategorieID'],
				'eintragTitel' => DB::getDB()->decodeString($row['eintragTitel']),
				'eintragDatumStart' => $row['eintragDatumStart'],
				'eintragTimeStart' => $row['eintragTimeStart'],
				'eintragDatumEnde' => $row['eintragDatumEnde'],
				'eintragTimeEnde' => $row['eintragTimeEnde'],
				'eintragOrt' => DB::getDB()->decodeString($row['eintragOrt']),
				'eintragKommentar' => DB::getDB()->decodeString($row['eintragKommentar']),
				'eintragCreatedTime' => $row['eintragCreatedTime'],
				'eintragModifiedTime' => $row['eintragModifiedTime'],
				'eintragUserID' => $row['eintragUserID'],
				'eintragUserName' => $createdUser->getDisplayName(),
                'eintragRepeat' => $row['eintragRepeat']
			];

			$ret[] = $item;
		}
		
		if(count($ret) > 0) {

			return [
				'list' => $ret
			];

		} else {
			// List ist empty
			return [
				'list' => []
			];
		}

		exit;
	}

	public function getAllowedMethod() {
		return 'GET';
	}

	protected function malformedRequest() {
		$this->statusCode = 400;
	}

	/**
	 * Überprüft, ob ein Modul eine System Authentifizierung benötigt. (z.B. zum Abfragen aller Schülerdaten)
	 * @return boolean
	 */
	public function needsSystemAuth() {
		return false;
	}

	public function needsUserAuth() {
		return true;
	}

	public function aclModuleName() {
		return 'kalenderAllInOne';
	}
    public static function getAdminGroup() {
        return 'Webportal_Kalender_allInOne_Admin';
    }

}	

?>
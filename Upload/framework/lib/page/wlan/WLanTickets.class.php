<?php


class WLanTickets extends AbstractPage {

    private $canAssignSchuelerCode = false;
    private $canAssignGastCode = false;
    
	public function __construct() {		
		parent::__construct(array("W-Lan Tickets"));
		
		$this->checkLogin();
	}

	public function execute() {
		if(DB::getSession()->isTeacher()) {
		    $this->canAssignSchuelerCode = true;
		}
		
		if(DB::getSession()->isMember('Webportal_Wlan_Tickets')) {
		    $this->canAssignGastCode = true;
		    $this->canAssignSchuelerCode = true;
		}
		
		if(DB::getSession()->isTeacher() && DB::getSettings()->getBoolean('wlan-gast-lehrer')) {
		    $this->canAssignGastCode = true;
		}
		
		if(DB::getSession()->isAdmin() || DB::getSession()->isMember(self::getAdminGroup())) {
		    $this->canAssignGastCode = true;
		    $this->canAssignSchuelerCode = true;
		}
		
		if(!DB::getSettings()->getBoolean('wlan-gast')) {
		    $this->canAssignGastCode = false;
		}
		
		if(!DB::getSettings()->getBoolean('wlan-schueler')) {
		    $this->canAssignSchuelerCode = false;
		}
		
		
		if($this->canAssignGastCode && $_REQUEST['action'] == 'getGastTicket') {		    
		    $ticket = WLanTicket::getNextTicket('GAST', $_REQUEST['duration']);
		    
		    if(!$ticket->isAssigned()) {
		        $ticket->assignToUser(DB::getSession()->getUser());
		        $ticket->setName($_REQUEST['name']);
		    }
		    
		    header("Location: index.php?page=WLanTickets");exit();
		}
		
		
		if($this->canAssignSchuelerCode && $_REQUEST['action'] == 'assignSchuelerTicket') {
		    if($_REQUEST['selfAssign'] == 1) {
		        $ticket = WLanTicket::getNextTicket('SCHUELER', $_REQUEST['duration']);
		        
		        if(!$ticket->isAssigned()) {
		            $ticket->assignToUser(DB::getSession()->getUser());
		        }
		    }
		    else {
		        $schueler = [];
		        
		        for($i = 0; $i < sizeof($_REQUEST['schuelerAsvIDs']); $i++) {
		            $sc = schueler::getByAsvID($_REQUEST['schuelerAsvIDs'][$i]);
		            if($sc != null) {
		                if($sc->getUser() != null) $schueler[] = $sc;
		            }
		        }
		        
		        if ($_REQUEST['klassen']) {
                    for($i = 0; $i < sizeof($_REQUEST['klassen']); $i++) {
                        $klasse = klasse::getByName($_REQUEST['klassen'][$i]);

                        if($klasse != null) {
                            $scs = $klasse->getSchueler();

                            for($s = 0; $s < sizeof($scs); $s++) {
                                if($scs[$s]->getUser() != null) $schueler[] = $scs[$s];
                            }
                        }
                    }
                }
		        
		        for($i = 0; $i < sizeof($schueler); $i++) {
		            $ticket = WLanTicket::getNextTicket('SCHUELER', $_REQUEST['duration']);
		            
		            if(!$ticket->isAssigned() && $schueler[$i]->getUser() != null) {
		                $ticket->assignToUser($schueler[$i]->getUser());
		            }

		        }
		        
		        
		        header("Location: index.php?page=WLanTickets&successSchueler=1");
		        exit(0);
		    }

		    
		    header("Location: index.php?page=WLanTickets");
		    exit(0);
		}
		
		
		if($_REQUEST['action'] == 'getSchuelerJSON' && $this->canAssignSchuelerCode) {
		    $schueler = schueler::getAll();
		    		    
		    $responseData = [
		        'results' => []
		    ];
		    
		    
		    if($_REQUEST['term'] != "") {
		        $search = strtolower($_REQUEST['term']);
		    }
		    else {
		        $search = null;
		    }
		    
		    
		    
		    
		    for($i = 0; $i < sizeof($schueler); $i++) {
		        $ok = false;
		        
		        
		        if($search != null && strpos(strtolower($schueler[$i]->getCompleteSchuelerName()), $search) > 0) {
		            $ok = true;
		        }
		        
		        if($search == null) $ok = true;
		        
		        if($ok) {
		            $responseData['results'][] = [
		                'id' => $schueler[$i]->getAsvID(),
		                'text' => $schueler[$i]->getCompleteSchuelerName() . " (" . $schueler[$i]->getKlasse() . ")"
		            ];
		        }
		    }
		    
		    header("Content-type: text/json");
		    echo json_encode($responseData);
		    exit(0);
		}
	   
	    
		// Meine Codes laden
		
		
		$codes = WLanTicket::getMyTickets();
		
		$ticketHTML = "";
		
		for($i = 0; $i < sizeof($codes); $i++) {
		    $ticketHTML .= "<tr><td>" . $codes[$i]->getTicketText() . "</td>";
		    $ticketHTML .= "<td>" . $codes[$i]->getType();
		    
		    
		    if($codes[$i]->getName() != "") {
		        $ticketHTML .= "<br />" . $codes[$i]->getName() . "</td>";
		    }
		    
		    $ticketHTML .= "<td>" . $codes[$i]->getAssignedDateAsNaturalDate() . "</td>";
		    $ticketHTML .= "<td>" . $codes[$i]->getDuration() . " Minuten</td></tR>";
		}
		
		if($ticketHTML == "") $ticketHTML = "<tr><td colspan=\"3\">Es stehen keine W-Lan Tickets für Sie bereit</td></tr>";
		
		
		
		if($this->canAssignSchuelerCode) {
		    $klassen = klasse::getAllKlassen();
		    
		    $selectKlassen = "";
		    
		    for($i = 0; $i < sizeof($klassen); $i++) {
		        $selectKlassen .= "<option value=\"" . $klassen[$i]->getKlassenName() . "\">" . $klassen[$i]->getKlassenName() . "</option>";
		    }
		    
		    $selectDurationSchueler = "";
		    
		    
		    $durations = WLanTicket::getAvailibleDurations('SCHUELER');
		    
		    for($i = 0; $i < sizeof($durations); $i++) {
		        $selectDurationSchueler .= "<option value=\"" . $durations[$i] . "\">" . $durations[$i] . " Minuten</option>";
		    }
		}
		
		if($this->canAssignGastCode) {

		    $selectDurationGast = "";
		    
		    
		    $durations = WLanTicket::getAvailibleDurations('GAST');
		    
		    for($i = 0; $i < sizeof($durations); $i++) {
		        $selectDurationGast .= "<option value=\"" . $durations[$i] . "\">" . $durations[$i] . " Minuten</option>";
		    }
		    
		    
		}
		
		
		
		eval("DB::getTPL()->out(\"" . DB::getTPL()->get("wlan/index") . "\");");
	}
	
	private function deleteEntry() {
	    DB::getDB()->query("DELETE FROM kondolenzbuch WHERE eintragID='" . DB::getDB()->escapeString($_GET['eintragID']) . "'");
	    header("Location: index.php?page=kondolenzbuch");
	    exit(0);
	    
	}
	
	private function addEntry() {
	    DB::getDB()->query("INSERT INTO kondolenzbuch (eintragName, eintragText, eintragTime) VALUES ('" . DB::getDB()->escapeString($_POST['name']) . "','" . DB::getDB()->escapeString($_POST['text']) . "',UNIX_TIMESTAMP())");
	
	    header("Location: index.php?page=kondolenzbuch");
	    exit(0);
	
	}
	
	public static function displayAdministration($selfURL) {
	    $html = "";
	    
	    $usergroup = usergroup::getGroupByName('Webportal_Wlan_Tickets');
	    
	    if($_REQUEST['action'] == 'addUser') {
	        $usergroup->addUser($_POST['userID']);
	        header("Location: $selfURL&userAdded=1");
	        exit(0);
	        
	    }
	    
	    if($_REQUEST['action'] == 'removeUser') {
	        $usergroup->removeUser($_REQUEST['userID']);
	        header("Location: $selfURL&userDeleted=1");
	        exit(0);
	    }
	    
	    if($_REQUEST['action'] == 'deleteAll') {

	        DB::getDB()->query("DELETE FROM wlan_ticket");
	        
	        header("Location: $selfURL&userDeleted=1");
	        exit(0);
	    }
	    /**
	     * 				'result' => false,
				'uploadobject' => null,
				'mimeerror' => false,
				'text' => "Es gab einen Fehler beim Upload: " . $_FILES['file']['error']
			];			
	     */
	    
	    if($_REQUEST['action'] == 'upload') {
	        $upload = FileUpload::uploadCSV("csvfilesophos", "");

	        if($upload['result']) {
	            // Datei einlesen
	            
	            WLanTicket::uploadSophosFile($upload['uploadobject'], $_REQUEST['type']);
	            
	            header("Location: $selfURL");
	            exit(0);
	        }
	        else die("NICHT OK");
	        
	    }
	    
	    $all = WLanTicket::getAll();
	    
	    
	    $ticketHTML = "";
	    
	    for($i = 0; $i < sizeof($all); $i++) {
	        $ticketHTML .= "<tr>";
	        
	        $ticketHTML .= "<td>" . $all[$i]->getType() . "</td>";
	        $ticketHTML .= "<td>" . $all[$i]->getTicketText() . "</td>";
	        $ticketHTML .= "<td>" . $all[$i]->getDuration() . "</td>";
	        
	        
	        if($all[$i]->isAssigned()) {
	            $user = $all[$i]->getAssignedUser();

	            if($user != null) {
                    $ticketHTML .= "<td>" . $user->getDisplayNameWithFunction() . "</td>";
                }
	            else {
                    $ticketHTML .= "<td>n/a</td>";
                }
	            
	        }
	        else {
	            $ticketHTML .= "<td>frei</td>";
	        }
	        
	        // $ticketHTML .= "<td>" . $all[$i]->getType() . "</td>";
	        
	        
	        
	        $ticketHTML .= "</tr>";
	    }
	    
	    // Aktuelle Benutzer suchen, die Zugriff haben
	    
	    $currentUserBlock = administrationmodule::getUserListWithAddFunction($selfURL, "wlan", "addUser", "removeUser", "Benutzer, die immer W-Lan Tickets ausgeben können.","", 'Webportal_Wlan_Tickets');
	    
	    eval("\$html = \"" . DB::getTPL()->get('wlan/admin') . "\";");
	    
	    
		return $html;
	}

	
	public static function hasSettings() {
		return true;
	}
	
	/**
	 * Stellt eine Beschreibung der Einstellungen bereit, die für das Modul nötig sind.
	 * @return array(String, String)
	 * array(
	 * 	   array(
	 * 		'name' => "Name der Einstellung (z.B. formblatt-isActive)",
	 *		'typ' => ZEILE | TEXT | NUMMER | BOOLEAN,
	 *      'titel' => "Titel der Beschreibung",
	 *      'text' => "Text der Beschreibung"
	 *     )
	 *     ,
	 *     .
	 *     .
	 *     .
	 *  )
	 */
	public static function getSettingsDescription() {
		return [
		    [
		        'name' => 'wlan-gast',
		        'typ' => 'BOOLEAN',
		        'titel' => 'Gast W-Lan aktiv',
		        'text' => 'Ist ein Gast W-Lan aktiv?',
		    ],
		    [
		        'name' => 'wlan-gast-ssid',
		        'typ' => 'ZEILE',
		        'titel' => 'SSID des Gast W-Lans',
		        'text' => '',
		    ],
		    [
		        'name' => 'wlan-schueler',
		        'typ' => 'BOOLEAN',
		        'titel' => 'Schüler W-Lan aktiv',
		        'text' => 'Ist ein Schüler W-Lan aktiv?',
		    ],
		    [
		        'name' => 'wlan-schueler-ssid',
		        'typ' => 'ZEILE',
		        'titel' => 'SSID des Schüler W-Lans',
		        'text' => '',
		    ],
		    [
		        'name' => 'wlan-gast-lehrer',
		        'typ' => 'BOOLEAN',
		        'titel' => 'Können Lehrer Gast Tickets ausgeben?',
		        'text' => '',
		    ]
		];
	}
	
	
	public static function getSiteDisplayName() {
		return 'W-Lan Tickets';
	}
	
	/**
	 * Liest alle Nutzergruppen aus, die diese Seite verwendet. (Für die Benutzeradministration)
	 * @return array(array('groupName' => '', 'beschreibung' => ''))
	 */
	public static function getUserGroups() {
		return [];	
	}
	
	public static function siteIsAlwaysActive() {
		return false;
	}
	
	public static function hasAdmin() {
		return true;
	}
	
	public static function getAdminMenuGroup() {
		return 'W-Lan Tickets';
	}
	
	public static function getAdminMenuIcon() {
		return 'fa fa-wifi';
	}
	
	public static function getAdminMenuGroupIcon() {
		return 'fa fa-wifi';
	}
	
	public static function getAdminGroup() {
		return 'Webportal_Wlan_Admin';
	}
	
	public static function onlyForSchool() {
		return [];
	}
	
}


?>
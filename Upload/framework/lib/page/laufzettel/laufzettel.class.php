<?php




class laufzettel extends AbstractPage {

	private $isAdmin = false;

	private $mailHausmeister = "";

	private $mailMittagsbetreuung = "";
	private $mailEssen = "";

	private $debugMail = "";
	
	private $elektroSchulleitung = false;
	
	private $isSchulleitung = false;
	
	public function __construct() {
		parent::__construct(array("Laufzettel"));

		$this->checkLogin();

		if(!DB::getSession()->isTeacher()) {
			new errorPage("Der Laufzettel ist nur für Lehrer erstellbar!");
		}

	}

	public function execute() {

		$this->mailHausmeister = DB::getSettings()->getValue("laufzettel-emailhausmeister");
		$this->mailMittagsbetreuung = DB::getSettings()->getValue("laufzettel-emailmittagsbetreuung");
		$this->mailEssen = DB::getSettings()->getValue("aufzettel-mittagessen");
		
		$this->elektroSchulleitung = DB::getSettings()->getBoolean("laufzettel-elektronische-genehmigung-schulleitung");
		
		$this->isSchulleitung = DB::getSession()->getUser()->isMember('Webportal_Laufzettel_Schulleitung');
				
	    $this->isAdmin = DB::getSession()->isMember('Webportal_Laufzettel_Admin');
	    
	    if(DB::getSession()->isAdmin()) $this->isAdmin = true;
		
		if($this->isAdmin) $this->isSchulleitung = true;

		$mode = $_REQUEST['mode'];

		switch($mode) {
			default:
				$this->showIndex();
			break;

			case "addLaufzettel":
				$this->showAddForm();
			break;

			case "create":
				$this->addLaufzettel();
			break;

			case "zustimmung":
				$this->handleZustimmung();
			break;

			case "myLaufzettel":
				$this->showLaufzettelForMe();
			break;

			case "myOwnLaufzettel":
				$this->showMyLaufzettel();
			break;
			
			case "schulleitung":
			    if($this->isSchulleitung) $this->showSchulleitung();
			break;
			
			case 'schulleitungGenehmigung':
			    if($this->isSchulleitung) $this->handleZustimmungSL();
			break;

			case "deleteLaufzettel":
				$this->deleteLaufzettel();
			break;

			case "printLaufzettel":
				$this->printLaufzettel();
			break;

			case "informMittagsbetreuung":
				$this->informMittagsbetreuung();
			break;

			case "informMittagessen":
				$this->informMittagessen();
			break;

			case "informHausmeister":
				$this->informHausmeister();
			break;
		}

	}

	private function informMittagsbetreuung() {
		$laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");
		if($laufzettel['laufzettelErsteller'] == DB::getSession()->getUserID()) {
			if($laufzettel['laufzettelMittagsbetreuung'] == 0 && $laufzettel['laufzettelArt'] == "UG") {

				if($_GET['doSend'] > 0) {
					$this->sendMail(
							$this->mailMittagsbetreuung,
							DB::getSession()->getUser()->getEMail(),
							$_POST['betreff'],
							$_POST['message'],
							DB::getSession()->getUser()->getEMail()
							);

					DB::getDB()->query("UPDATE laufzettel SET laufzettelMittagsbetreuung=UNIX_TIMESTAMP() WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

					new info("Die Benachrichtigung an die Mittagsbetreuung wurde verschickt!","index.php?page=laufzettel&mode=myOwnLaufzettel");

					exit(0);

				}

				$klassen = "";
				$klassenData = DB::getDB()->query("SELECT DISTINCT laufzettelKlasse FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

				$klassenArray = array();
				while($d = DB::getDB()->fetch_array($klassenData)) $klassenArray[] = $d['laufzettelKlasse'];
				
				$klassen = implode(", ", $klassenArray);

				$lehrer = functions::getDisplayNameFromUserID($laufzettel['laufzettelErsteller']);

				$datum = functions::getFormatedDateFromSQLDate($laufzettel['laufzettelDatum']);
				
				$mailtext = DB::getSettings()->getValue("laufzettel-emailmittagsbetreuung-text");
				$mailtext = str_replace("{KLASSEN}", $klassen, $mailtext);
				$mailtext = str_replace("{NAME}", $lehrer, $mailtext);
				$mailtext = str_replace("{DATUM}", $datum, $mailtext);
				
				$betreff = DB::getSettings()->getValue("laufzettel-emailmittagsbetreuung-betreff");
				

				// eval("\$mailtext = \"" . DB::getTPL()->get("laufzettel/mail/info_mittagsbetreuung") . "\";");

				eval("echo(\"" . DB::getTPL()->get("laufzettel/inform/send_mail_mittagsbetreuung") . "\");");


			}
			else {
				new error("Die Mittagsbetreuung wurde bereits benachtichtigt oder falscher Laufzetteltyp!");
			}

		}
		else {
			new error("Zugriffsverletzung!");
			die();
		}
	}


	private function informMittagessen() {
		$laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");
		if($laufzettel['laufzettelErsteller'] == DB::getSession()->getUserID()) {
			if($laufzettel['laufzettelMittagessen'] == 0 && $laufzettel['laufzettelArt'] == "UG") {

				if($_GET['doSend'] > 0) {
					$this->sendMail(
							$this->mailEssen,
							DB::getSession()->getUser()->getEMail(),
							$_POST['betreff'],
							$_POST['message'],
							DB::getSession()->getUser()->getEMail()
					);

					DB::getDB()->query("UPDATE laufzettel SET laufzettelMittagessen=UNIX_TIMESTAMP() WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

					new info("Die Benachrichtigung an den Caterer wurde verschickt!","index.php?page=laufzettel&mode=myOwnLaufzettel");

					exit(0);

				}

				$klassen = "";
				$klassenData = DB::getDB()->query("SELECT DISTINCT laufzettelKlasse FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

				$klassenArray = array();
				while($d = DB::getDB()->fetch_array($klassenData)) $klassenArray[] = $d['laufzettelKlasse'];
				$klassen = implode(", ", $klassenArray);

				$lehrer = functions::getDisplayNameFromUserID($laufzettel['laufzettelErsteller']);

				$datum = functions::getFormatedDateFromSQLDate($laufzettel['laufzettelDatum']);

				$mailtext = DB::getSettings()->getValue("laufzettel-mittagessen-text");
				$mailtext = str_replace("{KLASSEN}", $klassen, $mailtext);
				$mailtext = str_replace("{NAME}", $lehrer, $mailtext);
				$mailtext = str_replace("{DATUM}", $datum, $mailtext);
				
				$betreff = DB::getSettings()->getValue("laufzettel-mittagessen-betreff");
				
				
				eval("echo(\"" . DB::getTPL()->get("laufzettel/inform/send_mail_mittagessen") . "\");");


			}
			else {
				new error("Die Mittagsbetreuung wurde bereits benachtichtigt oder falscher Laufzetteltyp!");
			}

		}
		else {
			new error("Zugriffsverletzung!");
			die();
		}
	}

	private function informHausmeister() {
		$laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");
		if($laufzettel['laufzettelErsteller'] == DB::getSession()->getUserID()) {
			if($laufzettel['laufzettelHausmeister'] == 0 && $laufzettel['laufzettelArt'] == "UG") {

				if($_GET['doSend'] > 0) {
					$this->sendMail(
							$this->mailHausmeister,
							DB::getSession()->getUser()->getEMail(),
							$_POST['betreff'],
							$_POST['message'],
							DB::getSession()->getUser()->getEMail()
					);

					DB::getDB()->query("UPDATE laufzettel SET laufzettelHausmeister=UNIX_TIMESTAMP() WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

					new info("Die Benachrichtigung an die Hausmeister wurde verschickt!","index.php?page=laufzettel&mode=myOwnLaufzettel");

					exit(0);

				}

				$klassen = "";
				$klassenData = DB::getDB()->query("SELECT DISTINCT laufzettelKlasse FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

				$klassenArray = array();
				while($d = DB::getDB()->fetch_array($klassenData)) $klassenArray[] = $d['laufzettelKlasse'];
				$klassen = implode(", ", $klassenArray);

				$lehrer = functions::getDisplayNameFromUserID($laufzettel['laufzettelErsteller']);

				$datum = functions::getFormatedDateFromSQLDate($laufzettel['laufzettelDatum']);

				$mailtext = DB::getSettings()->getValue("laufzettel-mittagessen-text");
				$mailtext = str_replace("{KLASSEN}", $klassen, $mailtext);
				$mailtext = str_replace("{NAME}", $lehrer, $mailtext);
				$mailtext = str_replace("{DATUM}", $datum, $mailtext);
				
				$betreff = DB::getSettings()->getValue("laufzettel-mittagessen-betreff");
				
				eval("echo(\"" . DB::getTPL()->get("laufzettel/inform/send_mail_hausmeister") . "\");");


			}
			else {
				new error("Die Mittagsbetreuung wurde bereits benachtichtigt oder falscher Laufzetteltyp!");
			}

		}
		else {
			new error("Zugriffsverletzung!");
			die();
		}
	}

	private function printLaufzettel() {
		$laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");
		if($laufzettel['laufzettelErsteller'] == DB::getSession()->getUserID()) {
			$stunden = array();
			for($i = 0; $i < 12; $i++) {
				$stunden[] = array();
			}

			$data = DB::getDB()->query("SELECT * FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

			while($s = DB::getDB()->fetch_array($data)) {
				$stunden[$s['laufzettelStunde']][] = $s;
			}

			$stundenHTML = "";
			for($i = 1; $i < 12; $i++) {
				$stundenHTML .= "<tr><td>" . (($i<11) ? ($i.".") : ("KL")) . "</td><td>";
				for($f = 0; $f < sizeof($stunden[$i]); $f++) {
					$stundenHTML .= $stunden[$i][$f]['laufzettelKlasse'] . " - " . $stunden[$i][$f]['laufzettelFach'] . " - " . $stunden[$i][$f]['laufzettelLehrer'] . ": ";
					if($stunden[$i][$f]['laufzettelZustimmung'] == 1) {
						$stundenHTML .= "Einverstanden";
					}
					elseif($stunden[$i][$f]['laufzettelZustimmung'] == 2) {
						$stundenHTML .= "!! Nicht einverstanden";
					}
					else $stundenHTML .= "Keine Antwort";
					$stundenHTML .= "<br />";
				}
				$stundenHTML .= "</td></tr>";
			}

			$klassen = array();
			$klData = DB::getDB()->query("SELECT DISTINCT laufzettelKlasse FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "' ORDER BY laufzettelKlasse");

			while($k = DB::getDB()->fetch_array($klData)) $klassen[] = $k['laufzettelKlasse'];
			$klassen = implode(", ",$klassen);

			$datum = functions::getFormatedDateWithDayFromSQLDate($laufzettel['laufzettelDatum']);

			$leiter = functions::getDisplayNameFromUserID($laufzettel['laufzettelErsteller']);

			$statusMittagsbetreuung = (($laufzettel['laufzettelMittagsbetreuung'] > 0) ? ("Infomiert am " . functions::makeDateFromTimestamp($laufzettel['laufzettelMittagsbetreuung'])) : ("Nicht informiert"));
			$statusHausmeister = (($laufzettel['laufzettelHausmeister'] > 0) ? ("Infomiert am " . functions::makeDateFromTimestamp($laufzettel['laufzettelHausmeister'])) : ("Nicht informiert"));

			if($laufzettel['laufzettelArt'] == "SA") eval("\$print = \"" . DB::getTPL()->get("laufzettel/print/schulaufgabe") . "\";");
			else eval("\$print = \"" . DB::getTPL()->get("laufzettel/print/antrag_schulleitung") . "\";");

			$pdf = new PrintNormalPageA4WithHeader("Laufzettel");
			$pdf->setHTMLContent($print);
			$pdf->setPrintedDateInFooter();
			$pdf->send();

			exit(0);
		}
		else {
			new error("Access Violation!");
			exit(0);
		}
	}

	private function deleteLaufzettel() {
		$laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

		if($laufzettel['laufzettelErsteller'] == DB::getSession()->getUserID()) {
			DB::getDB()->query("DELETE FROM laufzettel WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");
			DB::getDB()->query("DELETE FROM laufzettel_stunden WHERE laufzettelID='" . intval($_GET['laufzettelID']) . "'");

			header("Location: index.php?page=laufzettel&mode=myOwnLaufzettel");
			exit(0);

		}
		else {
			new error("Access violation - " . md5("Du darfst hier nicht rein!"));
			exit(0);
		}
	}
	
	private function handleZustimmungSL() {
	    $laufzettel = DB::getDB()->query_first("SELECT * FROM laufzettel WHERE laufzettelID='" . intval($_REQUEST['laufzettelID']) . "'");
	    	    
	    $zustimmung = intval($_REQUEST['zustimmung']);
	    
	    if($zustimmung == 1) $isZustimmung = true;
	    else $isZustimmung = false;
	    
	    DB::getDB()->query("UPDATE laufzettel SET laufzettelZustimmungSchulleitung='" . $zustimmung . "' WHERE laufzettelID='" . $laufzettel['laufzettelID'] . "'");	    
	    
	    $userID = $laufzettel['laufzettelErsteller'];
	    
	    $user = user::getUserByID($userID);
	    
	    if($user != null) {
	        $lehrer = $user->getTeacherObject();
	        
	        $subject = "Ihr Laufzettel \"" . $laufzettel['laufzettelTitel'] . "\" am " . DateFunctions::getNaturalDateFromMySQLDate($laufzettel['laufzettelDatum']);
	        
	        
	        if($lehrer != null) {
	            
	            if($lehrer->getGeschlecht() == 'w') {
	                $text = "Sehr geehrte Frau " . $lehrer->getName() . ",<br><br>";
	            }
	            else {
	                $text = "Sehr geehrter Herr " . $lehrer->getName() . ",<br><br>";
	            }
	            
	        }
	        else {
	            $text = "Sehr geehrte/r Frau/Herr " . $$user->getDisplayName() . ",<br><br>";
	            
	            
	        }
	        
	        
	        $text .= "Ihr Laufzettel wurde " . (($isZustimmung) ? ("genehmigt") : "<b>nicht</b> genehmigt") . ".<br><br>";
	        
	        $text .= "Begründung: ";
	        
	        $text .= "<br><br>Mit freundlichen Grüßen,<br>";
	        
	        $text .= DB::getSession()->getUser()->getDisplayName();
	        
	        $url = "index.php?page=MessageCompose&recipientDataList=U:" . $userID . "&messageSubject=" . urlencode($subject) . "&messageText=" . urlencode($text);
	        
	        header("Location: $url");
	        exit(0);
	    }
	    else {
	        die("USERID not found.");
	    }
	}

	private function handleZustimmung() {
		$stunde = intval($_GET['stundeID']);

		$stunde = DB::getDB()->query_first("SELECT * FROM laufzettel_stunden WHERE laufzettelStundeID='" . $stunde . "' AND laufzettelLehrer LIKE '" . DB::getSession()->getTeacherObject()->getKuerzel() . "'");

		if($stunde['laufzettelStundeID'] > 0) {
			if($stunde['laufzettelZustimmung'] == 0 || $stunde['laufzettelZustimmung'] == 2) {
				DB::getDB()->query("UPDATE laufzettel_stunden
						SET
							laufzettelZustimmung='" . (($_POST['zustimmung'] == 2) ? 2 : 1) . "',
							laufzettelZustimmungZeit=UNIX_TIMESTAMP(),
							laufzettelZustimmungKommentar='" . addslashes($_POST['kommentar']) . "' WHERE laufzettelStundeID='" . $stunde['laufzettelStundeID'] . "'

				");

				header("Location: index.php?page=laufzettel&mode=myLaufzettel");
			}
			else {
				new error("Keine einmal erteilte Zustimmung kann nicht zurückgezogen werden!");
			}
		}
		else {
			new error("Zugriffsverletzung!");
			exit(0);
		}
	}

	private function addLaufzettel() {
		$errors = array();

		if(!isset($_POST['laufzettelTitel']) || $_POST['laufzettelTitel'] == "") {
			$errors[] = "Es wurde kein Titel angegeben!";
		}

		if(!isset($_POST['laufzettelDatum']) || $_POST['laufzettelDatum'] == "") {
			$errors[] = "Es wurde kein Laufzetteldatum angegeben!";
		} else {
			if(!DateFunctions::isNaturalDateTodayOrLater($_POST['laufzettelDatum'])) {
				$errors[] = "Es wurde ein ungültiges Datum für den Laufzettel angegeben! (Darf nicht in der Vergangenheit liegen!)";
			}
		}

		if($_POST['klassen'] && count($_POST['klassen']) == 0) {
			$errors[] = "Es wurden keine Klassen ausgewählt!";
		}

		if($_POST['stunden'] && count($_POST['stunden']) == 0) {
			$errors[] = "Es wurden kein Stunden ausgewählt!";
		}

		if( count($errors) < 1 ) {

			if($_POST['action'] == "correct") {
				$this->showAddForm();
				exit(0);
			}

			$optionsGrades = "";

			$grades = grade::getAllGrades();

			for($i = 0; $i < sizeof($grades); $i++) {
				if($grades[$i] != "")
					$optionsGrades .= "<option value=\"" . $grades[$i] . "\"" . ((in_array($grades[$i],(array)$_POST['klassen'])) ? (" selected=\"selected\"") : ("")) . ">" . $grades[$i] . "</option>\n";
			}

			// $myData = "<tr><td colspan=\"6\" style=\"text-align:center\"><strong>Keine</strong></td></tr>";



			for($i = 1; $i <= DB::getSettings()->getValue("stundenplan-anzahlstunden"); $i++) {
				if(in_array($i,$_POST['stunden'])) $selected['s' . $i] = " selected=\"selected\"";
			}

			$tag = DateFunctions::getWeekDayFromNaturalDate($_POST['laufzettelDatum']);

			$tag = $tag - 1;

			$teachers = "";

			if($_POST['action'] == "save") {
				// Laufzettel anlegen
				DB::getDB()->query("INSERT INTO laufzettel
						(laufzettelArt, laufzettelErsteller, laufzettelDatum, laufzettelTitel, laufzettelNachricht)
						values
						(
							'" . addslashes($_POST['laufzettelArt']) . "',
							'" . DB::getUserID() . "',
							'" . DateFunctions::getMySQLDateFromNaturalDate($_POST['laufzettelDatum']) . "',
							'" . addslashes($_POST['laufzettelTitel']) . "',
							'" . addslashes($_POST['laufzettelNachricht']) . "'
						)");
				$newID = DB::getDB()->insert_id();
			}

			$stundenplan = stundenplandata::getStundenplanAtDate(DateFunctions::getMySQLDateFromNaturalDate($_POST['laufzettelDatum']));

			$stunden = DB::getDB()->escapeString(implode(",", $_POST['stunden']));

			$ersteller = DB::getSession()->getTeacherObject()->getKuerzel();

			$alleKlassen = implode(", ", (array)$_POST['klassen']);

			$datum = $_POST['laufzettelDatum'];
			
			$messageRecipients = [];

            $klassen = (array)$_POST['klassen'];

			for($i = 0; $i < sizeof($klassen); $i++) {
				$klassendata = $stundenplan->getPlan(array("grade",$klassen[$i]));

				for($stunde = 0; $stunde < sizeof($klassendata[$tag]); $stunde++) {
					$realStunde = $stunde+1;

					if(in_array($realStunde, $_POST['stunden'])) {
						for($u = 0; $u < sizeof($klassendata[$tag][$stunde]); $u++) {
						    if($klassendata[$tag][$stunde][$u]['teacher'] != "") {

    							if($_POST['action'] == "save") {
    								DB::getDB()->query("INSERT INTO laufzettel_stunden
    									(laufzettelID,laufzettelKlasse,laufzettelLehrer,laufzettelFach,laufzettelStunde)
    										values(
    											'" . $newID . "',
    											'" . $klassendata[$tag][$stunde][$u]['grade'] . "',
    											'" . $klassendata[$tag][$stunde][$u]['teacher'] . "',
    											'" . $klassendata[$tag][$stunde][$u]['subject'] . "',
    											'" . $realStunde . "'
    										)");

    								$klasse = $klassendata[$tag][$stunde][$u]['grade'];
    								$fach = $klassendata[$tag][$stunde][$u]['subject'];
    								$titel = $_POST['laufzettelTitel'];
    								$nachricht = $_POST['laufzettelNachricht'];

    								$lehrer = lehrer::getByKuerzel($klassendata[$tag][$stunde][$u]['teacher']);
    								
    								if($lehrer != null) {
    								    $messageRecipients[] = $lehrer;
    								    
    								}
    							}
    							

    							$teachers .= "<tr><td>" . $realStunde . "</td>";
    							$teachers .= "<td>" . $klassendata[$tag][$stunde][$u]['grade'] . "</td>";
    							$teachers .= "<td>" . $klassendata[$tag][$stunde][$u]['teacher'] . "</td>";
    							$teachers .= "<td>" . $klassendata[$tag][$stunde][$u]['subject'] . "</td></tr>";
    						}
						}
					}
				}
			}

			if($_POST['action'] == "save") {
			   
			    
			    if(sizeof($messageRecipients) > 0) {
			        $messageSender = new MessageSender();
			        $messageSender->setSender(DB::getSession()->getUser());
			        
			        $recipientHandler = new RecipientHandler("");
			        
			        for($i = 0; $i < sizeof($messageRecipients); $i++) {
			            $recipientHandler->addRecipient(new TeacherRecipient($messageRecipients[$i]));
			        }
			        
			        // Debugger::debugObject($recipientHandler,1);
			        
			        $messageSender->setRecipients($recipientHandler);
			        
			        $messageSender->setSubject('Neuer Laufzettel');
			        $messageSender->setText("Sehr geehrte Kollegin,<br>Sehr geehrter Kollege,<br>Im Portal wartet ein Laufzettel auf Ihre Zustimmung. Ich bitte Sie den Laufzettel zu prüfen und zu bestätigen.<br><br>Vielen Dank!<br><br>Mit freundlichen Grüßen,<br>" . DB::getSession()->getTeacherObject()->getDisplayNameMitAmtsbezeichnung() . "<br><br><br><br><i>Dies ist eine automatisch erzeugte Nachricht.</i>");
			        $messageSender->send();
			    
			    }
			    
			    
				header("Location: index.php?page=laufzettel&mode=myOwnLaufzettel");
				exit(0);
			}

			$listKlassen = implode(", ",(array)$_POST['klassen']);
			
			
			eval("echo(\"" . DB::getTPL()->get("laufzettel/add/check/index") . "\");");
		}
		else {
		    
			$this->showAddForm($errors);
			exit(0);
		}
	}

	private function showIndex() {
		eval("echo(\"" . DB::getTPL()->get("laufzettel/index/index") . "\");");
	}

	private function showLaufzettelForMe() {
		// Eigene Daten finden
		$myData = $this->listLaufzettelForMe();

		eval("echo(\"" . DB::getTPL()->get("laufzettel/myLaufzettel/index") . "\");");
	}

	private function showMyLaufzettel() {

		$myOwnData = $this->listMyLaufzettel();

		eval("echo(\"" . DB::getTPL()->get("laufzettel/myOwnLaufzettel/index") . "\");");
	}
	
	private function showSchulleitung() {
	    
	    $myOwnData = $this->listSchulleitungLaufzettel();
	    
	    eval("echo(\"" . DB::getTPL()->get("laufzettel/schulleitung/index") . "\");");
	}
	

	private function showAddForm($errors = array()) {

		$optionsGrades = "";

		$grades = grade::getAllGrades();

		for($i = 0; $i < sizeof($grades); $i++) {
			if($grades[$i] != "")
			$optionsGrades .= "<option value=\"" . $grades[$i] . "\"" . ((is_array($_POST['klassen']) && in_array($grades[$i],$_POST['klassen'])) ? (" selected=\"selected\"") : ("")) . ">" . $grades[$i] . "</option>\n";
		}


		if(sizeof($errors) > 0) {
			$errorList = implode("</li><li>",$errors);
			eval("\$showError = \"" . DB::getTPL()->get("laufzettel/index/error") . "\";");
		}
		else $showError = "";
		
		if($_POST['laufzettelArt'] == "SA") $selected['sa'] = " selected=\"selected\"";
		if($_POST['laufzettelArt'] == "UG") $selected['ug'] = " selected=\"selected\"";

		for($i = 1; $i <= 11; $i++) {
			if((is_array($_POST['stunden']) && in_array($i,$_POST['stunden'])) || (!is_array($_POST['stunden']))) $selected['s' . $i] = " selected=\"selected\"";
		}



		eval("echo(\"" . DB::getTPL()->get("laufzettel/add/index") . "\");");
	}

	private function listLaufzettelForMe() {
		$html = "";

		$myZettel = DB::getDB()->query("SELECT * FROM laufzettel WHERE laufzettelDatum >= CURDATE() AND laufzettelID IN (SELECT laufzettelID FROM `laufzettel_stunden` WHERE `laufzettelLehrer` LIKE '" . DB::getSession()->getTeacherObject()->getKuerzel() . "')");

		while($zettel = DB::getDB()->fetch_array($myZettel)) {
			$art = "";

			if($zettel['laufzettelArt'] == "SA") {
				$art = "Schulaufgabe";
			}
			else $art = "Unterrichtsgang";

			$lehrer = functions::getDisplayNameFromUserID($zettel['laufzettelErsteller']);

			$datum = functions::getFormatedDateWithDayFromSQLDate($zettel['laufzettelDatum']);

			$myStunden = DB::getDB()->query("SELECT * FROM laufzettel_stunden WHERE laufzettelID='" . $zettel['laufzettelID'] . "' AND laufzettelLehrer='" . DB::getSession()->getTeacherObject()->getKuerzel() . "' ORDER BY laufzettelStunde ASC, laufzettelKlasse");

			$stundenHTML = "";
			while($stunde = DB::getDB()->fetch_array($myStunden)) {

				if(intval($stunde['laufzettelZustimmung']) == 0) {
					eval("\$stundenHTML .= \"" . DB::getTPL()->get("laufzettel/myLaufzettel/index_laufzettel_stunde_offen") . "\";");
				}
				elseif(intval($stunde['laufzettelZustimmung']) == 1) {
					// Zustimmung
					$zustmmungDatum = functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);
					eval("\$stundenHTML .= \"" . DB::getTPL()->get("laufzettel/myLaufzettel/index_laufzettel_stunde_zustimmung") . "\";");
				}
				elseif(intval($stunde['laufzettelZustimmung']) == 2) {
					// Keine Zustimmung
					$zustmmungDatum = functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);
					eval("\$stundenHTML .= \"" . DB::getTPL()->get("laufzettel/myLaufzettel/index_laufzettel_stunde_keine_zustimmung") . "\";");
				}

			}

			eval("\$html .= \"" . DB::getTPL()->get("laufzettel/myLaufzettel/index_laufzettel") . "\";");
		}

		if($html == "") return "Keine Laufzettel ausstehend.";

		return $html;
	}
	
	private function listSchulleitungLaufzettel() {
	    $html = "";
	    
	    $laufzettel = DB::getDB()->query("SELECT * FROM laufzettel ORDER BY laufzettelDatum DESC");
	    
	    while($zettel = DB::getDB()->fetch_array($laufzettel)) {
	        
	        $art = "";
	        
	        if($zettel['laufzettelArt'] == "SA") {
	            $art = "Schulaufgabe";
	        }
	        else $art = "Unterrichtsgang";
	        
	        $lehrer = functions::getDisplayNameFromUserID($zettel['laufzettelErsteller']);
	        
	        $datum = functions::getFormatedDateWithDayFromSQLDate($zettel['laufzettelDatum']);
	        
	        $Stunden = DB::getDB()->query("SELECT * FROM laufzettel_stunden WHERE laufzettelID='" . $zettel['laufzettelID'] . "' ORDER BY laufzettelStunde ASC, laufzettelFach ASC");
	        
	        $stundenHTML = "";
	        
	        $gesamt = 0;
	        $zustimmung = 0;
	        while($stunde = DB::getDB()->fetch_array($Stunden)) {
	            $text = "";
	            $gesamt++;
	            
	            if($stunde['laufzettelZustimmung'] == 1) {
	                $zustimmung++;
	            }
	            if($stunde['laufzettelZustimmung'] == 0) $text = "<p class=\"text-orange\"><i class=\"fa fa-question\"></i> Offen</p>";
	            if($stunde['laufzettelZustimmung'] == 1)
	                $text = "<p class=\"text-green\"><i class=\"fa fa-check\"></i> Zugestimmt</p><small> am " . functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);
	                
	                if($stunde['laufzettelZustimmung'] == 2)
	                    $text = "<p class=\"text-red\"><i class=\"fa fa-ban\"></i> Nicht Zugestimmt</p><small> am " . functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);
	                    
	                    
	                    if($stunde['laufzettelZustimmungKommentar'] != "") $text .= "<br /><code>" . $stunde['laufzettelZustimmungKommentar'] . "</code>";
	                    
	                    eval("\$stundenHTML .= \"" . DB::getTPL()->get("laufzettel/schulleitung/index_mylaufzettel_stunde") . "\";");
	                    
	        }
	        
	        $perCentDone = round($zustimmung / $gesamt *100);

	        
	        eval("\$html .= \"" . DB::getTPL()->get("laufzettel/schulleitung/index_my_laufzettel") . "\";");
	    }
	    
	    return $html;
	}

	private function listMyLaufzettel() {
		$html = "";

		$laufzettel = DB::getDB()->query("SELECT * FROM laufzettel WHERE laufzettelErsteller='" . DB::getUserID() . "' AND laufzettelDatum >= CURDATE() ORDER BY laufzettelDatum ASC");

		while($zettel = DB::getDB()->fetch_array($laufzettel)) {

			$art = "";

			if($zettel['laufzettelArt'] == "SA") {
				$art = "Schulaufgabe";
			}
			else $art = "Unterrichtsgang";

			$lehrer = functions::getDisplayNameFromUserID($zettel['laufzettelErsteller']);

			$datum = functions::getFormatedDateWithDayFromSQLDate($zettel['laufzettelDatum']);

			$Stunden = DB::getDB()->query("SELECT * FROM laufzettel_stunden WHERE laufzettelID='" . $zettel['laufzettelID'] . "' ORDER BY laufzettelStunde ASC, laufzettelFach ASC");

			$stundenHTML = "";

			$gesamt = 0;
			$zustimmung = 0;
			while($stunde = DB::getDB()->fetch_array($Stunden)) {
				$text = "";
				$gesamt++;

				if($stunde['laufzettelZustimmung'] == 1) {
					$zustimmung++;
				}
				if($stunde['laufzettelZustimmung'] == 0) $text = "<p class=\"text-orange\"><i class=\"fa fa-question\"></i> Offen</p>";
				if($stunde['laufzettelZustimmung'] == 1)
					$text = "<p class=\"text-green\"><i class=\"fa fa-check\"></i> Zugestimmt</p><small> am " . functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);
				
				if($stunde['laufzettelZustimmung'] == 2)
					$text = "<p class=\"text-red\"><i class=\"fa fa-ban\"></i> Nicht Zugestimmt</p><small> am " . functions::makeDateFromTimestamp($stunde['laufzettelZustimmungZeit']);


					if($stunde['laufzettelZustimmungKommentar'] != "") $text .= "<br /><code>" . $stunde['laufzettelZustimmungKommentar'] . "</code>";
					
				eval("\$stundenHTML .= \"" . DB::getTPL()->get("laufzettel/myOwnLaufzettel/index_mylaufzettel_stunde") . "\";");

			}

            if ( $gesamt > 0) {
                $perCentDone = round($zustimmung / $gesamt *100);
            }

			
			$optionenUnterrichtsgang = "";

			if($zettel['laufzettelArt'] == "UG") {
				// Zusätzliche Optionen
				if($zettel['laufzettelMittagsbetreuung'] > 0 && $this->mailMittagsbetreuung != "") {
					$optionenUnterrichtsgang .= "<i class=\"fa fa-check\"></i> Mittagsbetreuung benachrichtigt am " . functions::makeDateFromTimestamp($zettel['laufzettelMittagsbetreuung']) . "<br />";
				}
				else if($this->mailMittagsbetreuung != "") {
					$optionenUnterrichtsgang .= "<a href=\"index.php?page=laufzettel&laufzettelID=" . $zettel['laufzettelID'] . "&mode=informMittagsbetreuung\"><i class=\"fa fa-exclamation-triangle\"></i> Mittagsbetreuung benachrichtigen</a><br />";
				}

				if($zettel['laufzettelHausmeister'] > 0 && $this->mailHausmeister != "") {
					$optionenUnterrichtsgang .= "<i class=\"fa fa-check\"></i> Hausmeister benachrichtigt am " . functions::makeDateFromTimestamp($zettel['laufzettelMittagsbetreuung']) . "<br />";
				}
				else if($this->mailHausmeister != "") {
					$optionenUnterrichtsgang .= "<a href=\"index.php?page=laufzettel&laufzettelID=" . $zettel['laufzettelID'] . "&mode=informHausmeister\"><i class=\"fa fa-exclamation-triangle\"></i> Hausmeister benachrichtigen</a><br />";
				}

				if($zettel['laufzettelMittagessen'] > 0 && $this->mailEssen != "") {
					$optionenUnterrichtsgang .= "<i class=\"fa fa-check\"></i> Mittagessen benachrichtigt am " . functions::makeDateFromTimestamp($zettel['laufzettelMittagessen']) . "<br />";
				}
				else if($this->mailEssen != "") {
					$optionenUnterrichtsgang .= "<a href=\"index.php?page=laufzettel&laufzettelID=" . $zettel['laufzettelID'] . "&mode=informMittagessen\"><i class=\"fa fa-exclamation-triangle\"></i> Mittagessen (Caterer) benachrichtigen</a><br />";
				}

				$optionenUnterrichtsgang .= "<a href=\"index.php?page=laufzettel&mode=printLaufzettel&laufzettelID={$zettel['laufzettelID']}\"><i class=\"fa fa-print\"></i> Antrag für Schulleitung ausdrucken</a><br />";

			}
			else {
				$optionenUnterrichtsgang .= "<a href=\"index.php?page=laufzettel&mode=printLaufzettel&laufzettelID={$zettel['laufzettelID']}\"><i class=\"fa fa-print\"></i> Übersicht ausdrucken</a><br />";
			}


			eval("\$html .= \"" . DB::getTPL()->get("laufzettel/myOwnLaufzettel/index_my_laufzettel") . "\";");
		}

		return $html;
	}

	private function sendMail($to,$replyto,$subject,$text,$cc="") {
		if($this->debugMail != "") {
			$text = "Diese Mail solle an $to gehen. Wird aber an {$this->debugMail} gesendet zu Debugging Zwecken\r\n\r\n\r\n" . $text;
			$to = $this->debugMail;
		}

		$mail = new email($to, $subject, $text);
		if($replyto != "") $mail->setReplyTo($replyto);
		if($cc != "") {
			$mail->setCC($cc);
		}
		$mail->sendInstantMail();
	}

	public static function getNotifyItems() {
		return array();
	}

	public static function hasSettings() {
		return true;


	}
	
	public static function displayAdministration($selfURL) {
	    
	    $usergroup = usergroup::getGroupByName('Webportal_Laufzettel_Schulleitung');
	    
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
	    	    
	    // Aktuelle Benutzer suchen, die Zugriff haben
	    
	    $currentUserBlock = administrationmodule::getUserListWithAddFunction($selfURL, "sek", "addUser", "removeUser", "Schulleitung / Genehmiger", "Diese Benutzer können Laufzettel genehmigen. Die Schulleitung hat immer Zugriff.", 'Webportal_Laufzettel_Schulleitung');
	    
	    
	    $html = "";
	    
	    $isElektroSchulleitung = DB::getSettings()->getBoolean('laufzettel-elektronische-genehmigung-schulleitung');
	    
	    eval("\$html = \"" . DB::getTPL()->get("laufzettel/admin/index") . "\";");
	    
	    return $html;
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
		return array(
		    array(
		        'name' => "laufzettel-elektronische-genehmigung-schulleitung",
		        'typ' => 'BOOLEAN',
		        'titel' => "Elektronische Genehmigungen für Schulleitungen aktivieren?",
		        'text' => "Durch aktivieren dieser Option werden Laufzettel für Schulaufgaben und Unterrichtsgängen durch die Schulleitung elektronisch genehmigbar."
		    ),
		  	   array(
					'name' => "laufzettel-emailhausmeister",
					'typ' => 'ZEILE',
					'titel' => "E-Mailadresse des Hausmeisters",
					'text' => "Für Benachrichtigungen bei abwesenden Klassen. Leer lassen, um die Benachrichtigung an den Hausmeister zu deaktivieren."
		  	   ),
				array(
						'name' => "laufzettel-emailhausmeister-betreff",
						'typ' => 'ZEILE',
						'titel' => "E-Mail an den Hausmeister (Betreff)",
						'text' => ""
				),
				array(
						'name' => "laufzettel-emailhausmeister-text",
						'typ' => 'TEXT',
						'titel' => "E-Mail an den Hausmeister (Standardtext)",
						'text' => "{KLASSEN} als Platzhalter für die Liste der abwesenden Klassen, {NAME} als Name des Lehrers, {DATUM} für das Datum"
				),
				array(
					'name' => "laufzettel-emailmittagsbetreuung",
					'typ' => 'ZEILE',
					'titel' => "E-Mailadresse der Mittagsbetreuung",
					'text' => "Für Benachrichtigungen bei abwesenden Klassen. Leer lassen, um die Benachrichtigung an die Mittagsbetreuung zu deaktivieren."
				),
				array(
						'name' => "laufzettel-emailmittagsbetreuung-betreff",
						'typ' => 'ZEILE',
						'titel' => "E-Mail an die Mittagsbetreuung (Betreff)",
						'text' => ""
				),
				array(
						'name' => "laufzettel-emailmittagsbetreuung-text",
						'typ' => 'TEXT',
						'titel' => "E-Mail an die Mittagsbetreuung (Standardtext)",
						'text' => "{KLASSEN} als Platzhalter für die Liste der abwesenden Klassen, {NAME} als Name des Lehrers, {DATUM} für das Datum"
				),
				array(
						'name' => "laufzettel-mittagessen",
						'typ' => 'ZEILE',
						'titel' => "E-Mailadresse des Mittagessencaterers",
						'text' => "Für Benachrichtigungen bei abwesenden Klassen. Leer lassen, um die Benachrichtigung an den Mittagessen Caterer zu deaktivieren."
				),
				array(
						'name' => "laufzettel-mittagessen-betreff",
						'typ' => 'ZEILE',
						'titel' => "E-Mail an den Mittagessen Caterer (Betreff)",
						'text' => ""
				),
				array(
						'name' => "laufzettel-mittagessen-text",
						'typ' => 'TEXT',
						'titel' => "E-Mail an den Mittagessen Caterer (Standardtext)",
						'text' => "{KLASSEN} als Platzhalter für die Liste der abwesenden Klassen, {NAME} als Name des Lehrers, {DATUM} für das Datum"
				),
				array(
						'name' => "laufzettel-first-ug",
						'typ' => 'NUMMER',
						'titel' => "First für den Antrag eines Unterrichtsganges bei der Schulleitung",
						'text' => "Angabe der Tage für die Frist zur Abgabe des Antrags beid er Schulleitung. (Erscheint nur auf dem Ausdruck)"
				)
		);
	}


	public static function getSiteDisplayName() {
		return 'Laufzettel';
	}

	/**
	 * Liest alle Nutzergruppen aus, die diese Seite verwendet. (Für die Benutzeradministration)
	 * @return array(array('groupName' => '', 'beschreibung' => ''))
	 */
	public static function getUserGroups() {
		return array();

	}

	public static function onlyForSchool() {
		return array(
		);
	}

	public static function hasAdmin() {
		return true;
	}
	
	public static function getAdminMenuIcon() {
		return 'fa fa-file';
	}
	
	public static function getAdminGroup() {
		return 'Webportal_Laufzettel_Admin';
	}
	
	public static function getAdminMenuGroup() {
		return 'Lehrertools';
	}
	
	public static function getAdminMenuGroupIcon() {
		return 'fa fa-wrench';
	}
}


?>
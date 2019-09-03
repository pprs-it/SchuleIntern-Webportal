<?php 


/**
 * Sendet E-Mailnachrichten
 * @author Christian
 *
 */

class MailSender extends AbstractCron {

	private $result = null;
	
	public function __construct() {
		
	}
	
	public function execute() {
		if(!DB::isDebug() && DB::getGlobalSettings()->schulnummer != "9400") {
			$this->result = email::sendBatchMails();
		}
		else {
			$this->result = 99999;
		}
	}
	
	public function getName() {
		return "E-Mails versenden";
	}
	
	public function getDescription() {
		return "Vorbereitete Mails werden versendet.";
	}
	
	/**
	 *
	 *
	 * @return ['success' => 'true/false', 'resultText' => 'Text, der in der Administration angezeigt wird.']
	 */
	public function getCronResult() {
		return ['success' => $this->result > -1, 'resultText' => $this->result . " Mails versendet."];
	}
	
	public function informAdminIfFail() {
		return false;
	}
	
	public function executeEveryXSeconds() {
		return 0;		// Alle 2 Minuten ausführen. (Wird nicht beachtet.)
	}
	
	public function onlyExecuteSeparate() {
	   return true;
	}
}



?>
<?php 


class Message {
	/**
	 * ID der Nachricht
	 * @var int
	 */
	private $id;
	
	/**
	 * UserID
	 * @var int
	 */
	private $userID;
	
	
	/**
	 * Benutzer, dem die Nachricht gehört
	 * @var user
	 */
	private $user;
	
	/**
	 * Betreff der Nachricht
	 * @var String
	 */
	private $subject;
	
	/**
	 * Text der Nachricht
	 * @var String
	 */
	private $text;
	
	/**
	 * Absender der Nachricht
	 * @var user
	 */
	private $sender;
	
	/**
	 * Verzeichnis der Nachricht
	 * @var string
	 */
	private $folder = 'POSTEINGANG';
	
	/**
	 * ID des eigenen Verzeichnisses
	 * @var integer
	 */
	private $folderID = 0;
	
	/**
	 * Empfänger der Nachricht
	 * @var MessageRecipient[]
	 */
	private $recipients = null;

    /**
     * Empfänger der Nachricht. (Daten aus der Datenbank)
     * @var string
     */
	private $recipientRawData = "";

    /**
     * Vorschau der Empfänger.
     * @var string 
     */
	private $recipientsPreview = "";
	
	/**
	 * 
	 * @var MessageRecipient[]
	 */
	private $ccRecipients = null;


    /**
     * Kopieempfänger der Nachricht. (Rohdaten aus der Datenbank.)
     * @var string
     */
	private $ccrecipientRawData = "";

	
	/**
	 * 
	 * @var MessageRecipient[]
	 */
	private $bccRecipients = null;


    /**
     * Verdeckte Kopieempfänger der Nachricht. (Rohdaten aus der Datenbank.)
     * @var string
     */
	private $bccrecipientRawData = "";
	
	
	/**
	 * Nachricht gelesen?
	 * @var boolean
	 */
	private $isRead = false;
	
	/**
	 * Priorität der Nachricht
	 * @var string NORMAL, LOW, HIGH
	 */
	private $priority = 'NORMAL';
	
	/**
	 * Zeitstempel der Nachricht
	 * @var integer
	 */
	private $messageTime = 0;
	
	/**
	 * 
	 * @var MessageAttachment[]
	 */
	private $attachments = [];
	
	/**
	 * Benötigt Empfangsbestätigung?
	 * @var booelan
	 */	
	private $needConfirmation = false;
	
	/**
	 * Empfang bestätigt?
	 * @var boolean
	 */
	private $isConfirmed = false;
	
	/**
	 * Zeitpunkt der Bestätigung
	 * @var integer
	 */
	private $confirmationTime = 0;
	
	/**
	 * Kanal der Bestätigung
	 * @var string
	 */
	private $confirmationChannel = 'PORTAL';
	
	/**
	 * Hat Abfragen?
	 * @var boolean
	 */
	private $hasQuestions = false;
	
	/**
	 * Antwort erlauben?
	 * @var boolean
	 */
	private $allowAnswer = false;
	
	/**
	 * Nachricht, auf die diese Nachricht die Antwort ist.
	 * @var Message
	 */
	private $replyToMessage = null;

	/**
	 * Nachricht welche weiter geleitet wurde
	 * @var Message
	 */
	private $forwardFromMessage = null;
	
	/**
	 * Geheimer Text zur Bestätigung der Nachricht
	 * @var string
	 */
	private $confirmationSecret = "";
	
	/**
	 * Fragen zur Nachricht
	 * @var MessageQuestion[]
	 */
	private $questions = [];
	
	/**
	 * 
	 * @var MessageAnswer[]
	 */
	private $questionAnswers = [];

    /**
     * Nachricht vertrazlich?
     * @var bool
     */
	private $isConfidential = false;


    /**
     * An welchen Empfänger ging diese spezielle Nachricht?
     * @var MessageRecipient $myRecipient
     */
	private $myRecipient = null;
	
	
	public function __construct($data) {
		$this->id = $data['messageID'];
		$this->userID = $data['messageUserID'];
		$this->subject = $data['messageSubject'];
		$this->text = $data['messageText'];
		$this->sender = user::getUserByID($data['messageSender']);
		$this->folder = $data['messageFolder'];
		$this->folderID = $data['messageFolderID'];

		$this->recipientRawData = $data['messageRecipients'];

		$this->recipientsPreview = DB::getDB()->decodeString($data['messageRecipientsPreview']);

		$this->ccrecipientRawData = $data['messageCCRecipients'];
		$this->bccrecipientRawData = $data['messageBCCRecipients'];

		if($data['messageMyRecipientSaveString'] != null) {
            $this->myRecipient = RecipientHandler::getRecipientFromSaveString($data['messageMyRecipientSaveString']);
        }
		
		// $rh = new RecipientHandler($data['messageRecipients']);
		// $this->recipients = $rh->getAllRecipients();
		
		// $rhcc = new RecipientHandler($data['messageCCRecipients']);
		// $this->ccRecipients = $rhcc->getAllRecipients();
		
		
		// $rhbcc = new RecipientHandler($data['messageBCCRecipients']);
		// $this->bccRecipients = $rhbcc->getAllRecipients();



		$this->isRead = $data['messageIsRead'];
		
		$this->priority = $data['messagePriority'];
		$this->messageTime = $data['messageTime'];
		$this->hasAttachment = $data['messageHasAttachment'];
		$this->needConfirmation = $data['messageNeedConfirmation'] > 0;
		$this->confirmationTime = $data['messageConfirmationTime'];
		$this->confirmationChannel = $data['messageConfirmationChannel'];
		$this->hasQuestions = $data['messageHasQuestions'];		
		$this->allowAnswer = $data['messageAllowAnswer'];
		$this->isConfirmed = $data['messageIsConfirmed'] > 0;
		$this->confirmationSecret = $data['messageConfirmSecret'];
		
		if($data['messageIsForwardFrom'] > 0) {
			$this->forwardFromMessage = Message::getByID($data['messageIsForwardFrom']);
		}

		if($data['messageIsReplyTo'] > 0) {
			$this->replyToMessage = Message::getByID($data['messageIsReplyTo']);
		}
		
		if($data['userName'] != '') {
			// Userdaten vorhanden
			$this->user = new user($data);
		}
		
		if($data['messageAttachments'] != '') {
			$attachments = explode(",",$data['messageAttachments']);
			for($i = 0; $i < sizeof($attachments); $i++) {
				$at = MessageAttachment::getByID($attachments[$i]);
				if($at != null) $this->attachments[] = $at;
			}
		}
		
		if($this->hasQuestions) {
		   
		    $this->questions = MessageQuestion::getByIDs(explode(";",$data['messageQuestionIDs']));
		    		    
		    $this->questionAnswers = MessageAnswer::getByMessageID($this->getID());
		}

		$this->isConfidential = $data['messageIsConfidential'] > 0;
	}
	
	/**
	 * 
	 * @return number
	 */
	public function getID() {
		return $this->id;
	}
	
	/**
	 * 
	 * @return String
	 */
	public function getSubject() {
		return $this->subject;
	}
	
	/**
	 * 
	 * @return String
	 */
	public function getText() {
		return $this->text;
	}
	
	/**
	 * 
	 * @return user
	 */
	public function getSender() {
		return $this->sender;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getFolder() {
		return $this->folder;
	}
	
	/**
	 * 
	 * @return number
	 */
	public function getFolderID() {
		return $this->folderID;
	}

    /**
     * Ist die Nachricht vertraulich?
     * @return mixed
     */
	public function isConfidential() {
	    return $this->isConfidential;
    }
	
	/**
	 * 
	 * @return MessageRecipient[]
	 */
	public function getRecipients() {
	    if($this->recipients == null) {
            $rh = new RecipientHandler($this->recipientRawData);
            $this->recipients = $rh->getAllRecipients();
        }
		return $this->recipients;
	}

    /**
     * @return string
     */
	public function getRecipientsPreview() {
	    if($this->recipientsPreview == "") {
            $recs = $this->getRecipients();

            $recsNames = [];

            for($i = 0; $i < sizeof($recs); $i++) {
                $recsNames[] = $recs[$i]->getDisplayName();
            }

            $this->recipientsPreview = implode(", ", $recsNames);

            DB::getDB()->query("UPDATE messages_messages SET messageRecipientsPreview='" . DB::getDB()->encodeString($this->recipientsPreview) . "' WHERE messageID='" . $this->getID() . "'");
        }

	    return $this->recipientsPreview;
    }
	
	/**
	 *
	 * @return MessageRecipient[]
	 */
    public function getCCRecipients() {
        if($this->ccRecipients == null) {
            $rh = new RecipientHandler($this->ccrecipientRawData);
            $this->ccRecipients = $rh->getAllRecipients();
        }
        return $this->ccRecipients;
    }
	/**
	 *
	 * @return MessageRecipient[]
	 */
	public function getBCCRecipients() {
        if($this->bccRecipients == null) {
            $rh = new RecipientHandler($this->bccrecipientRawData);
            $this->bccRecipients = $rh->getAllRecipients();
        }
        return $this->bccRecipients;
    }
	
	/**
	 * 
	 * @return boolean
	 */
	public function isRead() {
		return $this->isRead;
	}
	
	public function isHighPriority() {
		return $this->priority == 'HIGH';
	}
	
	public function isLowPriority() {
		return $this->priority == 'LOW';
	}

    public function getPriority() {
        return $this->priority;
    }

	public function getTime() {
		return $this->messageTime;
	}
	
	public function hasAttachment() {
		return sizeof($this->attachments) > 0;
	}
	
	public function hasQuestions() {
	    return $this->hasQuestions;
	}
	
	/**
	 * 
	 * @return MessageAttachment[]
	 */
	public function getAttachments() {
		return $this->attachments;
	}
	
	public function needConfirmation() {
		return $this->needConfirmation;
	}
	
	public function isConfirmed() {
		return $this->isConfirmed;
	}
	
	public function getConfirmationTime() {
		return $this->confirmationTime;
	}
	
	public function getConfirmationChannel() {
		return $this->confirmationChannel;
	}
	
	public function allowAnswer() {
		return $this->allowAnswer;
	}
	
	public function getUserID() {
		return $this->userID;
	}
	
	public function isForward() {
		return $this->forwardFromMessage != null;
	}

	public function getForwardMessage() {
		return $this->forwardFromMessage;
	}

	public function isReply() {
		return $this->replyToMessage != null;
	}
	
	public function getReplyMessage() {
		return $this->replyToMessage;
	}
	
	public function setRead() {
		DB::getDB()->query("UPDATE messages_messages SET messageIsRead=1 WHERE messageID='" . $this->id . "'");
		$this->isRead = true;
	}
	
	public function setSentViaMail() {
		DB::getDB()->query("UPDATE messages_messages SET messageIsSentViaEMail=1 WHERE messageID='" . $this->id . "'");
		$this->isRead = true;
	}
	
	public function confirmMessage($channel) {
		DB::getDB()->query("UPDATE messages_messages SET messageIsConfirmed=1, messageConfirmTime=UNIX_TIMESTAMP(), messageConfirmChannel='$channel' WHERE messageID='" . $this->id . "'");
	}
	
	public function getConfirmationSecret() {
		return $this->confirmationSecret;
	}
	
	public function getQuestions() {
	    return $this->questions;
	}
	
	public function getQuestionAnswers() {
	    return $this->questionAnswers;
	}
	
	public function answerQuestion($questionID, $data, $deleteAnswer) {
	    $found = false;
	    	    
	    for($i = 0; $i < sizeof($this->questionAnswers); $i++) {
	        if($this->questionAnswers[$i]->getQuestionID() == $questionID) {
	            $found = true;
	            if($deleteAnswer) {
	                $this->questionAnswers[$i]->delete();
	            }
	            else {
	                $this->questionAnswers[$i]->updateAnswer($data);
	            }
	            break;
	        }
	    }
	    	    
	    if(!$found) {
	        MessageAnswer::createAnswer($questionID, $this->getID(), $data);
	    }
	}
	
	/**
	 * 
	 * @param user $user Der Benutzer, dem die Nachrichten gehören
	 * @param String $folder Verzeichnis ('POSTEINGANG','GESENDETE','PAPIERKORB','ANDERER')
	 * @param int $folderID MUSS geprüft sein!
	 * @param int $limit MUSS geprüft sein!
	 * @param int $offset MUSS geprüft sein!
	 * @return Message[]
	 */
	public static function getMessages($user, $folder, $folderID, $limit, $offset) {
		
		if($folder == 'ANDERER') {
			$addSQL = " AND messageFolderID='" . $folderID . "' ";
		}
		
		$messagesSQL = DB::getDB()->query("SELECT * FROM messages_messages WHERE messageUserID='" . $user->getUserID() . "' AND messageIsDeleted=0 AND messageFolder='" . $folder . "' $addSQL ORDER BY messageTime DESC LIMIT $limit OFFSET $offset");
		
		$messages = [];
		
		while($m = DB::getDB()->fetch_array($messagesSQL)) $messages[] = new Message($m);
		
		return $messages;
	}
	
	public static function getMessagesSearch($user, $folder, $folderID, $search, $limit, $offset) {
	    if($folder == 'ANDERER') {
	        $addSQL = " AND messageFolderID='" . $folderID . "' ";
	    }
	    
	    $addSQL .= " AND (";

        $addSQL .= " messageSubject LIKE '%".$search."%' ";
        $addSQL .= " OR messageText LIKE '%".$search."%' ";
        $addSQL .= " OR messageRecipients LIKE '%".$search."%' ";

	    $addSQL .= ")";
	    
	    $safeSearch = DB::getDB()->escapeString($search);
	    
	    $messagesSQL = DB::getDB()->query("SELECT * FROM messages_messages
            WHERE messageUserID='" . $user->getUserID() . "'
            AND messageFolder='" . $folder . "' $addSQL ORDER BY messageTime DESC LIMIT $limit OFFSET $offset");


	    $messages = [];
	    
	    while($m = DB::getDB()->fetch_array($messagesSQL)) $messages[] = new Message($m);
	    
	    return $messages;
	}
	
	/**
	 * 
	 * @param user $user Der Benutzer, dem die Nachrichten gehören
	 * @param String $folder Verzeichnis ('POSTEINGANG','GESENDETE','PAPIERKORB','ANDERER')
	 * @param int $folderID MUSS geprüft sein!
	 * @return int Anzahl der Nachrichten
	 */
	public static function getMessageNumber($user, $folder, $folderID) {
		if($folder == 'ANDERER') {
			$addSQL = " AND messageFolderID='" . $folderID . "' ";
		}
		
		$messagesSQL = DB::getDB()->query_first("SELECT count(messageID) AS count FROM messages_messages WHERE messageIsDeleted=0 AND messageUserID='" . $user->getUserID() . "' AND messageFolder='" . $folder . "' $addSQL");
		
		return $messagesSQL['count'];
	}
	
	/**
	 *
	 * @param user $user Der Benutzer, dem die Nachrichten gehören
	 * @param String $folder Verzeichnis ('POSTEINGANG','GESENDETE','PAPIERKORB','ANDERER')
	 * @param int $folderID MUSS geprüft sein!
	 * @return int Anzahl der Nachrichten
	 */
	public static function getUnreadMessageNumber($user, $folder, $folderID) {
		if($folder == 'ANDERER') {
			$addSQL = " AND messageFolderID='" . $folderID . "' ";
		}
		
		$messagesSQL = DB::getDB()->query_first("SELECT count(messageID) as count FROM messages_messages WHERE messageUserID='" . $user->getUserID() . "' AND messageIsRead=0 AND messageFolder='" . $folder . "' $addSQL");
		
		return $messagesSQL['count'];
	}
	
	/**
	 * 
	 * @param int $id
	 * @return Message|NULL
	 */
	public static function getByID($id) {
		$message = DB::getDB()->query_first("SELECT * FROM messages_messages WHERE messageID='" . $id . "'");
		if($message['messageID'] > 0) return new Message($message);
		else return null;
	}
	
	public function getUser() {
		if($this->user != null) return $this->user;
		else return user::getUserByID($this->userID);
	}

    /**
     * Welcher der Empfänger ist meiner?
     * @return MessageRecipient|null
     */
	public function getMyRecipient() {
	    return $this->myRecipient;
    }
	
	public static function userHasUnreadMessages() {
		$messagesSQL = DB::getDB()->query("SELECT * FROM messages_messages WHERE messageUserID='" . DB::getSession()->getUser()->getUserID() . "' AND messageIsRead=0 AND messageFolder='POSTEINGANG'");
		
		return DB::getDB()->num_rows($messagesSQL) > 0;
	}
	
	/**
	 * 
	 * @return Message[]
	 */
	public static function getUnsentMailsViaEMail() {
		$time = time() - ( 24 * 60 * 60);
		$mails = DB::getDB()->query("SELECT * FROM messages_messages JOIN users ON users.userID=messages_messages.messageUserID WHERE messageIsRead=0 AND messageIsSentViaEMail=0 AND messageTime > ".$time . " LIMIT 50");
		
		$mms = [];
		
		while($m = DB::getDB()->fetch_array($mails)) {
			$mms[] = new Message($m);
		}
		
		return $mms;
	}
}


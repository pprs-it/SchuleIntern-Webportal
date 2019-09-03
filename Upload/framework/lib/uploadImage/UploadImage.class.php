<?php


/**
 * @deprecated Use FileUpload instead.
 * @todo Migrate old Images to FileUpload
 */
class UploadImage {
	private $imageDir = "imageUploads";
	
	private $uploadID = 0;
	private $uploadTime = 0;
	private $uploadUserName = 0;
	// private $uploadFileType = "";
	
	public function __construct($imageID = -1) {
		if($imageID > 0) {
			// vorhandene ID laden
			$image = DB::getDB()->query_first("SELECT * FROM image_uploads WHERE uploadID='" . $imageID . "'");
			$this->uploadID = $image['uploadID'];
			$this->uploadTime = $image['uploadTime'];
			$this->uploadUserName = $image['uploadUserName'];
		}
		else {
			// Neues Bild
			// ID = 0		-->		sendet ein Fehlerbild
		}
		
	}
	
	public function sendImage($maxWidth=-1) {
		$imageFile = "../data/imageUploads/" . $this->uploadID . ".jpg";
		
		if(!file_exists($imageFile)) {
			// Bild existiert nicht!
			// Fehlerbild senden
			$imageFile = "../data/imageUploads/0.jpg";
		}
		
		$oldSize = getImageSize($imageFile);
		
		if($maxWidth > 0) {
			// Bild verkleinert senden
			// Vielleicht existiert schon eine verkleinerte Version
			$imageSmall = "imageUploadsResize/" . $this->uploadID . "-" . $this->uploadTime . "-" . $maxWidth . ".jpg";
			if(file_exists($imageSmall)) {
				$fp = fopen($imageSmall, 'rb');		// READ / BINARY
				
				header("Content-Type: image/jpg");
				header("Content-Length: " . filesize($imageSmall));
				
				fpassthru($fp);
				
				exit(0);
			}
			
			$scale = $maxWidth / $oldSize[0];
			
			$newWidth = round($oldSize[0] * $scale);
			$newHeight = round($oldSize[1] * $scale) ;
			
			$altesBild = ImageCreateFromJPEG($imageFile);
			$neuesBild = imagecreatetruecolor($newWidth,$newHeight);
			
			ImageCopyResized($neuesBild,$altesBild,0,0,0,0,$newWidth,$newHeight,$oldSize[0],$oldSize[1]);
			
			header("Content-type: image/jpeg");
			
			ImageJPEG($neuesBild);
			
			ImageJPEG($neuesBild,"imageUploadsResize/" . $this->uploadID . "-" . $this->uploadTime . "-" . $maxWidth . ".jpg",90); // Bild speichern
			
			exit(0);		// Script zur Sicherheit beenden			
		}
		else {
			$fp = fopen($imageFile, 'rb');		// READ / BINARY
			
			header("Content-Type: image/jpg");
			header("Content-Length: " . filesize($imageFile));
			
			fpassthru($fp);
			
			exit(0);
		}
	
	}
	
	/**
	 * Läd ein Bild hoch. Das Formular muss <form action="[script]" method="post" enctype="multipart/form-data"> sein.
	 * Das Bild wird in JPEG konvertiert (Qualität 90)
	 * @param String $formName Formularname
	 * @return
	 * true -> success (die Aktuelle Bild ID wird mit dem neuen Bild überschrieben.
	 * !true -> Fehlercode
	 * Fehler 2:	Bild ungültig
	 */
	
	public function uploadNewImage($formName, $maxSize = 4000000 ) {
		if($this->uploadID == 0) {
			// Neues Bild
			// userID vorhanden?
			if(!DB::isLoggedIn()) $userID = "";
			else $userID = DB::getSession()->getData("userName");
			DB::getDB()->query("INSERT INTO image_uploads (uploadTime, uploadUsername) values(UNIX_TIMESTAMP(),'" . $userID . "')");
			$this->uploadID = DB::getDB()->insert_id();
		}
		else {
			if(!DB::isLoggedIn()) $userID = "";
			else $userID = DB::getSession()->getData("userName");
			DB::getDB()->query("UPDATE image_uploads SET uploadTime=UNIX_TIMESTAMP(), uploadUsername='" . $userID . "' WHERE uploadID='" . $this->uploadID . "'");
		}
		
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES[$formName]["name"]);
		$extension = strtolower(end($temp));
		// print_R($_FILES);
		if ((($_FILES[$formName]["type"] == "image/gif")
				|| ($_FILES[$formName]["type"] == "image/jpeg")
				|| ($_FILES[$formName]["type"] == "image/jpg")
				|| ($_FILES[$formName]["type"] == "image/pjpeg")
				|| ($_FILES[$formName]["type"] == "image/x-png")
				|| ($_FILES[$formName]["type"] == "image/png"))
				&& ($_FILES[$formName]["size"] < $maxSize)
				&& ($_FILES[$formName]["size"] > 0)
				&& in_array($extension, $allowedExts)) {
			if ($_FILES[$formName]["error"] > 0) {
				return $_FILES[$formName]["error"];
			} else {
				if (file_exists("upload/" . $_FILES[$formName]["name"])) {
					unlink("../data/imageUploads/" . $this->uploadID . ".jpg");
				} else {
					// Bild in JPG konvertieren, wenn es kein JPG ist.
					if(!@move_uploaded_file($_FILES[$formName]["tmp_name"], "../data/imageUploads/" . $this->uploadID . ".temp")) {
						return 2;
					}
					
					// Überprüfen, ob das Bild wirklich das ist, was es vorgibt.
								
					$imageTypeCheck = exif_imagetype("../data/imageUploads/" . $this->uploadID . ".temp");
					
					if ($extension == 'jpg' && $imageTypeCheck == 2) {
						$srcImg = imagecreatefromjpeg("../data/imageUploads/" . $this->uploadID . ".temp");
					} else
					if ($extension == 'jpeg' && $imageTypeCheck == 2) {
						$srcImg = imagecreatefromjpeg("../data/imageUploads/" . $this->uploadID . ".temp");
					} else
					if ($extension == 'png' && $imageTypeCheck == 3) {
						$srcImg = imagecreatefrompng("../data/imageUploads/" . $this->uploadID . ".temp");
					} else
					if ($extension == 'gif' && $imageTypeCheck == 1) {
						$srcImg = imagecreatefromgif("../data/imageUploads/" . $this->uploadID . ".temp");
					}
					else {
						// Bild ist kein gültiges Bild.
						// hochgeladenes Bild wieder löschen
						unlink("../data/imageUploads/" . $this->uploadID . ".temp");
						
						return 2;
					}
					

					$size = getImageSize("../data/imageUploads/" . $this->uploadID . ".temp");

					$saveImageJPG = imagecreatetruecolor($size[0],$size[1]);
					
					ImageCopyResized($saveImageJPG,$srcImg,0,0,0,0,$size[0],$size[1],$size[0],$size[1]);

					imagejpeg($saveImageJPG, "../data/imageUploads/" . $this->uploadID . ".jpg", 90);
					
					unlink("../data/imageUploads/" . $this->uploadID . ".temp");
										
					return true;
				}
			}
		} else {
	
			return false;
		}
	}
	
	public function delete() {
		DB::getDB()->query("DELETE FROM image_uploads WHERE uploadID='" . $this->uploadID . "'");
		unlink("../data/imageUploads/" . $this->uploadID . ".jpg");
	}
	
	public function getUploadID() {
		return $this->uploadID;
	}
	
}
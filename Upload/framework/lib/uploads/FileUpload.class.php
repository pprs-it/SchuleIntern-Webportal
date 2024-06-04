<?php


class FileUpload {

	private static $mimeTypesMSOffice = array(
			'application/msword',
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
			'application/vnd.ms-word.document.macroEnabled.12',
			'application/vnd.ms-word.template.macroEnabled.12',
			'application/vnd.ms-excel',
			'application/vnd.ms-excel',
			'application/vnd.ms-excel',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
			'application/vnd.ms-excel.sheet.macroEnabled.12',
			'application/vnd.ms-excel.template.macroEnabled.12',
			'application/vnd.ms-excel.addin.macroEnabled.12',
			'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
			'application/vnd.ms-powerpoint',
			'application/vnd.openxmlformats-officedocument.presentationml.presentation',
			'application/vnd.openxmlformats-officedocument.presentationml.template',
			'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
			'application/vnd.ms-powerpoint.addin.macroEnabled.12',
			'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
			'application/vnd.ms-powerpoint.template.macroEnabled.12',
			'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
			'application/vnd.ms-access',
			'application/pdf',
			'application/zip'
	);

	private static $mimeTypesAudio = [
	    'audio/mpeg',
        'audio/mp4',
        'audio/vnd.wav',
        'audio/basic'
    ];

	private static $mimesPicture = [
			'image/png',
			'image/tiff',
			'image/jpeg',
			'image/jpg',
			'image/gif'
	];

	private $data = [];


	public function __construct($data) {
		$this->data = $data;
	}

    public function getID() {
        return $this->data['uploadID'];
    }

	public function getFileName() {
		return $this->data['uploadFileName'];
	}

	public function getExtension() {
		return $this->data['uploadFileExtension'];
	}

	public function getMimeType() {
		return $this->data['uploadFileMimeType'];
	}

	public function getUploadTime() {
		return $this->data['uploadTime'];
	}

    /**
     * Direkter Pfad zur Datei
     * @return string
     */
    public function getFilePath() {
        return PATH_DATA."uploads/" . $this->getID() . ".dat";
    }

    /**
     *
     * @return user|NULL
     */
    public function getUploader() {
        return user::getUserByID($this->data['uploaderUserID']);
    }



    public function getFileSize() {
        if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
            return 'n/a';
        }
        return str_replace(".",",",round(filesize("../data/uploads/" . $this->getID() . ".dat") / 1024 / 1024,2)) . " MB";
    }

    public function getCollection() {
        $collection = [
            "name" => $this->getFileName(),
            "ext" => $this->getExtension(),
            "mime" => $this->getMimeType(),
            "time" => date('d.m.Y', $this->getUploadTime() ),
            "timestamp" => $this->getUploadTime(),
            "path" => $this->getFilePath(),
            "user" => false,
            "id" => $this->getID(),
            "exist" => $this->isExist(),
            "size" => $this->getFileSize()
        ];
        $user = $this->getUploader();
        if ($user) {
            $collection['user'] = $user->getCollection(false, false);
        }
        return $collection;

    }

    public function getAvatarThumb() {

        $folder = PATH_WWW_TMP.'avatar';
        if ( !is_dir($folder) ) {
            mkdir($folder);
        }

        $newFilename = $folder.DS.$this->getID().'.jpg';

        if ( file_exists($newFilename) ) {
            return $newFilename;
        } else {

            $filename = PATH_ROOT."data/imageUploads/" . $this->getID() . ".jpg";
            if (file_exists($filename)) {
                if ( !$this->copyAndResizeImage($filename, $newFilename) ) {
                    copy($filename, $newFilename);
                }
                if (file_exists($newFilename)) {
                    return $newFilename;
                }
            }
        }

        return false;
    }

    private function copyAndResizeImage($filename,$output, $size= [200,200]) {

        // Set a maximum height and width
        $width = $size[0];
        $height = $size[1];

        // Content type
        header('Content-Type: image/jpeg');

        // Get new dimensions
        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
            $width = $height*$ratio_orig;
        } else {
            $height = $width/$ratio_orig;
        }

        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        if ( imagejpeg($image_p, $output, 100) ) {
            return true;
        }

        return false;
    }

	public function getThumb($folder = 'thumbs', $title = false) {

        $folder = PATH_WWW_TMP.$folder;
        if ( !is_dir($folder) ) {
            mkdir($folder);
        }

        $newFilename = $folder.DS.$this->getID().'.'.$this->getExtension();
		if ($title) {
			$newFilename = $folder.DS.$title.'.'.$this->getExtension();
		}

        if ( file_exists($newFilename) ) {
            return $newFilename;
        } else {
            $filename = $this->getFilePath(); //PATH_ROOT."data/uploads/" . $this->getID() . ".dat";
            if (file_exists($filename)) {

                copy($filename, $newFilename);
                if (file_exists($newFilename)) {
                    return $newFilename;
                }
            }
        }

        return false;
    }



    public function isExist() {
        if ( file_exists($this->getFilePath())) {
            return true;
        }
        return false;
    }

	public function isImage() {
	    return in_array($this->data['uploadFileMimeType'], self::$mimesPicture);
	}

	public function isWord() {
	    return $this->getExtension() == 'doc' || $this->getExtension() == 'docx';
	}

	public function isExcel() {
	    return $this->getExtension() == 'xls' || $this->getExtension() == 'xlsx';
	}

	public function isPowerpoint() {
	    return $this->getExtension() == 'ppt' || $this->getExtension() == 'ppts';
	}

	public function isPDF() {
	    return $this->getMimeType() == 'application/pdf';
	}

	public function getAccessCode() {
		return $this->data['fileAccessCode'];
	}

	public function reuploadJPEGImageFromBase64($base64) {
	    $ifp = fopen( $this->getFilePath(), 'wb' );

	    $data = explode( ',', $base64 );

	    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

	    fclose( $ifp );

	    DB::getDB()->query("UPDATE uploads SET uploadFileMimeType='image/jpeg' WHERE uploadID='" . $this->getID() . "'");
	    DB::getDB()->query("UPDATE uploads SET uploadFileExtension='jpg' WHERE uploadID='" . $this->getID() . "'");
	}

	public function getTextFileContent() {
	    if($this->getMimeType() == 'text/plain') return file_get_contents($this->getFilePath());
	    else return 'no text Content - invalid mime type';
	}

	public function getURLToFile($forceDownload=false) {

		if($this->getAccessCode() == '') {
			$this->data['fileAccessCode'] = strtoupper(md5(rand()) . md5(rand()));
			DB::getDB()->query("UPDATE uploads SET fileAccessCode='" . $this->data['fileAccessCode'] . "' WHERE uploadID='" . $this->getID() . "'");
		}

		return DB::getGlobalSettings()->urlToIndexPHP . "?page=FileDownload&uploadID=" . $this->getID() . "&accessCode=" . $this->getAccessCode() . (($forceDownload) ? ("&fd=1") : (""));
	}



	public function delete() {
		@unlink('../data/uploads/' . $this->getID() . ".dat");
		DB::getDB()->query("DELETE FROM uploads WHERE uploadID='" . $this->getID() . "'");
	}

	public function getFileTypeIcon() {
		switch(strtolower($this->getExtension())) {
			case 'pdf':
				return 'fa fa-file-pdf';

			case 'doc':
			case 'docx':
			    return 'fa fa-file-word';

			case 'xls':
			case 'xlsx':
			    return 'fa fa-file-excel';

			case 'ppt':
			case 'pptx':
			    return 'fa fa-file-powerpoint';


			default:
				return 'fa fa-file';
		}
	}




	public function sendFile() {
		if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
			new errorPage("Upload existiert nicht!");
			exit(0);
		}


		$fileextension = $this->getExtension();
		$fileextension = strtolower($fileextension);

		// Hat Dateiname schon eine Erweiterung?
        $filename = $this->getFileName();

        if(substr($filename,-(strlen(($fileextension)))) != $fileextension) {
            $filename =  $filename . "." . $fileextension;
        }

		header('Content-Description: Dateidownload');
		header('Content-Type: ' . $this->getMimeType());
		header('Content-Disposition: attachment; filename="'. $filename . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize("../data/uploads/" . $this->getID() . ".dat"));

		ob_clean();
		flush();

        $fp = fopen("../data/uploads/" . $this->getID() . ".dat", 'rb');		// READ / BINARY

        fpassthru($fp);

		exit(0);
	}

	public function sendPreviewForPDFFirstPage($width) {
	    if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
	        new errorPage("Upload existiert nicht!");
	    }

	    if($this->getMimeType() != "application/pdf") new errorPage();

	    $this->sendPDFPageAsImage(1);
	}

	public function sendPDFPageAsImage($page) {
	    if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
	        new errorPage("Upload existiert nicht!");
	    }

	    if($this->getMimeType() != "application/pdf") new errorPage();

	    $showPage = 0;

	    if($page <= $this->getPDFPageNumber()) {
	        $showPage = $page-1;
	    }

	    $image = new Imagick("../data/uploads/" . $this->getID() . ".dat[" . $showPage ."]");

	    $image->setImageFormat('jpg');

	    header('Content-Type: image/jpeg');
	    echo $image;
        exit();
	}

	public function getPDFPageNumber() {

	    if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
	        new errorPage("Upload existiert nicht!");
	    }

	    $image = new Imagick();
	    $image->pingImage("../data/uploads/" . $this->getID() . ".dat");
	    return $image->getNumberImages();
	}

	public function sendImageWidthMaxWidth($maxWidth) {

		if(!file_exists("../data/uploads/" . $this->getID() . ".dat")) {
			new errorPage("Upload existiert nicht!");
		}

		$cacheKey = 'upload-' . $this->getID() . '-' . $maxWidth;

		if(DB::getCache()->isItemSet($cacheKey)) {
            header ( "Content-type: image/jpeg" );
            echo DB::getCache()->getFromBase64($cacheKey);
            exit(0);
        }

		$oldSize = getImageSize ( "../data/uploads/" . $this->getID() . ".dat" );

		$scale = $maxWidth / $oldSize [0];

		$newWidth = round ( $oldSize [0] * $scale );
		$newHeight = round ( $oldSize [1] * $scale );

		$altesBild = ImageCreateFromJPEG ( "../data/uploads/" . $this->getID() . ".dat" );

		if($this->getExtension() == 'png') {
		    $altesBild = imagecreatefrompng( "../data/uploads/" . $this->getID() . ".dat" );
		}

		$neuesBild = imagecreatetruecolor ( $newWidth, $newHeight );

		ImageCopyResized ( $neuesBild, $altesBild, 0, 0, 0, 0, $newWidth, $newHeight, $oldSize [0], $oldSize [1] );

		header ( "Content-type: image/jpeg" );

        ImageJPEG($neuesBild, "../data/temp/" . $cacheKey);

        DB::getCache()->storeAsBase64($cacheKey, file_get_contents("../data/temp/" . $cacheKey));
        unlink("../data/temp/" . $cacheKey);

		ImageJPEG ( $neuesBild );

		exit ( 0 ); // Script zur Sicherheit beenden
	}

	/**
	 *
	 * @param int $id
	 * @return FileUpload|null
	 */
	public static function getByID($id) {
		$upload = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . DB::getDB()->escapeString($id) . "'");
		if($upload['uploadID'] > 0) {
			return new FileUpload($upload);
		}

		return null;
	}

    /**
     *
     * @return FileUpload|null
     */
    public static function getAll() {
        $ret = [];
        $dataSQL = DB::getDB()->query("SELECT * FROM uploads");
        while ($data = DB::getDB()->fetch_array($dataSQL, true)) {
            $ret[] = new FileUpload($data);
        }

        return $ret;
    }


	/**
	 *
	 * @param String $fieldName
	 * @param String $fileName
	 * @return String[]
	 */
	public static function uploadPicture($fieldName, $fileName) {


		return self::uploadFileImpl($fieldName, self::$mimesPicture, $fileName);
	}


    /**
     * @param $filepath
     * @param $filename
     * @return array
     */
    public static function uploadPictureFromFile($filepath, $filename) {
        $ext = strtolower(array_pop(explode('.',$filepath)));

        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filepath);
            finfo_close($finfo);
            $mimetype = str_replace("; charset=binary", "", $mimetype);
            $mimetype = str_replace("; charset=utf-8", "", $mimetype);

            if(!in_array($mimetype, self::$mimesPicture)) {
                $mime = null;
            }
            else $mime = $mimetype;
        }
        else new errorPage("MIME Type kann nicht bestimmt werden!");

        DB::getDB()->query("INSERT INTO uploads
				(
					uploadFileName,
					uploadFileExtension,
					uploadFileMimeType,
					uploadTime,
					uploaderUserID
				) values(
					'" . DB::getDB()->escapeString($filename) . "',
					'" . $ext . "',
					'" . $mime . "',
					UNIX_TIMESTAMP(),
					" . DB::getSession()->getUser()->getUserID() . "				
				)
			");

        $newID = DB::getDB()->insert_id();

        copy($filepath, "../data/uploads/" . $newID . ".dat");

        $data = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . $newID. "'");

        return [
            'result' => true,
            'uploadobject' => new FileUpload($data),
            'mimeerror' => false,
            'text' => "Upload OK"
        ];
    }

	public static function uploadPDF($fieldName, $fileName) {
		$mimePDF = [
				'application/pdf'
		];

		return self::uploadFileImpl($fieldName, $mimePDF, $fileName);
	}

	public static function uploadCSV($fieldName, $fileName) {
	    $mime = [
	        'text/csv',
	        'text/plain'
	    ];

	    return self::uploadFileImpl($fieldName, $mime, $fileName);
	}
	public static function uploadPowerpoint($fieldName, $fileName) {
	    $mimePDF = [
	        'application/vnd.openxmlformats-officedocument.presentationml.presentation'
	    ];

	    return self::uploadFileImpl($fieldName, $mimePDF, $fileName);
	}

	public static function uploadOfficeDocumentsAndPDF($fieldName, $fileName) {
		$mimes = self::$mimeTypesMSOffice;
		$mimes[] = 'application/pdf';

		for($i = 0; $i < sizeof(self::$mimesPicture); $i++) {
		    $mimes[] = self::$mimesPicture[$i];
		}

		return self::uploadFileImpl($fieldName, $mimes, $fileName);
	}

	public static function uploadOfficeFilesPicturesTextAndZip($fieldName, $fileName) {
        $mimes = self::$mimeTypesMSOffice;

        $mimes[] = 'application/pdf';
        $mimes[] = 'text/csv';
	    $mimes[] = 'text/plain';
        $mimes[] = 'application/zip';

        $mimes = array_merge($mimes, self::$mimesPicture);

        for($i = 0; $i < sizeof(self::$mimesPicture); $i++) {
            $mimes[] = self::$mimesPicture[$i];
        }

        for($i = 0; $i < sizeof(self::$mimeTypesAudio); $i++) {
            $mimes[] = self::$mimeTypesAudio[$i];
        }


        return self::uploadFileImpl($fieldName, $mimes, $fileName);
    }

	public static function uploadOfficeDocument($fieldName, $fileName) {
		return self::uploadFileImpl($fieldName, self::$mimeTypesMSOffice, $fileName);
	}

	public static function uploadOfficePdfOrPicture($fieldName, $fileName) {
		$mimes = self::$mimeTypesMSOffice;

		for($i = 0; $i < sizeof(self::$mimesPicture); $i++) {
		    $mimes[] = self::$mimesPicture[$i];
		}

		$mimes[] = 'application/pdf';


		return self::uploadFileImpl($fieldName, $mimes, $fileName);
	}

	public static function uploadPDFOrZip($fieldName, $fileName) {
	    $mimes = [];

	    $mimes[] = 'application/pdf';
	    $mimes[] = 'application/zip';

	    return self::uploadFileImpl($fieldName, $mimes, $fileName);
	}




	/**
	 *
	 * @param String $filename
	 * @param TCPDF $tcpdf
	 */
	public static function uploadFromTCPdf($filename, $tcpdf) {
		$mime = 'application/pdf';

		if(DB::isLoggedIn()) {

    		$user = DB::getSession()->getUser();

    		if($user == null) {
    		    // SystemCall

    		    $userID = 0;
    		}
    		else $userID = $user->getUserID();

		}
		else $userID = 0;

		DB::getDB()->query("INSERT INTO uploads
				(
					uploadFileName,
					uploadFileExtension,
					uploadFileMimeType,
					uploadTime,
					uploaderUserID,
                    fileAccessCode
				) values(
					'" . DB::getDB()->escapeString($filename) . "',
					'pdf',
					'" . $mime . "',
					UNIX_TIMESTAMP(),
					" . $userID . ",
					'" . strtoupper(md5(rand()) . md5(rand())) . "'
				)
			");


		$newID = DB::getDB()->insert_id();

		$path = getcwd();

		$saveDir = "/../data/uploads/" . $newID . ".dat";

        $saveDir = $path . $saveDir;


        $tcpdf->Output($saveDir, 'F');

		$data = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . $newID. "'");

		return [
				'result' => true,
				'uploadobject' => new FileUpload($data),
				'mimeerror' => false,
				'text' => "Save from TCPDF OK"
		];



	}

	private static function uploadFileImpl($fieldName, $mimes, $fileName='') {
		if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
			return [
				'result' => false,
				'uploadobject' => null,
				'mimeerror' => false,
				'text' => "Es gab einen Fehler beim Upload: " . $_FILES['file']['error']
			];
		}

		$mime = null;

		if($fileName == '') $fileName = $_FILES[$fieldName]['name'];

		$ext = strtolower(array_pop(explode('.',$_FILES[$fieldName]['name'])));

		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $_FILES[$fieldName]['tmp_name']);
			finfo_close($finfo);
			$mimetype = str_replace("; charset=binary", "", $mimetype);
			$mimetype = str_replace("; charset=utf-8", "", $mimetype);
            $mimetype = str_replace("; charset=us-ascii", "", $mimetype);

			if(!in_array($mimetype, $mimes)) {
			    $mimeerror = $mimetype;
				$mime = null;
			}
			else $mime = $mimetype;
		}
		else new errorPage("MIME Type kann nicht bestimmt werden!");

		if($mime != null) {

			DB::getDB()->query("INSERT INTO uploads
				(
					uploadFileName,
					uploadFileExtension,
					uploadFileMimeType,
					uploadTime,
					uploaderUserID
				) values(
					'" . DB::getDB()->escapeString($fileName) . "',
					'" . $ext . "',
					'" . $mime . "',
					UNIX_TIMESTAMP(),
					" . DB::getSession()->getUser()->getUserID() . "				
				)
			");

			$newID = DB::getDB()->insert_id();

			if (!move_uploaded_file($_FILES[$fieldName]["tmp_name"], "../data/uploads/" . $newID . ".dat")) {
				return [
					'result' => false,
					'uploadobject' => null,
					'mimeerror' => false,
					'text' => "Es gab einen Fehler beim Upload: Move File"
				];
			}

			$data = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . $newID. "'");

			return [
					'result' => true,
					'uploadobject' => new FileUpload($data),
					'mimeerror' => false,
					'text' => "Upload OK"
			];
		}
		else {
			return [
					'result' => false,
					'uploadobject' => null,
					'mimeerror' => true,
					'text' => "wrong mime type: $mimeerror"
			];
		}
	}

	public static function uploadTextFileContents($name, $content) {
	    $mime = 'text/plain';

	    DB::getDB()->query("INSERT INTO uploads
				(
					uploadFileName,
					uploadFileExtension,
					uploadFileMimeType,
					uploadTime,
					uploaderUserID,
                    fileAccessCode
				) values(
					'" . DB::getDB()->escapeString($name) . "',
					'txt',
					'" . $mime . "',
					UNIX_TIMESTAMP(),
					" . DB::getSession()->getUser()->getUserID() . ",
					'" . strtoupper(md5(rand()) . md5(rand())) . "'
				)
			");


	    $newID = DB::getDB()->insert_id();

	    $saveDir = "../data/uploads/" . $newID . ".dat";

	    file_put_contents($saveDir, $content);

	    $data = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . $newID. "'");

	    return [
	        'result' => true,
	        'uploadobject' => new FileUpload($data),
	        'mimeerror' => false,
	        'text' => "Upload from Text - Content OK"
	    ];

	}

	public static function generateUploadID($name, $extension, $isWord, $isPDF) {

	    if($isWord) {
	        $mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
	    }

	    if($isPDF) {
	        $mime = 'application/pdf';
	    }

	    DB::getDB()->query("INSERT INTO uploads
				(
					uploadFileName,
					uploadFileExtension,
					uploadFileMimeType,
					uploadTime,
					uploaderUserID,
                    fileAccessCode
				) values(
					'" . DB::getDB()->escapeString($name) . "',
					'" . DB::getDB()->escapeString($extension) . "',
					'" . $mime . "',
					UNIX_TIMESTAMP(),
					" . DB::getSession()->getUser()->getUserID() . ",
					'" . strtoupper(md5(rand()) . md5(rand())) . "'
				)
			");


	    $newID = DB::getDB()->insert_id();

	    $saveDir = "../data/uploads/" . $newID . ".dat";

	    // file_put_contents($saveDir, "");

	    $data = DB::getDB()->query_first("SELECT * FROM uploads WHERE uploadID='" . $newID. "'");

	    return [
	        'result' => true,
	        'uploadobject' => new FileUpload($data),
	        'mimeerror' => false,
	        'text' => "Upload from Text - Content OK"
	    ];

	}
}


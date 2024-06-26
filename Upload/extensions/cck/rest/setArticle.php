<?php

class setArticle extends AbstractRest {
	
	protected $statusCode = 200;


	public function execute($input, $request) {


        $userID = DB::getSession()->getUser()->getUserID();
        if (!$userID) {
            return [
                'error' => true,
                'msg' => 'Missing User ID'
            ];
        }

        if (!$input['form_id'] || !$input['fields'] || !$input['title'] ) {
            //die('missing data');
            return [
                'error' => true,
                'msg' => 'Missing Data'
            ];
        }

        $acl = $this->getAcl();
        if ((int)$acl['rights']['write'] !== 1 && (int)DB::getSession()->getUser()->isAnyAdmin() !== 1 ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }



        if ((int)$input['id'] > 0) {

/*
            if ((int)$acl['rights']['write'] !== 1 && (int)DB::getSession()->getUser()->isAnyAdmin() !== 1 ) {
                return [
                    'error' => true,
                    'msg' => 'Kein Zugriff (2)'
                ];
            }

            if (!DB::getDB()->query("UPDATE cck_forms
                SET title='" . DB::getDB()->escapeString($input['title']) . "',
                template='" . DB::getDB()->escapeString($input['template']) . "',
                modifiedTime = '".date('Y-m-d H:i', time())."',
                modifiedBy = ".$userID."
                WHERE id=".(int)$input['id']
            )) {
                return [
                    'error' => true,
                    'msg' => 'Fehler beim Hinzufügen!'
                ];
            }

            return [
                'error' => false,
                'insert' => true
            ];
            */

        } else {

            if (!DB::getDB()->query("INSERT INTO cck_articles
				(
				    createdTime,
				    createdBy,
					form_id,
				    title
				) values(
				    '".date('Y-m-d H:i', time())."',
				    ".$userID.",
					'" . DB::getDB()->escapeString($input['form_id']) . "',
					'" . DB::getDB()->escapeString($input['title']) . "'
				)
		    ")) {
                return [
                    'error' => true,
                    'msg' => 'Fehler beim Hinzufügen! (list)'
                ];
            }
            $insertID = DB::getDB()->insert_id();

            if (!(int)$insertID ) {
                return [
                    'error' => true,
                    'msg' => 'Fehler beim Hinzufügen! (insert)'
                ];
            }



            $fields = json_decode($_POST['fields']);

            if ($insertID && count($fields) > 0) {
                foreach($fields as $field) {
                    if ($field->content && (int)$field->field_id && !DB::getDB()->query("INSERT INTO cck_content
                        (
                            article_id,
                            field_id,
                            content,
                            formfield_id
                        ) values(
                            ".$insertID.",
                            ".(int)$field->field_id.",
                            '".$field->content."',
                            ".(int)$field->id."
                        )
                    ")) {
                        return [
                            'error' => true,
                            'msg' => 'Fehler beim Hinzufügen! (content)'
                        ];
                    }
                }
            }



            return [
                'error' => false,
                'insert' => true
            ];
        }






        return [
			'error' => true,
			'msg' => 'Return Data!'
		];

	}


	/**
	 * Set Allowed Request Method
	 * (GET, POST, ...)
	 * 
	 * @return String
	 */
	public function getAllowedMethod() {
		return 'POST';
	}


    /**
     * Muss der Benutzer eingeloggt sein?
     * Ist Eine Session vorhanden
     * @return Boolean
     */
    public function needsUserAuth() {
        return true;
    }

    /**
     * Ist eine Admin berechtigung nötig?
     * only if : needsUserAuth = true
     * @return Boolean
     */
    public function needsAdminAuth()
    {
        return false;
    }
    /**
     * Ist eine System Authentifizierung nötig? (mit API key)
     * only if : needsUserAuth = false
     * @return Boolean
     */
    public function needsSystemAuth() {
        return false;
    }

}	

?>
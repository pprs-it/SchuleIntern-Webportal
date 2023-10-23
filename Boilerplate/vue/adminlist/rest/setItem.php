<?php

class setItem extends AbstractRest {
	
	protected $statusCode = 200;


	public function execute($input, $request) {


        $userID = DB::getSession()->getUser()->getUserID();
        if (!$userID) {
            return [
                'error' => true,
                'msg' => 'Missing User ID'
            ];
        }

        $acl = $this->getAcl();
        if ( !$this->canWrite() ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }

        $id = (int)$input['id'];
        if (!$id) {
            $id = false;
        }

        $title = (string)$input['title'];
        if (!$title) {
            $title = '';
        }


        include_once PATH_EXTENSION . 'models' . DS . 'List.class.php';
        if ( !extPodcastModelList::setItem($id, $title) ) {
            return [
                'error' => true,
                'msg' => 'Fehler'
            ];
        }



        return [
            'done' => true
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
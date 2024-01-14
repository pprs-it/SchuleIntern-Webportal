<?php

class delEvent extends AbstractRest {
	
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

        if ( !$this->canDelete() ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }
        /*
        if ( DB::getSession()->isAdminOrGroupAdmin($this->extension['adminGroupName']) !== true ) {
            if ((int)$acl['rights']['delete'] !== 1) {
                return [
                    'error' => true,
                    'msg' => 'Kein Zugriff'
                ];
            }
        }
        */

        /*
        if ((int)$acl['rights']['delete'] !== 1 || DB::getSession()->isAdminOrGroupAdmin($this->extension['adminGroupName']) !== true ) {
        //if ((int)$acl['rights']['delete'] !== 1 && (int)DB::getSession()->getUser()->isAnyAdmin() !== 1 ) {

        }
        */



        if ( !$input['id'] ) {
            return [
                'error' => true,
                'msg' => 'Missing Data: id'
            ];
        }

        include_once PATH_EXTENSION . 'models' . DS . 'Event.class.php';

        if ( extKalenderModelEvent::deleteFromID($input['id']) ) {
            return [
                'success' => true
            ];
        }

        return [
            'error' => true,
            'msg' => 'Error'
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
<?php

class getList extends AbstractRest {
	
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
        if ((int)$acl['rights']['read'] !== 1 && (int)DB::getSession()->isMember($this->extension['adminGroupName']) !== 1 ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }

        include_once PATH_EXTENSION . 'models' . DS . 'List.class.php';

        $data = extUserlistModelList::getAllByOwner($userID);

        $ret = [];
        if (count($data) > 0) {
            foreach ($data as $item) {


                $collection = $item->getCollection();

                $collection['members'] = [];
                foreach($item->getMembers() as $user) {
                    if ($user) {
                        $collection['members'][] = $user->getCollection(false, true);
                    }
                }

                $collection['owners'] = [];
                foreach($item->getOwners() as $user) {
                    if ($user && $userID != $user->getUserID()) {
                        $collection['owners'][] = $user->getCollection(false, true);
                    }
                }

                $collection['stats'] = $item->getStatsMember();

                $ret[] = $collection;
            }
        }


        return $ret;

	}


	/**
	 * Set Allowed Request Method
	 * (GET, POST, ...)
	 * 
	 * @return String
	 */
	public function getAllowedMethod() {
		return 'GET';
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
<?php

class getMyBuchung extends AbstractRest
{

    protected $statusCode = 200;


    public function execute($input, $request)
    {

        $userID = DB::getSession()->getUser()->getUserID();
        if (!$userID) {
            return [
                'error' => true,
                'msg' => 'Missing User ID'
            ];
        }
        $acl = $this->getAcl();
        if ( !$this->canRead() ) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }


        include_once PATH_EXTENSION . 'models' . DS . 'Buchung.class.php';

        $class = new extFinanzenModelBuchung();
        $tmp_data = $class->getMy($userID);

        $userTyp = DB::getSession()->getUser()->getUserTyp(true);
        if ( $userTyp == 'isEltern') {
            $eltern = DB::getSession()->getUser()->getElternObject();
            $mySchueler = $eltern->getMySchueler();
            if ($mySchueler) {
                foreach ($mySchueler as $schueler) {
                    $tmp = $class->getMy($schueler->getUserID());
                    $tmp_data = array_merge($tmp_data, $tmp);
                }
            }
        }

        $ret = [];
        foreach ($tmp_data as $item) {
            $collection = $item->getCollection(true);
            $ret[] = $collection;
        }

        return $ret;

    }


    /**
     * Set Allowed Request Method
     * (GET, POST, ...)
     *
     * @return String
     */
    public function getAllowedMethod()
    {
        return 'GET';
    }


    /**
     * Muss der Benutzer eingeloggt sein?
     * Ist Eine Session vorhanden
     * @return Boolean
     */
    public function needsUserAuth()
    {
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
    public function needsSystemAuth()
    {
        return false;
    }

}

?>
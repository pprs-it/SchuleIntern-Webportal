<?php

class uploadItem extends AbstractRest
{

    protected $statusCode = 200;


    public function execute($input, $request)
    {

        $type = $request[2];
        if (!$type || $type == 'undefined') {
            $this->statusCode = 400;
            return [
                'error' => true,
                'msg' => 'Missing Type'
            ];
        }

        $id = $request[3];
        if (!$id || $id == 'undefined') {
            $id = '__tmp';
            /*
            $this->statusCode = 400;
            return [
                'error' => true,
                'msg' => 'Missing ID'
            ];
            */
        }

        $user = DB::getSession()->getUser();
        if (!$user) {
            return [
                'error' => true,
                'msg' => 'Missing User'
            ];
        }
        $acl = $this->getAcl();
        if (!$this->canWrite()) {
            return [
                'error' => true,
                'msg' => 'Kein Zugriff'
            ];
        }

        $file = $_FILES['file'];
        if (!$file) {
            $this->statusCode = 400;
            return [
                'error' => true,
                'msg' => 'Missing Files'
            ];
        }

        $info = pathinfo($file['name']);
        switch ($type) {
            case 'pdf':
                if ($info['extension'] != 'pdf') {
                    $this->statusCode = 400;
                    return [
                        'error' => true,
                        'msg' => 'Falsches Dateiformat'
                    ];
                }
                break;
            case 'cover':
                $allowed = ['jpg', 'jpeg', 'png'];
                if ( !in_array($info['extension'], $allowed)) {
                    $this->statusCode = 400;
                    return [
                        'error' => true,
                        'msg' => 'Falsches Dateiformat'
                    ];
                }
                break;
            default:
                return [
                    'error' => true,
                    'msg' => 'Falsches Dateiformat'
                ];
                break;

        }

        include_once PATH_EXTENSION . 'models' . DS .'Item.class.php';
        $class = new extBoardModelItem();

        $filename = $type.'_' . time() . rand(100, 999);

        if ( $ret = $class->uploadFile($file, $filename,'ext_board/board_'.$id) ) {

            $ret['success'] = true;
            return $ret;

        }





        return [
            'error' => true,
            'msg' => 'Nicht Erfolgreich!'
        ];

    }


    /**
     * Set Allowed Request Method
     * (GET, POST, ...)
     *
     * @return String
     */
    public function getAllowedMethod()
    {
        return 'POST';
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
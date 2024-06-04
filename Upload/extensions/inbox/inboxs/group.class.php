<?php

/**
 *
 */
class extInboxRecipientGroup
{


    /**
     * Constructor
     * @param $data
     */
    public function __construct()
    {

    }


    public static function getTitle($inbox_id = false)
    {
        if (!(int)$inbox_id) {
            return false;
        }

        include_once PATH_EXTENSION . 'models' . DS . 'Inbox2.class.php';
        $class = new extInboxModelInbox2();
        $inbox = $class->getByID((int)$inbox_id);

        if ($inbox->getData('title')) {
            return $inbox->getData('title');
        }

        return false;
    }


    /**
     * @return Array[]
     */
    public static function getInboxs($inbox_id = false)
    {

        if (!(int)$inbox_id) {
            return false;
        }

        include_once PATH_EXTENSION . 'models' . DS . 'Inbox2.class.php';
        $class = new extInboxModelInbox2();
        $inbox = $class->getByID($inbox_id);

        if ($inbox) {
            $inbox_collection = $inbox->getCollection(true);
            if ($inbox_collection) {
                return [$inbox_collection];
            }
        }

        return false;



    }


}
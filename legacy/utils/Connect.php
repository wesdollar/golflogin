<?php

class Connect {

    protected $host = null;
    protected $user = null;
    protected $pass = null;
    protected $db = null;
    protected $supportContact = null;

    public function __construct() {

        $whoami = null;

        if (file_exists('/Library/WebServer/Documents/golo_live/_stable/env.txt')) {
            $whoami = gethostname();
        }

        if ($whoami == 'wd.local') {
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "564406";
            $this->db = "golo_dev";
        }
        else {
            $this->host = "localhost";
            $this->user = "golostat_admin";
            $this->pass = "564406";
            $this->db = 'golostat_demo';
        }

        $contactPhone = '(229) 292-0507';
        $contactName = 'Wes Dollar';
        $contactEmail = 'wes@webitguys.com';
        $supportMsg = '<p>For additional support, please contact ' . $contactName . ' at ' . $contactPhone . ' or via ' . $contactEmail . '.';
        $this->supportContact = $supportMsg;
    }

    public function cxn($db = null) {

        $this->db = (!$db) ? $this->db : $db;

        date_default_timezone_set('America/New_York');
        // $cxn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die('Unable to connect to DB. ' . __CLASS__);
        $cxn = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die('Unable to connect to DB. ' . __CLASS__);
        return $cxn;
    }

}
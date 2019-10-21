<?php

namespace models\user;

class AppUserRecord extends UserRecord {

    public static function instance($table = '_user') {
        return parent::instance($table);
    }
    
    public function auth($mail, $password) {
        return parent::auth($mail, $password);
    }

}

<?php

namespace models\content;

class AppOrderReader extends ContentReader {

    /**
     * @return AppServiceReader
     */
    public static function instance($table = 'order') {
        return parent::instance($table);
    }

    public function reader() {
        return parent::reader();
    }

    public function getOneWithItems($id) {
        return parent::getOneWithItems($id);
    }

}

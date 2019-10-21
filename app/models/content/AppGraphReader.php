<?php

namespace models\content;

class AppGraphReader extends ContentReader {

    public static function instance($table = 'graph') {
        return parent::instance($table);
    }

    public function getListItems($search = '') {
        $sort = [
            'field' => 'title',
            'dir' => 'ASC'
        ];
		$search = trim($search);
		if (!empty($search)) {
			$db = $this->db();
			$q = 'SELECT * FROM ' . $db->quotekey($this->table) . ' WHERE `title` LIKE '. $db->quote('%'.$search.'%');
			$list = $db->exec($q);
		} else {
			$list = parent::getAll();
		}
//        $list = parent::getList(0, 1000, true, $sort);
        $arList = [];
        foreach ($list as $item) {
            $adres = explode(",", $item['title']);
			if (count($adres) == 3) {
				$title = $adres[1].', '.$adres[2].', '.$adres[0];
				$street = explode(" ", $adres[1]);
			} elseif (count($adres) == 4) {
				if (mb_strpos($adres[3], 'кв.') !== false) {
					$title = $adres[1].', '.$adres[2].', '.$adres[3].', '.$adres[0];
					$street = explode(" ", $adres[1]);
				} else {
					$title = $adres[2].', '.$adres[3].', '.$adres[1].', '.$adres[0];
					$street = explode(" ", $adres[2]);
				}
			} elseif (count($adres) == 5) {
				if (mb_strpos($adres[3], 'корпус') !== false) { 	// Улица, дом, корпус, квартира
					$title = $adres[1].', '.$adres[2].', '.$adres[3].', '.$adres[4].', '.$adres[0];
					$street = explode(" ", $adres[1]);
				} else {											// Улица, дом, квартира, посёлок, район/город
					$title = $adres[2].', '.$adres[3].', '.$adres[4].', '.$adres[1].', '.$adres[0];
					$street = explode(" ", $adres[2]);
				}
			} else {
				$title = $item['title'];
				$street = explode(" ", $adres[2]);
			}
			$title = trim($title);
            $fin = array(
                "date" => "",
                "house" => "",
                "street" => "",
                "title" => $title
            );
            $litera = false;
            foreach ($street as $val) {
                if (strlen($val) > 1) {
					if (mb_substr($val, 0, 3) == 'ул.') {
						$val = mb_substr($val, 3);
					}
                    if ($litera === false) {
                        $litera = mb_strtolower(mb_substr($val, 0, 1));
                    }
                    if ($val === "ул") {
                        $fin['street'] .= " улица";
                    } else {
                        $fin['street'] .= " " . $val;
                    }
                }
            }
            $fin['date'] = $item['af_date'];
//            for ( $i = 2; $i < count($adres); $i++ ) {
//                $fin['house'] = $fin['house'] . " " .$adres[$i];
//            }
            $arList[$litera][] = $fin;
			ksort($arList);
        }
        return $arList;
    }

}

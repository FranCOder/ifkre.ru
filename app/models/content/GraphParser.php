<?php

namespace models\content;

/** PHPExcel_IOFactory */
include 'vendor/PHPOffice/PHPExcel/Classes/PHPExcel.php';

class GraphParser extends \Prefab {

    use \FrameworkAbstraction;
    use \Debug;

    static protected $instance = null;

    protected function __construct() {
        $this->fw = \Base::instance();
    }

    public function run($file) {
        $inputFileType = 'Excel5';
		//  $inputFileType = 'Excel2007';
        //	$inputFileType = 'Excel2003XML';
        //	$inputFileType = 'OOCalc';
        //	$inputFileType = 'Gnumeric';
        $inputFileName = $file;
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        $arDates = [];
        foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
            $full = true;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $data = [];
            foreach ($cellIterator as $i => $cell) {
                if ($full === true) {
                    if (!is_null($cell)) {
						$value = $cell->getValue();
                        if (!empty($value) && $value !== "Адрес абонента") {
                            $data[$i] = $value;
                        } else {
                            $full = false;
                        }
                    }
                }
            }
            if ($full === true) {
                $arDates[] = $data;
			}
        }
        return $arDates;
    }
    
    protected function notEmptyColumns($cols, $data) {
        if (!is_array($cols)) {
            $cols = explode(',', $cols);
        }
        return array_reduce(
                $cols, function ($res, $col) use ($data) {
            return $res && !empty($data[$col]);
        }, true
        );
    }

    protected function isEmptyColumns($cols, $data) {
        if (!is_array($cols)) {
            $cols = explode(',', $cols);
        }
        return array_reduce(
                $cols, function ($res, $col) use ($data) {
            return $res && empty($data[$col]);
        }, true
        );
    }

}

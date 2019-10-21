<?php

namespace models\content;

class AppServiceReader extends ContentReader {

	/**
	 * @return AppServiceReader
	 */
	public static function instance($table='service') {
		return parent::instance($table);
	}
	
	public function getListByFilter($filters, $options = null) {
		$res = parent::getListByFilter($filters, $options);
		if (!empty($res)) {
			foreach ($res as $k => $v) {
				$this->setStepsAndDocs($res[$k]);
			}
		}
		return $res;
	}
	
	public function getHtmlpageServices($id) {
		return $this->getListByFilter([
			['field' => 'published', 'value' => '1'],
			['field' => 'fko_htmlpage', 'value' => $id]
		]);
	}
	
	protected function setStepsAndDocs(&$one) {
		$one['steps'] = ContentReader::instance('service_step')->getListByFilter([
			['field' => 'published', 'value' => '1'],
			['field' => 'fko_service', 'value' => $one['id']]
		]);
		
		$one['docs'] = ContentReader::instance('service_doc')->getListByFilter([
			['field' => 'published', 'value' => '1'],
			['field' => 'fko_service', 'value' => $one['id']]
		]);
		
		$one['legal'] = ContentReader::instance('doc')->getListByFilter([
			['field' => 'published', 'value' => '1'],
			['field' => 'fko_service', 'value' => $one['id']]
		]);
                
        $one['references'] = ContentReader::instance('reference')->getListByFilter([
			['field' => 'published', 'value' => '1'],
			['field' => 'fko_service', 'value' => $one['id']]
		]);
	}
	
}
<?php

namespace models\content;

class AppBannerReader extends ContentReader {
	
	public function getListPublished($options = null) {
		$res = parent::getListPublished();
		foreach ($res as $k => $v) {
			$res[$k]['style'] = ContentReader::instance('banner_style')->getOne($v['fko_banner_style']);
		}
		return $res;
	}
	
}
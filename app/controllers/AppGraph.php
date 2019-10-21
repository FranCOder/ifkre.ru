<?php

namespace controllers;

class AppGraph extends Content {
	
	protected $table = 'graph';

	public function form() {
		parent::form();
		$this->set('html.inc', $this->get('site.tpl').'/xls/form.html');
    }
	
}
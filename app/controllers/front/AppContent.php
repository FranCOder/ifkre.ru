<?php

namespace controllers\front;

use models\content\ContentReader;
use models\content\AppBannerReader;
use models\content\AppServiceReader;
use models\content\AppGraphReader;
use models\user\AppUserRecord;
use Ekapusta\OAuth2Esia\EsiaService;

class AppContent extends Content {

    protected $tpldir = 'ifkre.ru';
    protected $layout = 'layout.html';
    protected $page_layout = 'inner';

    /**
     * 
     * @return \helpers\AppLayout
     */
    protected function layout() {
        return \helpers\AppLayout::instance();
    }

    public function home() {
        $this->show();
		$this->set('home_tabs', $this->layout()->getHomeMenuTabs());
        $this->set('list_banner', AppBannerReader::instance('banner')->getListPublished());
        $this->set('list_brand', ContentReader::instance('brand')->getListPublished());
        $this->set('list_advantage', ContentReader::instance('advantage')->getListPublished());
        $this->page_layout = 'home';
    }
    
    public function calc() {
        parent::show();
        $this->page_layout = 'rashod';

        $list = ContentReader::instance('calc_calc')->getListPublished();
        foreach ($list as $item) {
            $calc['ID'] = 'calc' . $item['id'];
            $calc['TEXT'] = json_encode($item['af_desc']);
            $listCalc[] = $calc;
            unset($calc);
        }
        $this->set('listCalc', $listCalc);
        unset($list);

        $list = ContentReader::instance('calc_const')->getListPublished();
        foreach ($list as $item) {
            $calc['ID'] = $item['af_id'];
            $calc['VALUE'] = $item['af_value'];
            $listConst[] = $calc;
            unset($calc);
        }
        $this->set('listConst', $listConst);
        unset($list);

        $list = ContentReader::instance('calc_option')->getListPublished();
        foreach ($list as $item) {
            $calc['ID'] = 'sum' . $item['id'];
            $calc['VALUE'] = $item['af_value'];
            $calc['TEXT'] = json_encode(htmlspecialchars_decode($item['af_desc']));
            $listOption[] = $calc;
            unset($calc);
        }
        $this->set('listOption', $listOption);
    }

    public function show() {
        parent::show();
        $services = AppServiceReader::instance()->getHtmlpageServices($this->struct_page['id']);
        if (!empty($services)) {
            $this->set('html.inc', $this->tpldir . '/service/list.html');
			$b_fields = ['online', 'email', 'office', 'post'];
			foreach ($services as $k => $s) {
				$services[$k]['buttons'] = [];
				foreach ($b_fields as $name) {
					if (!empty($s['af_'.$name])) {
						$services[$k]['buttons'][$name] = $s['af_'.$name];
					}
				}
			}
            $this->set('services', $services);
        }
    }
    public function graph() {
		$graph = AppGraphReader::instance();
		if ($this->exists('GET.search', $search)) {
			$list = $graph->getListItems($search);
		} else {
			$list = $graph->getListItems();
		}
		$this->set('list', $list);
		if ($this->get('AJAX')) {
			$tmp = $this->tpldir;
			$this->setBlankLayout();
			$this->tpldir = $tmp;
			$this->set('inc', $this->tpldir.'/graph/list.html');
		} else {
			$this->show();
			$this->page_layout = "graph";
		}
    }
    public function fl_tp() {
        $this->show();
        $this->set('html.buttons', $this->tpldir . '/pages/fl_tp.html');
    }

    public function fl_tp_zayavka() {
        if ( !$this->layout()->isAuthorized() ) {
            AppUserRecord::instance()->auth('simple@simple.ru', 'qwerty');
        } 
        $user = $this->layout()->getAuthorizedUser();
        $this->show();
        $this->set('html.inc', $this->tpldir . '/forms/tp.html');
        $this->set('include_form_scripts', true);
    }

    public function fl_tp_zayavka_post() {
        $this->fl_tp_zayavka();
        $data = $this->get('POST');
        $files = $this->get('FILES');
    }

    public function search() {
        parent::search();
        $this->page_layout = 'search';
    }
    
    public function loaderXls() {
        $this->show();
        $user = $this->layout()->getAuthorizedUser();
        if ( $user !== false && $user['id'] != 4 ) {
            $this->set('html.inc', $this->tpldir . '/xls/form.html');
        } else {
            $this->set('html.inc', $this->tpldir . '/xls/alert.html');
        }
    }

    public function loginForm()
    {
        parent::loginForm();
        $this->layout = 'layout.html';
        $this->page_layout = 'login-register';
    }
}

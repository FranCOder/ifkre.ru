<?php

namespace helpers;

use models\content\ContentReader;
use Ekapusta\OAuth2Esia\EsiaService;

class AppLayout extends Layout {

    public function setMenus($url) {
        parent::setMenus($url);
        $menu = $this->get('MENUS.main');
        $footer = [];
        foreach ($menu as $k => $v) {
            $node = $this->structReader()->getOne($v['id']);
            if (!$node['af_hide_in_footer']) {
                if ($v['childs'] > 0) {
                    $childs = $this->structReader()->getChildsFast($v['id'], false);
                    foreach ($childs as $c) {
                        $v['subpages'][$k . '/' . $c['slug']] = $this->getMenuItemTitle($c);
                    }
                }
                $footer[$k] = $v;
            }
        }
        $this->set('MENUS.footer', $footer);
        $this->setSettings();
        $this->setEsiaLink();
    }
    
    public function setEsiaLink() {
        $config = \helpers\EsiaConfig::getConfig();
        $service = new EsiaService($config);
        $_SESSION['esia.state'] = $service->generateState();
        $authUrl = $service->getAuthorizationUrl($_SESSION['esia.state']);
        echo '<!--'.$authUrl.'-->';
        $this->set('esia', $authUrl);

    }

    public function setSettings() {
        if (!$this->exists('html.settings')) {
            $res = ContentReader::instance('settings')->getAll();
            $settings = [];
            foreach ($res as $v) {
                $settings[$v['slug']] = $v['af_val'];
            }
            $this->set('html.settings', $settings);
        }
    }

    public function setProperties($page) {
        parent::setProperties($page);
        $this->set('html.page_title_add', $page['af_title_add']);
    }
    
    public function userReader() {
        return \models\user\UserReader::instance();
    }
    
    public function isAuthorized() {
        if ( $this->getAuthorizedUser() ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getAuthorizedUser() {
        if ($this->exists('COOKIE.user_sign', $sign)) {
            return $this->userReader()->getBySign($sign);
        } else {
            return null;
        }
    }

	
	public function getHomeMenuTabs() {
		$tabs = ContentReader::instance('main_menu_tab')->getListPublished();
		if (!empty($tabs)) {
			foreach ($tabs as $k => $v) {
				$blocks = ContentReader::instance('main_menu_tab_block')->getListByFilter([
					['field' => 'published', 'value' => '1'],
					['field' => 'fko_main_menu_tab', 'value' => $v['id']],
				], ['order' => ['sort ASC']]);
				if (!empty($blocks)) {
					foreach ($blocks as $k2 => $v2) {
						$blocks[$k2]['links'] = ContentReader::instance('main_menu_link')->getListByFilter([
							['field' => 'published', 'value' => '1'],
							['field' => 'fko_main_menu_tab_block', 'value' => $v2['id']],
						], ['order' => ['sort ASC']]);
					}
					$tabs[$k]['blocks']= $blocks;
				}
			}
		}
		return $tabs;
	}
}

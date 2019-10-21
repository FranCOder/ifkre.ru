<?php


namespace controllers\front;

use Ekapusta\OAuth2Esia\EsiaService;

class AppProfile extends AppContent
{
    protected $table = 'order';
    protected $tpldir = 'ifkre.ru';
    protected $layout = 'layout.html';
    protected $page_layout = 'inner';


    public function home()
    {
        if (!$this->exists('SESSION.esia.user', $esiaPersonData)) {
            if ($this->exists('GET.state', $state) && $this->exists('GET.code', $code)) {
                $service = new EsiaService(\helpers\EsiaConfig::getConfig());
                $esiaPersonData = $service->getResourceOwner($_SESSION['esia.state'], $state, $code);
            } else {
                \helpers\Msg::error('Необходимо авторизоваться через портал ГосУслуги');
                $this->reroute('@home');
            }
        }
//        die(var_dump($esiaPersonData));
        $this->set('SESSION.esia.user', $esiaPersonData);

        $db1c = \helpers\EsiaConfig::get1cdb();
        $kontragents = $db1c->exec("SELECT * FROM kontragents WHERE Series = :series AND Number = :number",
            array(':series' => $esiaPersonData['documents']['elements'][0]['series'],
                  ':number' => $esiaPersonData['documents']['elements'][0]['number']));

        $this->set('SESSION.kontragent', $kontragents);

        $zayavki = $db1c->exec("SELECT * FROM online_zayavka WHERE `doc-serial` = :series AND `doc-number` = :number",
            array(':series' => $esiaPersonData['documents']['elements'][0]['series'],
                ':number' => $esiaPersonData['documents']['elements'][0]['number']));

        foreach($kontragents AS $kontragent) {
            $dogovors = $db1c->exec("SELECT * FROM dogovor WHERE kontragent_id = :id", array(':id' => $kontragent['kontragent_id']));
        }

        $this->setLayout();
        $this->layout()->setProperties(['title' => 'Личный кабинет']);
        $this->layout()->setSettings();
        $this->layout()->addLevelToBreadCrumbs(array(
            '/' => "Главная",
        ));

        $this->set('html.inc', $this->tpldir.'/lk/show.html');
        $this->set('kontragents', $kontragents);
        $this->set('dogovors', $dogovors);
        $this->set('zayavki', $zayavki);
//        $this->set('esia', $esia);
    }
    
    public function logout() {
        $this->clear('SESSION.esia');
        $this->reroute($this->alias('home'));
    }
    
}
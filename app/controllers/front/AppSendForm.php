<?php

namespace controllers\front;

use helpers\Msg;
use models\content\AppOrderReader;

class AppSendForm extends Content {

    protected $tpldir = 'ifkre.ru';
    protected $layout = 'alert.html';
    protected $table = "order";
    protected $cache_output = false;
    protected $data;
    protected function layout() {
        return \helpers\AppLayout::instance();
    }

    protected function reader() {
        return AppOrderReader::instance();
    }

    public function convertForm() {
        $this->data = $this->get('POST');
        $html = "";
        //echo "<pre>"; print_r($data); echo "</pre>";
        //echo "<pre>"; print_r($data); echo "</pre>";
        foreach ($this->data as $block) {
            $html .= $block['title'] . ': <br/>';
            foreach ($block['item'] as $item) {
                if (is_array($item['title'])) {
                    $html .= $item['title'][$item['value']] . " - " . $item['value'] . "<br/>";
                } else {
                    $html .= $item['title'] . " - " . $item['value'] . "<br/>";
                }
            }
            $html .= "<br/>";
        }
        return $html;
    }

    public function nodeById() {
        $this->set('PARAMS.id', $this->get('SESSION.node'));
        $model = $this->reader();
        if ($this->setNode($model->getOneWithItems($this->get('PARAMS.id'), true))) {
            $node = $this->get('node');
            echo "<pre>"; print_r($node); echo "</pre>";
        }
    }

    public function sendForm() {
        $html = $this->convertForm();
        $this->saveForm();
        $this->sendMessage($html);
    }

    public function setUserMailOrder() {
        $res = \models\content\ContentReader::instance('settings')->getBySlug('order_text');
        $html = 'Ваша заявка №'.$this->get('SESSION.node').' принята в обработку';
        if (strlen($res['af_val']) > 0) {
            $html .= '<br/>'.$res['af_val'];
        }
        if (\helpers\Tools::mail(
                        $this->data['name']['item']['email']['value'],
                        'Заявка на технологическое присоединение', $html, $this->get('email.from')
                )) {
         //   return true;
        } else {
           // return false;
        }
    }

    public function sendMessage($html) {
        $this->nodeById();
        $this->get("SESSION.node");
        $this->set("DEBUG", false);
        if (\helpers\Tools::mail(
                        $this->get('email.admin'),
                        //'peterpostbox001@gmail.com',
                        'Заявка на технологическое присоединение', $html, $this->get('email.from')
                )) {
            if ( !empty($this->data['name']['item']['email']['value']) ) {
                $this->setUserMailOrder();
            }
            $result['success'] = "Отправлено";
            Msg::success("Ваш заявка принята. Номер заявки #".$this->get('SESSION.node'), null, true);
        } else {
            $result['error'] = "Ошибка";
            Msg::error("Ошибка отправки сообщения. Попробуйте повторить позже.", null, true);
        }
        echo json_encode($result);
    }

    public function saveForm()
    {

        $db1c = \helpers\EsiaConfig::get1cdb();
        $this->data = $this->get('POST');
        $this->exists('SESSION.kontragent.0.kontragent_id', $kontragent_id);

        $form = array(
          'fio_f'  => $this->data['name']['item']['fio_f']['value'],
          'fio_i'  => $this->data['name']['item']['fio_i']['value'],
          'fio_o'  => $this->data['name']['item']['fio_o']['value'],
          'phone'  => $this->data['name']['item']['phone']['value'],
          'email'  => $this->data['name']['item']['email']['value'],

          'reg-index'  => $this->data['reg']['item']['index']['value'],
          'reg-city'   => $this->data['reg']['item']['city']['value'],
          'reg-street' => $this->data['reg']['item']['street']['value'],
          'reg-house'  => $this->data['reg']['item']['house']['value'],
          'reg-number' => $this->data['reg']['item']['number']['value'],
          'reg-flat'   => $this->data['reg']['item']['flat']['value'],

          'post-index'  => $this->data['post']['item']['index']['value'],
          'post-city'   => $this->data['post']['item']['city']['value'],
          'post-street' => $this->data['post']['item']['street']['value'],
          'post-house'  => $this->data['post']['item']['house']['value'],
          'post-number' => $this->data['post']['item']['number']['value'],
          'post-flat'   => $this->data['post']['item']['flat']['value'],

          'doc-serial'  => $this->data['doc']['item']['serial']['value'],
          'doc-number'  => $this->data['doc']['item']['number']['value'],
          'doc-code'    => $this->data['doc']['item']['code']['value'],
          'doc-place'   => $this->data['doc']['item']['place']['value'],
          'doc-who'     => $this->data['doc']['item']['who']['value'],
          'doc-when'    => $this->data['doc']['item']['when']['value'],

          'target'     => $this->data['target']['item']['base']['value'],

          'obj'        => $this->data['obj']['item']['type']['value'],
          'obj-status' => $this->data['obj']['item']['status']['value'],

          'place-region' => $this->data['place']['item']['region']['value'],
          'place-dist'   => $this->data['place']['item']['dist']['value'],
          'place-city'   => $this->data['place']['item']['city']['value'],
          'place-street' => $this->data['place']['item']['street']['value'],
          'place-house'  => $this->data['place']['item']['house']['value'],
          'place-number' => $this->data['place']['item']['number']['value'],
          'place-flat'   => $this->data['place']['item']['flat']['value'],
          'place-kad'    => $this->data['place']['item']['kad']['value'],
          'place-type'   => $this->data['place']['item']['type']['value'],
          'place-volume' => $this->data['place']['item']['volume']['value'],
          'place-max'    => $this->data['place']['item']['max']['value'],

          'proekt1-name'  => $this->data['proekt1']['item']['name']['value'],
          'proekt1-month' => $this->data['proekt1']['item']['month']['value'],
          'proekt1-year'  => $this->data['proekt1']['item']['year']['value'],

          'proekt2-name'  => $this->data['proekt2']['item']['name']['value'],
          'proekt2-month' => $this->data['proekt2']['item']['month']['value'],
          'proekt2-year'  => $this->data['proekt2']['item']['year']['value'],

          'proekt3-name'  => $this->data['proekt3']['item']['name']['value'],
          'proekt3-month' => $this->data['proekt3']['item']['month']['value'],
          'proekt3-year'  => $this->data['proekt3']['item']['year']['value'],

          'plan1-name'  => $this->data['plan1']['item']['name']['value'],
          'plan1-month' => $this->data['plan1']['item']['month']['value'],
          'plan1-year'  => $this->data['plan1']['item']['year']['value'],

          'plan2-name'  => $this->data['plan2']['item']['name']['value'],
          'plan2-month' => $this->data['plan2']['item']['month']['value'],
          'plan2-year'  => $this->data['plan2']['item']['year']['value'],

          'plan3-name'  => $this->data['plan3']['item']['name']['value'],
          'plan3-month' => $this->data['plan3']['item']['month']['value'],
          'plan3-year'  => $this->data['plan3']['item']['year']['value'],

          'almost-number' => $this->data['almost']['item']['number']['value'],
          'almost-data'   => $this->data['almost']['item']['data']['value'],
          'almost-right'  => $this->data['almost']['item']['right']['value'],

          'ready-type'    => $this->data['ready']['item']['type']['value'],

        );


        $db1c->exec("CREATE TABLE IF NOT EXISTS `ifkre_1c`.`online_zayavka` 
          (`id` INT(11) NOT NULL AUTO_INCREMENT ,
          `kontragent_id` INT(11) NULL ,
          `fio_f` VARCHAR(128) NOT NULL ,
          `fio_i` VARCHAR(128) NOT NULL ,
          `fio_o` VARCHAR(128) NOT NULL , 
          `phone` VARCHAR (32) NOT NULL , 
          `email` VARCHAR (32) NOT NULL , 
          `reg-index` VARCHAR(11) NOT NULL , 
          `reg-city` VARCHAR (32) NOT NULL , 
          `reg-street` VARCHAR (32) NOT NULL , 
          `reg-house` VARCHAR(11) NOT NULL , 
          `reg-number` VARCHAR (11) NOT NULL , 
          `reg-flat` VARCHAR (11) NOT NULL , 
          `post-index` VARCHAR (11) NOT NULL , 
          `post-city` VARCHAR (11) NOT NULL , 
          `post-street` VARCHAR (32) NOT NULL , 
          `post-house` VARCHAR (11) NOT NULL , 
          `post-number` VARCHAR (11) NOT NULL , 
          `post-flat` VARCHAR (11) NOT NULL , 
          `doc-serial` VARCHAR (11) NOT NULL , 
          `doc-number` VARCHAR (11) NOT NULL , 
          `doc-code` VARCHAR (11) NOT NULL , 
          `doc-place` VARCHAR (32) NOT NULL , 
          `doc-who` VARCHAR (32) NOT NULL , 
          `doc-when` VARCHAR (11) NOT NULL , 
          `target` VARCHAR (11) NOT NULL , 
          `obj` VARCHAR (11) NOT NULL , 
          `obj-status` VARCHAR (11) NOT NULL , 
          `place-region` VARCHAR (32) NOT NULL , 
          `place-dist` VARCHAR (32) NOT NULL , 
          `place-city` VARCHAR (32) NOT NULL , 
          `place-street` VARCHAR (32) NOT NULL , 
          `place-house` VARCHAR (11) NOT NULL , 
          `place-number` VARCHAR (11) NOT NULL , 
          `place-flat` VARCHAR (11) NOT NULL , 
          `place-kad` VARCHAR (11) NOT NULL , 
          `place-type` VARCHAR (11) NOT NULL , 
          `place-volume` VARCHAR (11) NOT NULL , 
          `place-max` VARCHAR (11) NOT NULL , 
          `proekt1-name` VARCHAR (11) NOT NULL , 
          `proekt1-month` VARCHAR (11) NOT NULL , 
          `proekt1-year` VARCHAR (11) NOT NULL , 
          `proekt2-name` VARCHAR (11) NOT NULL , 
          `proekt2-month` VARCHAR (11) NOT NULL , 
          `proekt2-year` VARCHAR (11) NOT NULL , 
          `proekt3-name` VARCHAR (11) NOT NULL , 
          `proekt3-month` VARCHAR (11) NOT NULL , 
          `proekt3-year` VARCHAR (11) NOT NULL , 
          `plan1-name` VARCHAR (11) NOT NULL , 
          `plan1-month` VARCHAR (11) NOT NULL , 
          `plan1-year` VARCHAR (11) NOT NULL , 
          `plan2-name` VARCHAR (11) NOT NULL , 
          `plan2-month` VARCHAR (11) NOT NULL , 
          `plan2-year` VARCHAR (11) NOT NULL , 
          `plan3-name` VARCHAR (11) NOT NULL , 
          `plan3-month` VARCHAR (11) NOT NULL , 
          `plan3-year` VARCHAR (11) NOT NULL , 
          `almost-number` VARCHAR (11) NOT NULL , 
          `almost-data` VARCHAR (11) NOT NULL , 
          `almost-right` VARCHAR (32) NOT NULL , 
          `ready-type` VARCHAR (11) NOT NULL , 
          `status` VARCHAR(11) NOT NULL ,
           PRIMARY KEY (`id`))"
        );
        $db1c->exec('INSERT INTO online_zayavka VALUES(
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
            )',
            array(
                1 => NULL,
                2  => $kontragent_id,
                3  => $form['fio_f'],
                4  => $form['fio_i'],
                5  => $form['fio_o'],
                6  => $form['phone'],
                7  => $form['email'],
                8  => $form['reg-index'],
                9  => $form['reg-city'],
                10  => $form['reg-street'],
                11 => $form['reg-house'],
                12 => $form['reg-number'],
                13 => $form['reg-flat'],
                14 => $form['post-index'],
                15 => $form['post-city'],
                16 => $form['post-street'],
                17 => $form['post-house'],
                18 => $form['post-number'],
                19 => $form['post-flat'],
                20 => $form['doc-serial'],
                21 => $form['doc-number'],
                22 => $form['doc-code'],
                23 => $form['doc-place'],
                24 => $form['doc-who'],
                25 => $form['doc-when'],
                26 => $form['target'],
                27 => $form['obj'],
                28 => $form['obj-status'],
                29 => $form['place-region'],
                30 => $form['place-dist'],
                31 => $form['place-city'],
                32 => $form['place-street'],
                33 => $form['place-house'],
                34 => $form['place-number'],
                35 => $form['place-flat'],
                36 => $form['place-kad'],
                37 => $form['place-type'],
                38 => $form['place-volume'],
                39 => $form['place-max'],
                40 => $form['proekt1-name'],
                41 => $form['proekt1-month'],
                42 => $form['proekt1-year'],
                43 => $form['proekt2-name'],
                44 => $form['proekt2-month'],
                45 => $form['proekt2-year'],
                46 => $form['proekt3-name'],
                47 => $form['proekt3-month'],
                48 => $form['proekt3-year'],
                49 => $form['plan1-name'],
                50 => $form['plan1-month'],
                51 => $form['plan1-year'],
                52 => $form['plan2-name'],
                53 => $form['plan2-month'],
                54 => $form['plan2-year'],
                55 => $form['plan3-name'],
                56 => $form['plan3-month'],
                57 => $form['plan3-year'],
                58 => $form['almost-number'],
                59 => $form['almost-data'],
                60 => $form['almost-right'],
                61 => $form['ready-type'],
                62 => 0
            ));
    }

}

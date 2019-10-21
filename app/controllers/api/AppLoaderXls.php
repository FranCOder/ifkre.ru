<?php

namespace controllers\api;

use models\content\GraphParser;
use models\ACL\ACLReader as ACL;

class AppLoaderXls extends Content {

    protected $table = 'graph';
    protected $list;
    protected $arFiles;
    protected $res;

    public function record() {
        return parent::record();
    }

    public function reader() {
        return parent::reader();
    }
	
	public function deleteAll() {
		if ($this->checkAccess(ACL::ACTION_DELETE, $this->user['id'])) {
			$del_res = $this->db()->exec('DELETE FROM graph');
			if ($del_res === false) {
				$res['result'] = false;
				$res['error'] = 'Ошибка при удалении записей';
			} else {
				$res['result'] = true;
				$res['success'] = 'Записи успешно удалены';
			}
		} else {
			$res = $this->res401('delete');
		}
		$this->result($res);
	}

    public function delete() {
        if ($this->exists('POST.id', $id)) {
            $one = $this->reader()->getOne($id);
            if ($this->checkAccess(ACL::ACTION_DELETE, $one['user_id'])) {
                $del_res = $this->record()->deleteforever($id);
                if ($del_res !== \models\content\ContentRecord::DELETE_SUCCESS) {
                    $res['result'] = false;
                    $res['error'] = 'node.delete_res.' . $del_res;
                } else {
                    $res = ['result' => true];
                }
            } else {
                $res = $this->res401('delete');
            }
        } else {
            $res = $this->res404();
        }
        //$this->result($res);
    }

    public function parseXls() {
        
        $this->arFiles = $this->uploadXls();
        if (count($this->arFiles) > 0) {
            foreach ($this->arFiles as $path => $bool) {
                $this->parser = GraphParser::instance()->run($path);
                if (is_array($this->parser) && !empty($this->parser)) {
                    if ( !$this->updateItems() ) {
                        $this->res['error'] = "Ошибка при добавлении элементов";
                    }
                } else {
                    $this->res['error'] = "Ошибка парсинга файла";
                }
                unlink($path);
            }
        } else {
            $this->res['error'] = 'Файл не выбран';
        }
        if ( !isset($this->res['error']) && empty($this->res['error']) ) {
            $this->res['success'] = 'Добавление данных успешно завершено';
        }
        echo json_encode($this->res);
    }

    protected function updateItems() {
//        if ($this->deleteItems()) {
            foreach ($this->parser as $item) {
                if ( !$this->createItem($item['B'], $item['C']) ) {
                   return false;
                }
            }
//        }
        return true;
    }

    protected function getListItem() {
        $this->list = $this->reader()->getListPublished();
    }

    protected function deleteItems() {
        $this->getListItem();
        if (is_array($this->list) && !empty($this->list)) {
            foreach ($this->list as $item) {
                $this->set("POST.id", $item['id']);
                $this->delete();
                $this->set("POST.id", null);
            }
        }
        return true;
    }

    public function createItem($title, $date) {
        $this->set('POST.title', $title);
        $this->set('POST.af_date', $date);
        $this->set('POST.user_id', 3);
        $res = $this->record()->create($this->get('POST'));
        //$this->result($res);
        if ( !empty($res['success']) && isset($res['success']) )
            return true;
        else
            return false;
    }

    protected function uploadXls() {
        $web = \Web::instance();
//        $this->set('UPLOADS', 'uploads/'); // don't forget to set an Upload directory, and make it writable!
        $overwrite = false; // set to true, to overwrite an existing file; Default: false
        $slug = true; // rename file to filesystem-friendly version
        $files = $web->receive(function($file, $formFieldName) {
					if ($file['size'] > (2 * 1024 * 1024)) // if bigger than 2 MB
						return false;
					return true;
				}, $overwrite, $slug
			);
        return ($files);
    }

}

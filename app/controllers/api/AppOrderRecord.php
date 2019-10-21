<?php

namespace controllers\api;

class AppOrderRecord extends Content {

    protected $table = 'order';

    public function record() {
        return parent::record();
    }

    protected function setNode() {
        $id = $this->get("POST.id");
        $this->set('PARAMS.id', $id);
        if ($this->exists('PARAMS.id', $id) && is_numeric($id)) {
            $this->node = $this->reader()->getOne($id);
            if (is_null($this->node)) {
                $this->error(404);
            }
            if (!$this->checkAccess(\models\ACL\ACLReader::ACTION_UPDATE, $this->node['user_id'])) {
                Msg::error('update_no_rights');
                $this->error(401);
            }
        } else {
            $this->error(406);
        }
        return true;
    }
    
    public function uploader() {
        $id = $this->get("POST.id");
        $this->exists('SESSION.node', $node);
        if ( empty($node) )
            $this->set('SESSION.node', $id);
        $this->set('PARAMS.id', $id);
        parent::uploader();
    }

    public function upload() {
        $this->setNode();
        $field_meta = $this->getUploadableFieldMeta();
        $this->scrub($_POST);
        if (!$this->record()->upload($this->node['id'], $field_meta['fullname'], $this->get('POST.content'), false)) {
            $this->error(406);
        } else {
            $this->node = $this->reader()->getOne($this->node['id']); // Надо получить данные заново, так как нод был обновлён
            $result['success'] = true;
        }
        echo json_encode($result);
    }

    public function update() {
        parent::update();
    }
    
    public function refresh() {
        $this->exists('SESSION.node', $node);
        if ( empty($node) ) {
            $result['refresh'] = true;
        } else {
            $result['ready'] = true;
        }
        echo json_encode($result);
    }
    
    public function create() {
        $this->set('POST.user_id', 4);
        $res = $this->record()->create($this->get('POST'));
        $this->result($res);
        $this->set('SESSION.node', $res['result']);
        return $res;
    }
    
}

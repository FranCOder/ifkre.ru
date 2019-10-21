<?php

namespace controllers\api;

class AppOrderAddRecord extends ContentItem {

    protected $table = 'order';

    private function getUploaderOptions($method) {
        return [
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i',
            'script_url' => $this->alias(
                    'backend_content_item_uploader_' . $method, [
                'table' => $this->table,
                'id' => $this->node['id']
                    ]
            ),
            'upload_dir' => $this->get('UPLOADS'),
            'user_dirs' => true,
            'download_via_php' => 1
        ];
    }

    public function record() {
        return parent::record();
    }

    public function beforeroute() {
        $id = $this->get("POST.id");
        $this->set('PARAMS.id', $id);
        $this->setNode();

        parent::beforeroute();
    }

    public function reader() {
        return \models\content\ContentReader::instance($this->table);
    }

    protected function setNode() {
        if ($this->exists('PARAMS.id', $id) && is_numeric($id)) {
            //echo "<pre>"; print_r($this->reader()); echo "</pre>";
            $this->node = $this->reader()->getOne($id);
            if (is_null($this->node)) {
                $this->error(404);
            }
        } else {
            $this->error(406);
        }
        return true;
    }

    public function upload() {
        return parent::upload();
    }

    public function uploader() {
        if (!$this->checkAccess(\models\ACL\ACLReader::ACTION_UPDATE, $this->node['user_id'])) {
            Msg::error('update_no_rights');
            $this->error(401);
        } else {
            $options = $this->getUploaderOptions('post');
            $upload_handler = new \UploadHandler($options);
        }
    }

}

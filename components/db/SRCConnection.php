<?php

namespace app\components\db;

class SRCConnection extends \yii\db\Connection {

    public function init() {
        $this->schemaMap = array_merge($this->schemaMap, [
            'mysql' => 'app\components\db\mysql\SRCSchema',
        ]);
        return parent::init();
    }

    public function getQueryBuilder() {
        return parent::getQueryBuilder();
    }

    public function getSchema() {
        return parent::getSchema();
    }

}

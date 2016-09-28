<?php

namespace app\components\db\mysql;

class SRCQueryBuilder extends \yii\db\mysql\QueryBuilder {

    public function buildLikeCondition($operator, $operands, &$params) {

        // original escape chars = ['%' => '\%', '_' => '\_', '\\' => '\\\\'];
        $operands[2] = ['%' => '\%', '\\' => '\\\\'];

        return parent::buildLikeCondition($operator, $operands, $params);
    }

}

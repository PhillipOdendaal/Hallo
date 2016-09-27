<?php

namespace app\components\db\mssql;

class SRCQueryBuilder extends \yii\db\mssql\QueryBuilder {

    public function buildLikeCondition($operator, $operands, &$params) {

        // original escape chars = ['%' => '\%', '_' => '\_', '\\' => '\\\\'];
        $operands[2] = ['%' => '\%', '\\' => '\\\\'];

        return parent::buildLikeCondition($operator, $operands, $params);
    }

}

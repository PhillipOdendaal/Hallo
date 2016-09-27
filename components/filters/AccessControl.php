<?php

namespace app\components\filters;

class AccessControl extends \yii\filters\AccessControl {

    public $ruleConfig = ['class' => 'app\components\filters\AccessRule'];

}

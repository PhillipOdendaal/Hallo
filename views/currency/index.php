<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Standard;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Currency;

$this->title = 'Currency Conversion';
?>
<div class="site-currency-conversion" style="margin-top: 50px;padding: 100px;">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Currency Conversion.
    </p>
    <div class="container">
    <?php 
        $model = new Currency();

        $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['currency/CurrencyManager']
            ]);
    ?>
        
    <div class="converter" style="width:200px">
        
    <?= $model->getAttributeLabel('from') ?>
    <?= $form->field($model, 'currency')
                ->label('')
                ->dropDownList( ArrayHelper::map(Currency::getCurrency(), 'currency_code', 'currency_name'), 
                        ['prompt' => 'Select Currency'] ); ?>
    <?= $model->getAttributeLabel('to') ?>
    <?= $form->field($model, 'currency')
            ->label('')
            ->dropDownList( ArrayHelper::map(Currency::getCurrency(), 'currency_code', 'currency_name'),
                    ['prompt' => 'Select Currency'] ); ?>
    <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>
    
    </div>
</div>
</div>

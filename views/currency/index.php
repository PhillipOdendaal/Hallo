<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use backend\models\Standard;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\models\Currency;

$this->title = 'Currency Conversion';
//$base = Yii::app()->getBaseUrl(true);

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
    <?= $form->field($model, 'currency')
                ->label('From:')
                ->dropDownList( ArrayHelper::map(Currency::getCurrency(), 'currency_id', 'currency_name'), 
                        ['prompt' => 'Select Currency'] ); ?>
    <?= $form->field($model, 'currency')
            ->label('To:')
            ->dropDownList( ArrayHelper::map(Currency::getCurrency(), 'currency_id', 'currency_name'),
                    ['prompt' => 'Select Currency'] ); ?>
    <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'displayCalc')->textInput(['autofocus' => true]) ?>
    
    <?= Html::a('Currency Manager','index.php/Currency', array('target'=>'_self','class' => 'btn btn-primary','name' => 'CManager-button')); ?>    
    </div>
</div>
</div>
<script type="text/javascript">
$("#currency-amount").keypress(function() {
        var dInput = $('input:text[name=\'Currency[amount]\']').val();
        var ll_from  = $("label:contains('From:')").parent().find('#currency-currency').val();
        var ll_to  = $("label:contains('To:')").parent().find('#currency-currency').val();
        var monetary_value = (ll_from / ll_to) * dInput;
        if(monetary_value == 'Infinity' || monetary_value == '-Infinity'){
            $('#currency-displaycalc').val('calculating...');
        }else{
            var c_converted = ( monetary_value / 100 ) * 1000;
            $('#currency-displaycalc').val(c_converted);
        }
});
</script>

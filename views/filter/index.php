<?php
use app\widgets\ActiveForm;
use yii\base\DynamicModel;
use yii\helpers\Html;
?>


<?php

$field_options = [];

$form = ActiveForm::begin([
            'horizLabelWidth' => 140,
            'options' => [
                'class' => 'form advanced-filter-form'
            ]
        ]);
?>

<h3>Advanced Filtering</h3>
<div class="ui stackable nopadding grid">

    <div class="eight wide column">
        <div class="ui form">
            <?= $form->field($model, 'Currency', $field_options)->dropDownList([], [], true, true); ?>
            <?= $form->field($model, 'Service', $field_options); ?>
        </div>
    </div>

    <div class="eight wide computer only column">
        <div class="ui divider"></div>
    </div>
	
    <div class="eight wide column">
        <div class="ui form">
            <?=
            $form->field($model, 'Attribute', $field_options)->textInput([
                'name' => 'attribute'
            ]);
            ?>
        </div>
    </div>

    <div class="eight wide computer only column">
        <div class="ui compact divider"></div>
    </div>
	
    <div class="eight wide column">
        <div class="form-buttons">
            <?= Html::submitButton("Search", ['class' => 'ui primary button']) ?>
        </div>

    </div>

</div>


<?php
ActiveForm::end();
?>
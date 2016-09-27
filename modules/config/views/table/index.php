<?php

use app\widgets\DataColumn;
use app\widgets\GridView;
use app\widgets\Pjax;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Tables';
$this->params['breadcrumbs'][] = [ 'label' => 'Config'];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>
    <div style="float: right">
        <?=
        Html::tag("a", "Add Table", [
            'class' => 'ui button green',
            'href' => Url::to(['edit?id=0'])
        ]);
        ?>
    </div>
    <?= $this->title; ?>
</h1>


<?php
Pjax::begin([
    'timeout' => false,
    'enablePushState' => false,
    'id' => 'table',
]);


echo GridView::widget([
    'id' => 'table',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    // 'summary' => '',
    'showHeader' => true,
    'columns' => [
        [
            'class' => DataColumn::className(),
            'attribute' => 'TableName',
            'content' => function($model, $key, $index, $column) {
                return Html::tag("a", $model->TableName, ['href' => Url::to(['view?id=' . $model->ID])]);
            }
        ],
        'TableType',
        'TableIdentifier',
        [
            'class' => ActionColumn::className(),
            'template' => '{unassign}',
            'headerOptions' => [
                'style' => 'width: 130px;'
            ],
            'contentOptions' => [
                'style' => 'text-align: right;'
            ],
            'buttons' => [
                'unassign' => function ($url, $model, $key) {

                    $editbutton = Html::tag("a", "Edit", [
                                'class' => 'mini ui button compact blue',
                                'href' => Url::to(['edit?id=' . $model->ID])
                    ]);

                    $deletebutton = Html::tag("a", "Delete", [
                                'class' => 'mini ui button compact red delete-button',
                                'href' => Url::to(['delete?id=' . $model->ID])
                    ]);

                    return $editbutton . ' ' . $deletebutton;
                }
            ]
        ],
    ]
]);

Pjax::end();
?>
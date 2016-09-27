<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Currency;
use yii\helpers\ArrayHelper;

namespace app\assets;

use yii\web\AssetBundle;




class CurrencyController extends Controller
{
    public function actionIndex()
    {
        //$this->registerJs( $this->renderPartial('currencyConverter.js') );
        
        $this->registerJsFile( 
            'currencyConverter.js', 
            ['\backend\assets\AppAsset'],  
            ['position' => '\yii\web\View::POS_END']
        );
        
        $model = new Country();
        return $this->render('index', ['model' => $model]);

    }
    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionCurrencyManager()
    {
        return $this->render('CurrencyManager');
    }
}
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
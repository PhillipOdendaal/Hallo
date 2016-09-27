<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{
    public $code;
    public $can;
    public $amount;
    public $displayCalc;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }
     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_id'], 'integer', 'max' => 11],
            [['currency_name'], 'string', 'max' => 64],
            [['currency_code'], 'string', 'max' => 3],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currency_id' => 'Currency Value',
            'currency_code' => 'Currency Code',
            'currency_name' => 'Currency Name',
            'from' => 'Convert From',
            'to' => 'To',
            'amount' => 'Amount',
            'displayCalc' => 'Calculated Amount',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function getCurrency()
    {
        $rows = (new \yii\db\Query())
            ->select(['currency_id', 'currency_name'])
            ->from('currency')
            ->limit(10)
            ->all();
        
        return $rows;
    }
    
    /**
     * @inheritdoc
     */
    public static function calculateFinalAmount()
    {
    }
}
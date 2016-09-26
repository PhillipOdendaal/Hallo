<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{
    public $code;
    public $can;
    public $amount;

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
            'currency_code' => 'Currency Code',
            'currency_name' => 'Currency Name',
            'from' => 'Convert From',
            'to' => 'To',
            'amount' => 'Amount',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function getCurrency()
    {
        $rows = (new \yii\db\Query())
            ->select(['currency_code', 'currency_name'])
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
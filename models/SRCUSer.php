<?php

namespace app\models;

use app\components\Utils;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class SRCUser extends \app\components\db\ConfigurationActiveRecord implements IdentityInterface {
    
    public $NewPassword;
    public $id;
    public $username;
    public $password;

    public $frontend_permission_definitions = [
                'Admin|Admin',
		'Administrator|Super',
		'Front End|Environment Popup'
	];
	
    public $frontend_task_perspectives = [
            'DEFAULT' => 'Default',
        ];

    public static function tableName() {
        return 'map_user';
    }

    public static function getDb() {
        //return Yii::$app->get('src_v1');
        //return Yii::$app->get('session');
        return Yii::$app->get('sourcev1');
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}

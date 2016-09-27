<?php

namespace app\forms\site;

use app\models\SRCUser;
use Exception;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model {

    public $username;
    public $password;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {

        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->password = "";
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login() {
        //$local_login = $_SERVER["REMOTE_ADDR"] == "127.0.0.1" || $_SERVER["REMOTE_ADDR"] == "::1";
        $full_username = $this->username;
        $this->username = $this->getUsername($this->username);

        $user = SRCUser::findByUsername($this->username);
    }

    private function getUsername($fullUserName) {

        if (strpos($fullUserName, "\\") !== false) {
            $fullUserName = substr($fullUserName, strpos($fullUserName, "\\") + 1);
        }

        $fullUserName = strtolower($fullUserName);

        return $fullUserName;
    }

    /**
     * Finds user by [[username]]
     *
     * @return SRCUser|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = SRCUser::findByUsername($this->username);
        }

        return $this->_user;
    }

}

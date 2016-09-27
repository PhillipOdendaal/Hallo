<?php

namespace app\components\filters;

use \Yii;

class AccessRule extends \yii\filters\AccessRule {

    public $permissions;
    public $actions;

    protected function matchPermission($user) {
        if (empty($this->permissions)) {
            return true;
        }

        if (!is_array($this->permissions)) {
            $this->permissions = [$this->permissions];
        }

        foreach ($this->permissions as $action_permission) {
            if ($action_permission === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            }
            elseif ($action_permission === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            }
            else {
                if (!$user->getIsGuest()) {
                    if ($user->identity->hasPermission($action_permission)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks whether the Web user is allowed to perform the specified action.
     * @param Action $action the action to be performed
     * @param User $user the user object
     * @param Request $request
     * @return boolean|null true if the user is allowed, false if the user is denied, null if the rule does not apply to the user
     */
    public function allows($action, $user, $request) {
        if ($this->matchAction($action) &&
                $this->matchRole($user) &&
                $this->matchIP($request->getUserIP()) &&
                $this->matchVerb($request->getMethod()) &&
                $this->matchController($action->controller) &&
                $this->matchPermission($user) &&
                $this->matchCustom($action)) {

            return $this->allow ? true : false;
        }
        else {
            return null;
        }
    }

}

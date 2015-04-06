<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * Login form
 */

class PasswordForm extends Model
{
    
    public $password;
    public $confirm_password;
    

    


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'confirm_password'], 'required'],
            // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}

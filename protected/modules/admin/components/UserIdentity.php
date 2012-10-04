<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CBaseUserIdentity
{

    public $email;
    public $password;

    private $_id;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return boolean
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(email) = :email', array(':email' => $this->email));

        $this->password = Yii::app()->securityManager->hashPassword($this->password, $user->hash);

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($this->password !== $user->password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->processAuthenticate($user);
        }

        return $this->errorCode == self::ERROR_NONE;
    }

    public function processAuthenticate(User $user)
    {
        $this->_id = $user->id;
        $this->errorCode = self::ERROR_NONE;

        foreach ($user as $k => $v) {
            $this->setState($k, $v);
        }
    }

    public function getId()
    {
        return $this->_id;
    }
}
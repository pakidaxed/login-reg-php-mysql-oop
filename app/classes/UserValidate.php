<?php


class UserValidate
{
    private array $data;
    private array $errors = [];
    // Only these field will be validated, if any different comes to POST, will return false
    // Also to demonstrate that i know what static means also :)
    private static array $reg_fields = ['email', 'name', 'last_name', 'phone', 'password', 'password_confirm'];
    private static array $login_fields = ['email', 'password'];

    /**
     * UserValidate constructor.
     *
     * @param array $post_data
     */
    public function __construct(array $post_data)
    {
        $this->data = $post_data;
    }

    /**
     * Main validator, securing from not confirmed POSTS
     *
     * @return array|false
     */
    public function validateRegister()
    {
        foreach (self::$reg_fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                $this->setError('main', 'Not confirmed POST data is not allowed');
                return false;
            }
        }
        $this->validateEmail();
        $this->validateName();
        $this->validateLastName();
        $this->validatePhone();
        $this->validatePassword();
        $this->validatePasswordConfirm();

        return $this->errors;
    }
    public function validateLogin()
    {
        foreach (self::$login_fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                $this->setError('main', 'Not confirmed POST data is not allowed');
                return false;
            }
        }

        return $this->errors;
    }

    /**
     * Validating email with regex for special requirements '@' and '.'
     */
    private function validateEmail()
    {
        if (empty(trim($this->data['email']))) {
            $this->setError('email', 'Enter your email');
        } else {
            // It should be enough with FILTER_VALIDATE_INPUT
            if (!preg_match('/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,10}$/', $this->data['email'])) {
                $this->setError('email', 'Please enter a valid email address');
            }
        }
    }

    /**
     * Validating users first name
     */
    private function validateName()
    {
        if (empty(trim($this->data['name']))) {
            $this->setError('name', 'Enter your first name');
        } else {
            if (preg_match('/[\d\W\s]/', $this->data['name'])) {
                $this->setError('name', 'First name must contain only letters');
            }
        }
    }

    /**
     * Validating users last name
     */
    private function validateLastName()
    {
        if (empty(trim($this->data['last_name']))) {
            $this->setError('last_name', 'Enter your last name');
        } else {
            if (preg_match('/[\d\W\s]/', $this->data['last_name'])) {
                $this->setError('last_name', 'Last name must contain only letters');
            }
        }
    }

    /**
     * Validating phone number to allow only numbers
     */
    private function validatePhone()
    {
        if (empty(trim($this->data['phone']))) {
            $this->setError('phone', 'Enter your phone number');
        } else {
            if (!preg_match('/^[0-9]+$/', $this->data['phone'])) {
                $this->setError('phone', 'Phone number must contain only numbers');
            }
        }
    }

    /**
     * Validating password with preg match for spec requirements
     */
    private function validatePassword()
    {
        $password = $this->data['password'];

        if (empty(trim($password))) {
            $this->setError('password', 'Enter your password');
        } else {
            $preg_result = (
                preg_match('/\d/', $password) && // Checking for at least one number
                preg_match('/[A-Z]/', $password) && // Checking for at least one capital letter
                preg_match('/^[a-zA-Z0-9]{8,50}$/', $password) // Checking for required minimum length of password
            );
            if (!$preg_result) {
                $this->setError('password', 'Must use at least one capital and one number and not less than 8 letters');
            }
        }
    }

    /**
     * Validating password confirmation
     */
    private function validatePasswordConfirm()
    {
        if (empty(trim($this->data['password_confirm']))) {
            $this->setError('password_confirm', 'Please confirm your password');
        } else {
            if ($this->data['password'] !== $this->data['password_confirm']) {
                $this->setError('password_confirm', 'Passwords do not match');
            }
        }
    }

    /**
     * Adding validation errors to array for display
     *
     * @param string $field
     * @param string $message
     */
    private function setError(string $field, string $message)
    {
        $this->errors[$field] = $message;
    }
}
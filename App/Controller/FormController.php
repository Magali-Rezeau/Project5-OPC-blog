<?php
namespace App\Controller;

class FormController 
{
    private $errors;
    private $datas;
   
    public function __construct($datas = [],$errors = [])
    {
        $this->datas = $datas;
        $this->errors = $errors;
    }
    /**
     * check rules and return associated errors
     *
     * @param  string $name
     * @param  string $rule
     * @param  string $message
     * @param  string $name2
     * @param  integer $value
     *
     */
    public function check($name, $rule, $message, $name2= null, $value = null) 
    {
        $validate = 'validate_'.$rule;
        if(!$this->$validate($name, $name2, $value)) {
            $this->errors[$name] = $message; 
        }
    }
    /**
     * filter to validate the email
     *
     * @param  string $name = input
     *
     * @return boolean
     */
    public function validate_email($name) 
    {
        return isset($this->datas[$name]) && filter_var($this->datas[$name],FILTER_VALIDATE_EMAIL);
    }
    /**
     * compare confirmation email
     *
     * @param  string $name = input email
     * @param  string $name2 = input confirm email
     *
     * @return boolean
     */
    public function validate_confirm_email($name, $name2) 
    {
        return isset($this->datas[$name]) && isset($this->datas[$name2]) && $this->datas[$name] === $this->datas[$name2];
    }
    /**
     * compare confirmation password
     *
     * @param  string $name = input password
     * @param  string $name2 = input confirm password
     *
     * @return boolean
     */
    public function validate_confirm_password($name, $name2) 
    {
        return isset($this->datas[$name]) && isset($this->datas[$name2]) && $this->datas[$name] === $this->datas[$name2];
    }
    /**
     * minimum size of the string
     *
     * @param  string $name = input
     * @param  integer $value = minimum size
     *
     * @return boolean
     */
    public function validate_minLenght($name, $value) 
    {
        return isset($this->datas[$name]) && strlen($this->datas[$name]) >= $value;
    }
    /**
     * maximum size of the string
     *
     * @param  string $name = input
     * @param  integer $value = maximum size
     *
     * @return boolean
     */
    public function validate_maxLenght($name, $value) 
    {
        return isset($this->datas[$name]) && strlen($this->datas[$name]) < $value;
    }
    public function getErrors() 
    {
        return $this->errors;
    }
}

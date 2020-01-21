<?php
namespace App\Controller;

class FormController {
    
    private $errors;
    private $datas;
   
    public function __construct($datas = [],$errors = [])
    {
        $this->datas = $datas;
        $this->errors = $errors;
    }
    public function check($name, $rule, $message, $value = null) {
        $validate = 'validate_'.$rule;
        if(!$this->$validate($name, $value)){
            $this->errors[$name] = $message;    
        }
    }
    public function validate_required($name) {
        return  isset($this->datas[$name]) && $this->datas[$name] != '';
    }
    public function validate_email($name) {
        return isset($this->datas[$name]) && filter_var($this->datas[$name],FILTER_VALIDATE_EMAIL);
    }
    public function validate_minLenght($name,$value) {
        return isset($this->datas[$name]) && strlen($this->datas[$name]) >= $value;
    }
    public function validate_maxLenght($name,$value) {
        return isset($this->datas[$name]) && strlen($this->datas[$name]) < $value;
    }
    public function getErrors() {
        return $this->errors;
    }
}

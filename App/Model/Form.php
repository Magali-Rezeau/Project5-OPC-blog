<?php 
namespace App\Model;

class Form {
    
    private $datas;
   
    public function __construct($datas = [])
    {
        $this->datas = $datas; 
    }
    private function input($type, $name, $label, $value = null) {
        if(isset($this->datas[$name])) {
            $value = $this->datas[$name];
        } 
        if ($type === 'textarea') {
            return '<label for="'.$name.'">'.$label.'</label><textarea required name="' . $name . '"  id="' . $name . '">' . $value . '</textarea>';
        } else if ($type === 'submit') { 
            
            return '<button class="btn" type="' . $type . '" id="' . $name . '">'. $label .'</button>';
        
        } else {
            return '<label for="'.$name.'">'.$label.'</label><input required type="' . $type . '" name="' . $name . '" id="' . $name . '" value ="'. $value .'">';
        }
    }
    public function text($name, $label, $value=null) {
       return $this->input('text', $name, $label,$value);
    }
    public function email($name, $label,$value=null) {
        return $this->input('email', $name, $label,$value);
     }
     public function password($name, $label, $value=null) {
        return $this->input('password', $name, $label, $value);
     }
     public function textarea($name, $label,$value=null) {
        return $this->input('textarea', $name, $label,$value);
     }
    public function submit($name, $label,$value=null) {
        return $this->input('submit', $name, $label,$value);
    }
}

<?php

class Form{

    // initialisation
    private $data;
    private $errorMessage;

    public function __construct($data){
        $this->data = $data;
    }
    
    // wrap line
    private function wrapper($line){
        return "<$this->wrap>".$line."</$this->wrap>";
    }

    // if value exist we return this
    private function getValue($index){
      return isset($this->data[$index]) ? $this->data[$index] : null;
       
    }
    // initiaisation of required data of form
    public function requiredData($requiredData){
        $this->requiredData = $requiredData;
    }
    // check if this element is required
    private function checkRequired($element){
        $result="";
        foreach ($this->requiredData as $key => $value) {
            ($value==$element) ? "required" : null;
        }            
    }
    // create the form
    public function openForm($action,$methode){
        return "<form id=$this->id  method=$methode action=$action>";
    }
    // closing the form
    public function closeForm(){
        return "</form>";
    }
    // create a new input element
    public function input($id=null,$name,$type,$class,$placeholder=null){   
       // testing if this element is required 
       $required=$this->checkRequired($id);
       // initialisation of element
       $html ="<input type=$type id=$id name=$name class=\"$class\"";   
       // we check value if exist 
       if($type!=="password"){
       if($this->getValue($name) !== null){
           $html.="value=\"".$this->getValue($name)."\"";
          }   
          }
       // we check placeolder if not null
       if($placeholder!==null){
           $html.="placeholder=\"".$placeholder."\"";
       }
       // we push the required if is it
       $html.="$required>";
       //we return the element
       return $this->wrapper($html);
    }

    // create a new select element
    public function select($id=null,$name,$options){
        // we checking if this element is required
        $required=$this->checkRequired($id);
        // initialisation of element
        $html="<select id=$id name=$name $required>";
        // for each option of the select element
        foreach ($options as $key => $value) {
            // initialisation of the option
            ($this->getValue($name)===$value)? $selected="selected" : $selected=null;
            $html.="<option value=$value $selected>$value</option>";
        }
        // we close the select
        $html.="</select>";
        // we return the element
        return $html;
    }

    // create new radio element
    public function radio($name,$options){
        $html="";
        // if value $_POST exist value=user choice or value=0 (the first)
        ($this->getValue($name)!==null) ? $valueSelected=$this->getValue($name) : $valueSelected = $options[0];
        foreach ($options as $key => $value) {
            if($value===$valueSelected){
                $checked="checked";
            }else{
                $checked=null;
            }
            $html.="<input type=\"radio\" name=$name value=$value $checked >$value";
        }            
        return $html;
    }

    // create new checkbox element
    public function checkbox($name,$options){
        $html="";        
        $datas = $this->getValue($name);
        $checked=null;
        foreach ($options as $key => $value) {
            if(sizeof($datas)>0){
                $existe = in_array($value,$datas);
                ($existe==1) ? $checked="checked" : $checked=null;
            }
            $html.="<input type=\"checkbox\" name=\"".$name."[]\" value=\"$value\" $checked>".$value;
            
        }        
        return $html;
    }

    // create  button submit
    public function submit($text){
        return "<button type=\"submit\">$text</button>";
    }



}
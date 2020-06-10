<?php
class template_class
    {
    var $values = array();
    var $html;

    function get_tpl($tpl_name)
      {
      if(empty($tpl_name) || !file_exists($tpl_name))
        {
        return false;
        }
      else
        {
        $this->html  = join('',file($tpl_name));
        }
      }

    function set_value($key,$var)
      {
      $key = '{' . $key . '}';
      $this->values[$key] = $var;
      }

    function tpl_parse()
      {
      foreach($this->values as $find => $replace)
             {
             $this->html = str_replace($find, $replace, $this->html);
             }
      }
    }
$tpl = new template_class;
?>
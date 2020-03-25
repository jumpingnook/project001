<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Ldap{

    protected $status=false;
    protected $bind=false;
    protected $e_code='';
    protected $e_msg='';
    protected $res;
    public $host='10.10.10.71';
    public $port='';
    protected $user='nu\\';
    protected $pass='';


    protected function _ClearErr(){
        $this->e_code = '';
        $this->e_msg = '';
    }

    function Get_Error(){
        return $this->e_code." : ".$this->e_msg;
    }

    function Get_E_Code(){
        return $this->e_code;
    }

    function Set_User($user,$pass){
        $this->user .= $user;
        $this->pass = $pass;
    }

    function Connect(){
        $this->res = @ldap_connect($this->host);
        $this->bind = @ldap_bind($this->res,$this->user,$this->pass);
        if ($this->bind){
            $this->status = true;
            $this->_ClearErr();		
        }else{
            $this->status = false;
            $this->e_code = ldap_errno($this->res);
            $this->e_msg = ldap_error($this->res);					
        }
        return $this->status;
    }

}
?>
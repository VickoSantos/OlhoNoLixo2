<?php

class Application_Model_Empresa extends Zend_Db_Table_Abstract
{
    protected $_name = "empresa";
    
    public function cadastrar($data){
        return $this->insert($data);
    }
    
    public function listar($cidade){
        $select = $this->select()
                ->where('nm_cidade = ?', "$cidade")
                ->order("nm_empresa");
        return $this->fetchAll($select)->toArray();
    }
}


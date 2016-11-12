<?php

class Application_Model_PontoColeta extends Zend_Db_Table_Abstract
{
    protected $_name = "ponto_coleta";
    
    public function cadastrar($data)
    {
        return $this->insert($data);
    }
    
    public function listar($cidade)
    {
        $select = $this->select()
                ->where('nm_cidade_ponto_coleta = ?', "$cidade")
                ->order('nm_ponto_coleta');
        return $this->fetchAll($select)->toArray();
    }
}
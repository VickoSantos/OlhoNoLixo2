<?php

class EmpresaController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        if ($this->getRequest()->isPost()) {
            $nome = $this->getRequest()->getParam("nome", "");
            $endereco = $this->getRequest()->getParam("endereco", "");
            $cidade = $this->getRequest()->getParam("cidade", "");
            $tipoEmpresa = $this->getRequest()->getParam("tipoEmp", "");

            $data = [
                'nm_empresa' => $nome,
                'nm_endereco' => $endereco,
                'nm_cidade' => $cidade,
                'nm_tipo_empresa' => $tipoEmpresa
            ];

            $empresa = new Application_Model_Empresa();
            $result = $empresa->cadastrar($data);
            if ($result) {
                $this->view->resp = "Empresa cadastrada!";
            } else {
                $this->view->resp = "Empresa não cadastrada!";
            }
        }
        
        $this->view->form = $this->defineFormulario();
    }
}
  

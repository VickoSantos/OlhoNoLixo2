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
            $telefone = $this->getRequest()->getParam("telefone", "");
            $email = $this->getRequest()->getParam("email", "");
            $tipoEmpresa = $this->getRequest()->getParam("tipoEmp", "");
            $tipoRes = $this->getRequest()->getParam("tipoRes", "");
            $bairro = $this->getRequest()->getParam("bairro", "");

            $data = [
                'nm_empresa' => $nome,
                'nm_endereco' => $endereco,
                'nm_cidade' => $cidade,
                'cd_telefone_empresa' => $telefone,
                'nm_tipo_empresa' => $tipoEmpresa,
                'nm_email_empresa' => $email,
                'nm_tipo_residuo' => $tipoRes,
                'nm_bairro_empresa' => $bairro
            ];

            $empresa = new Application_Model_Empresa();
            $result = $empresa->cadastrar($data);
            if ($result) {
                $this->view->resp = "Empresa cadastrada!";
            } else {
                $this->view->resp = "Empresa não cadastrada!";
            }
        }
    }

    public function buscarAction() {
        if ($this->getRequest()->isPost()) {
            $cidade = $this->getRequest()->getParam("cidade", "");
            $empresa = new Application_Model_Empresa();
            $lista = $empresa->listar($cidade);
            $this->view->listaEmpresa = $lista;
        }
    }

}

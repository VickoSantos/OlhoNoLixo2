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
        
        $this->view->form = $this->defineFormulario();
    }

    public function buscarAction() {
        if ($this->getRequest()->isPost()) {
            $cidade = $this->getRequest()->getParam("cidade", "");
            $empresa = new Application_Model_Empresa();
            $lista = $empresa->listar($cidade);
            if(count($lista) != 0)
                $this->view->listaEmpresa = $lista;
            else
                $this->view->msg = "Não há empresas cadastradas!";
        }
    }
    
    public function defineFormulario(){
        
        $nome = new Zend_Form_Element_Text("nome");
        $nome->setLabel("Nome:");
        $endereco = new Zend_Form_Element_Text("endereco");
        $endereco->setLabel("Endereço:");
        $cidade = new Zend_Form_Element_Text("cidade");
        $cidade->setLabel("Cidade:");
        $telefone = new Zend_Form_Element_Text("telefone");
        $telefone->setLabel("Telefone:");
        $email = new Zend_Form_Element_Text("email");
        $email->setLabel("Email:");
        $tipoEmp = new Zend_Form_Element_Select("tipoEmpresa");
        $tipoEmp->addMultiOptions(array('Selecionar', 'Produto', 
            'Coletora', 'Recicladora'));
        $tipoEmp->setLabel("Tipo de Empresa:");
        $tipoRes = new Zend_Form_Element_Select("tipoRes");
        $tipoRes->setLabel("Tipo de Resíduo:");
        $tipoRes->addMultiOptions(array('Selecionar', 'Papel', 'Plástico', 'Metal', 
                'Vidro', 'Hospitalar', 'Químico'));
        $bairro = new Zend_Form_Element_Text("bairro");
        $bairro->setLabel("Bairro:");
        $submit = new Zend_Form_Element_Submit("Cadastrar");
        
        $form = new Zend_Form();
        $form->setMethod('post');
        $form->setAttrib('id', 'cadastroEmpresa');
        
        $form->addElements([$nome, $endereco, $bairro, $cidade, $telefone, 
                $email, $tipoEmp, $tipoRes, $submit]);
        
        return $form;
    }

}

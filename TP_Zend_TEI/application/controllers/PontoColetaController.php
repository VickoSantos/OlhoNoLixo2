<?php

class PontoColetaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        if($this->getRequest()->isPost()){
            $nome = $this->getRequest()->getParam("nome", "");
            $endereco = $this->getRequest()->getParam("endereco", "");
            $bairro = $this->getRequest()->getParam("bairro", "");
            $cidade = $this->getRequest()->getParam("cidade", "");
            $telefone = $this->getRequest()->getParam("telefone", "");
            $email = $this->getRequest()->getParam("email", "");
            $tipoRes = $this->getRequest()->getParam("tipoRes", "");
            
            $data = [
                'nm_ponto_coleta'=>$nome,
                'nm_endereco_ponto_coleta'=>$endereco,
                'nm_bairro_ponto_coleta'=>$bairro,
                'nm_cidade_ponto_coleta'=>$cidade,
                'cd_telefone_ponto_coleta'=>$telefone,
                'nm_email_ponto_coleta'=>$email,
                'nm_tipo_residuo'=>$tipoRes
            ];
            
            $pontoColeta = new Application_Model_PontoColeta();
            $result = $pontoColeta->cadastrar($data);
            if($result){
                $this->view->resp = "Ponto cadastrado com sucesso!";
            }else{
                $this->view->resp = "Ocorreu um erro. Não foi possível cadastrar!";
            }
        }
        
        $this->view->form = $this->definirFormulario();
    }

    public function buscarAction()
    {
        if($this->getRequest()->isPost()){
            $cidade = $this->getRequest()->getParam("cidade", "");
            
            $pontoColeta = new Application_Model_PontoColeta();
            $lista = $pontoColeta->listar($cidade);
            
            if(count($lista) != 0){
                $this->view->listaPontos = $lista;
            }else{
                $this->view->msg = "Nenhum ponto encontrado!";
            }
        }
    }
    
    public function definirFormulario(){
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
                $email, $tipoRes, $submit]);
        
        return $form;
    }
    
}

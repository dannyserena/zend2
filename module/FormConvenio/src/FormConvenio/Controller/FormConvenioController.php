<?php

/**
 * namespace de localizacao do nosso controller
 */

namespace FormConvenio\Controller;

// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
// import Zend\View
use Zend\View\Model\ViewModel, 
    FormConvenio\Model\FormConvenioTable,
    FormConvenio\Model\FormConvenio;

// import Model\ModelFormConvenio com alias
//use FormConvenio\Model\FormConvenioTable as ModelFormConvenio;

class FormConvenioController extends AbstractActionController {

    protected $formConvenioTable;
     

    // GET /FormConvenio
    public function indexAction() {
          $adapter = $this->getServiceLocator()->get('AdapterDb');
          $this->formConvenioTable = new FormConvenioTable($adapter);
          
          return new ViewModel(array('formconvenio' => $this->formConvenioTable->fetchAll()));
        // enviar para view o array com key FormConvenio e value com todos os FormConvenio
//        return new ViewModel(array('form-convenio' => $this->getformConvenioTable()->fetchAll()));
    }

    
    // GET /contFormConvenio/novo
    public function novoAction() {
        
         
        $adapter = $this->getServiceLocator()->get('AdapterDb');
        
        $formConvenioTable = new FormConvenioTable($adapter);
        
        
        
        return new ViewModel(array('formconvenio' => $formConvenioTable->fetchAll()));
    }

    // POST /FormConvenio/adicionar
    public function adicionarAction() {
        // obtém a requisição
        // return new ViewModel(array('formconvenio' => $this->getformconvenioTable()->fetchAll()));
        echo "<br>clicou no método adicionarAction";
        $request = $this->getRequest();
        $formconvenio = new FormConvenio();

        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
            $postData = $request->getPost();
            echo 'if request';
            // $formularioValido->setData($postData);
            $formularioValido = true;
            $formataData = $request->getPost();
            echo 'if request';
         
                        
            
           //  $formconvenio->exchangeArray($postData);
           // validaCamposFormConvenio( $formconvenio);
                
               
            // verifica se o formulário segue a validação proposta
            if ($formularioValido) {
                echo "<br>if formulario válido";
                $formconvenio->exchangeArray($postData);
                
                echo 'teste';
                $formconvenio->exchangeArray($formataData);
                
                echo "<br>if formulario válido2";
//                $this->getformConvenioTable()->saveFormConvenio($formconvenio);
                $adapter = $this->getServiceLocator()->get('AdapterDb');
                $this->formConvenioTable = new FormConvenioTable($adapter);
                 $this->formConvenioTable->saveFormConvenio($formconvenio);
                     echo "<br>if formulario válido3";

                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela adição
                // 2 - inserir dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Convênio criado com sucesso");

                // redirecionar para action index no controller FormConvenio
                return $this->redirect()->toRoute('form-convenio');
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao criar Convênio");

                // redirecionar para action novo no controllers FormConvenio
                return $this->redirect()->toRoute('form-convenio', array('action' => 'novo'));
            }
        }
    }

    // GET /FormConvenio/detalhes/id
    public function detalhesAction() {
        echo "<br>entrou no método detalhesAction";
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 1);
       // $id = 2;

        // se id = 0 ou não informado redirecione para FormConvenio
        if (!$id) {
            // adicionar mensagem
            $this->flashMessenger()->addMessage("Convênio não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('formconvenio');
        }

        try {
            // aqui vai a lógica para pegar os dados referente ao FormConvenio
            // 1 - solicitar serviço para pegar o model responsável pelo find
            // 2 - solicitar form com dados desse FormConvenio encontrado
            // formulário com dados preenchidos
            $form = (array) $this->getformConvenioTable()->find($id);
        } catch (\Exception $exc) {
            
            
            
            
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('form-convenio');
        }

        // dados eviados para detalhes.phtml
        return array('id' => $id, 'form' => $form);
    }

    // GET /FormConvenio/editar/id
    public function editarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 1);

        // se id = 0 ou não informado redirecione para FormConvenio
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Convenio não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('form-convenio');
        }

        try {
            // aqui vai a lógica para pegar os dados referente ao FormConvenio
            // 1 - solicitar serviço para pegar o model responsável pelo find
            // 2 - solicitar form com dados desse FormConvenio encontrado
            // formulário com dados preenchidos
            $form = (array) $this->getformConvenioTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('form-convenio');
        }

        // dados eviados para editar.phtml
        return array('id' => $id, 'form' => $form);
    }

    // PUT /FormConvenio/editar/id
    public function atualizarAction() {
        // obtém a requisição
        $request = $this->getRequest();

        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
            $postData = $request->getPost()->toArray();
            $formularioValido = true;

            // verifica se o formulário segue a validação proposta
            if ($formularioValido) {
                // aqui vai a lógica para editar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela atualização
                // 2 - editar dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Convênio editado com sucesso");

                // redirecionar para action detalhes
                return $this->redirect()->toRoute('form-convenio', array("action" => "detalhes", "id" => $postData['id'],));
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao editar Convenio");

                // redirecionar para action editar
                return $this->redirect()->toRoute('form-convenio', array('action' => 'editar', "id" => $postData['id'],));
            }
        }
    }

    // DELETE /FormConvenio/deletar/id
    public function deletarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para FormConvenio
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Convenio não encotrado");
        } else {
            // aqui vai a lógica para deletar o FormConvenio no banco
            // 1 - solicitar serviço para pegar o model responsável pelo delete
            // 2 - deleta FormConvenio
            // adicionar mensagem de sucesso
            $this->getFormConvenioTable()->deleteFormConvenio($id);
            $this->flashMessenger()->addSuccessMessage("FormConvenio de ID $id deletado com sucesso");
        }

        // redirecionar para action index
        return $this->redirect()->toRoute('form-convenio');
    }

    /**
     * Metodo privado para obter instacia do Model formConvenioTable
     * 
     * @return \FormConvenio\Model\formConvenioTable
     */
    private function getFormConvenioTable() {
        // adicionar service ModelFormConvenio a variavel de classe
        if (!$this->formConvenioTable) {
            $this->formConvenioTable = $this->getServiceLocator()->get('ModelFormConvenio');
        }

        // return vairavel de classe com service ModelFormConvenio
        return $this->formConvenioTable;
    }
    
    
    /**
     * Valida os campos do formulário
     * @param \FormConvenio\Controller\FormConvenio $formconvenio
     * @return boolean
     */
     public  function  ValidaCamposFormConvenio(FormConvenio $formconvenio)
    {
         //!isset($_POST['Idade']) || ($_POST['Idade']=="")
        if(!isset($formconvenio->con_numero) || $formconvenio->con_numero == "")
        {
            $this->flashMessenger()->addErrorMessage("O Numero do Convenio deve ser preenchindo");
            return false;
        }
        
        return true;
    }

}

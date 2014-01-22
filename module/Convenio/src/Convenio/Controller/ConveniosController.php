<?php

/**
 * namespace de localizacao do nosso controller
 */

namespace Convenio\Controller;

// import Zend\Mvc
use Zend\Mvc\Controller\AbstractActionController;
// import Zend\View
use Zend\View\Model\ViewModel;

class ConveniosController extends AbstractActionController {

    protected $convenioTable;

    // GET /convenios
    public function indexAction() {
        // enviar para view o array com key convenios e value com todos os convenios
        return new ViewModel(array('convenios' => $this->getConvenioTable()->fetchAll()));
    }

    // GET /convenios/novo
    public function novoAction() {
        
    }

    // POST /convenios/adicionar
    public function adicionarAction() {
        // obtém a requisição
        $request = $this->getRequest();
        $convenio = new \Convenio\Model\Convenio();

        // verifica se a requisição é do tipo post
        if ($request->isPost()) {
            // obter e armazenar valores do post
            $postData = $request->getPost();
            echo 'if request';
            // $formularioValido->setData($postData);
            $formularioValido = true;

            // verifica se o formulário segue a validação proposta
            if ($formularioValido) {
                echo "<br>if formulario válido";
                $convenio->exchangeArray($postData);
                echo "<br>if formulario válido2";
                $this->getConvenioTable()->saveConvenio($convenio);
                     echo "<br>if formulario válido3";

                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela adição
                // 2 - inserir dados no banco pelo model
                // adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Convenio criado com sucesso");

                // redirecionar para action index no controller convenios
                return $this->redirect()->toRoute('convenios');
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao criar convenio");

                // redirecionar para action novo no controllers convenios
                return $this->redirect()->toRoute('convenios', array('action' => 'novo'));
            }
        }
    }

    // GET /convenios/detalhes/id
    public function detalhesAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para convenios
        if (!$id) {
            // adicionar mensagem
            $this->flashMessenger()->addMessage("Convenio não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('convenios');
        }

        try {
            // aqui vai a lógica para pegar os dados referente ao convenio
            // 1 - solicitar serviço para pegar o model responsável pelo find
            // 2 - solicitar form com dados desse convenio encontrado
            // formulário com dados preenchidos
            $form = (array) $this->getConvenioTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('convenios');
        }

        // dados eviados para detalhes.phtml
        return array('id' => $id, 'form' => $form);
    }

    // GET /convenios/editar/id
    public function editarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para convenios
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Convenio não encotrado");

            // redirecionar para action index
            return $this->redirect()->toRoute('convenios');
        }

        try {
            // aqui vai a lógica para pegar os dados referente ao convenio
            // 1 - solicitar serviço para pegar o model responsável pelo find
            // 2 - solicitar form com dados desse convenio encontrado
            // formulário com dados preenchidos
            $form = (array) $this->getConvenioTable()->find($id);
        } catch (\Exception $exc) {
            // adicionar mensagem
            $this->flashMessenger()->addErrorMessage($exc->getMessage());

            // redirecionar para action index
            return $this->redirect()->toRoute('convenios');
        }

        // dados eviados para editar.phtml
        return array('id' => $id, 'form' => $form);
    }

    // PUT /convenios/editar/id
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
                $this->flashMessenger()->addSuccessMessage("Convenio editado com sucesso");

                // redirecionar para action detalhes
                return $this->redirect()->toRoute('convenios', array("action" => "detalhes", "id" => $postData['id'],));
            } else {
                // adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao editar convenio");

                // redirecionar para action editar
                return $this->redirect()->toRoute('convenios', array('action' => 'editar', "id" => $postData['id'],));
            }
        }
    }

    // DELETE /convenios/deletar/id
    public function deletarAction() {
        // filtra id passsado pela url
        $id = (int) $this->params()->fromRoute('id', 0);

        // se id = 0 ou não informado redirecione para convenios
        if (!$id) {
            // adicionar mensagem de erro
            $this->flashMessenger()->addMessage("Convenio não encotrado");
        } else {
            // aqui vai a lógica para deletar o convenio no banco
            // 1 - solicitar serviço para pegar o model responsável pelo delete
            // 2 - deleta convenio
            // adicionar mensagem de sucesso
            $this->flashMessenger()->addSuccessMessage("Convenio de ID $id deletado com sucesso");
        }

        // redirecionar para action index
        return $this->redirect()->toRoute('convenios');
    }

    /**
     * Metodo privado para obter instacia do Model ConvenioTable
     * 
     * @return \Convenio\Model\ConvenioTable
     */
    private function getConvenioTable() {
        // adicionar service ModelConvenio a variavel de classe
        if (!$this->convenioTable)
            $this->convenioTable = $this->getServiceLocator()->get('ModelConvenio');

        // return vairavel de classe com service ModelConvenio
        return $this->convenioTable;
    }

}

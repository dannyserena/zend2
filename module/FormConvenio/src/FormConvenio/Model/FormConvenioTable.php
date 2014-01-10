<?php

// namespace de localizacao do nosso model

namespace FormConvenio\Model;

// import Zend\Db
use //Zend\Db\Adapter\Adapter,
   // Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;


class FormConvenioTable {

    protected $tableGateway;
    
    private function getFormConvenioTable()
{
    return $this->getServiceLocator()->get('ModelFormConvenio');
}

 public function saveFormConvenio(FormConvenio $formconvenio) {
    
     echo '<br>código con_id ';
     echo '<br>numero con_numero ';
     //echo $grandegerador->emp_prestadora_fk;
     
     
     
     print_r( $formconvenio->con_id);
     print_r( $formconvenio->con_tipo);
    print_r( $formconvenio->con_numero);
    
        $data = array(
            'con_tipo' => $formconvenio->con_tipo,
            'con_numero' => $formconvenio->con_numero,
            'con_valor' => $formconvenio->con_valor,
            'con_vigencia_atual' => $formconvenio->con_vigencia_atual,
            'con_objeto' => $formconvenio->con_objeto,
            'con_conveniado' => $formconvenio->con_conveniado,
            'con_data_assinatura' => $formconvenio->con_data_assinatura,
            'con_publicacao_do' => $formconvenio->con_publicacao_do,
            'con_data_inicio' => $formconvenio->con_data_inicio,
            'con_data_termino' => $formconvenio->con_data_termino,
            'con_prazo' => $formconvenio->con_prazo,
            'con_situacao' => $formconvenio->con_situacao,
           // 'con_saldo_convenio' => $formconvenio->con_saldo_convenio,
            'con_observacao' => $formconvenio->con_observacao,
           
          
        );
        
        echo "<br>Metodo saveFormConvenio";

     //   $codorgao = (int) $grandegerador>codorgao;

       // if ($grandegerador->emp_prestadora_fk == -1) {
        try {
                          $this->tableGateway->insert($data);
            } catch (Exception $e) {
                         $pdoException = $e->getPrevious();
                  var_dump($e);
                echo "<br>exceção ao salvar";
                exit;
            }
//        } else {
//            if ($this->getOrgao($codorgao)) {
//                $this->update($data, array('codorgao' => $codorgao));
//            } else {
//                throw new \Exception("Orgao ID# $codorgao não lozalizado no banco de dados!");
//            }
    //    }
    }
    
    public  function  validaCamposFormConvenio(FormConvenio $formconvenio)
    {
        if($formconvenio->con_id == 0)
        {
            $this->flashMessenger()->addSuccessMessage("Convenio de ID $id deletado com sucesso");
            return false;
        }
        
        return true;
    }

    /**
     * Contrutor com dependencia do Adapter do Banco
     *
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
//    public function __construct(Adapter $adapter) {
//        $resultSetPrototype = new ResultSet();
//        $resultSetPrototype->setArrayObjectPrototype(new GrandeGerador());
//
//        $this->tableGateway = new TableGateway('grandegerador', $adapter, null, $resultSetPrototype);
//    }

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Recuperar todos os elementos da tabela FormConvenio
     *
     * @return ResultSet
     */
    
      
       
    public function fetchAll() {
         echo "<br> Entrou no metódo fetchall FormConvenioTable";
        return $this->tableGateway->select();
    }
    /**
     * Recuperar todos os elementos da tabela ConvenioAditivo
     *
     * @return ResultSet
     */
    public function convenioAditivofetchAll() {
         echo "<br> Entrou no metódo fetchall FormConvenioAditivoTable";
        return $this->tableGateway->select();
    }

    /**
     * Localizar linha especifico pelo id da tabela FormConvenio
     *
     * @param type $id
     * @return \Model\FormConvenio
     * @throws \Exception
     */
    public function find($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('con_id' => $id));
        $row = $rowset->current();
        if (!$row)
            throw new \Exception("Não foi encontrado Convênio de id = {$id}");

        return $row;
    }
    //Tratamento de exclusão do convênio
    public function deleteFormConvenio($id) {
        $id = (int) $id;
         
        try {
                      $this->tableGateway->delete(array('con_id' => $id));
        } catch (Exception $e) {
                     $pdoException = $e->getPrevious();
              var_dump($e);
            echo "<br>exceção ao salvar";
            exit;
        }
    }
    
    
    

}

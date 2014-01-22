<?php

namespace FormConvenio\Model;

// import Model\FormConvenio
use FormConvenio\Model\FormConvenio,
    FormConvenio\Model\FormConvenioTable;
// import Zend\Db
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class FormConvenio {


    public $con_id;
    public $con_numero;
    public $con_tipo; // gera resultado no combox
    public $con_valor;
    public $con_vigencia_atual;
    public $con_objeto;
    public $con_conveniado;
    public $con_data_assinatura;
    public $con_publicacao_do;
    public $con_data_inicio;
    public $con_data_termino;
    public $con_prazo;
    public $con_situacao;
    public $con_saldo_convenio;
    public $con_observacao;
    public $con_banco;

    public function exchangeArray($data) {
         echo "<br> Entrou no construtor FormConvenio";
        $this->con_id = (!empty($data['con_id'])) ? $data['con_id'] : null;
        
        $this->con_numero = (!empty($data['con_numero'])) ? $data['con_numero'] : null;
        $this->con_tipo = (!empty($data['con_tipo'])) ? $data['con_tipo'] : null;
        $this->con_valor = (!empty($data['con_valor'])) ? $data['con_valor'] : null;
        $this->con_vigencia_atual = (!empty($data['con_vigencia_atual'])) ? $data['con_vigencia_atual'] : null;
        $this->con_objeto = (!empty($data['con_objeto'])) ? $data['con_objeto'] : null;
       // $this->con_conveniado = (!empty($data['con_conveniado'])) ? $data['con_conveniado'] : null;
        $this->con_conveniado = 9;
         $this->con_banco = 70;
        $this->con_data_assinatura = (!empty($data['con_data_assinatura'])) ? $data['con_data_assinatura'] : null;
        $this->con_publicacao_do = (!empty($data['con_publicacao_do'])) ? $data['con_publicacao_do'] : null;
        $this->con_data_inicio = (!empty($data['con_data_inicio'])) ? $data['con_data_inicio'] : null;
        $this->con_data_termino = (!empty($data['con_data_termino'])) ? $data['con_data_termino'] : null;
        $this->con_prazo = (!empty($data['con_prazo'])) ? $data['con_prazo'] : null;
        $this->con_situacao = (!empty($data['con_situacao'])) ? $data['con_situacao'] : null;
        $this->con_saldo_convenio = (!empty($data['con_saldo_convenio'])) ? $data['con_saldo_convenio'] : null;
        $this->con_observacao = (!empty($data['con_observacao'])) ? $data['con_observacao'] : null;
       
        
    }



}

<?php

/**
 * namespace para nosso modulo FormConvenio
 */

namespace FormConvenio;

// import Model\FormConvenio
use FormConvenio\Model\FormConvenio,
    FormConvenio\Model\FormConvenioTable;
// import Zend\Db
use Zend\Db\ResultSet\ResultSet,
    Zend\Db\TableGateway\TableGateway;

class Module {

    /**
     * include de arquivo para outras configuracoes desse modulo
     */
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * autoloader para nosso modulo
     */
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Register View Helper
     */
    public function getViewHelperConfig() {
        return array(
            # registrar View Helper com injecao de dependecia
            'factories' => array(
                'menuAtivo' => function($sm) {
            return new View\Helper\MenuAtivo($sm->getServiceLocator()->get('Request'));
        },
                'message' => function($sm) {
            return new View\Helper\Message($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
        },
            )
        );
    }

    /**
     * Register Services
     */
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'FormConvenioTableGateway' => function ($sm) {
            // obter adapter db atraves do service manager
            $adapter = $sm->get('Zend\Db\Adapter\Adapter');

            // configurar ResultSet com nosso model FormConvenio
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new FormConvenio());

            // chamando a tabela para return TableGateway configurado para nosso model FormConvenio
            return new TableGateway('tb_convenio', $adapter, null, $resultSetPrototype);
        },
                'ModelFormConvenio' => function ($sm) {
            // return instacia Model FormConvenioTable
            return new FormConvenioTable($sm->get('FormConvenioTableGateway'));
        }
            )
        );
    }

}

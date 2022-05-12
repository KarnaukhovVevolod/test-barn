<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Controller\IndexController;


/**
 * Description of TestControllerFactory
 *
 * @author 222
 */
class IndexControllerFactory implements FactoryInterface {
    //put your code here
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        return new IndexController($entityManager);
    }
}
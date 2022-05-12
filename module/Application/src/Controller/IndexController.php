<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\DeliveryForm;
use Application\Form\PackageWeightForm;
use Application\Form\TransportCompanyForm;
use Application\Form\WarehousesForm;
use Application\Service\DataBaseService;
use Application\Service\DeliveryService;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Form\DistanceSendingForm;

class IndexController extends AbstractActionController
{
    private $entityManager;
    private $db_service;
    private $delivery_service;

    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
        $this->db_service = new DataBaseService($entityManager);
        $this->delivery_service = new DeliveryService($entityManager);
    }
    public function indexAction()
    {
        return new ViewModel();
    }

    public function deliveryAction()
    {
        $data_transport = $this->db_service->getData('transport');
        $data_warehouse = $this->db_service->getData('warehouse');
        $form_delivery = new DeliveryForm([$data_transport, $data_warehouse]);
        $url_fastDelivery = $this->url()->fromRoute('application', ['action'=>'fast-delivery']);
        $url_regularDelivery = $this->url()->fromRoute('application',['action'=>'regular-delivery']);
        return new ViewModel(compact('form_delivery',
            'url_fastDelivery','url_regularDelivery'));
    }
    public function adminerAction()
    {
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $param = '';
            if (isset($data['distance_from'])) {
                $form = new DistanceSendingForm();
                $param = 'distance';
            } else if (isset($data['weight_from'])) {
                $form = new PackageWeightForm();
                $param = 'package';
            } else if(isset($data['dop_info_company'])) {
                $form = new TransportCompanyForm();
                $param = 'transport';
            } else if(isset($data['name_wrehouse'])) {
                $form = new WarehousesForm();
                $param = 'warehouse';
            }
            $form->setData($data);
            if ($form->isValid()) {
                $validData = $form->getData();
                if ($data['id'] != '' && (int)$data['id'] > 0) {
                    $this->db_service->updateData($validData, $param);
                } else {
                    $this->db_service->addData($validData, $param);
                }

            } else {
                $message = $form->getMessages();
                echo '<pre>'.print_r($message,true).'</pre>';
            }
        }
        $form_Distance = new DistanceSendingForm();
        $form_Weight = new PackageWeightForm();
        $form_Transport = new TransportCompanyForm();
        $form_Warehouses = new WarehousesForm();

        $data_distance = $this->db_service->getData('distance');
        $data_weight = $this->db_service->getData('package');
        $data_transport = $this->db_service->getData('transport');
        $data_warehouse = $this->db_service->getData('warehouse');
        return new ViewModel(compact(
            'form_Distance',
            'form_Weight',
            'form_Transport',
            'form_Warehouses',
            'data_distance',
            'data_weight',
            'data_transport',
            'data_warehouse'
        ));
    }

    public function fastDeliveryAction()
    {
        $f ='';
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $data_transport = $this->db_service->getData('transport');
            $data_warehouse = $this->db_service->getData('warehouse');
            $form = new DeliveryForm([$data_transport, $data_warehouse]);

            $form->setData($data);
            if ($form->isValid()) {
                $validData = $form->getData();
                $data_result = $this->
                delivery_service->getDelivery($validData);
                echo json_encode($data_result);
                die();
            } else {
                $message = $form->getMessages();
                echo json_encode($message);
                die();
                //echo '<pre>'.print_r($message,true).'</pre>';
            }

        }
    }
    public function regularDeliveryAction()
    {
        $r = '';
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $data_transport = $this->db_service->getData('transport');
            $data_warehouse = $this->db_service->getData('warehouse');
            $form = new DeliveryForm([$data_transport, $data_warehouse]);

            $form->setData($data);
            if ($form->isValid()) {
                $validData = $form->getData();
                $data_result = $this->
                delivery_service->getDelivery($validData, 'regular');
                echo json_encode($data_result);
                die();
            } else {
                $message = $form->getMessages();
                echo json_encode($message);
                die();
                //echo '<pre>'.print_r($message,true).'</pre>';
            }
        }

    }
}

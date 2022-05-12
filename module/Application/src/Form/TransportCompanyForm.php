<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 9:32
 */

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class TransportCompanyForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('transport_company');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        $this->addElements();
        $this->addInputFilter();

    }
    protected function addElements()
    {
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'id',
            'attributes' =>[
                'id' => 'id_transport_company',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'id (при добавлении записи поле должно быть пустым)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'name_company',
            'attributes' =>[
                'id' => '_name_company',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите название компании'
            ]
        ]);
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'company_total_cars',
            'attributes' =>[
                'id' => '_total_number_cars',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите сколько машин у компании'
            ]
        ]);
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'average_number_car',
            'attributes' =>[
                'id' => '_average_number_car',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите среднее кол-во заказов выполняемые одной машиной в сутки',
            ]
        ]);
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'current_orders_fast_delivery',
            'attributes' =>[
                'id' => '_current_orders_fast_delivery',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите текущее количество заказов быстрой доставки'
            ]
        ]);
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'current_order_regular_delivery',
            'attributes' =>[
                'id' => '_current_order_regular_delivery',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите текущее количество заказов обычной доставки',
            ],
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'dop_info_company',
            'attributes' =>[
                'id' => '_dop_info_company',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите дополнительную информацию о компании',
            ],
        ]);
        $this->add([
            'type'=>Element\Number::class,
            'name'=>'dop_number_fast_delivery_in_day',
            'attributes' =>[
                'id' => '_dop_number_fast_delivery_in_day',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите кол-во зарезервированные мест (в сутки) для  быстрой доставки',
            ],
        ]);
        $this->add([
            'type' => 'csrf',
            'name' =>'csrf',
            'attributes' => [],
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ],
            ],
        ]);
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Отправить',
                'class'=> 'btn btn-primary'
            ],
        ]);
    }

    protected function addInputFilter()
    {
        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name'=>'id',
            'required'=>false,
        ]);
        $inputFilter->add([
            'name'=>'name_company',
            'required'=>true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'max' => 250
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'=>'company_total_cars',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'average_number_car',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'current_orders_fast_delivery',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'current_order_regular_delivery',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'dop_info_company',
            'required'=>false,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'max' => 250
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'=>'dop_number_fast_delivery_in_day',
            'required'=>true
        ]);

    }
}
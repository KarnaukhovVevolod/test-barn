<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 10:35
 */

namespace Application\Form;
use Laminas\Form\Form;
use Laminas\Form\Element;

class WarehousesForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('warehouses');

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
                'id' => 'id_warehouses',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'id (при добавлении записи поле должно быть пустым)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'name_wrehouse',
            'attributes' =>[
                'id' => '_name_wrehouse',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите название Склада'
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'quarter',
            'attributes' =>[
                'id' => 'quarter',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'выберите четверть в какой расположен склад',
                'value_options'=>[
                    null=>'Выберите четверть в какой расположен склад',
                    1=>'Первая четверть',
                    2=>'Вторая четверть',
                    3=>'Третья четверть',
                    4=>'Четвёртая четверть'
                ]
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'position_relative_o',
            'attributes' =>[
                'id' => '_position_relative_o',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Расстояние до центральной точки О (км)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'position_relative_a',
            'attributes' =>[
                'id' => '_position_relative_a',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Расстояние до точки A (км) если она ближайшая'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'position_relative_b',
            'attributes' =>[
                'id' => '_position_relative_b',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Расстояние до точки B (км) если она ближайшая'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'warehouse_address',
            'attributes' =>[
                'id' => '_warehouse_address',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите адрес склада',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'warehouse_dopinfo',
            'attributes' =>[
                'id' => '_warehouse_dopinfo',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Введите дополнительную информацию о складе'
            ]
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
            'name'=>'name_wrehouse',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'quarter',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'position_relative_o',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'position_relative_a',
            'required'=>false
        ]);
        $inputFilter->add([
            'name'=>'position_relative_b',
            'required'=>false
        ]);
        $inputFilter->add([
            'name'=>'warehouse_address',
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
            'name'=>'warehouse_dopinfo',
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

    }

}
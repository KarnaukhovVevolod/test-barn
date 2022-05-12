<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 8:40
 */

namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Form\Element;

class PackageWeightForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('package_weight');

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
                'id' => 'id_weight',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'id (при добавлении записи поле должно быть пустым)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_from',
            'attributes' =>[
                'id' => '_weight_from',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите от скольки кг включительно(тип поля float)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_up_to',
            'attributes' =>[
                'id' => '_weight_up_to',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите до скольки кг включительно (тип поля float)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_coefficient',
            'attributes' =>[
                'id' => '_weight_coefficient',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите коэффициент для обычной доставка',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_price',
            'attributes' =>[
                'id' => '_weight_price',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите цену для быстрой доставки',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_coefficient',
            'attributes' =>[
                'id' => '_weight_coefficient',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите коэффициент для обычной доставка',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'weight_dop_param',
            'attributes' =>[
                'id' => '_weight_dop_param',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите дополнительные параметры (описание)'
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'weight_select',
            'attributes' =>[
                'id' => '_weight_up_to',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Выберите стандартный тип или компанию',
                'value_options'=>[
                    null=>'Выберите либо стандартный тип либо компанию',
                    0=>'Выбрать стандартный тип'
                ]
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
            'name'=>'weight_from',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'weight_up_to',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'weight_coefficient',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'weight_price',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'weight_dop_param',
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
            'name'=>'weight_select',
            'required'=>true
        ]);

    }
}
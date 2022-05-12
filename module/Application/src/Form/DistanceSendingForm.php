<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 09.05.2022
 * Time: 16:07
 */

namespace Application\Form;
use Laminas\Form\Form;
use Laminas\Form\Element;

class DistanceSendingForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('distance_for_sending');

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
                'id' => 'id_distance',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'id (при добавлении записи поле должно быть пустым)'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'distance_from',
            'attributes' =>[
                'id' => '_distance_from',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите от скольки км включительно'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'distance_up_to',
            'attributes' =>[
                'id' => '_distance_up_to',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите до скольки км включительно'
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'distance_coefficient',
            'attributes' =>[
                'id' => '_distance_coefficient',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите коэффициент для обычной доставки',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'distance_price',
            'attributes' =>[
                'id' => '_distance_price',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите Цену для быстрой доставки',
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'distance_dop_param',
            'attributes' =>[
                'id' => '_distance_dop_param',
                'class'=>"form-control"
            ],
            'options'=> [
                'label'=> 'Введите дополнительные параметры (описание)'
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'distance_select',
            'attributes' =>[
                'id' => '_distance_up_to',
                'class'=>"form-control"
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
                'class' => 'btn btn-primary'
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
            'name'=>'distance_from',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'distance_up_to',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'distance_coefficient',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'distance_price',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'distance_dop_param',
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
            'name'=>'distance_select',
            'required'=>true
        ]);

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: 222
 * Date: 10.05.2022
 * Time: 18:46
 */

namespace Application\Form;
use Laminas\Form\Form;
use Laminas\Form\Element;

class DeliveryForm extends Form
{
    protected $data;
    protected $transport=[];
    protected $warehouse=[];
    public function __construct($data)
    {
        // Define form name
        parent::__construct('delivery');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        $this->data = $data;
        $this->filterData();
        $this->addElements();
        $this->addInputFilter();

    }

    protected function filterData()
    {
        $data = $this->data;
        $transport = $data[0];
        $warehouse = $data[1];
        $this->transport[null] = 'Выберите компанию';
        $this->warehouse[null] = 'Выберите склад';
        foreach ($transport as $one) {
            $this->transport[$one['id']] = $one['nameCompany'];
        }
        foreach ($warehouse as $one) {
            $this->warehouse[$one['id']] = $one['nameWrehouse'];
        }

    }


    protected function addElements()
    {
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'company',
            'attributes' =>[
                'id' => 'id_company',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Выберите траснспортную компанию',
                'value_options'=>$this->transport
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'type_delivery',
            'attributes' =>[
                'id' => 'id_type_delivery',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Выберите тип доставки',
                'value_options'=>[
                    null=>'выберите тип доставки',
                    0=>'Обычная доставка',
                    1=>'Быстрая доставка',
                ]
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'stock_1',
            'attributes' =>[
                'id' => 'id_stock_1',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Выберите склад отправления',
                'value_options'=> $this->warehouse
            ]
        ]);
        $this->add([
            'type'=>Element\Select::class,
            'name'=>'stock_2',
            'attributes' =>[
                'id' => 'id_stock_2',
                'class'=>'form-control'
            ],
            'options'=> [
                'label'=> 'Выберите склад прибытия',
                'value_options'=>$this->warehouse
            ]
        ]);
        $this->add([
            'type'=>Element\Text::class,
            'name'=>'stock_weight',
            'attributes' =>[
                'id' => 'id_stock_weight',
                'class'=>'form-control',
                'placeholder'=> '0.15'
            ],
            'options'=> [
                'label'=> 'Введите вес посылки (кг)'

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
                'class'=> 'btn btn-primary button_serve'
            ],
        ]);
    }

    protected function addInputFilter()
    {
        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name'=>'company',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'type_delivery',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'stock_1',
            'required'=>true,
        ]);
        $inputFilter->add([
            'name'=>'stock_2',
            'required'=>true
        ]);
        $inputFilter->add([
            'name'=>'stock_weight',
            'required'=>true
        ]);

    }

}
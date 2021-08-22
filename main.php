<?php
#классы 
	#класс животные
	trait animals{

		public $id;
		public $product;
		public $type;

		#получаем животных и их продукцию
		public function getAnimals($id, $type){ 

			$this->id = $id;
			if( $type == 'cow' ){
				$this->product = rand(8,12);
				$this->type = 'cow';
				$data = 'id = '.$this->id. ' '. 'type = '. $this->type. ' milk_product = '.$this->product.' liters';
			}else{
				$this->product = rand(0,1);
				$this->type = 'chicken';
				$data = 'id = '.$this->id. ' '. 'type = '. $this->type. ' egg_product = '.$this->product.' ';
			}
			
			$param = ['type'=>$this->type,'product'=>$this->product];
			return [$data, $param];

		}
	}

	#класс хлев
	class barn {
		use animals;

		public $barn_pull_string = [];
		public $barn_pull_milk = 0;
		public $barn_pull_egg = 0;
		public $end_id;

		#инициализируем хлев
		public function __construct(){
			for($i = 0; $i < 7; $i++){
				$data = $this->getAnimals($i,'cow');
				array_push($this->barn_pull_string, $data[0]);
				$this->barn_pull_milk = $this->barn_pull_milk + $data[1]['product'];
			}

			for($i = 7; $i < 22; $i++){
				$data = $this->getAnimals($i,'chicken');
				array_push($this->barn_pull_string, $data[0]);
				$this->barn_pull_egg = $this->barn_pull_egg + $data[1]['product'];

			}
			$this->end_id = $i;  
		}

		#получаем хлев
		public function getBarn(){
			return [$this->barn_pull_string, $this->barn_pull_milk, $this->barn_pull_egg];
		}

		#добавляем коров в хлев
		public function addBarnCow($number){
			$end_number = $this->end_id + $number;
			for($i = $this->end_id; $i < $end_number; $i++){
				$data = $this->getAnimals($i,'cow');
				array_push($this->barn_pull_string, $data[0]);
				$this->barn_pull_milk = $this->barn_pull_milk + $data[1]['product'];
			}
			$this->end_id = $end_number;
		}


		#добавляем куриц в хлев
		public function addBarnChicken($number){
			$end_number = $this->end_id + $number;
			for($i = $this->end_id; $i < $end_number; $i++){
				$data = $this->getAnimals($i,'chicken');
				array_push($this->barn_pull_string, $data[0]);
				$this->barn_pull_egg = $this->barn_pull_egg + $data[1]['product'];

			}
			$this->end_id = $end_number;
		}

		#вывод хлева в консоле
		public function consoleOutputBarn(){
			$get_barn = $this->getBarn();
			$milk = $get_barn[1];
			$egg = $get_barn[2];
			$init_barn = implode(PHP_EOL,$get_barn[0]);
			echo PHP_EOL.'init barn '.$init_barn.PHP_EOL;
			echo PHP_EOL.'all milk = '.$milk;
			echo PHP_EOL.'all egg = '.$egg;
		}

	}


 ?>
      
<?php 
		#инициализируем хлев
		$barn = new barn();

		#выводим в консоле всех животных в хлеву
		$barn->consoleOutputBarn();

		#добавляем в хлев коров
		echo PHP_EOL;
		$line_cow = readline("add cow (Example: 0;)(Example: 10)(only-number) ");
		$line_cow = (int) $line_cow;
		if($line_cow > 0){
			$barn->addBarnCow($line_cow);
		}

		#добавляем в хлев куриц  
		echo PHP_EOL;
		$line_chicken = readline("add chicken(Example: 0;)(Example: 10)(only-number)");
		$line_chicken = (int) $line_chicken;
		if($line_chicken > 0){
			$barn->addBarnChicken($line_chicken);
		}

		#выводим результат после добавления (если что-то добавили в хлев )
		if($line_cow > 0  || $line_chicken > 0){
			$barn->consoleOutputBarn();
		}
		echo PHP_EOL.PHP_EOL.' END SCRIPT';
     	?>
}

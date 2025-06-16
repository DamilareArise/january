<?php 
    $name = 'Damilare';
    function hello(){
        echo "Hello, World!";
    }
    // hello();

    class Car{
        private $name;
        private $color;

        function __construct($inp_name, $inp_color){
            $this->name = $inp_name;
            $this->color = $inp_color;

        }
        // public function start(){
        //     return "This is a $this->color $this->name ";
        // }

        public function get_name(){
            return $this->name;
        }

    }

    $car1 = new Car("Lexus", "Red");
    $car2 = new Car("Benz", 'Black');

    
    // $car2->color = 'Black';
    // $car2->name = 'Benz';
    // // echo $car2->color;

    $smt = $car1->get_name();
    // echo $smt;


    class Contact{
        private $contacts;

        function __construct($inp_contacts){
            $this->contacts = $inp_contacts;
        }

        public function fetch_all(){
            return $this->contacts;
        }

        public function fetch_one($index){
            $contact = $this->contacts[$index];
            return $contact;
        }

        public function add_contact($name, $phone){
            $contact = [
                "name" => $name,
                "phone" => $phone,
            ];
            array_push($this->contacts, $contact);
        }

        public function delete_contact($index){
            array_splice($this->contacts, $index, 1);
        }

        public function edit_contact($index, $name, $phone){
            $contact = [
                "name" => $name,
                "phone" => $phone,
            ];

            array_splice($this->contacts, $index, 1, $contact);
        }
    }


?>
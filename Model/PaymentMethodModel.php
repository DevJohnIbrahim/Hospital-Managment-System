<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");

class PaymentMethodModel implements CRUD{
    public $id;
    public $name;
    public function Insert()
    {
        // TODO: Implement Insert() method.
    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM payment_method";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new self();
                $Objects[$x]->id = $row['id'];
                $Objects[$x]->name = $row['name'];
                $x++;
            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }
}
?>
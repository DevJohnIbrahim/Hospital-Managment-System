<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");

class TimeSlotsModel implements CRUD{
    public $ID;
    public $Doctor_ID;
    public $From;
    public $To;
    public $Day;
    public $Capacity;
    public $MaxCapacity;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = 'INSERT INTO timeslots (Doctor_ID,From,to,Day,MMaxCapacity) VALUES ("'.$this->Doctor_ID.'","'.$this->From.'","'.$this->To.'","'.$this->Day.'","'.$this->MaxCapacity.'")';
        $DB->execute($sql);
        // TODO: Implement Insert() method.
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql ="DELETE FROM timeslots WHERE ID = ".$this->ID;
        $DB->execute($sql);
        // TODO: Implement Delete() method.
    }

    public function Modify()
    {
        $sql = "UPDATE timeslots SET `From`=['".$this->From."'],
        To`=['".$this->To."'],Day`=['".$this->Day."'],`Capacity`=['".$this->Capacity."'],`MaxCapacity`=['".$this->MaxCapacity."'] WHERE ID = '".$this->ID."'";
        $DB = DB::getInstance();
        $DB->execute($sql);
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM timeslots WHERE Doctor_ID = '".$this->Doctor_ID."' AND Day = '".$this->Day."'";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($Result)){
                if ($row['Capacity']>= $row['MaxCapacity']){

                }
                else{
                    $Objects[$x] = new self();
                    $Objects[$x]->ID = $row['ID'];
                    $Objects[$x]->Doctor_ID = $row['Doctor_ID'];
                    $Objects[$x]->From = $row['From'];
                    $Objects[$x]->To = $row['To'];
                    $Objects[$x]->Day = $row['Day'];
                    $Objects[$x]->Capacity = $row['Capacity'];
                    $Objects[$x]->MaxCapacity = $row['MaxCapacity'];
                    $x++;
                }

            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }
}
?>
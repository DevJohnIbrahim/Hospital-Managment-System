<?php

    require_once ("..\Public\Interfaces\CRUDInterface.php");

    require_once ("..\Public\Database\DBConnect.php");

    class AppointmentModel implements CRUD
    {
        public $ID;
        public $Patient;
        public $Doctor;
        public $TimeSlot_ID;
        public $status;
        public function Insert()
        {
            $DB = DB::getInstance();
            $sql = "INSERT INTO `appointment`(patient_id ,doctor_id , TimeSlot_ID , status) VALUES
                    ('".$this->Patient."','".$this->Doctor."' , '".$this->TimeSlot_ID."','".$this->status."')";
            $Result = $DB->execute($sql);
        }

        public function Delete()
        {
            $DB = DB::getInstance();
            $sql = "DELETE FROM `appointment` WHERE ID = '".$this->ID."'";
            echo $sql;
            $DB->execute($sql);
        }

        public function Modify()
        {

        }

        public function Select()
        {
            $DB = DB::getInstance();
            $sql = "SELECT * FROM `appointment` WHERE ID = '" . $this->ID . "'";
            $result = $DB->execute($sql);
            if ($result->num_rows>0){
                $Object = new AppointmentModel();
                $row = mysqli_fetch_array($result);
                $Object->ID = $row['id'];
                $Object->Patient = $row['patient_id'];
                $Object->Doctor = $row['doctor_id'];
                return $Object;
            }
            else{
                return NULL;
            }

        }

        public function selectAll()
        {

            $DB = DB::getInstance();

            $sql = "SELECT * FROM `appointment`";

            $result = $DB->execute($sql);

            if ($result->num_rows>0)

            {

                $Objects = array();

                $x = 0;

                while ($row = mysqli_fetch_array($result))

                {

                    $Objects[$x] = new self();

                    $Objects[$x]->ID = $row['patient_id'];

                    $Doctor_ID = $row['doctor_id'];

                    $Objects[$x]->time = $row['app_time'];

                    $Objects[$x]->date = $row['app_date'];

                    $Bill_ID = $row['bill_id'];

                   // self::getbill($Bill_ID);

                   // getDoctor($Doctor_ID);

                    //getPatient($Paitent_ID);

                    $x++;

                }

                return $Objects;

            }

            else

            {

                return NULL;

            }

        }

        public function SelectAppointments($ID){
            $DB = DB::getInstance();
            $sql = "SELECT * FROM appointment WHERE doctor_id IN (SELECT ID FROM doctor WHERE Employee_ID IN (SELECT id FROM employee WHERE dep_id = '".$ID."'))";
            $Results = $DB->execute($sql);

            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($Results)){
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['id'];
                $Objects[$x]->Patient = $row['patient_id'];
                $Objects[$x]->Doctor = $row['doctor_id'];
                $x++;
            }
            return $Objects;
        }

        public function Check(){
            $DB = DB::getInstance();
            $sql = "SELECT * from appointment WHERE doctor_id = '".$this->Doctor."' AND patient_id = '".$this->Patient."' AND TimeSlot_ID = '".$this->TimeSlot_ID."'";
            $Result = $DB->execute($sql);
            if ($Result->num_rows>0){
                return True;
            }
            else{
                return False;
            }
        }
    }
?>

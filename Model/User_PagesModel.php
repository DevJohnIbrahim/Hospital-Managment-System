<?php
require_once ("..\Public\Database\DBConnect.php");
require_once ("..\Public\Interfaces\CRUDInterface.php");
class User_PagesModel implements CRUD{
    public $ID;
    public $Page_ID;
    public $User_Type_ID;
    public function Insert()
    {
            $DB = DB::getInstance();
            $sql = "INSERT INTO `user_pages`(`Page_ID`, `User_Type_ID`) VALUES ('".$this->Page_ID."','".$this->User_Type_ID."')";
            $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `user_pages` WHERE Page_ID = '".$this->Page_ID."'AND User_Type_ID = '".$this->User_Type_ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `user_pages` WHERE User_Type_ID = '".$this->User_Type_ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Objects = array();
            $x = 0;

            while ($row = mysqli_fetch_array($result)){
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->Page_ID = $row['Page_ID'];
                $Objects[$x]->User_Type_ID = $row['User_Type_ID'];
                $x++;

            }
            return $Objects;
        }else{
            return NULL;
        }
    }

    public function Check(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `user_pages` WHERE User_Type_ID = '".$this->User_Type_ID."' AND Page_ID = '".$this->Page_ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Objects = array();
            $x = 0;

            while ($row = mysqli_fetch_array($result)){
                $Objects[$x] = new self();
                $x++;
            }
            return $Objects;
        }else{
            return NULL;
        }
    }
}

?>
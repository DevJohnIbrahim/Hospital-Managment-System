<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class PageModel implements CRUD{
    public $ID;
    public $Friendly_Name;
    public $URL;
    public $HTML;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `pages`(`Friendly_Name`, `URL`) VALUES ('".$this->Friendly_Name."','".$this->URL."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `pages` WHERE ID = '".$this->ID."'";
        $DB->execute($sql);

    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `pages` WHERE ID = '".$this->ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
                $row = mysqli_fetch_array($result);
                $Objects = new self();
                $Objects->Friendly_Name = $row['Friendly_Name'];
                $Objects->ID = $row['ID'];
                $Objects->URL = $row['URL'];
                 return $Objects;
        }

        else{
            return NULL;
        }
    }

    public function Check(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `pages` WHERE URL = '".$this->URL."' AND Friendly_Name = '".$this->Friendly_Name."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $row = mysqli_fetch_array($result);
            $Objects = new self();
            $Objects->Friendly_Name = $row['Friendly_Name'];
            $Objects->ID = $row['ID'];
            $Objects->URL = $row['URL'];
            return $Objects;
        }

        else{
            return NULL;
        }
    }
    public function SelectAll(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `pages`";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($result)){
                $Objects[$x] = new self();
                $Objects[$x]->Friendly_Name = $row['Friendly_Name'];
                $Objects[$x]->ID = $row['ID'];
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
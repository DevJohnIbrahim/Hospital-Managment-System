<?php
require_once ("..\Controller\DoctorController.php");
require_once ("..\Model\DoctorModel.php");
require_once ("../Controller/UserController.php");
$DepID = 1;
$DoctorControllerObject = new DoctorController();
$Doctors = $DoctorControllerObject->GetDepDR($DepID);
$UserControllerObject = new UserController();
?>

<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }
    .result p:hover{
        background: #f2f2f2;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    //**********Time Slot
    $(document).ready(function(){
        $('#Doctors').on('change',function(){
            var Doctors = $(this).val();
            var inputDate = document.getElementById("appDate").valueAsDate;
            var select = document.getElementById("TimeSlots");

            var length = select.options.length;
            for (i = 0; i < length; i++) {
                select.options[i] = null;
            }
            if (inputDate == null){

            }
            else{
                var day = inputDate.getDay();
                var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                var appdate = (days[day]);
                if (Date){
                    $.ajax({
                        type:'get',
                        url :'../Controller/AppointmentController.php',
                        datatype:"json",
                        data:{Doctors:Doctors,
                            Date:appdate},
                        success:function (html) {
                            if (html == ""){
                                $("#TimeSlots").append("<option>No data to show</option>");

                            }
                            else{
                                $("#TimeSlots").append(html);
                            }

                        }
                    });
                }else{
                    $('#TimeSlots').html('<option value = "">Please Select Doctor First And Date First</option>');
                }
            }

        });

    });


    //*************Search
    $(document).ready(function(){
        $("#ID").change(function(){
            var ID = $(this).val();
            $.ajax({
                type : "get",
                url : "../Controller/UserController.php",
                datatype :"json",
                data :{ID:ID},
                success:function (html){

                    $('h4.manager').text(html);

                }

            });
        });
    });

</script>
<html>
<head>

</head>
<body>
<h4 style="color: red">Sorry But the ID you entered is incorrect please try again</h4>
<form action = "../Controller/AppointmentController.php" method="post">

    Select Appointment Date: <input type = "date" id = "appDate" required><br>

    Select Dr.Name:  <select id = "Doctors" name = "Doctors">
        <option value="1">test</option>
        <?php
        for ($x=0;$x<count($Doctors);$x++){
            echo "<option value = ".$Doctors[$x]->ID.">".$UserControllerObject->getDoctorName($Doctors[$x]->ID)."</option>";
        }

        ?>
    </select><br>
    Select Time :
    <select id = "TimeSlots" name = "TimeSlots">

    </select>
    <br>
    <div class="search-box">
        <input type="text" id = "ID" name = "ID" autocomplete="off" placeholder="Patient ID" />
        <div class="result"></div>
    </div>


    <h4 id = "Checking" class = "manager"></h4>
    <br>
    <input type = "submit"  name = "Add" value="Save">

</form>
</body>
</html>

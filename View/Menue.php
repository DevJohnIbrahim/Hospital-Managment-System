<?php
require_once ("..\Controller\UserController.php");
require_once ("..\Controller\User_PagesController.php");
require_once ("..\Model\UserModel.php");
require_once ('..\Controller\PageController.php');
$UserObject = UserController::ViewProfile($_SESSION['ID']);
$Pages = User_PagesController::getPages($UserObject->UserType_ID);
?>

<style>
    .vertical-menu {
        width: 200px; /* Set a width if you like */
    }

    .vertical-menu a {
        background-color: #eee; /* Grey background color */
        color: black; /* Black text color */
        display: block; /* Make the links appear below each other */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove underline from links */
    }

    .vertical-menu a:hover {
        background-color: #ccc; /* Dark grey background on mouse-over */
    }

    .vertical-menu a.active {
        background-color: #4CAF50; /* Add a green color to the "active/current" link */
        color: white;
    }
</style>
<html>
<head>
    <title>Menue</title>
</head>
<body>
<div class="vertical-menu">
    <?php
        for ($x=0; $x<count($Pages);$x++){
            $Object = PageController::getPageData($Pages[$x]->Page_ID);
            echo "<a href = ".$Object->URL.">".$Object->Friendly_Name."</a>";
        }
    ?>
</div>
</body>
</html>

<!DOCTYPE html>

<html>

<head>

 <title>Notification using PHP Ajax Bootstrap</title>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

 <br /><br />

 <div class="container">

  <nav class="navbar navbar-inverse">

   <div class="container-fluid">

    <div class="navbar-header">

     <a class="navbar-brand" href="#">PHP Notification Tutorial</a>

    </div>
    <ul class="nav navbar-nav navbar-right">

     <li class="dropdown">

      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span></a>
      <ul class="dropdown-menu">
      <div id="search1">john</div>
      </ul>

     </li>

    </ul>

   </div>

  </nav>

  <br />


 </div>

</body>

</html>

<script>
setInterval(search(), 20000);
function search() {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("search1").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","fetch.php",true);
  xmlhttp.send();
}
</script>

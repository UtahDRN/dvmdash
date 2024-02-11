<?php
   ob_start();
   session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CTRS Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php require('control/_config.php'); ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">CTRS Dashboard</a>
    </div>
     <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php?page=Home">Home</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Logs<span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=ShortLogs">Short Logs</a></li>
            <li><a class="dropdown-item" href="index.php?page=FullLogs">Full Logs</a></li>
          </ul>
        </li>
 <?php
               if ($_SESSION['username'] == $username) {
           echo '<li><a href="index.php?page=Admin">Admin</a></li>';
               }else {
               }
          ?>
        
       <li class="dropdown">
          
          
                   <?php
               if ($_SESSION['username'] == $username) {
           echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Control<span class="caret"></span></a>
           <ul class="dropdown-menu">
            <li><a href="index.php?page=CChannel">Control Channel</a></li>
            <li><a href="index.php?page=VChannel">Voice Channel</a></li>
            <li><a href="index.php?page=DChannel">DVRS</a></li>
            <li role="separator" class="divider"></li>
            <li class="disabled"><a href="index.php?page=VOChannel">VOC</a></li>
          </ul>';
               }else {
               }
          ?>  
        <li class="active"><a href="index.php?page=Map">Map</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
               if ($_SESSION['username'] == $username) {
           echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
               }else {
          echo  '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
               }
          ?>
      </ul>
    </div>
  </div>
</nav>

    <div class="container-fluid">
        <?php
$path = '/api/tg/list';
$url = "https://$apihost:$port$path";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'X-DVMFNE-MANAGER-API-KEY: ' . $apikey
]);

$response = curl_exec($curl);
$httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (curl_errno($curl)) {
    echo "error: " . curl_error($curl);
} else if ($httpStatusCode == 200) {
   // echo "Response: " . $response;
   echo  '
   <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Austin+Texas" width="800" height="800" frameborder="0" style="border:0" allowfullscreen></iframe>';
} else {
    echo '<iframe src="https://monitor.centrunk.net/fnePeerMap" width="1100" height="700" title="CTRS Web Map"></iframe>';
}

curl_close($curl);
$arr = json_decode($response, true);

        
            
            
?>
</div>
<footer class="container-fluid text-center">
  <p>&copy; Copyright <?php echo date("Y");?> Hanna Johnson. All rights reserved.</p>
</footer>

</body>
</html>

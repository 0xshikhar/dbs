<html>
<title>DBMS LAB</title>

<body>
<form action="accessControl.php" method="post">
<input type="text" id="path" name="path" placeholder="Enter file path" />
<input type="submit" value="Submit">
</form>



<?php
clearstatcache();
$path = $_POST['path'];
exec('pwd ', $pwd, $retval);
echo '<br>Present Working Directory: '; foreach($pwd as $x) { echo $x, ' '; } 

if($path!=null){
echo '<br>Absolute Path...'.$path;
echo "<h3>Method 1: Using system/exec </h3>";
echo 'List of files in this directory file';
exec('ls '.$path, $la, $retval);
foreach($la as $l => $s) {
  	echo "<br>".$s;
	echo " ---> "; 
	$outx = "";
	exec("stat -c '%U' ".$path."/".$s, $outx, $ret); 
	foreach($outx as $x) { echo $x; } 
}

echo '<br><br>List of users from /etc/passwd: <br>';
exec('cat /etc/passwd | cut -d":" -f1 ', $us, $retval);
foreach($us as $l => $s) {
  	echo $s. ", "; 
}

echo "<h3>Method 2: Using PHP's inbuilt functions</h3>";
$ls = scandir($path);
$ownerList = array();

clearstatcache(); /*Clear the cache*/
echo 'List of files in this directory file';
foreach($ls as $l => $s) {
  	echo "<br>".$path.'/'.$s; 

/*posix_getpwuid() will return an array of information about the user referenced by the user ID.
fileowner() will return the user id of the owner of the file*/
	echo " ---> ".posix_getpwuid(fileowner($path.'/'.$s))['name']; 
	array_push($ownerList, posix_getpwuid(fileowner($path.'/'.$s))['name']);
}

$user = array_unique($ownerList);
//print_r(count($user));
echo '<br><br>List of Users: ';
foreach($user as $l => $s) {echo $s.", ";}
}

?>


</body>
</html>

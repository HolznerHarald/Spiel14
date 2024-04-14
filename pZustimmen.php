<?php
//verbinden
try
{
	$dbh = new PDO ("mysql:dbname=spiel1; host=localhost", "HH11", "abc");
	//print ("Verbindung erfolgreich hergestellt.\nuser1 existiert:");
	// Select 1 from table_name will return false if the table does not exist.
}
catch(PDOException $e)
{
		print $e->getMessage();
}
// Parameter
$Gegnername =$_REQUEST["wert"];
//print $Gegnername;
$Name= $_REQUEST["wert2"];

//update Status Gegner
$sql = "UPDATE user1 SET SpielStatus = 'g', gegner={$Name} WHERE p_id = {$Gegnername}"; 
print $sql;
$dbh->query($sql);


//Spielfile schreiben
$Spielfilename = "a".$Gegnername;
$sql = "INSERT INTO {$Spielfilename} "."(Spieler,Action)"."VALUES ({$Name},'Zustimmen');";
print $sql;
$dbh->query($sql);	
$sql = "INSERT INTO {$Spielfilename} "."(Spieler,Action)"."VALUES ({$Name},'Ende');";
print $sql;
$dbh->query($sql);	

$dbh = null;

?>

<?php
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
// 1. Zeile Wurf 2.Zeile Ende anhängen
$Spielfilename = substr($_REQUEST["wert"],0,2); 
;
$Spieler = substr($_REQUEST["wert2"],0,1);
$Action = substr($_REQUEST["wert2"],2);
$sql = "INSERT INTO {$Spielfilename} "."(Spieler,Action)"."VALUES ({$Spieler},{$Action});";
$dbh->query($sql);	

$sql = "INSERT INTO {$Spielfilename} "."(Spieler,Action)"."VALUES ({$Spieler},'Ende');";
$dbh->query($sql);	
$dbh = null;
?>



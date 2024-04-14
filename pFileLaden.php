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

// alle abfragen

$Spielfilename = $_REQUEST["wert"]; 
$sql = "SELECT * FROM {$Spielfilename}";			
$rueckgabe2 = $dbh->query($sql);
$ergebnis2 = $rueckgabe2-> fetchAll();
$zae=count($ergebnis2);
for ($i = 0; $i <$zae; $i++) {
	if ($Spielfilename=="user1"){
		print($ergebnis2[$i][2].$ergebnis2[$i][0]."\n");
	}
	else{
		print($ergebnis2[$i][2].$ergebnis2[$i][1]."\n");
	}
}
$dbh = null;
?>
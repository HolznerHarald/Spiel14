<?php
//user 1 verbinden
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
// user 1 einlesen
$sql = "SELECT * FROM user1";		
$rueckgabe2 = $dbh->query($sql);
$ergebnis2 = $rueckgabe2-> fetchAll();
//print_r ($ergebnis2);
//print $ergebnis2[10][0];
$zae=count($ergebnis2);
for ($i = 0; $i <$zae; $i++) {
    if ($ergebnis2[$i][0] == $_REQUEST["wert"]){
		$wert = $_REQUEST["wert"];
        $sql = "UPDATE user1 SET SpielStatus = 'a' WHERE p_id = {$wert}";        
		$dbh->query($sql);		
    }
}
// Spieltabelle anlegen
$SpielTablename = "a".$_REQUEST["wert"];
//Exist  ?
try {		
		$result = $dbh->query("SELECT 1 FROM {$SpielTablename} LIMIT 1");
		$exis = 1;	
} catch (Exception $e) {  
		$exis = 0;		
}

if ($exis==1) {
	try {
		$result = $dbh->query("DROP TABLE {$table}");
	} catch (Exception $e) {  
		print $e->getMessage();
	}	
}

try
{
	$result = $dbh->query("CREATE TABLE {$SpielTablename} (p_id integer unsigned not null auto_increment primary key, Spieler integer, Action varchar(10))");
	
	$sql = "INSERT INTO {$SpielTablename} "."(Spieler,Action)"."VALUES ({$wert},'Ende');";
	print  $sql;
	$dbh->query($sql);			
}
catch(PDOException $e)
{
	print $e->getMessage();
}
$dbh = null;
?>


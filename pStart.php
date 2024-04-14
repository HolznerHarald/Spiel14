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

//Exist
try {
		$table="user1";
		$result = $dbh->query("SELECT 1 FROM {$table} LIMIT 1");
		$exis = 1;	
} catch (Exception $e) {  
		$exis = 0;		
}		
//print $exis;
	
//Create
if ($exis==0) {
	try
	{
		$result = $dbh->query("CREATE TABLE USER1 (p_id integer unsigned not null auto_increment primary key, gegner integer, SpielStatus varchar(10))");
	
		//print "created";			
	}
	catch(PDOException $e)
	{
		print $e->getMessage();
	}
}
//Eintrag
$sql = "INSERT INTO user1 "."(gegner,SpielStatus)"."VALUES (0,'');";
$dbh->query($sql);
//print ("Eintrag:j\n");

$sql = "SELECT (p_id) FROM user1 ORDER BY p_id DESC LIMIT 1";
$rueckgabe2 = $dbh->query($sql);
$ergebnis2 = $rueckgabe2-> fetchAll();		
print $ergebnis2[0][0];
$dbh = null;
?>



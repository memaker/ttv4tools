<?php
/**
 * This scrip creates a corpus file
 * Author: Roberto Bartolomé
 * 2014-06-21 v1.0
 * 2014-07-15 v1.1 Rename to corpus_compile.php
 * 
 * Usage:
 * Open a navigator with the url http://localhost/ttv4tools/corpus_compile.php
 * 
 */

// ====================== Update only this block of code ======================
$FILENAME = "leads.csv";
// ====================== Update only this block of code ======================

if (isset($_POST['boton']))
{
	// save the file, do not open it
	header("Content-Disposition: attachment; filename=\"$FILENAME\"");
	
	// conecto la bd
	$db = mysql_connect("localhost", "root", "root") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("corpus_compile");
	
	$query1 = "SELECT description FROM item1";
	$result1 = mysql_query($query1);
	if (!$result1) { 
		die('Invalid query: ' . mysql_error()); 
	}
	while ($row1 = mysql_fetch_assoc($result1))
	{
		$query2 = "SELECT description FROM item2";
		$result2 = mysql_query($query2);
		if (!$result2) { 
			die('Invalid query: ' . mysql_error()); 
		}
		while ($row2 = mysql_fetch_assoc($result2))
		{
			$query3 = "SELECT description FROM item3";
			$result3 = mysql_query($query3);
			if (!$result3) {
				die('Invalid query: ' . mysql_error());
			}
			while ($row3 = mysql_fetch_assoc($result3))
			{
				$query4 = "SELECT description FROM item4";
				$result4 = mysql_query($query4);
				if (!$result4) {
					die('Invalid query: ' . mysql_error());
				}
				while ($row4 = mysql_fetch_assoc($result4))
				{
					$reg = "\"lead\",";
					$reg .= sprintf("\"%s\"", 
							$row1['description'] 
							. " " . $row2['description']
							. " " . $row3['description']
							. " " . $row4['description']
					);
					$reg .= "\n";
					echo $reg;
				}
			}
		}
	}	
	
	$lines = file("corpus_compile_noleads.txt");
	foreach($lines as $line)
	{
		echo $line;
	}
	
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
	
	echo $contents;
} else {
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
	<h2>Generate a corpus file</h2>
	<p>Save the file to workspace/data/corpus_twittermometro/base/leads.csv</p>
	<form name="form" method="post" action="corpus_compile.php">
	<table border="0">
	<tr>
	<td colspan="2"><input type="submit" name="boton" value="Submit"></td>
	</tr>
	</table>
	</form>
	</body>
	</html>
	<?php 
}
?>


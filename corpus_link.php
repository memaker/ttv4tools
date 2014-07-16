<?php
/**
 * This scrip creates a corpus file
 * Author: Roberto Bartolomé
 * 2014-07-16 v1.0
 * 
 * Usage:
 * Open a navigator with the url http://localhost/ttv4tools/corpus_link.php
 * Files are:
 * 		base/leads.csv
 *		base/noleads.csv
 *		base/neutrals.csv
 *
 *		pets/leads.csv
 *		pets/noleads.csv
 */

// ====================== Update only this block of code ======================
$BASE_LEADS_FILE = "/home/roberto/workspace/data/corpus_twittermometro/base/leads.csv";
$BASE_NOLEADS_FILE = "/home/roberto/workspace/data/corpus_twittermometro/base/leads.csv";
$BASE_NEUTRALS_FILE = "/home/roberto/workspace/data/corpus_twittermometro/base/leads.csv";

$PETS_LEADS_FILE = "/home/roberto/workspace/data/corpus_twittermometro/base/leads.csv";
$PETS_NOLEADS_FILE = "/home/roberto/workspace/data/corpus_twittermometro/base/leads.csv";

$CORPUS = "/home/roberto/workspace/data/corpus_twittermometro/corpus_synthetic.txt";
// ====================== Update only this block of code ======================

if (isset($_POST['boton']))
{
	// read the files
	$file1 = file_get_contents($BASE_LEADS_FILE, true);
	$file2 = file_get_contents($BASE_NOLEADS_FILE, true);
	$file3 = file_get_contents($BASE_NEUTRALS_FILE, true);
	$file4 = file_get_contents($PETS_LEADS_FILE, true);
	$file5 = file_get_contents($PETS_NOLEADS_FILE, true);

	// delete the existing file
	unlink($CORPUS);

	// put the contents
	if (!empty($file1)) {
		file_put_contents($CORPUS, $file1);
	}
	if (!empty($file2)) {
		file_put_contents($CORPUS, $file2, FILE_APPEND | LOCK_EX);
	}
	if (!empty($file3)) {
		file_put_contents($CORPUS, $file3, FILE_APPEND | LOCK_EX);
	}
	if (!empty($file4)) {
		file_put_contents($CORPUS, $file4, FILE_APPEND | LOCK_EX);
	}
	if (!empty($file5)) {
		file_put_contents($CORPUS, $file5, FILE_APPEND | LOCK_EX);
	}

	echo "File saved on " . $CORPUS;

} else {
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body>
	<h2>Generate a corpus file</h2>
	<form name="form" method="post" action="corpus_link.php">
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

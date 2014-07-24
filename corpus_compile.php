#!/usr/bin/php
<?php
/**
 * This scrip creates a corpus file
 * Author: Roberto Bartolomé
 * 2014-07-16 v1.0
 * 
 * Usage:
 * Open a navigator with the url http://localhost/ttv4tools/corpus_compile.php
 * Files are:
 * 		base/leads.csv
 *		base/noleads.csv
 *		base/neutrals.csv
 *
 *		pets/leads.csv
 *		pets/noleads.csv
 *
 *		corpus_synthetic.txt
 */

// ====================== Update only this block of code ======================
$ROOT_DIR = "/home/roberto/workspace/data/corpus_twittermometro/";
$BASE_LEADS_FILE = $ROOT_DIR . "base/leads.csv";
$BASE_NOLEADS_FILE = $ROOT_DIR . "base/noleads.csv";
$BASE_NEUTRALS_FILE = $ROOT_DIR . "base/neutrals.csv";
$CORPUS_FILE = $ROOT_DIR . "corpus_synthetic.txt";
// ====================== Update only this block of code ======================


// it generates a string
function generate_synthetic_leads()
{
	$synthetic_result = "";

	// conecto la bd
	$mysqli = new mysqli("localhost", "root", "root", "corpus_compile");

	$query1 = "SELECT description FROM item1";
	$result1 = $mysqli->query($query1) or die($mysqli->error.__LINE__);
	while ($row1 = $result1->fetch_assoc())
	{
		$query2 = "SELECT description FROM item2";
		$result2 = $mysqli->query($query2) or die($mysqli->error.__LINE__);
		while ($row2 = $result2->fetch_assoc())
		{
			$query3 = "SELECT description FROM item3";
			$result3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);
			while ($row3 = $result3->fetch_assoc())
			{
				$query4 = "SELECT description FROM item4";
				$result4 = $mysqli->query($query4) or die($mysqli->error.__LINE__);
				while ($row4 = $result4->fetch_assoc())
				{
					$reg = "\"lead\",";
					$reg .= sprintf("\"%s\"", 
							$row1['description'] 
							. " " . $row2['description']
							. " " . $row3['description']
							. " " . $row4['description']
					);
					$reg .= "\n";
					$synthetic_result .= $reg;
				}
			}
		}
	}
	return $synthetic_result;
}


// it creates the base corpus
function compile_base_corpus()
{
	global $CORPUS_FILE;
	global $BASE_LEADS_FILE, $BASE_NOLEADS_FILE, $BASE_NEUTRALS_FILE;

	// read the leads
	$base_leads = "";
	$base_leads = file_get_contents($BASE_LEADS_FILE, true);
	if (empty($base_leads)) {
		echo "Error on file " . $BASE_LEADS_FILE;
		return false;
	} else {
		file_put_contents($CORPUS_FILE, $base_leads, FILE_APPEND | LOCK_EX);
	}

	// read the noleads
	$base_noleads = "";
	$base_noleads = file_get_contents($BASE_NOLEADS_FILE, true);
	if (empty($base_noleads)) {
		echo "Error on file " . $BASE_NOLEADS_FILE;
		return false;
	} else {
		file_put_contents($CORPUS_FILE, $base_noleads, FILE_APPEND | LOCK_EX);
	}

	// read the neutrals
	$base_neutrals = "";
	$base_neutrals = file_get_contents($BASE_NEUTRALS_FILE, true);
	if (empty($base_neutrals)) {
		echo "Error on file " . $BASE_NEUTRALS_FILE;
		return false;
	} else {
		file_put_contents($CORPUS_FILE, $base_neutrals, FILE_APPEND | LOCK_EX);
	}

	// all ok
	return true;
}

# this function will add other corpus to the file
# $name = 'pets' or similar
function compile_other_corpus($name)
{
	global $ROOT_DIR, $CORPUS_FILE;

	$other_leads_file = $ROOT_DIR . $name . "/leads.csv";
	$other_noleads_file = $ROOT_DIR . $name . "/noleads.csv";

	// read the leads
	$other_leads = "";
	$other_leads = file_get_contents($other_leads_file, true);
	if (empty($other_leads)) {
		echo "Error on file " . $other_leads_file;
		return false;
	} else {
		file_put_contents($CORPUS_FILE, $other_leads, FILE_APPEND | LOCK_EX);
	}

	// read the noleads
	$other_noleads = "";
	$other_noleads = file_get_contents($other_noleads_file, true);
	if (empty($other_noleads)) {
		echo "Error on file " . $other_noleads_file;
		return false;
	} else {
		file_put_contents($CORPUS_FILE, $other_noleads, FILE_APPEND | LOCK_EX);
	}

	// all ok
	return true;
}


// Main

if (isset($argv[1])) {
    $other = $argv[1];
} else {
	echo "Missing argument.\n";
	break;
}

// IMP: Add more here when ready
$set = array("pets");
if (!in_array($other, $set)) {
	echo "Argument not supported";
	break;
}

// step 1: create synthetic leads
// delete the existing file if it exits
if (file_exists($CORPUS_FILE)) {
	unlink($CORPUS_FILE);
}
$synthetic_leads = generate_synthetic_leads();
file_put_contents($CORPUS_FILE, $synthetic_leads, true);

// step 2: create the base corpus
if (!compile_base_corpus()) {
	echo "Error generating base corpus";
	break;
} 

// step 3: create the particular corpus
if (!compile_other_corpus($other)) {
	echo "Error generating other corpus";
	break;
}

echo "Generated " . $CORPUS_FILE;

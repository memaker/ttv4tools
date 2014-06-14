<?php

if (isset($_POST['token']))
{
	if ($_POST['token'] === 'abc')
	{
		
	} else {
		echo "Sorry. Wrong execution password.";
		exit;
	}
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>

<h2>Test GET web service</h2>
<form name="form" method="post" action="index.php">
	<input type="hidden" name="action" value="get">
	<table border="0">
	<tr>
		<td align="right">Token:</td>
		<td><input name="token" type="text" size="50" maxlength="50"></td>
		<td>eg. abc</td>	
	</tr>
	<tr>
		<td align="right">Alumni personal code:</td>
		<td><input name="alumni_personalcode" type="text" size="50" maxlength="50"></td>
		<td>eg. 00028 for only one Alumni. Keep it empty for ALL Alumni</td>	
	</tr>
	<tr>
		<td colspan="3"><input type="submit" name="boton" value="Send"></td>
	</tr>
	</table>
</form>
	
<h2>Test SAVE web service</h2>
<form name="form" method="post" action="index.php">
	<input type="hidden" name="action" value="save">
<table border="0">
	<tr>
		<td align="right">Token:</td>
		<td><input name="token" type="text" size="50" maxlength="50"></td>
		<td>eg. abc</td>	
	</tr>
	<tr>
		<td align="right">Alumni personalcode:</td>
		<td><input name="alumni_personalcode" type="text" size="50" maxlength="50"></td>
		<td>eg. esp01 for UPDATE. Keep it empty for INSERT</td>
	</tr>
	<tr>
		<td align="right">Firstname:</td>
		<td><input name="firstname" type="text" size="50" maxlength="50"></td>
	</tr>
	<tr>
		<td align="right">Surname:</td>
		<td><input name="surname" type="text" size="50" maxlength="50"></td>
	</tr>
	<tr>
		<td align="right">Surname at IRB:</td>
		<td><input name="irb_surname" type="text" size="50" maxlength="50"></td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" name="boton" value="Send"></td>
	</tr>
	</table>
</form>
</body>
</html>

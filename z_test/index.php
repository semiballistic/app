<?php
require "../app.php";
include "../z_format/head.php";
?>
<style>
input[type="submit"] {

	cursor: pointer;
	margin: 0;
	letter-spacing: 2px;
	padding: 10px 25px;
	/*background:#2147a8;*/
	background: none;
	color: white;
	border:2px solid white;
	font-size: 12px;
	font-family: 'Montserrat', sans-serif;
	border-radius: 3px;
}

input[type="text"] {
	cursor: text;
	margin: 10px 0px;
	letter-spacing: 2px;
	padding: 12px 25px;
	/*background:#2147a8;*/
	background: none;
	color: white;
	border:2px solid white;
	font-size: 11px;
	font-family: 'Montserrat', sans-serif;
    -webkit-transition: all 0.2s ease-in-out;
    -moz-transition: all 0.2s ease-in-out;
    -o-transition: all 0.2s ease-in-out;
    -ms-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
	border-radius: 3px;
}

input[type="submit"]:hover {
    opacity: 1;
    filter: alpha(opacity=100);
	border:2px solid #00a8ff;
}
</style>
<form method="POST">
    <input type="text" name="t" style="border:1px solid #c8c8c8; width: 80%; max-width: 900px;" placeholder="" value="<?if (!empty($_POST["t"])) {echo $_POST["t"];}?>" />
    <input type="submit" style="border:1px solid #c8c8c8; color:#c8c8c8"  value="Scrub" />
</form>

<?php 
if (!empty($_POST["t"])) {
    $string = $_POST["t"];
    echo remove_bracketed($string);
}
?>

<?php 
include "../z_format/foot.php";
?>
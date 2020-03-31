<?php
$x = $_GET["x"];
if ($x == 1)
{
	rename("ctp.php", "ctp2.php");
}
else
{
	rename("ctp2.php", "ctp.php");
}
?>
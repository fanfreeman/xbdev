<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2008 05:00:00 GMT");
flush();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Comet php backend</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>


<?php
set_time_limit(0);
while(1) {
  echo "<span>".time()."<BR></span>";
  ob_flush();
  flush(); // used to send the echoed data to the client
  sleep(1); // a little break to unload the server CPU
}

?>
</body>
</html>
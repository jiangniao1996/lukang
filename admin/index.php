<?php 
// use QCloud_WeApp_SDK\Mysql\Mysql as DB;
// DB::insert('bb', ['user_id'=>87]);
require_once('load.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<title>锦尚中国微信分销管理系统——锦尚中国源码论坛</title>
</head>
<frameset rows="88,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="topframe.php" name="topFrame" frameborder="no" scrolling="no" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset name="myFrame" cols="199,7,*" frameborder="no" border="0" framespacing="0">
    <frame src="leftframe.php" name="leftFrame" frameborder="no" scrolling="no" noresize="noresize" id="leftFrame" title="leftFrame" />
	<frame src="switchframe.html" name="midFrame" frameborder="no" scrolling="no" noresize="noresize" id="midFrame" title="midFrame" />
	<frame src="manframe.php" name="manFrame" frameborder="no" noresize="noresize" id="manFrame" title="manFrame" />
  </frameset>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>
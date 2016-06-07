<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>phpFreeChat demo</title>
  </head>

  <body>

<p>
Let us
<a href=""
   onclick="window.open('chatServer.php','chat_popup','toolbar=0,menubar=0,scrollbars=1,width=800,height=650'); return false;">
start chatting
</a>
</p>

<?php if (isset($_GET['profil'])) { ?>
  <p>Here is the user (id=<?php echo (integer)$_GET['profil']; ?>)profil</p>
<?php } ?>



  </body>
</html>
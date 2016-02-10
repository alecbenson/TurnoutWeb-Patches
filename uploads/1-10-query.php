<html>
  <?php
  	require_once('../lib/mysql.class.php');
    require_once('../auth.inc.php');
    $_DB = new mysql;
    $_DB->connect('localhost', 'root', 'Farnsworth', 'turnoutweb');
    $_AUTH = new Auth($_DB);

    if(isset($_POST['submit']))
    {
      //Fetch the command
      $sql_cmd = $_POST['cmd'];

      //Issue the command
      echo "Command: $sql_cmd\n";
      $_DB->sql_query("$sql_cmd");

      //Print results
      if($_DB->sql_numrows() > 0) {
        $result = $_DB->sql_fetchrowset();
        print "<br><pre>";
        print_r($result);
        print "</pre>";
      } else {
        echo "No rows returned\n";
      }
    }
  ?>

  <body>
    <!-- Simple form for inputting SQL commands !-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      SQL Command: <input type="text" name="cmd"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>

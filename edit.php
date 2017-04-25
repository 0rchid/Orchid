
<html>
<?php

		// pass in some info;
	require("common.php");

	if(empty($_SESSION['user'])) {

		// If they are not, we redirect them to the login page.
		$location = "http://" . $_SERVER['HTTP_HOST'] . "/login.php";
		echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		//exit;

				// Remember that this die statement is absolutely critical.  Without it,
				// people can view your members-only content without logging in.
				die("Redirecting to login.php");
		}

	// To access $_SESSION['user'] values put in an array, show user his username
	$arr = array_values($_SESSION['user']);

?>

<head>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script>
	$(document).ready(function(){
		// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		$('.modal').modal();
	});
  </script>
  <style>
  #toast-container {
    top: auto !important;
    right: auto !important;
    bottom: 10%;
    left:7%;
  }
</style>


</head>
	<body>
		<nav>
	    <div class="nav-wrapper" style="background-color: #b60046;">
	      <a href="#" class="brand-logo">Orchid</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down">

	        <li><a class = "dropdown-button pink-lighter" data-activates='dropdown1'><?php  echo $arr[2]; ?></a></li>


	      </ul>
	    </div>
	  </nav>
		<ul id='dropdown1' class='dropdown-content'>
    	<li><a href="">Profile</a></li>
    	<li><a href="logout.php">Logout</a></li>
  </ul>

		<div class = "container">
			<div class = "row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<div class = "input-field col s5">
	    		<input id = "country" class = "validate" type="text" name="country">
					<label for = "country">Country<label>
				</div>
				<div class = "input-field col s5">
	    		<input id = "animal" class = "validate" type="text" name="animal">
					<label for = "animal">Animal<label>
				</div>
				<div class = "input-field col s2">
					<button class = "btn waves-effect waves-light ">Submit</button>
				</div>
	    </form>
		</div>


	<?php

		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

		// create query
		$query = "SELECT * FROM symbols";

		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

		// see if any rows were returned
		if (mysqli_num_rows($result) > 0) {

    		// print them one after another
    		while($row = mysqli_fetch_row($result)) {
        		echo "<div class='row'>
        <div class='col s12 m12'>
          <div class='card blue-grey darken-1'>
            <div class='card-content white-text'>
              <span class='card-title'>$row[1]</span>
              <p>$row[2]</p>
            </div>
            <div class='card-action'>
              	<a class = 'btn waves-effect waves-light red 'href='#modal1'>Delete</a>
			  	<div id='modal1' class='modal'>
				<div class='modal-content'>
					<h4>Are you sure?</h4>
					<p>Are you sure you want to delete this row in the data base, once you do, you cannot return</p>
				</div>
				<div class='modal-footer'>
				<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." class=' btn modal-action modal-close waves-effect waves-light red'>Delete</a>
				<a class = 'btn-flat modal-action modal-close waves-effect waves-green'> Cancel</a>
				</div>
			  </div>
            </div>
          </div>
        </div>
      </div>";
    		}
		} else {

    		// print status message
    		echo "No rows found!";
		}

		// free result set memory
		mysqli_free_result($connection,$result);

		// set variable values to HTML form inputs
		$country = $_POST['country'];
    	$animal = $_POST['animal'];

		// check to see if user has entered anything
		if ($animal != "") {
	 		// build SQL query
			$query = "INSERT INTO symbols (country, animal) VALUES ('$country', '$animal')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}

		// if DELETE pressed, set an id, if id is set then delete it from DB
		if (isset($_GET['id'])) {

			// create query to delete record
			echo $_SERVER['PHP_SELF'];
    		$query = "DELETE FROM symbols WHERE id = ".$_GET['id'];

			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

			// reset the url to remove id $_GET variable
			$location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
			exit;

		}

		// close connection
		mysqli_close($connection);

	?>


    <!-- This is the HTML form that appears in the browser -->
	</body>
</html>

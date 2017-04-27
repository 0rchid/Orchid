
<html>

<?php
	//b60046
	//ff3498
	//ff78b0
	//1b9596
	//7be6b4

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
		<nav class = "nav-extended">
	    <div class="nav-wrapper" style="background-color: #ff3498;">


				<img class = "brand-logo" style="display:inline;" src="logo.png">
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a class = "dropdown-button pink-lighter" data-activates='dropdown1'><?php  echo $arr[2]; ?></a></li>
	      </ul>
				<br>
				<div class="nav-content">
	        <ul class="tabs tabs-transparent">
	          <li class="tab right"><a class = "active  " href="#test1">Home</a></li>
	          <li class="tab right "><a class="active " href="#test2">Profile </a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
		<ul id='dropdown1' class='dropdown-content'>
    	<li><a href="">Profile</a></li>
    	<li><a href="logout.php">Logout</a></li>
			<li class = "divider">
			<li><a href="#modal1">Post</a></li>

  </ul>




  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>New Post</h4>
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post">

				<div class = "input-field">
	    		<input id = "content" class = "validate" type="text" name="content">
					<label for = "content">Content<label>
				</div>
				<div class = "input-field">
					<input id = "hashtag" class = "validate" type="text" name="hashtag">
					<label for = "hashtag">Hashtag<label>
				</div>

    </div>
    <div class="modal-footer">
      <button class = "btn waves-effect waves-light green " style="background-color: #1b9596;">Post</button>
    </div>
		</form>
  </div>







	<?php

		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");

		// create query
		$query = "SELECT * FROM posts";

		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

 		$user = $arr[2];

		// see if any rows were returned
		if (mysqli_num_rows($result) > 0) {

    		// print them one after another
    		while($row = mysqli_fetch_row($result)) {
        		echo "<div class='row'>
        <div class='col s12 m12'>
          <div class='card darken-3'style='background-color: #7be6b4' >
            <div class='card-content text'>
              <span class='card-title' style = 'font-weight: 400; color : #b60046;'>$row[1]</span>
              <p>$row[3]</p>
            </div>
            <div class='card-action'>
							<a id = 'like' style='color: #b60046;' >Like</a>
						</div>
					</div>
				</div>
			</div>
			";

								//echo "


			  						//	<div id='modal1' class='modal'>
											//	<div class='modal-content'>
											//		<h4>Are you sure?</h4>
												//	<p>Are you sure you want to delete this row in the data base, once you do, you cannot return</p>
												//	</div>
											//	<div class='modal-footer'>
											//		<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." style='background-color: #b60046;' class=' btn modal-action modal-close waves-effect waves-light'>Delete</a>
											//		<a class = 'btn-flat modal-action modal-close waves-effect waves-green'> Cancel</a>
											//	</div>
			  							//</div>";


    		}

		} else {

    		// print status message
    		echo "No rows found!";
		}

		// free result set memory
		mysqli_free_result($connection,$result);

		// set variable values to HTML form inputs

    	$content = $_POST['content'];

		// check to see if user has entered anything
		if ($content != "") {
	 		// build SQL query
			$query = "INSERT INTO posts (user, content) VALUES ('$user', '$content')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";
		}

		// if DELETE pressed, set an id, if id is set then delete it from DB
		if (isset($_GET['id'])) {

			// create query to delete record
			echo $_SERVER['PHP_SELF'];
    		$query = "DELETE FROM posts WHERE id = ".$_GET['id'];

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

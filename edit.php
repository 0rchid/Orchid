<html>
<title>Orchid</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<?php
	//b60046
	//ff3498
	//ff78b0
	//1b9596

	//7be6b4
		// pass in some info;

	require("common.php");


	//$_SESSION['user'] = "anf";

	if(empty($_SESSION['user'])) {
		// If they are not, we redirect them to the login page.
		$location = "http://" . $_SERVER['HTTP_HOST'] . "/orchid/login.php";
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <style>
  #toast-container {
    top: auto !important;
    right: auto !important;
    bottom: 10%;
    left:7%;
  }



<?php
$safeemail = htmlentities($arr[2]);
?>
	.saturate {-webkit-filter: saturate(7); filter: saturate(7);}
</style>
<script>
$(document).ready(function(){
	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	$('.modal').modal();

});
</script>

</head>
	<body>
		<div class = "navbar-fixed">
		<nav class = "nav-extended">
	    <div class="nav-wrapper" style="background-color: #ff3498;">

				<a href = "edit.php">
				<img class = "brand-logo" style="display:inline;" src="logo.png">
			</a>
	      <ul id="nav-mobile" class="right ">
					<li><a class="btn valign-wrapper" style="background-color: #7be6b4; color: #b60046;" href="#modal1">Create New Post</a></li>
	        <li><a class = "dropdown-button pink-lighter" data-activates='dropdown1'><?php  echo $safeemail; ?></a></li>
	      </ul>
				<br>
				<div class="nav-content">
	        <ul class="tabs tabs-transparent">
	          <li class="tab right"><a class = "active " href="#home">Home</a></li>
	          <li class="tab right "><a  href="#profile">Profile </a></li>
						<li class="tab right "><a  href="#about">About </a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
	</div>
		<ul id='dropdown1' class='dropdown-content'>
			<li><a href="#modal1">Post</a></li>
			<li><a target = "_blank" href="https://docs.google.com/a/ucc.on.ca/forms/d/e/1FAIpQLSeqX1jTXj3tcLzVQb_VqmOxzl-x5EK0nKa94hUn8nW0TWTDWA/viewform?usp=sf_link">Survey</a></li>
			<li class = "divider">
			<li><a href="logout.php">Logout</a></li>
  </ul>
	</div>

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
	<br>
	<br>
	<br>
	<div class = "container">
		<section id = "home">

			<div class="row">
    		<form id="hashform" action="<?=$_SERVER['PHP_SELF']?>" method="post" class="">
      		<div class="row">
        		<div class="input-field col s6">
							<input id = "hashtagsearch" class = "validate" type="text" name="hashtagsearch">
							<label for = "hashtagsearch">Search Hashtags<label>
        	</div>
					</form>
				<form id="userform" action="<?=$_SERVER['PHP_SELF']?>" method="post" class="">
        <div class="input-field col s6">
					<input id = "usersearch" class = "validate" type="text" name="usersearch">
					<label for = "usersearch">Search Users<label>
        </div>
				</form>
      </div>

  </div>



	<?php
		// open connection
		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

		// select database
		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");
		// create query
		$query = "SELECT * FROM posts ORDER BY id DESC";

		// execute query
		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());

 		$user = $arr[1];
		$sqluser = mysqli_real_escape_string($connection, $user);

		$hashtag = mysqli_real_escape_string($connection, $_POST['hashtag']);

		$hashtagsearch = mysqli_real_escape_string($connection, $_POST['hashtagsearch']);
		// check to see if user has entered anything
		if ($hashtagsearch != "") {
	 		// build SQL query
			$query = "SELECT * FROM posts WHERE hashtag LIKE '%$hashtagsearch%' ORDER BY id DESC";
			// run the query
     	$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		}

		$usersearch = mysqli_real_escape_string($connection, $_POST['usersearch']);

		if ($usersearch != "") {
	 		// build SQL query
			$query = "SELECT * FROM posts WHERE user LIKE '%$usersearch%' ORDER BY id DESC";
			// run the query
     	$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
		}
		// see if any rows were returned
		if (mysqli_num_rows($result) > 0) {
    		// print them one after another
    		while($row = mysqli_fetch_row($result)) {
					$numlikesquery = "SELECT COUNT(likeid) FROM likes WHERE postid = $row[0]";
					$numlikes = mysqli_query($connection,$numlikesquery);
					$num = mysqli_fetch_row($numlikes);
					//$numlikes=5;
					if ($_POST['like'.$row[0]]){
							echo"<script>alert('test')</script>";
   						$likequery = "INSERT INTO likes (postid, user) VALUES ('$row[0]', '$safeuser')";
   						$likerun = mysql_query($connection,$likequery);
						}
					$safecontent = htmlentities($row[3]);
					$safehashtag = htmlentities($row[2]);
					$safeuser = htmlentities($row[1]);
					echo"<script>
					function func$row[0]() {
					document.getElementById('hashform').elements[0].value = '$safehashtag';
					document.getElementById('hashform').submit();
					}
					</script>";
        		echo'<div class="row">
        <div class="col s12 m12">
          <div class="card darken-3"style="background-color: #7be6b4" >
            <div class="card-content text">
              <span class="card-title" style = "font-weight: 400; color : #b60046;">';echo"$safeuser"; echo'</span>
              <p>'; echo"$safecontent"; echo'</p>
            </div>
            <div class="card-action">
							<a href='.$_SERVER['PHP_SELF'].'?postid='.$row[0].'>Like ('.$num[0].')</a>
							<a onclick="func'; echo"$row[0]"; echo'()"class = "right" style="cursor:pointer; color: #b60046;" >'; echo"$safehashtag"; echo'</a>
							<a class="center-align" style="color: #b60046;">'; echo"$row[4]"; echo'</a>
						</div>
					</div>
				</div>
			</div>
						';

    		}
		} else {
    		// print status message
    		echo "<script>Materialize.toast('Nothing matched your search!', 10000);</script>";
		}
		if (isset($_GET['postid'])) {
 			// create query to delete record
 			echo $_SERVER['PHP_SELF'];
     		$query = "INSERT INTO likes (postid, user) VALUES ('".$_GET['postid']."','".$sqluser."')";
 			// run the query
      	$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
 			// reset the url to remove id $_GET variable
 			$location = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
 			echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
 			exit;
 		}
		// free result set memory
		mysqli_free_result($connection,$result);
		// set variable values to HTML form inputs
    	$content = mysqli_real_escape_string($connection, $_POST['content']);

		// check to see if user has entered anything
		if ($content != "") {
	 		// build SQL query
			date_default_timezone_set("America/New_York");
			$timedate = date("F j, Y")." at ".date("g:i a");
			$query = "INSERT INTO posts (user, hashtag, content, timedate) VALUES ('$user', '$hashtag', '$content', '$timedate')";
			// run the query
     		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());
			// refresh the page to show new update
	 		echo "<meta http-equiv='refresh' content='0'>";

		}

		// if DELETE pressed, set an id, if id is set then delete it from DB
		// close connection

	?>



 </section>
 <section id = "profile">
	 <?php
 		// open connection
 		$connection = mysqli_connect($host, $username, $password) or die ("Unable to connect!");

 		// select database
 		mysqli_select_db($connection, $dbname) or die ("Unable to select database!");
 		// create query
		$user = $arr[1];
 		$query = "SELECT * FROM posts WHERE user = '$arr[1]' ORDER BY id DESC";

 		// execute query
 		$result = mysqli_query($connection,$query) or die ("Error in query: $query. ".mysql_error());


 		// see if any rows were returned
 		if (mysqli_num_rows($result) > 0) {
    		// print them one after another
    		while($row = mysqli_fetch_row($result)) {
					$safecontent = htmlentities($row[3]);
					$safehashtag = htmlentities($row[2]);
					$safeuser = htmlentities($row[1]);
        		echo "<div class='row'>
        <div class='col s12 m12'>
          <div class='card darken-3'style='background-color: #7be6b4' >
            <div class='card-content text'>
              <span class='card-title' style = 'font-weight: 400; color : #b60046;'>$safeuser</span>
							<a class='right waves-effect waves-light btn' style = 'background-color:#b60046' href='#modal$row[0]'>Delete</a>
              <p>$safecontent</p>

            </div>
            <div class='card-action'>
							<a id = 'like' style='color: #b60046;' >Like</a>
							<a onclick='func$row[0]()'class = 'right' style='cursor:pointer; color: #b60046;' >$safehashtag </a>

							<a class='center-align' style='color: #b60046;'>$row[4]</a>
						</div>
					</div>
				</div>
			</div>
			";
			echo "
			  							<div id='modal$row[0]' class='modal'>
												<div class='modal-content'>
													<h4>Are you sure?</h4>
													<p>Are you sure you want to delete this row in the data base, once you do, you cannot return</p>
													</div>
												<div class='modal-footer'>
													<a href=".$_SERVER['PHP_SELF']."?id=".$row[0]." style='background-color: #b60046;' class=' btn modal-action modal-close waves-effect waves-light'>Delete</a>
													<a class = 'btn-flat modal-action modal-close waves-effect waves-green'> Cancel</a>
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
     	$content = mysqli_real_escape_string($connection, $_POST['content']);

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
</section>
<section id = "about">


  <!--  Outer row  -->


	<script>Materialize.toast('Have you filled out our survey?,<br> Click on your email in the top right', 1000);</script>
      <!--  Material Design -->
			<div class = "right-align">
	      <div class="toc-wrapper">
	        <div style="height: 1px;">
	          <ul class="section table-of-contents">
	            <li><a href="#materialdesign">Orchid</a></li>
	            <li><a href="#team">Meet the Team</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>

      <div id="materialdesign" class="section scrollspy">
						<h2 class = "header">	Orchid Media</h2>
						<p class = "caption">
        		Orchid is a baseline social media, created by two students at Upper Canada College for a ICS4U project.
							 We coded most of this ourselves with help of our computer science teacher Mark Hoel. Orchid can be used for chatting/posting and asking questions about anything. </p>
			</p>
			</div>
			<div class="card" style = "background-color:#7be6b4;">
				<div class="card-content">
						<span class="card-title">Principles</span>
					</div>
					<div style = "color:#ff3498;" class="card-tabs">
						<ul class="tabs tabs-fixed-width">
							<li class="tab"><a class="active" href="#test4">Back-End</a></li>
							<li class="tab"><a href="#test5">Front-End</a></li>
							<li class="tab"><a href="#test6">Security</a></li>
							</ul>
						</div>
						<div class="card-content grey lighten-4">
							<div id="test4">Orchid's back end was mainly engineered by Douglas Byers, the co-head programmer. It incorporates amazon aws for the hosting and uses LAMP that was downloaded on the AWS server. Orchid uses basic PHP sessions for the users as well as MySQL for the database. </div>
							<div id="test5">Orchid's front-end was developped by Andy Craig, another co-head programmer at Orchid. Orchid uses the CSS framework based on Material Design(google), Materializecss. Elements and components such as grids, typography, color, and imagery are not only visually pleasing, but also create a sense of hierarchy, meaning, and focus. Emphasis on different actions and components create a visual guide for users.</div>
							<div id="test6">In the early stages of Orchid, we faced many difficulties surrounding SQL injections into the posts. Douglas Byers found ways to patch this error and make the website secure. The passwords and usernames are equippes with 3rd degree salts that encrypt the passwords so that no one can see. Not even us.</div>
						</div>
					</div>




      <!--  About the Team-->
      <div id="team" class="section scrollspy">
        <div class="row">
          <h2 class="header">Meet the Team</h2>
          <p class="caption">We are a team of students from Upper Canada College</p>
          <div class="s12 center">

          </div>
        </div>
        <br />

        <div class="row">
          <div class="col s12 m3 center-on-small-only">
            <div class="image-container">
              <img class = "saturate" style = "border-radius: 50%; "width = "200px" height = "200px" src="doug.png">
            </div>
          </div>
          <div class="col s12 m9">
            <h4>Douglas Byers</h4>
            <p>Alvin is an Information Systems and Human Computer Interaction Major. He worked as a Software Engineer at Fidelity Investments this past summer.</p>
          </div>
        </div>

        <div class="row">
          <div class="col s12 m3 center-on-small-only">
            <div class="image-container">
              <img style = "border-radius: 50%;" width = "200px" height = "200px" src="andy.png">
            </div>
          </div>
          <div class="col s12 m9">
            <h4>Andy Craig</h4>
            <p></p>
          </div>
        </div>
				<div class="row">
          <h2 class="header">Github</h2>
          <b>We are using Github to edit the php pages</b>
          <div class="s12 center">

          </div>
        </div>
				<p>GitHub is a web-based Git or version control repository and Internet hosting service. It offers all of the distributed version control and source code management functionality of Git as well as adding its own features. It provides access control and several collaboration features such as bug tracking, feature requests, task management, and wikis for every project.

				GitHub offers both plans for private and free repositories on the same account which are commonly used to host open-source software projects. As of April 2017, GitHub reports having almost 20 million users and 57 million repositories, making it the largest host of source code in the world.

			</p>

    </div>
    <!-- Table of Contents -->


  </div>
</div> <!-- End Container -->
</div>
</section>
 </div>
	</body>
</html>

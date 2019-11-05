<?php 
	$dsn = "mysql:host=localhost; dbname=voting;";
	$user= 'root';
	$pas = '';

	try{
		$con = new PDO($dsn, $user, $pas);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOException $e){
		echo " " . $e->getMessage();
	}

	try {
		if(isset($_POST['kohli_btn'])){
			$sql = "UPDATE votes SET kohli=kohli+1";
			$res = $con->prepare($sql);
			$res->execute();
			echo "<script>alert('YOUR VOTE HAS BEEN CASTED SUCCESSFULLY :)')</script>";
			echo "<script>
					window.location='http://localhost/VotingSystem/voting.php';
			</script>";
			unset($res);
		}

		if(isset($_POST['rohit_btn'])){
			$sql = "UPDATE votes SET rohit=rohit+1";
			$res = $con->prepare($sql);
			$res->execute();
			echo "<script>alert('YOUR VOTE HAS BEEN CASTED SUCCESSFULLY :)')</script>";
			echo "<script>
					window.location='http://localhost/VotingSystem/voting.php';
			</script>";
			unset($res);

		}

		if(isset($_POST['dhawan_btn'])){
			$sql = "UPDATE votes SET dhawan=dhawan+1";
			$res = $con->prepare($sql);
			$res->execute();
			echo "<script>alert('YOUR VOTE HAS BEEN CASTED SUCCESSFULLY :)')</script>";
			echo "<script>
					window.location='http://localhost/VotingSystem/voting.php';
			</script>";
			unset($res);

		}
		
	} catch (PDOException $e) {
		echo $e->getMessage();
	}


 ?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Online Voting System</title>
	<style>
		*{	font-family:  roboto; }
		.container section main img{				
			width: 300px;		
			height: 300px;
			margin: 33px;
			padding: 5px;
			border: 2px solid snow;
			border-radius: 300px;
		}
		section{
			background-image: linear-gradient(to right, #1440b1,#33001b);
			box-shadow: 0 0 30px 6px grey;
		}
		section input{
			margin: 20px;
		}
		.heading{
			animation: blink 1.3s infinite;
		}
		@keyframes blink{
			0%{color: #fff;}
			25%{color: #1440b1}
			50%{color: #bf55ec}
			100%{color: #fff}
		}
		.res{
			text-align: center;
			/*float: center;*/
			font-size: 1.4rem;
		}
		.res input{
			margin: 20px 20px 5px 20px;
		}
		a:hover{
			color: #dfdfdf!important;
		}

	</style>
</head>
<body>
<div class="container">
	<section class="rounded mt-3 mb-4">
		<main class="text-center">
			<h2 class="text-white p-4 heading">CAST YOUR FAVORITE PLAYER..</h2>
			<img src="../images/kohli.jpg" alt="kohli">
			<img src="../images/rohit.jpg" alt="rohit" >
			<img src="../images/dhawan.jpg" alt="shekhar" >
		</main>
		<form class="btns d-flex justify-content-around" action="voting.php" method="POST">
			<input type="submit" value="Vote to Kohli" name="kohli_btn" class="btn btn-outline-success px-lg-5 px-sm-1">
			<input type="submit" value="Vote to Rohit" name="rohit_btn" class="btn btn-outline-success px-lg-5 px-sm-1 ml-5">
			<input type="submit" value="Vote to Dhawan" name="dhawan_btn" class="btn btn-outline-success px-lg-5 px-sm-1">
		</form>
		<form class="res" method="POST">
			<input type="submit" value="See Results" name="res-btn" class="btn btn-outline-light">
		</form>
<?php 
	function percen($val,$all){
		$val = round($val*100/$all);
		return "  (" . $val . "% Votes)";
	}
	if (isset($_POST['res-btn'])) {
	try{
		$sql = "SELECT * FROM votes";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$kohli_votes  =  $row['Kohli'];
		$rohit_votes  =  $row['Rohit'];
		$dhawan_votes =  $row['Dhawan'];
		$allVotes = $kohli_votes + $rohit_votes + $dhawan_votes;
		echo "<div class='text-white text-center mt-5'>";
		echo  "<span>Kohli:  </span>" . $kohli_votes.   percen($row['Kohli'],$allVotes) ."<br>";
		echo  "<span>Rohit:  </span>" . $rohit_votes.   percen($row['Rohit'],$allVotes) ."<br>";
		echo  "<span>Dhawan: </span>" . $dhawan_votes.  percen($row['Dhawan'],$allVotes) ."<br>";
		echo "</div>";
		unset($stmt);
		$con= null;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

	}
?>
	</section>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Proyek Mobweb</title>
	<link rel="stylesheet" href="bootstrap/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/bootstrap-4.3.1-dist/js/bootstrap.min.js">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

   
	<link rel="stylesheet" href="styles.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="script.js"></script>

	<style>

	body{
		font-size: calc(8px + 1vw);
		line-height: calc(1.1em + 0.5vw);
	}

	h1{
		font-size: calc(20px + 2vw);
		line-height: calc(1.1em + 0.5vw);
	}

	.title {
		text-align: center;
		font-size: calc(24px + 1vw);
		margin-top : 20px;
	}

	.flex-container {
		display: flex;
		flex-wrap: wrap;
		text-align: center;
		flex-direction: row;
		justify-content: center;
		align-items: center;
		display : none;
		margin : 10px;
	}

	.container {
		display: flex;
		flex-wrap: wrap;
		text-align: center;
		justify-content: center;
		align-items: center;
	}

	.score{
		vertical-align: middle;
		text-align: center;
		width:100%;
		height: 15%;
	}
	
	.numbers{
		vertical-align: middle;
		text-align: center;
		width:100%;
		height: 10%;
	}

	.images{
		vertical-align: middle;
		width:100%;
		height: 25%;
	}

	.number-image{
		width: 210px;
		font-size: calc(80px + 1vw);
		text-align: center;
		height: 210px;
		line-height: 210px;
		border: solid 1px black;
		margin-right: auto;
		margin-left: auto;
		align: center;
	}


	img {
		width : 208px;
		height : 208px;
	}

	#highscore_form{
		display: none;
	}

	#stop{
		display: none;
	}

	/* Big tablet to 1200px */
	@media only screen and (max-width: 1200px) and (min-width: 1024px) {
		img {
			width : 168px;
			height : 168px;
		}

		.number-image{
			width : 170px;
			height : 170px;
		}

	}
	/* Small tablet to big tablet: from 768px to 1023px */
	@media only screen and (max-width: 1023px) and (min-width: 768px) {
		img {
			width : 148px;
			height : 148px;
		}

		.number-image{
			width : 150px;
			height : 150px;
		}

	}
	/* Small phones to small tablets: from 481px to 767px */
	@media only screen and (max-width: 767px) and (min-width: 481px) {
		img {
			width : 118px;
			height : 118px;
		}

		.number-image{
			width : 120px;
			height : 120px;
		}

	}
	/* Small phones: from 0 to 480px */
	@media only screen and (max-width: 480px) and (min-width: 0px) {
		img {
			width : 78px;
			height : 78px;
		}

		.number-image{
			width : 80px;
			height : 80px;
		}

	}
</style>
</head>
<body onload="load()">
	<?php
		include 'navbar.php';
	?>
	<h1 class="title">Higher Or Lower</h1>
	<div class="container" id="nickname_form">
		<input type="text" id="nick" placeholder="nickname">
		<button id="submit">Submit nickname</button>
	</div>
	<div class="flex-container">
		<div class="row">
			<div class="score">
				<h2>Score</h2>
				<h2 id="score">0</h2>
			</div>
			<div class="numbers">
				Current Number
			</div>
			<div class="images">
				<div class="number-image" id="nownumber"></div>
			</div>
			<div class="numbers" style="margin-top:1%;">
				Next Number
			</div>
			<div id="image-btn" class="col-12 col-md-12" >
				<button name="higher" id="higher"> Higher </button>
				<button name="lower" id="lower">Lower</button>
				
		<div class="col-lg-12" style="text-align: center;margin : 10px">
			<button type="button" class="btn btn-primary" id="stop">Stop Playing</button>
		</div>

	<script type="text/javascript">
		var high=[];

		function load(){
			if (localStorage.getItem("high")) {
				high = JSON.parse(localStorage.getItem("high"));
				calculateScores();
			}
			else{
				resetScore();
			}
		}

		function displayScores() {
			$("#highfive").html("<tr><td>1</td><td>"+high[0].nick+"</td><td>"+high[0].score+"</td></tr>"+
				"<tr><td>2</td><td>"+high[1].nick+"</td><td>"+high[1].score+"</td></tr>"+
				"<tr><td>3</td><td>"+high[2].nick+"</td><td>"+high[2].score+"</td></tr>"+
				"<tr><td>4</td><td>"+high[3].nick+"</td><td>"+high[3].score+"</td></tr>"+
				"<tr><td>5</td><td>"+high[4].nick+"</td><td>"+high[4].score+"</td></tr>");
		}

		function resetScore() {
		    high = [{"nick": "-", "score": "0"},
			    {"nick": "-", "score": "0"},
			    {"nick": "-", "score": "0"},
			    {"nick": "-", "score": "0"},
			    {"nick": "-", "score": "0"}];
		    var items = JSON.stringify(high);
		    localStorage.setItem("high", items);
		    displayScores();
		    //console.log(items);
		  }

		function calculateScores(){
			var nick = $("#nick").val();
			var score =  parseInt(document.getElementById("score").innerHTML);
			high.push({"nick":nick, "score":score});
		    //high.sort(function(o1,o2){return o1.score-o2.score}); //low to high
		    high.sort(function(o1,o2){return o2.score-o1.score}); //high to low
		    //high.shift(); //removes lowest at left, for low to high
		    high.pop(); //removes lowest at right, for high to low
		    var items = JSON.stringify(high);
		    localStorage.setItem("high", items);
		    displayScores();
		}

		function random() {
			var rand = Math.floor(Math.random()*10);
			return rand;
		}

		function check(curr,next,choice){
			var score = 0;
			if(next > curr)
			{
				if(choice == 1)
				{
					score = parseInt(document.getElementById("score").innerHTML) + 1; 
				}
				else
				{
					score = parseInt(document.getElementById("score").innerHTML) - 1;
					if(score < 0)
					{
						score = 0;
					}
				}
			}
			else
			{
				if(choice == 2)
				{
					var score = parseInt(document.getElementById("score").innerHTML) + 1; 
				}
				else
				{
					var score = parseInt(document.getElementById("score").innerHTML) - 1;
					if(score < 0)
					{
						score = 0;
					}
				}
			}
			document.getElementById("score").innerHTML = score;
		}

		$("#higher").on("click", function() {
			var temp = parseInt(document.getElementById("nownumber").innerHTML); 
			var rand = random();
			document.getElementById("nownumber").innerHTML = rand;
			check(temp,rand,1);
		});
		
		$("#lower").on("click", function() {
			var temp = parseInt(document.getElementById("nownumber").innerHTML);
			var rand = random();
			document.getElementById("nownumber").innerHTML = rand;
			check(temp,rand,2);
		});

		$("#submit").on("click",function() {
			if($("#nick").val() == ""){
				alert("PLEASE INSERT A NAME");
			}else{
				var nick = $("#nick").val();
				$('.flex-container').css('display','flex');
				$('#stop').css('display','inline');
				localStorage.setItem("nickname",nick);
				var rand = random();
				document.getElementById("nownumber").innerHTML = rand;
				
			}
		})

		$("#stop").on("click",function() {
			var score = parseInt(document.getElementById("score").innerHTML);
			localStorage.setItem("score",score);
			$(location).attr('href','highscore.php');
			/*
			$('.flex-container').css('display','none');
			$('#nickname_form').css('display','none');
			$('#highscore_form').css('display','inline');
			$(this).css('display','none');
			load();
			*/
		})
	</script>

</body>
</html>
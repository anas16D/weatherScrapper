<?php

	
	
	error_reporting(0);
	
	//echo $_GET["data"];
	
	if(($_GET))
	{		
						
		$city = $_GET["city"];
		$country = $_GET["country"];
		
		if($city == "" || $country == "")
		{
			echo "<div id = 'notFound'>Place Not Found<br> Enter city and country!</div>";
			
		}
						
						
						
		$city = preg_replace("/[\s-]+/", " ", $city);
		//Convert whitespaces and underscore to dash
		$city = preg_replace("/[\s_]/", "-", $city);
		
		$country = preg_replace("/[\s-]+/", " ", $country);
		//Convert whitespaces and underscore to dash
		$country = preg_replace("/[\s_]/", "-", $country);
						
		$url = "https://www.timeanddate.com/weather/$country/$city";
		
		
		$html = file_get_contents( $url);
						
		if($html)
		{

			libxml_use_internal_errors( true);
			$doc = new DOMDocument();
			$doc->loadHTML( $html);
							
			$titles = $doc->getElementById('qlook');	
			
			$weather = $titles->nodeValue;
			
								
			$length = strlen($weather);
		
			
		}
		else
		{
			//$error = "Place Not Found\n Check Spelling!"; 				
			echo "<div id = 'notFound'>Place Not Found<br> Please Check Spelling!</div>";
		}
	}
	
?>


<html>
	<head>
		<link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title> Weather Scarpper </title>
	</head>
	
	<body>
		<div id = "main">
			<form method = "get">
				<label for = "country">Country</label><br>
				<input type = "text" name = "country" id = "country" list = "suggestCountry" placeholder = "eg: USA, UK, india">
				<datalist id="suggestCountry">
					<option value="USA">
					<option value="UK">
					<option value="India">
					<option value="Egypt">
					<option value="Pakistan">
					<option value="Saudi Arabia">
				</datalist>
				<br><br>
				<label for = "city">City</label><br>
				<input type = "text" name = "city" id = "city" list = "suggestCity"  placeholder = "eg: New York, London">
				<datalist id="suggestCity">
					<option value="New York">
					<option value="Etawah">
					<option value="Hyderabad">
					<option value="Kanpur">
					<option value="London">
					<option value="Tokyo">
					<option value="Lucknow">
					<option value="New Delhi">
					<option value="Berlin">
					<option value="Moscow">
					<option value="Jeddah">
				</datalist>
				<br><br>
				
				
				<input type = "submit" id = "submit" name = "submit" value = "submit">
				<br><br>
				
				<button id = "currentLocation" type= "button">Get Current Location</button>
				
			</form>
			
			
			<div id = "weather">
				<?php
					error_reporting(0);
	
						if($weather)
						{
							
							echo "<h1>".$city.", ".$country."</h1>";
	
							for($i = 0; $i < $length; $i++)
							{
									
									
								echo $weather[$i];
									
								if($weather[$i] >= 'A' && $weather[$i] <= 'Z' && $weather[$i+1] >= 'A' && $weather[$i+1] <= 'Z')
								{
									echo "<br>";
								}
								
							}
						
							
						}
					
					
					
				?>
				</div>
			
			
		</div>
		
		
		
		<script>
			/*$(document).ready(function(){
				if(navigator.geolocation){
					navigator.geolocation.getCurrentPosition(showLocation);
				}else{ 
					$('#location').html('Geolocation is not supported by this browser.');
				}
			});

			function showLocation(position){
				var latitude = position.coords.latitude;
				var longitude = position.coords.longitude;
				console.log(latitude);
				$.ajax({
					type:'GET',
					url:'getLocation.php',
					data:'latitude='+latitude+'&longitude='+longitude,
					success:function(msg){
						if(msg){
						   $("#location").html(msg);
						}else{
							$("#location").html('Not Available');
						}
					}
				});
			}*/
			
			
			
			/*$.ajax({
				type: 'GET',
				url: 'index.php',
				data: { text1: val1, text2: val2 },
				success: function(response) {
					;
				}
			});*/
			
			
			var val = "<?php echo $weather; ?>"
			var error = $('#notFound').html();
			//val -= " ";
			var length = val.length;
			//console.log(length);
			if(val == "" )
			{
				$('#weather').css("display", "none");
				console.log("hello");
			}
				
			
			if(error)
			{
				$('#weather').css("display", "none");
				console.log("check");
			}
			
			
			
			
			
			
			$("button").hover(function()
			{
								
				$(this).css("backgroundColor", "#25d98e");
				$(this).css("cursor", "pointer");
				
			}, 
			function()
			{
					
				$(this).css("backgroundColor", "#16f296");
				
			});
			
			
			$("#submit").hover(function()
			{
				
								
				$(this).css("backgroundColor", "#25b8b8");
				$(this).css("cursor", "pointer");
				
			}, 
			function()
			{
					
				$(this).css("backgroundColor", "#16b0f2");
				
			});
			
			
			
			$("#currentLocation").click(function()
			{
				 
				$.ajax('http://ip-api.com/json')
				
			    .then(
				  function success(response) {
					  
					  console.log('User\'s Location Data is ', response);
					  console.log('User\'s Country', response.country);
					  
					  
					   var val1 = response.city;
					   var val2 = response.country;
					  
					    $('#city').val(val1);
						$('#country').val(val2);
					  
					 
					  
					  /*var data = {					
						city: response.city,
						country: response.country
					  }
					  console.log(data);
					  $.get("index.php",data);*/
					  
					 
					 
					  /*$.ajax({
					  type: 'GET',
					  url: 'index.php',
					  data: { 'city': val1, 'country': val2 },
					  success: function() {
					   ;
				       }
					  });*/
			  
				
				
					  
				  },

				  function fail(data, status) {
					  console.log('Request failed.  Returned status of',
								  status);
				  }
				
			  );
			    
				
		
				
				
			
			});
				
			
			
			
			
			
			
			
		</script>
		
		
		
		
		
		
		
		
		
		
		
	</body>
</html>
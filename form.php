<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

	<title>Two Containers Example</title>
	<style>
		html,
		body {
			height: 100%;
		}

		#container1 {

			margin: 10px;
			float: left;
			width: 45%;
			height: 100%;
			box-sizing: border-box;
		}

		#container2 {

			padding: 20px;
			margin: 10px;
			float: left;
			width: 45%;
			height: 100%;
			box-sizing: border-box;
		}

		#my-text-field {

			margin: 10px;
			width: 80%;
			padding: 10px;
			border-radius: 10px;
			box-shadow: 1px 1px rgb(173, 176, 177);
			border: none;

		}

		#jobtitle {
			margin: 10px;
			padding-left: 10%;
			padding-right: 10%;
			padding-top: 5px;

		}

		.label {
			margin-left: 10px;
		}

		.my-button {
			background-color: #0fd2b5;
			border: none;
			color: white;
			font-size: 16px;
			padding: 10px 20px;
			border-radius: 10px;
			margin-left: 65%;
			margin-top: 20px;

		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p,
		label,
		button,
		input
		 {
			font-family: Roboto,
		}

		#container3 {
			height: 550px;
			clear: both;
			width: 65%;
			box-sizing: border-box;
			margin-left: 17.5%;
			margin-right: 17.5%;
			margin-bottom: 5%;
			padding: 20px;
			border: 1px solid;
            border-radius: 10px;
			border-width: 1.5px;
		}
		#textarea1{
			height: 480px;
			width:100%; 
			border: none;
			font-family: Roboto;
			outline: none;
		}
	</style>
</head>

<body>
	<div style="width: 100%; padding: 3%;">
		<div >
			<div id="container1" >
				<div style="padding-left:35%">
					<h1>Cover Letter<br>Assistant</h1>
					<p>by branch.ai</p>
					<p>Create personalized, optimized cover letters that<br> make a lasting impression on the potentail
						employers</p>
				</div>

			</div>
			<div id="container2" >
				<form action="#" method="post">
					<div id="jobtitle">
						<div>
							<label for="field1" class="label">Job Title</label>
						</div>
						<div>
							<input type="text" id="my-text-field" name="job"
								placeholder="enter desired job position here">
						</div>
					</div>
					<div id="jobtitle">
						<div>
							<label for="field1" class="label">Company Name</label>
						</div>
						<div>
							<input type="text" id="my-text-field" name="company"
								placeholder="enter company name here">
						</div>
					</div>
					<div id="jobtitle">
						<div>
							<label for="field1" class="label">Recruiter Name</label>
						</div>
						<div>
							<input type="text" id="my-text-field" name="recruter"
								placeholder="eg John Smith or [company name] hiring services">
						</div>
					</div>
					<div id="jobtitle">
						<div>
							<label for="field1" class="label">Why you're the perfect person for Job</label>
						</div>
						<div>
							<input type="text" id="my-text-field" name="skills"
								placeholder="Show off your personal skills and experience">
						</div>
					</div>
					<div id="jobtitle">
						<div>
							<label for="field1" class="label">What makes you a good fit with the company</label>
						</div>
						<div>
							<input type="text" id="my-text-field" name="fit"
								placeholder="Descibe why your are good fit for the company culture">
						</div>
						<div class="mybutton">
							<button class="my-button">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		

<?php

// Set the OpenAI API endpoint and key
$openai_api_url = "https://api.openai.com/v1/engines/davinci-codex/completions";
$openai_api_key = "PUT-YOUR-API-KEY-HERE";

// Define the input fields for the cover letter
if( isset($_POST['job']) && isset($_POST['company'])  && isset($_POST['recruter']) )
{
	if(!empty($_POST['job']) && !empty($_POST['company']) && !empty($_POST['recruter']))
$job_title = $_POST["job"];
$company_name = $_POST["company"];
$recruiter_name = $_POST["recruter"];
$why_you = "I have a proven track record of delivering high-quality software products and collaborating effectively with cross-functional teams.";
$what_makes_you_a_good_fit = "My skills and experience align perfectly with the requirements of this position. I am passionate about using technology to solve real-world problems and am excited about the opportunity to work with a dynamic team of professionals.";

// Define the prompt for the GPT-3 API
$prompt = "Write a cover letter for the position of " . $job_title . " at " . $company_name . ". The letter should be addressed to " . $recruiter_name . " and should explain why you are perfect for the job and what makes you a good fit for the company. Here is a sample letter:\n\nDear " . $recruiter_name . ",\n\n" . $why_you . " " . $what_makes_you_a_good_fit . "\n\nSincerely,\nYour Name";

// Define the parameters for the GPT-3 API request
$params = array(
    "prompt" => $prompt,
    "temperature" => 0.7,
    "max_tokens" => 1024,
    "top_p" => 1,
    "frequency_penalty" => 0,
    "presence_penalty" => 0
);

// Encode the parameters as JSON
$data = json_encode($params);

// Set up the cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $openai_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $openai_api_key
));

// Execute the cURL request and get the response
$response = curl_exec($ch);
curl_close($ch);

// Decode the response JSON
$json = json_decode($response, true);

// Get the generated cover letter from the response
$cover_letter = $json["choices"][0]["text"];

// Print the generated cover letter
echo '
<div id="container3">
<textarea id="textarea1"  >
'.$cover_letter.'
</textarea>
</div>
';
}

?>


</div>

</body>

</html>

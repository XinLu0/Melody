<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
		      /* 
		      Template Name: email 
		      */ 
		session_start();
		$logout=@$_GET['logout'];
  		if($logout ==1)
  			$_SESSION['loggedin']=0;
  		if($_SESSION['loggedin']!=1)
  		{
  			header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
  			exit;
  		}
		function alert($msg) {
			echo "<script type='text/javascript'>alert('$msg');</script>";
		}
		function getNameByMemberID($memberID){
			global $wpdb;
			$result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
			return $result[0]->Name;
		}
		function getAllTeacherMemberID(){
			global $wpdb;
			$result = $wpdb->get_results("SELECT Member FROM Teacher_infor");
			$mList;
			$size = sizeof($result);
			for($x = 0; $x < $size; $x++){
				$mList[$x] = $result[$x]->Member;
			}
			return $mList;
		}
		function getListofEmail(){
			global $wpdb;
			$sum = $wpdb->get_results("SELECT Email FROM `Teacher_infor`");
			$num = sizeof($sum);
			$result = array();
			for($x=0;$x<$num;$x++){
				if($sum[$x]->Email!="")
					$result[$x]=$sum[$x]->Email;
			}
			return $result;
		}
		function getEmailByMid($MId){
			global $wpdb;
			$sum = $wpdb->get_results("SELECT Email FROM `Teacher_infor` WHERE Member = $MId");
			return $sum[0]->Email;
		}
		function sendEmail($subject, $emailList, $message,$isHTML)
		{
			
			for($x = 0; $x<sizeof($emailList);$x++)
			{
				$to = $emailList[$x];
			
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';
				$headers[] = 'From: Melody Strings Art Center <Melody@Melody.com>';
				if($isHTML)
				{
					mail($to, $subject, $message,implode("\r\n", $headers));
				}
				else mail($to, $subject, $message);
			}
		}
		if(isset($_POST["receiver"])){
			if($_POST["receiver"]=="All"){
				$emailList=getListofEmail();
				sendEmail($_POST["Subject"],$emailList,$_POST["Message"],False);
			}
			else {
				$emailList=array();
				$emailList[0]=getEmailByMid($_POST["receiver"]);
				sendEmail($_POST["Subject"],$emailList,$_POST["Message"],False);
			}
			alert("Successfully Send Email");
		}

		?>
		<meta charset="utf-8">
		<style>
	    	* {
				box-sizing: border-box;
			}

			body {
				margin: 0;
				height: 1000px;
			}

			/* Style the header */
			.header {
				background-color: #ffffff;
				padding: 1px;
				text-align: center;
			}

			/* Style the top navigation bar */
			.topnav {
				overflow: hidden;
				background-color: #333;
			}

			/* Style the topnav links */
			.topnav a {
				float: left;
				display: block;
				color: #f2f2f2;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			/* Change color on hover */
			.topnav a:hover {
				background-color: #ddd;
				color: black;
			}

			.topnav button {
				float: right;
				display: block;
				color: white;
				background-color: #333;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				border: 0px;
			}

			.update {
				width: 60%;
				border-radius: 5px;
				background-color: #f2f2f2;
				padding: 20px;
				margin: auto;
				border: 1px solid gray;
			}

			input[type=text], select{
			    width: 100%;
			    padding: 12px 20px;
			    margin: 8px 0;
			    display: inline-block;
			    border: 1px solid #ccc;
			    border-radius: 4px;
			    box-sizing: border-box;
			}

			input[type=submit] {
			    width: 100%;
			    background-color: #A6502D;
			    color: white;
			    padding: 14px 20px;
			    margin: 8px 0;
			    border: none;
			    border-radius: 4px;
			    cursor: pointer;
			}

			input[type=submit]:hover {
			    background-color: #8C2A05;
			}

			textarea {
				width: 100%;
				height: 150px;
				padding: 12px 20px;
				box-sizing: border-box;
				border: 2px solid #ccc;
				border-radius: 4px;
				background-color: #f8f8f8;
				font-size: 16px;
				resize: auto;
			}
		</style>
	</head>

	<body>
		<div class="header">
			<img src="<?php echo get_template_directory_uri(); ?>/test/ArtCenterFederation.jpg">
		</div>

		<div class="topnav">
			<a href="http://www.melodysac.com.sg/index.php/en/table2/">MyTable</a>
			<a href="http://www.melodysac.com.sg/index.php/en/admintable/">WholeTable</a>
			<a href="http://www.melodysac.com.sg/index.php/en/user_contact_us/">Contact Us</a>
			<form action="#" method="get">
				<button name="logout" value = 1>Logout</button>
			</form>
		</div>
		<br>
		<br>
		<br>
		<div class="update">
			<form action="#" name="send_email" method="post">
				<label for="receiver">To..</label>
				<select id="receiver" name="receiver">
					<option value="All">All members</option>
					<?php
						$MemberList= getAllTeacherMemberID();
						for($x=0; $x<sizeof($MemberList); $x++){
							$name = getNameByMemberID($MemberList[$x]);
							echo "<option value=\"$MemberList[$x]\">$name</option>";
						}
					?>
				</select>

				<label for="Subject">Subject</label>
				<input type="text" id="Subject" name="Subject"></text>

				<label for="Message">Message</label>
				<textarea  id="Message" name="Message"></textarea>

				<input type="submit" value="Send">
			</form>
		</div>
	</body>
</html>
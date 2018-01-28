<!DOCTYPE html>

<html lang="en">
  <head>
		<?php
  		/* 
  		Template Name: login 
  		*/ 
			session_start();

			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}

			function getPasswordByMemberID($memberID){
				global $wpdb;    
				$result = $wpdb->get_results( "SELECT Password FROM Teacher_infor WHERE Member=".$memberID);
				return $result[0]->Password;
			}

			function comparePassword($input,$fromDatabase){
			  return strcmp($input,$fromDatabase);
			}
			
			if(isset($_POST['user'])&&isset($_POST['Password'])){
				$pa=getPasswordByMemberID($_POST['user']);
				
				$re=comparePassword($_POST['Password'],$pa);
				if($re==0){
				$_SESSION['username']=$_POST['user'];
				$_SESSION['loggedin']=1;
				header("Location: http://www.melodysac.com.sg/index.php/en/table2/");
			}
			else {
				alert("Username does not match password");
			}
		?>

    <meta charset="utf-8">
    <script>
      function onSubmitForm(){
        x=document.getElementById("User");
        y=document.getElementById("pwd_val");
        if(x.value.length>32){
          alert("User Name is too long!(1-32)");
          return false;
        }

        if((y.value.length < 8)||(y.value.length>64)){
          alert("Password length is between 8 to 64");
          return false;
        }
      }
    </script>

    <style>
      * {
          box-sizing: border-box;
      }

      body {
        margin: 0;
        height: 1000px;
        background-image: linear-gradient(white, grey);
      }

      /* Style the header */
      /* Style the header */
      .header {
        background-color: #ffffff;
        padding: 1px;
        text-align: center;
      }
      .heading2 { color:  FF0000; }

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

      /* Create three equal columns that floats next to each other */
      .column_left {
          float: left;
          width: 20%;
          padding: 15px;
      }
      /* Create three equal columns that floats next to each other */
      .column_center {
          float: left;
          width: 60%;
          padding: 15px;
      }
      /* Create three equal columns that floats next to each other */
      .column_right {
          float: left;
          width: 20%;
          padding: 15px;
      }

      /* Clear floats after the columns */
      .row:after {
          content: "";
          display: table;
          clear: both;
      }

      /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
      @media (max-width:600px) {
          .column {
              width: 100%;
          }
      }

      .heading_left { 
        margin-top:50px;
        color:  #FF0000; 
      }

      .change_left_color{
        width: 200px;
        height: 300px;
        text-align: center;
        background-color: #F5F5F5;
        -webkit-animation-name: color_change; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 6s; /* Safari 4.0 - 8.0 */
        animation-name: color_change;
        animation-duration: 6s;
        animation-iteration-count: infinite;
      }

      /* Safari 4.0 - 8.0 */
      @-webkit-keyframes color_change {
        from {background-color: #F5F5F5;}
        to {background-color: #F08080;}
      }

      /* Standard syntax */
      @keyframes color_change {
        from {background-color: #F5F5F5;}
        to {background-color: #F08080;}
      }
      .left_img{
        text-align: center;
        margin-top:50px;
        width: 150px; 
        height: 200px;  
      }

      .center_wrapper {
        text-align:left;
        margin:0 auto;
        margin-top:100px;
        border:#000;
        width:700px;
      }
      .center_header {
        background-color:#F5F5F5;
        font-size:30px;
        line-height:80px;
        text-align:center;
      }
      .center_oneline {
        width:100%;
        border-left:#FC3 10px;
        font-size:30px;
        height:80px;
        margin-top:3px;
      }
      .center_left {
        background-color:#F5F5F5;
        line-height:80px;
        height:100%;
        width:40%;
        float:left;
        padding-left:20px;
      }
      .center_right {
        margin-left:20px;
      }
      .center_box {
        width:50%;
        height:70px;
        margin-left:20px;
        font-size:25px;
      }
      .center_btn {
        background-color:#F5F5F5;
        height:70px;
        text-align:center;
        margin-top:20px;
      }

      .center_btn input {
        font-size:30px;
        height:50px;
        width:300px;
        border:5px;
        line-height:30px;
        margin-top:10px;
        border-radius:50px;
        background-color:#FFF;
      }
      .center_btn input:hover{
        cursor:pointer;
        background-color:#FB4044;
      }

      .right_img {
        margin-top:50px;
        padding: 1px;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <div class="header">
      <img src="<?php echo get_template_directory_uri(); ?>/test/melody.jpg">
    </div>

    <div class="topnav">
      <a href="#">Contact us</a>
    </div>


    <div class="row">
      <div class="column_left">
        <h2 class="heading_left">The Sales Champion</h2>
        <div class="change_left_color">
          <img class="left_img" src="<?php echo get_template_directory_uri(); ?>/test/blair.jpg">
        </div>
      </div>

      <div class="column_center">
        <form method="post" onSubmit="return onSubmitForm()" accept-charset="utf-8">
          <div class="center_wrapper">

            <div class="center_header">
              Login
            </div>
            <div class="center_oneline">
              <div class="center_left">User Name:</div> 
              <div class="center_right">
                <input class="center_box" type="text" name="user" id="User" value="">
              </div>
            </div>
            <div class="center_oneline">
              <div class="center_left">Password: </div>
              <div class="center_right" >
                <input  class="center_box" type="text" name="Password" id="pwd_val" value="" >
              </div>
            </div>
            <div class="center_oneline center_btn">
              <input  type="submit" value="Submit">
            </div>
          </div>
        </form>
      </div>

      <div class="column_right">
        <div class="right_img">
          <img src="<?php echo get_template_directory_uri(); ?>/test/cellos.jpg">
        </div>
      </div>
    </div>

  </body>
</html>

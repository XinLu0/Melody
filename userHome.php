<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
  		/* 
  		Template Name: userHome 
  		*/ 
    ?>
    
  	<?php
      session_start();
      require('utils.php');
  		$logout=@$_GET['logout'];
  		if($logout ==1)
  			$_SESSION['loggedin']=0;
  		if($_SESSION['loggedin']!=1)
  		{
  			header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
  			exit;
  		}
  		//$username = $_SESSION['username'];
		if(isset($_POST['Month'])){
			getDatefromToByMonth($_POST['Month']);
			
		}else{
			getDatefromToByCurrent();
		}
		$_SESSION['dateFrom'] = $dateFrom;
		$_SESSION['dateTo'] = $dateTo;
		
  	?>

    <meta charset="utf-8">
    <style>
      * {
          box-sizing: border-box;
      }

      body {
        margin: 0;
      }

      /* Style the header */
      .header {
        background-color: #ffffff;
        padding: 1px;
        text-align: center;
      }

      .heading2 {
        color:  FF0000;
      }

      .heading4 {
        color:  FF0000;
        text-align: center;
      }
      /* Style the top welcome bar */
      .topWel {
        overflow: hidden;
        background-color: #333;
      }

      /* Style the topWel links */
      .topWel p {
        float: right;
        display: block;
        color: #f2f2f2;
        text-align: center;
        text-decoration: none;
      }

      .topWel button {
        float: right;
        display: block;
        color: white;
        background-color: #333;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        border: 0px;
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

      /* Create three equal columns that floats next to each other */
      .column_left {
        float: left;
        width: 20%;
        padding: 15px;
      }

      .img_left{
        text-align: center;
        margin-top:20px;
        margin-bottom:20px;
        width: 220px; 
        height: 200px;
      }

      /* Create three equal columns that floats next to each other */
      .column_center {
        float: center;
        width: 80%;
        padding: 15px;
        padding-top: 40px;
        text-align:center"
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

      .left_img{
        text-align: center;
        margin-top:50px;
        width: 150px; 
        height: 200px;
      }

      #Performance {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 80%;
        margin: auto;
      }

      #Performance th {
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: grey;
        color: white;
      }

      #Major {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
      }

      #Major th {
        font-weight: 100;
        font-size: 20px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: yellow;
        color: black;
      }

      #Major td{
        font-size: 20px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: white;
        color: black;
      }

      #Minor1 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
      }

      #Minor1 th {
        font-weight: 100;
        font-size: 20px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: skyblue;
        color: white;
      }

      #Minor1 td{
        font-size: 20px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: white;
        color: black;
      }

      #Minor2 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
      }

      #Minor2 th {
        font-weight: 100;
        font-size: 20px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: pink;
        color: white;
      }

      #Minor2 td{
        font-size: 20px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: white;
        color: black;
      }

      #right_table {
        margin-top:20px;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 30%;
      }

      #right_table th {
        font-weight: 100;
        font-size: 12px;
        border: 1px solid #ddd;
        padding: 10px;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: #cccccc;
        color: white;
      }

      #right_table td{
        font-size: 15px;
        border: 1px solid #ddd;
        padding:  10px;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: center;
        background-color: #cccccc;
        color: black;
      }

    </style>
  </head>

  <body>
    <div class="header">
      <img src="<?php echo get_template_directory_uri(); ?>/test/ArtCenterFederation.jpg">
    </div>

    <div class="topWel">
        <form action="#" method="get">
            <button name="logout" value = 1>Logout</button>
        </form>
        <?php
          session_start();
          $userId = $_SESSION['username'];
          $name = getNameByMemberID($userId);
          echo "<p>Welcome back: $name</p>";
        ?>
    </div>

    <div class="topnav">
      <a href="http://www.melodysac.com.sg/index.php/en/melodysac_instruments/">MelodySAC Instruments</a>
      <a href="http://www.melodysac.com.sg/index.php/en/seasoned_instruments/">Seasoned Instruments</a>
      <a href="http://www.melodysac.com.sg/index.php/en/orchestra/">Orchestra</a>
      <a href="http://www.melodysac.com.sg/index.php/en/layout1/">Chart</a>
      <a href="http://www.melodysac.com.sg/index.php/en/update_information/">Update Profile</a>
      <?php
       $contract = get_template_directory_uri()."/MemberInfo/"."/ContractPDF/".$_SESSION['username'].".pdf";
       echo "<a href=\"$contract\" download=\"contract\">Contract Download</a>";
      ?>
      <a href="http://www.melodysac.com.sg/index.php/en/contact/">Contact Us</a>
      <a href="http://www.melodysac.com.sg/index.php/en/terms/">Terms&Conditions</a>
      <a HREF="javascript:window.print()">Print</a>
    </div>

    <div class="row">
      <div style="text-align:center">
        <?php
          session_start();
          $userId = $_SESSION['username'];
          $name = getNameByMemberID($userId);
          echo "<h3 class=\"heading3\">Hi, $name</h3>";
          echo "<h3 class=\"heading3\">Congratulations!</h3>";
          $creditEarnedOfMainUser = getCreditEarnedWithRefByMemberID($userId);
          $creditEarnedByAll = getAllCreditIncSubByMemberId($userId);
          $creditEarnedByAll += getCreditChangeByMemberID($userId);

          echo "<a href=\"http://www.melodysac.com.sg/index.php/en/userinformation/\" >You had collect: $creditEarnedOfMainUser points</a>";
          echo "<h3 class=\"heading3\" >Total Point earn(included your direct member): $creditEarnedByAll points</a>";
          echo "<br>";
          $img = get_template_directory_uri()."/MemberInfo/ProfileImgJPG/".$_SESSION['username'].".jpg";
          $relativeImg="wp-content/themes/top3themes/MemberInfo/ProfileImgJPG/".$_SESSION['username'].".jpg";
          $defaultImg = get_template_directory_uri()."/MemberInfo/ProfileImgJPG/default.jpg";
          if (file_exists($relativeImg)){
            echo "<img class=\"img_left\" src=\"$img\">";
          }
          else echo "<img class=\"img_left\" src=\"$defaultImg\">";
        ?>

        <br> 
        <br>
        <h3 class="heading3">YOUR TOTAL DIRECT MEMBER: </h3>

        <table id="Performance">
          <tr id="Performance">
            <th id="Performance">YOUR TOTAL DIRECT MEMBER:</th>
          </tr>
          
            <?php
              $userid = $_SESSION['username'];
              $belowList = getBelowTeacherListFromName(getNameByMemberID($userid));
              for($x = 0; $x < sizeof($belowList); $x++)
              {
                // name of sub teacher
                echo "<tr id=\"Performance\">";
                echo "<td id=\"Performance\">";
                echo " <form action=\"http://www.melodysac.com.sg/index.php/en/userinformation/\" method=\"get\">";
                echo "<button name=\"userInfo\" value = ".getMemberIDFromName($belowList[$x])."> ";
                echo "<div style=\"height:100%;width:100%\">";
                echo ($x+1).".";
                echo $belowList[$x];
                echo " - ";
                echo getGradeNameSGByCredit(getAllCreditIncSubByMemberId(getMemberIDFromName($belowList[$x])));
                echo "</div>";
                echo "</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
              }
            ?>
        </table>
        
        <br> 
        <br>
      </div>
    </div>

  </body>
</html>

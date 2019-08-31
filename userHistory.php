<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
  		/* 
      Template Name: userHistory
       
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
		if(isset($_POST['startMonth'])){
			getDatefromByMonth($_POST['startMonth']);
		}else{
			getDatefromByCurrentYear();
    }
    getDateToByCurrentMonth();
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

      #Performance td {
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: white;
        color: black;
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
    <div class="column_left">
        <p></p>
        <p>Select Start Month</p>

        <table id="right_table">
          <tr id="right_table">
            <form action="#" method="post">
              <select name="startMonth">
                <?php
                  $y = date('Y');
                  $m = date('m');
                  for($i = 0; $i < 24; $i++){
                    if($y == substr($dateFrom, 0, 4) && $m == substr($dateFrom, 5, 2))
                    {
                      echo "<option selected=\"selected\" value=\"$y$m\">$y/$m</option>";
                    }
                    else
                    {
                      echo "<option value=\"$y$m\">$y/$m</option>";
                    }
                    $m--;
                    if($m==0){
                      $m=12;
                      $y--;
                    }
                    if($m<10)$m="0".$m;
                  }
                ?>
              </select>
              <input type="submit" value="Submit"/>
            </form>
          </tr>
        </table>
      </div>
      <div style="text-align:center">
        <?php
          session_start();
          $userId = $_SESSION['username'];
          $name = getNameByMemberID($userId);
          echo "<h3 class=\"heading3\">Hi, $name, Level YuanFen@ Member</h3>";
        ?>

        <br> 
        <br>
        <h3 class="heading3">History </h3>

        <table id="Performance">
          <tr id="Performance">
            <th id="Performance">Individual Points from Products Selling</th>
            <td id="Performance"><?php echo getCreditEarnedWithoutRefByMemberID($userId); ?></td>
          </tr>
          <tr id="Performance">
            <th id="Performance">Points as Melody's membership referral</th>
            <td id="Performance"><?php echo getReferringCreditEarnedByMemberId($userId); ?></td>
          </tr>
          <tr id="Performance">
            <th id="Performance">Points from direct member</th>
            <td id="Performance"><?php echo getAllCreditFromSubByMemberId($userId); ?></td>
          </tr>
          <tr id="Performance">
            <th id="Performance">Total Points</th>
            <td id="Performance"><?php echo getAllCreditIncSubByMemberId($userId); ?></td>
          </tr>
          <tr id="Performance">
            <th id="Performance">Total Points redemption</th>
            <td id="Performance"><?php echo getCreditChangeByMemberID($userId); ?></td>
          </tr>
          <tr id="Performance">
            <th id="Performance">Balance</th>
            <td id="Performance"><?php echo getBalanceByMemberId($userId); ?></td>
          </tr>
        </table>

        <br> 
        <br>
        <h3 class="heading3">History Record </h3>

        <table id="Performance">
          <tr id="Performance">
            <th id="Performance">Month</th>
            <th id="Performance">Total Point Collected</th>
            <th id="Performance">Total Point Redeemed</th>
            <th id="Performance">Balance Points</th>
          </tr>
          <tr id="Performance">
            <th id="Performance">Balance Brought Forward</th>
            <td id="Performance">
              <?php 
                $balanceBroughtForward = 0;
                $balanceBroughtForward = getAllCreditIncSubByMemberIdANDDateTo($userId, $dateFrom);
                echo $balanceBroughtForward;
              ?>
            </td>
            <td id="Performance"><?php echo getCreditChangeByMemberIDANDDateFromANDDateTo($userId, "0000-00-00", $dateFrom);?></td>
            <td id="Performance"><?php echo (getAllCreditIncSubByMemberIdANDDateTo($userId, $dateFrom)+getCreditChangeByMemberIDANDDateFromANDDateTo($userId, "0000-00-00", $dateFrom));?></td>
          </tr>
          <?php
            $startYear = substr($dateFrom, 0, 4);
            $startMonth = substr($dateFrom, 5, 2); 
            $currentYear = substr($dateTo, 0, 4);
            $currentMonth = substr($dateTo, 5, 2); 
            $months = array (1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');
            $AllCreditTotalSum = getAllCreditIncSubByMemberId($userId) - getAllCreditIncSubByMemberIdANDDateTo($userId, $startYear."-".sprintf("%02d", $startMonth)."-01"); 
            $AllCreditChangeTotalSum = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear."-".sprintf("%02d", $startMonth)."-01", $dateTo);
            while($startYear < $currentYear || $startMonth <= $currentMonth)
            {

              $AllCreditByMonth = getAllCreditIncSubByMemberIdANDDateTo($userId, $startYear."-".sprintf("%02d", ($startMonth+1))."-01") - getAllCreditIncSubByMemberIdANDDateTo($userId, $startYear."-".sprintf("%02d", $startMonth)."-01");
              $AllCreditChangeByMonth = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear."-".sprintf("%02d", $startMonth)."-01", $startYear."-".sprintf("%02d", ($startMonth+1))."-01");
              echo "<tr id=\"Performance\">";
              echo "<th id=\"Performance\">".$startYear."-".$months[intval($startMonth)]."</th>";
              echo "<td id=\"Performance\">".$AllCreditByMonth."</td>";
              echo "<td id=\"Performance\">".$AllCreditChangeByMonth."</td>";
              echo "<td id=\"Performance\">".($AllCreditByMonth + $AllCreditChangeByMonth)."</td>";
              echo "</tr>";
              $startMonth++;
              if($startMonth>12)
              {
                $startYear++;
                $startMonth = 01;
              }
            }
            echo "<tr id=\"Performance\">";
            echo "<th id=\"Performance\">Total Sum</th>";
            echo "<td id=\"Performance\">".$AllCreditTotalSum."</td>";
            echo "<td id=\"Performance\">".$AllCreditChangeTotalSum."</td>";
            echo "<td id=\"Performance\">".($AllCreditTotalSum + $AllCreditChangeTotalSum)."</td>";
            echo "</tr>";


          ?>

        </table>
        
        <br> 
        <br>
      </div>
    </div>

  </body>
</html>

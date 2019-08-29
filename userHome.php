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
  		$totalIncome=0;
		function getPriceCNByItemNo($itemNo){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Price_CN FROM Melody_items_New WHERE Item_no=$itemNo");
		return $result[0]->Price_CN;
		}
		function getPriceSGByItemNo($itemNo){
		global $wpdb;
		$result = $wpdb->get_results("SELECT Price_SG FROM Melody_items_New WHERE Item_no=$itemNo");
		return $result[0]->Price_SG;
		}
  	?>
    <?php
      session_start();

      function getTotalItemNumber(){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT * FROM Melody_items_New");
        return sizeof($sum);
      }

	  function getMajorPropsCNByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_CN;
	  }
	  function getMinorPropsCNByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_CN;
	  }
	  function getMajorPropsSGByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_SG;
	  }
	  function getMinorPropsSGByItemNo($itemNo){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_SG;
	  }

      function getNameByMemberID($memberID){
        global $wpdb;
        $result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
        return $result[0]->Name;
      }

      function getNumOfItemByItemIDAndMemeberID($memberID, $item_no){
				global $wpdb;
				$sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no");

				
				if(sizeof($sum)==0)
					return 0;
				else 
				{
					$result;
					for($x=0;$x<sizeof($sum);$x++){
						$result = $result+ $sum[$x]->Number;
						
					}
					return $result;
				}
      }

      function getNumOfItemByItemIDAndMemeberIDAndDate($memberID, $item_no, $dateFrom)
      {
        global $wpdb;
  
        $sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no AND dDate >=\" $dateFrom \"");
  
        if(sizeof($sum)==0)
          return 0;
        else 
        {
          $result;
          for($x=0;$x<sizeof($sum);$x++){
            $result = $result+ $sum[$x]->Number;
            
          }
          return $result;
        }	  
      }

      function getBelowTeacherListFromName($Name){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Name FROM Teacher_infor WHERE Major=\"".$Name."\"");

        $nameArray;
        $size = sizeof($result);
        for($x = 0; $x < $size; $x ++){
          $nameArray[$x]=$result[$x]->Name;
        }
        return $nameArray;
      }

      function getMemberIDFromName($Name){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
        return $result[0]->Member;
      }

      function getItemNameByItemID($item_id){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Item FROM Melody_items WHERE item_no=$item_id");
        return $sum[0]->Item;
      }

      function getDatefromToByMonth($yyyymm){
        $month = substr($yyyymm, -2);
        $year = substr($yyyymm,0, 4);
        $toyear = substr($yyyymm,0, 4);
        $nextMonth = $month+1;
        if($nextMonth>12)
          {
            $nextMonth="01";
            $toyear++;
          }
        else if($nextMonth<10)
          $nextMonth = "0".$nextMonth;
        global $dateFrom;
        $dateFrom = $year."-".$month."-01";
        global $dateTo;
        $dateTo = $toyear."-".$nextMonth."-01";
      }

      function getDatefromToByCurrent(){
        $currentDate = date('Y-m-d');
        $currentMonth = substr($currentDate,5,2);
        $nextMonth = $currentMonth+1;
        $year = substr($currentDate,0,4);
        if($nextMonth>12)
          {
          $nextMonth="01";
          $year++;
          }
        else if($nextMonth<10)
          $nextMonth = "0".$nextMonth;
        global $dateFrom;
        global $dateTo;
        $dateFrom = substr($currentDate,0,7)."-01";
        $dateTo = $year."-".$nextMonth."-01";
      }
      function getIsInChinaByMemberId($memberId){
        global $wpdb;
        $result = $wpdb->get_results("SELECT isInChina FROM Teacher_infor WHERE Member=$memberId");
        return $result[0]->isInChina;
      }
      
      function getCreditChangeByMemberID($memberID)
      {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID");
        if(sizeof($sum) == 0)
          return 0;
        else
        {
          $result = 0;
          for($x = 0; $x < sizeof($sum); $x++){
            $result = $result + $sum[$x]->CreditChange;
          }
          return $result;
        }
      }

      function getGradePropSGByCredit($credit)
      {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Grade_Major_Prop_SG FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $results[sizeof($results)-1]->Grade_Major_Prop_SG;
      }

      function getCreditEarnedWithRefByMemberID($memberID)
      {
        global $wpdb;
        $results = $wpdb->get_results("SELECT *, IFNULL(Melody_performance.dDate,\"\") AS FinalDate, IFNULL(Melody_performance.Member, \"\") AS FinalMember
        FROM `Melody_performance`
        LEFT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        UNION
        SELECT *, IFNULL(Melody_Referring_Performance.dDate, \"\") AS FinalDate, IFNULL(Melody_Referring_Performance.Member, \"\") AS FinalMember
        FROM `Melody_performance`
        RIGHT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        ORDER BY FinalDate ASC");
      

        $map = array();
        $prop = getGradePropSGByCredit(0);
        for($x = 0; $x < sizeof($results); $x++){
          if(!is_null($results[$x]->Item_no))
          {
            //sell performance
            $sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
            $currentSum =0;
            for($y = 0; $y < sizeof($sublist); $y++){
              $subMemberId = getMemberIDFromName($sublist[$y]);
              if(is_null($map[$subMemberId]))
              {
                $map[$subMemberId] = 0;
              }
              $currentSum += $map[$subMemberId];
            }
            $currentSum += $map[$results[$x]->FinalMember];
            $prop = getGradePropSGByCredit($currentSum);
            if($results[$x]->props == 0)
            {
              $wpdb->update(Melody_performance, array('props'=>$prop), array('id' => $results[$x]->id ));
            }
            $map[$results[$x]->FinalMember] +=$results[$x]->Number * $results[$x]->PricePerItem * $prop;
          }
          else
          {
            $map[$results[$x]->FinalMember] += $results[$x]->Credit;
          }
        }
        return $map[$memberID];

      }

      function getReferringCreditEarnedByMemberId($memberID)
      {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Credit FROM Melody_Referring_Performance WHERE Member = $memberID");
        $sum =0;
        for($x = 0; $x < sizeof($results); $x++){
          $sum += $results[$x]->Credit;
        }
        return $sum;
      }

      function getAllCreditIncSubByMemberId($memberID)
      {
        $belowTeacherList = getBelowTeacherListFromName(getNameByMemberID($memberID));
        $CreditEarnedBysubMember = 0;
        for($x = 0; $x < sizeof($belowTeacherList); $x++)
        {
          $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
          $CreditEarnedBysubMember += getCreditEarnedWithRefByMemberID($subMemberID);
        }
        $total = $CreditEarnedBysubMember + getCreditEarnedWithRefByMemberID($memberID);
        return $total;
      }

      function getGradeNameSGByCredit($credit)
      {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Grade_Name FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $result[sizeof($result)-1]->Grade_Name;
      }

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
                echo "<a href=\"http://www.melodysac.com.sg/index.php/en/information/\">";
                echo "<div style=\"height:100%;width:100%\">";
                echo ($x+1).".";
                echo $belowList[$x];
                echo " - ";
                echo getGradeNameSGByCredit(getAllCreditIncSubByMemberId(getMemberIDFromName($belowList[$x])));
                echo "</div>";
                echo "</a>";
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

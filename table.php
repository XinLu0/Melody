<!DOCTYPE html>
<html>
  <head>
    <?php
  		/* 
  		Template Name: table2 
  		*/ 
    ?>
	<?php
		session_start();
		//$logout=@$_GET['logout'];
		//if($logout ==1)
		//	$_SESSION['loggedin']=0;
		//	if($_SESSION['loggedin']!=1)
		//{
		//	header("Location:http://www.melodysac.com.sg/index.php/zh/testing/");
		//	exit;
		//}
		//$username = $_SESSION['username'];
		$totalIncome=0;
		function getItemPriceByItemID($item_id)
		{
			global $wpdb;
			$sum = $wpdb->get_results("SELECT Price
		FROM `Melody_items` WHERE item_no =$item_id");
		return $sum[0]->Price;
		}
	?>
    <?php
      session_start();
      function getTotalItemNumber(){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT * FROM Melody_items");
        return sizeof($sum);
      }

      function getMajorprop($item_no)
      {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Major_proprotion FROM Melody_items WHERE Item_no = $item_no");
        $result = $sum[0]->Major_proprotion;
        return $result;
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
        else {
          $result;
          for($x = 0; $x < sizeof($sum); $x ++){
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

      function getMinorOneprop($item_no)
      {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Minor1_proprotion FROM Melody_items WHERE Item_no = $item_no");
        $result = $sum[0]->Minor1_proprotion;
        return $result;
      }

      function getMinorTwoprop($item_no)
      {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Minor2_proprotion FROM Melody_items WHERE Item_no = $item_no");
        $result = $sum[0]->Minor2_proprotion;
        return $result;
      }

      function getMemberIDFromName($Name){
        global $wpdb;
        $result = $wpdb->get_results( "SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
        return $result[0]->Member;
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
        background-image: linear-gradient(white, grey);
      }

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
          width: 80%;
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
        font-size: 12px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: #BA55D3;
        color: white;
      }

      #Major td{
        font-size: 20px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: #BA55D3;
        color: black;
      }

      #Minor1 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
      }
      #Minor1 th {
        font-weight: 100;
        font-size: 12px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: #DDA0DD;
        color: white;
      }
      #Minor1 td{
        font-size: 17px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 8px;
        padding-bottom: 8px;
        text-align: center;
        background-color: #DDA0DD;
        color: black;
      }

      #Minor2 {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 50%;
      }
      #Minor2 th {
        font-weight: 100;
        font-size: 12px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: #FFC0CB;
        color: white;
      }
      #Minor2 td{
        font-size: 14px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 8px;
        padding-bottom: 8px;
        text-align: center;
        background-color: #FFC0CB;
        color: black;
      }

    </style>
  </head>

  <body>
    <div class="header">
      <img src="<?php echo get_template_directory_uri(); ?>/test/melody.jpg">
    </div>

    <div class="topnav">
      <a href="http://www.melodysac.com.sg/index.php/en/layout1/">Layer</a>
    </div>

    <div class="row">
      <div class="column_left">
      <?php
          session_start();
          $mid = $_SESSION['username'];
          $name = getNameByMemberID($mid);
          echo "<h2 id=\"heading2\">Hello $name</h2>"
      ?>
      <img src="<?php echo get_template_directory_uri(); ?>/test/<?php echo $_SESSION['username']; ?>.jpg">
      </div>

      <div class="column_center">
        <table id="Performance">
          <tr id="Performance">
            <th id="Performance">Name</th>
            <th id="Performance">Member No.</th>
        		<?php
        			session_start();
        			$sum = getTotalItemNumber();
        			$_SESSION['TotalItem']=$sum;

        			for($i = 1; $i <= $sum; $i ++){
        				echo "<th id=\"Performance\">Item $i</th>";
        			}
        			echo "<th id=\"Performance\">Total</th>";
        		?>
          </tr>

          <tr id="Major">
            <th id="Major">Major</th>
            <th id="Major"></th>
            <?php
              session_start();
        			$sum=$_SESSION['TotalItem'];
        			for($i = 1; $i <= $sum; $i ++){
        				$re = getMajorprop($i);
        				$re = $re*100;
        				echo "<th id=\"Major\">$re %</th>";
        			}
        		?>
            <th id="Major"></th>
          </tr>
          <tr id="Major">
            <?php 
              session_start();
			
        			$mid = $_SESSION['username'];
        			$name = getNameByMemberID($mid);
        			echo "<td id=\"Major\">$name</td>";
        			echo "<td id=\"Major\">$mid</td>";
        			$_SESSION['user'] = $name;

              $sum = $_SESSION['TotalItem'];
              $mid = $_SESSION['username'];
			$majorincome=0;
              for ($i = 1; $i <= $sum; $i ++){
				$num =getNumOfItemByItemIDAndMemeberID($mid,$i);
				$price = getItemPriceByItemID($i);
				$prop = getMajorprop($i);
				$majorincome = $majorincome + $num *$price*$prop;
				echo "<td id=\"Major\">$num</td>";
        			}
			echo"<td id=\"Major\">$majorincome</td>";
			$totalIncome =$totalIncome+$majorincome;
            ?>
          </tr>

          <?php
            session_start();
            $major_name = $_SESSION['user'];
            $nameList = getBelowTeacherListFromName($major_name);
            $total_item = $_SESSION['TotalItem'];

            for($x = 0; $x < sizeof($nameList); $x ++){
      				//Minor1's percentage
      				echo "<tr id=\"Minor1\">";
      				echo "<th id=\"Minor1\">Minor1</th>";
      				echo "<th id=\"Minor1\"></th>";
      				for($i = 1; $i <= $total_item; $i ++){
      					$minor1= getMinorOneprop($i);
      					$minor1 = $minor1*100;
      					echo "<th id=\"Minor1\">$minor1%</th>";
      				}
      				echo "<th id=\"Minor1\"></th></tr>";

      				//Minor1's Data
      				$subMemId = getMemberIDFromName($nameList[$x]);
      				echo "<tr id=\"Minor1\">";
      				echo "<td id=\"Minor1\">$nameList[$x]</td>";
      				echo "<td id=\"Minor1\">$subMemId</td>";
					$subincome=0;
      				for($i = 1; $i <= $total_item; $i ++){
      					$re = getNumOfItemByItemIDAndMemeberID($subMemId,$i);
					$price = getItemPriceByItemID($i);
					$prop = getMinorOneprop($i);
					$subincome = $subincome+$price*$re*$prop;
      					echo "<td id=\"Minor1\">$re</td>";
      				}
					echo "<td id=\"Minor1\">$subincome</td></tr>";
				$totalIncome = $totalIncome+$subincome;
				$subincome=0;
      				$subNameList = getBelowTeacherListFromName($nameList[$x]);
      				
				      if(sizeof($subNameList) > 0){
                //Minor2's percentage
                echo "<tr id=\"Minor2\">";
                echo "<th id=\"Minor2\">Minor2</th>";
                echo "<th id=\"Minor2\"></th>";
      					for($i = 1; $i <= $total_item; $i ++){
      						$minor2 = getMinorTwoprop($i);
      						$minor2 = $minor2*100;
      						echo "<th id=\"Minor2\">$minor2%</th>";
      					}
                echo"<th id=\"Minor2\"></th></tr>";

                //Minor2's data
                for($y = 0; $y < sizeof($subNameList); $y ++){
                  $minor2MemberID = getMemberIDFromName($subNameList[$y]);
                  echo "<tr id=\"Minor2\">";
                  echo "<td id=\"Minor2\">$subNameList[$y]</td>";
                  echo "<td id=\"Minor2\">$minor2MemberID</td>";
						$subincome=0;
      						for($i = 1; $i <= $total_item; $i ++){
      							$re = getNumOfItemByItemIDAndMemeberID($minor2MemberID,$i);
							$price = getItemPriceByItemID($i);
							$prop = getMinorTwoprop($i);
							$subincome=$subincome+$re*$price*$prop;
      							echo "<td id=\"Minor2\">$re</td>";
      						}
						echo "<td id=\"Minor2\">$subincome</td></tr>";
						$totalIncome = $totalIncome+$subincome;
                }//End of Minor2's data
				      } //End of Minor2
            }//End of Minor
            //Last Total
            echo "<tr id=\"Performance\">";
            echo "<th id=\"Performance\"> </th>";
            echo "<th id=\"Performance\"> </th>";
            for($i = 1; $i <= $total_item; $i ++){
              echo "<th id=\"Performance\"> </th>";
            }
            echo "<th id=\"Performance\">$totalIncome</th>";
            echo "</tr>";
          ?>
        </table>
      </div>
    </div>
  </body>
</html>

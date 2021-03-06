<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
  /* 
    Template Name: layout2 
  */ 
  session_start();
  $_SESSION['cMinor1']=1001;// to be deprecated
  function getNameByMemberID($memberID){
  global $wpdb;
  $result = $wpdb->get_results( "SELECT Name FROM Teacher_infor WHERE Member=".$memberID);
  return $result[0]->Name;
  }
  $myName = getNameByMemberID($_SESSION['username']);
  function getBelowTeacherListFromName($Name){
  global $wpdb;
  $result = $wpdb->get_results( "SELECT Name FROM Teacher_infor WHERE Major=\"".$Name."\"");
  $nameArray;
  $size = sizeof($result);
  for($x=0;$x<$size;$x++){
    $nameArray[$x]=$result[$x]->Name;
  }
  return $nameArray;
  }
  function getTotalItemNumber(){
  global $wpdb;
  $sum = $wpdb->get_results("SELECT * FROM `Melody_items` ");

  return sizeof($sum);
  }
  
  function getNumOfItemByItemIDAndMemeberID($memberID, $item_no){
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Number FROM `Melody_performance` WHERE Member =$memberID AND Item_no=$item_no");
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
  function getMemberIDFromName($Name){
  global $wpdb;
  $result = $wpdb->get_results( "SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
  return $result[0]->Member;
}
  function alert($msg) {
          echo "<script type='text/javascript'>alert('$msg');</script>";
  }
  function getItemNameByItemID($item_id)
  {
    global $wpdb;
    $sum = $wpdb->get_results("SELECT Item
  FROM `Melody_items` WHERE item_no =$item_id");
  return $sum[0]->Item;
  }
  function getItemPriceByItemID($item_id)
  {
    global $wpdb;
    $sum = $wpdb->get_results("SELECT Price
    FROM `Melody_items` WHERE item_no =$item_id");
    return $sum[0]->Price;
  }
  $totalItem = getTotalItemNumber();
  function getMinorOneprop($item_no)
  {
    global $wpdb;
    $sum = $wpdb->get_results("SELECT Minor1_proprotion FROM `Melody_items` WHERE Item_no = $item_no");
    $result = $sum[0]->Minor1_proprotion;
    return $result;
  }
  $currentMinor1 = $_SESSION['cMinor1'];

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

      .heading2 {
        color:  FF0000;
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

      .label_moving {
        width: 500px;
        background-color: red;
        position: relative;
        -webkit-animation-name: label_anim; /* Safari 4.0 - 8.0 */
        -webkit-animation-duration: 8s; /* Safari 4.0 - 8.0 */
        animation-name: label_anim;
        animation-duration: 8s;
        animation-iteration-count: 10;
      }

      /* Safari 4.0 - 8.0 */
      @-webkit-keyframes label_anim {
        0%    {background-color:red; left:0px; top:0px;}
        100%  {background-color:yellow; left:1000px; top:0px;}
      }

      /* Standard syntax */
      @keyframes label_anim {
        0%    {background-color:red; left:0px; top:0px;}
        100%  {background-color:yellow; left:1000px; top:0px;}
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

      .left_img{
        text-align: center;
        margin-top:50px;
        width: 150px; 
        height: 200px;
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

      .center_major {
        margin: auto;
        width: 300px;
        border: 1px solid green;
        border-radius: 35px;
        padding: 10px;
      }

      .center_major1 {
        margin: auto;
        width: 250px;
        border: 1px solid green;
        border-radius: 35px;
        padding: 5px;
      }

      #center_line {
        border-collapse: collapse;
        width: 100%;
      }

      #center_line th {
        padding: 8px;
        text-align: left;
        border-top: 3px solid green;
        border-left: 2px solid green;
        border-right: 2px solid green;
      }

      .center_minor {
        padding: 1px;
        float: left;
        width: 24.99999%;
      }

      @media only screen and (max-width: 700px){
        .center_minor {
          width: 49.99999%;
          margin: 6px 0;
        }
      }

      @media only screen and (max-width: 500px){
        .center_minor {
          width: 100%;
        }
      }

      .center_container {
        display: grid;
        grid-template-columns: auto auto auto auto;
        grid-gap: 10px;
        background-color: #d9d9d9;
        padding: 10px;
      }

      .center_container > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: center;
        padding: 20px 0;
        font-size: 20px;
      }

      div.gallery_major {
        border: 1px solid green;
        border-radius: 35px;
        padding: 25px;
        margin: 25px;
        border: 1px solid #ccc;
        width: 220px;
      }

      div.gallery {
          border: 1px solid green;
          border-radius: 35px;
          padding: 25px;
          margin: 25px;
          border: 1px solid #ccc;
          width: 180px;
      }

      .gallery-dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }

      div.gallery:hover .gallery-dropdown-content {
        border: 1px solid #777;
        display: block;
      }

      div.gallery img {
        width: 100%;
        height: auto;
      }

      div.desc {
        padding: 15px;
        text-align: center;
      }

      #center_table {
        padding: 15px;
        text-align: center;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
      }

      #center_table th {
        font-weight: 100;
        font-size: 12px;
        border: 1px solid #ddd;
        padding: 12px;
        padding-top: 1px;
        padding-bottom: 1px;
        text-align: center;
        background-color: #cccccc;
        color: white;
      }

      #center_table td{
        font-size: 20px;
        border: 1px solid #ddd;
        padding:  12px;
        padding-top: 16px;
        padding-bottom: 16px;
        text-align: center;
        background-color: #cccccc;
        color: black;
      }

    </style>
  </head>

  <body>
    <div class="header">
      <img src="<?php echo get_template_directory_uri(); ?>/test/melody.jpg">
    </div>
    <div class="topnav">
      <a href="#">Link</a>
      <a href="#">Link</a>
      <a href="#">Link</a>
    </div>

    <div class="label_moving">Hurry up! The cello already be sold 10!!</div>

    <div class="row">
      <div class="column_left">
        <h2 class="heading2"><?php echo "Hello ".$myName?></h2>
        <img class="left_img" src="<?php echo get_template_directory_uri(); ?>/test/<?php echo $_SESSION['username']; ?>.jpg"> 
                <table id="right_table">
          <tr id="right_table">
            <th id="right_table">Item No</th>
            <th id="right_table">Sold No</th>
          </tr>
           <?php
      for($i=1;$i<=$totalItem;$i++){
        $iItemNumber = getNumOfItemByItemIDAndMemeberID($_SESSION['username'],$i);
        echo"
        <tr id=\"right_table\">
        <td id=\"right_table\">$i</td>
        <td id=\"right_table\">$iItemNumber</td>
        </tr>
        ";
      }
      ?>
          
        </table>
      </div>


      <div class="column_center">
        <div class="center_major">
          <div class="gallery_major">
              <img src="<?php echo get_template_directory_uri(); ?>/test/<?php echo $_SESSION['username']; ?>.jpg" width="170" height="220">
              <div class="desc"><?php echo $_SESSION['username']; ?></div>
          </div>
        </div>

        <p></p>
        <p></p>
        <p></p>

        <div class="center_major1">
          <div class="gallery">
              <img src="<?php echo get_template_directory_uri(); ?>/test/<?php echo $currentMinor1; ?>.jpg" width="300" height="200">
              <div class="desc"><?php echo $currentMinor1; ?></div>
              <div class="gallery-dropdown-content">
              <table id="center_table">
                <tr id="center_table">
                  <?php
                  for($i=1;$i<=$totalItem;$i++){
                    echo "<th id=\"center_table\">Item$i</th>";
                  }
                  echo "<th id=\"center_table\">Total</th>";

                  ?>
                  </tr>
                  <tr id="center_table">
                  <?php
                  $contri = 0;
                  for($i=1;$i<=$totalItem;$i++){
                    $re = getNumOfItemByItemIDAndMemeberID($currentMinor1,$i);
                    echo "<td id=\"center_table\">$re</td>";
                    $price = getItemPriceByItemID($i);
                    $prop = getMinorOneprop($i);
                    $contri =$contri+$price *$re*$prop;
                  }
                  echo "<td id=\"center_table\">$contri</td>";
                  ?>

                </tr>
              </table>
            </div>  
          </div>
        </div>

        <p></p>
        <p></p>
        <p></p>

        <table id="center_line">
          <tr id="center_line">
            <th id="center_line"></th>
          </tr>
        </table>
        
        <p></p>
        <p></p>
        <p></p>

        <?php
            $subTeacherList = getBelowTeacherListFromName(getNameByMemberID($currentMinor1));
            $path =  get_template_directory_uri();
            for($x=0; $x<sizeof($subTeacherList);$x++){
              $subTeacherid =getMemberIDFromName($subTeacherList[$x]);
              $subpath = "\"".$path."/test/".$subTeacherid.".jpg\"";
              echo "<div class=\"center_minor\">
              <div class=\"gallery\">";
              echo"<img src=$subpath width=\"300\" height=\"200\">
              ";
              echo "<div class=\"desc\">$subTeacherid</div>";
              echo"<div class=\"gallery-dropdown-content\">
                   <table id=\"center_table\">
                    <tr id=\"center_table\">
              ";
              for($i=1;$i<=$totalItem;$i++)
              {
                echo"<th id=\"center_table\">Item$i</th>";
              }
              echo"<th id=\"center_table\">Total</th>;
              </tr>
                <tr id=\"center_table\">
                ";
                $contri = 0;
                for($i=1;$i<=$totalItem;$i++){
                  $re = getNumOfItemByItemIDAndMemeberID($subTeacherid,$i);
                  echo "<td id=\"center_table\">$re</td>";
                  $price = getItemPriceByItemID($i);
                  $prop = getMinorOneprop($i);
                  $contri =$contri+$price *$re*$prop;
                }
                echo "<td id=\"center_table\">$contri</td>";
                echo"</tr>
                </table>
                </div>
                </div>
                </div>
                ";
                
                }
        ?>
        
      </div>


      <div class="column_right">
        <table id="right_table">
          <tr id="right_table">
            <th id="right_table">Item</th>
            <th id="right_table">Item_No</th>
            <th id="right_table">Price</th>
          </tr>
      <?php
      for($i=1;$i<=$totalItem;$i++){
      $iName = getItemNameByItemID($i);
      $iPrice = getItemPriceByItemID($i);
      echo "
        <tr id=\"right_table\">
        <td id=\"right_table\">$iName</td>
        <td id=\"right_table\">$i</td>
        <td id=\"right_table\">$iPrice</td>
        </tr>
      ";
      }
      
      
      ?>

        </table>
      </div>
    </div>

  </body>
</html>

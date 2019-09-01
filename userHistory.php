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
    $logout = @$_GET['logout'];
    if ($logout == 1)
        $_SESSION['loggedin'] = 0;
    if ($_SESSION['loggedin'] != 1) {
        header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
        exit;
    }
    //$username = $_SESSION['username'];
    if (isset($_POST['startMonth'])) {
        getDatefromByMonth($_POST['startMonth']);
    } else {
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
            color: FF0000;
        }

        .heading4 {
            color: FF0000;
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

        .topWel button:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style the top navigation bar */
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a,
        .dropbtn {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover,
        .dropdown:hover .dropbtn {
            background-color: #ddd;
            color: black;
        }

        li.dropdown {
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Create three equal columns that floats next to each other */
        .column_left {
            float: left;
            width: 20%;
            padding: 15px;
        }

        .img_left {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 220px;
            height: 200px;
        }

        /* Create three equal columns that floats next to each other */
        .column_center {
            float: center;
            width: 80%;
            padding: 15px;
            padding-top: 40px;
            text-align: center"

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

        .left_img {
            text-align: center;
            margin-top: 50px;
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
            padding: 12px;
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: grey;
            color: white;
        }

        #Performance td {
            border: 1px solid #ddd;
            padding: 12px;
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

        #Major td {
            font-size: 20px;
            border: 1px solid #ddd;
            padding: 12px;
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

        #Minor1 td {
            font-size: 20px;
            border: 1px solid #ddd;
            padding: 12px;
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

        #Minor2 td {
            font-size: 20px;
            border: 1px solid #ddd;
            padding: 12px;
            padding-top: 16px;
            padding-bottom: 16px;
            text-align: center;
            background-color: white;
            color: black;
        }

        #right_table {
            margin-top: 20px;
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

        #right_table td {
            font-size: 15px;
            border: 1px solid #ddd;
            padding: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
            background-color: #cccccc;
            color: black;
        }

        table.one {
            table-layout: fixed;
            word-break: break-all;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?php echo get_template_directory_uri(); ?>/test/ArtCenterFederation.jpg">
    </div>

    <div class="topWel">
        <form action="#" method="get">
            <button name="logout" value=1>Logout</button>
        </form>
        <?php
        session_start();
        $userId = $_SESSION['username'];
        $name = getNameByMemberID($userId);
        echo "<p>Welcome back: $name</p>";
        ?>
    </div>

    <ul>
        <li class="dropdown">
            <?php
            session_start();
            $userId = $_SESSION['username'];
            $name = getNameByMemberID($userId);
            echo "<a class=\"dropbtn\" href=\"https://www.melodysac.com.sg/en/userhome/\" > $name</a>";
            ?>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/userinformation/">Information</a>
                <a href="https://www.melodysac.com.sg/en/userhistory/">History</a>
                <a href="http://www.melodysac.com.sg/index.php/en/update_information/">Setting</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn">About Us</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/yuanfen_memberbenifits/">Member Benefits</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn">YuanFen@ info</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/yuanfen_level/">YanFen@ Level</a>
                <a href="https://www.melodysac.com.sg/en/yuanfen_pointcollection/">Point Collection</a>
                <a href="https://www.melodysac.com.sg/en/yuanfen_pointredemption/">Point Redemption</a>
                <?php
                $contract = get_template_directory_uri() . "/MemberInfo/" . "/ContractPDF/" . $_SESSION['username'] . ".pdf";
                echo "<a href=\"$contract\" download=\"contract\">Member form download</a>";
                ?>
                <a href="http://www.melodysac.com.sg/index.php/en/terms/">Term and Condition</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="http://www.melodysac.com.sg/index.php/en/contact/">CONTACT US</a>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/en/yuanfen_melodysacproducts/">MelodySAC Products</a>
        </li>
    </ul>

    <div class="row">
        <div style="text-align:center">
            <?php
            session_start();
            $userId = $_SESSION['username'];
            $name = getNameByMemberID($userId);
            echo "<h3 class=\"heading3\">Hi, $name, Level YuanFen@ Member</h3>";
            ?>
        </div>


        <p></p>
        <p>Select Start Month</p>

        <table id="right_table">
            <tr id="right_table">
                <form action="#" method="post">
                    <select name="startMonth">
                        <?php
                        $y = date('Y');
                        $m = date('m');
                        for ($i = 0; $i < 24; $i++) {
                            if ($y == substr($dateFrom, 0, 4) && $m == substr($dateFrom, 5, 2)) {
                                echo "<option selected=\"selected\" value=\"$y$m\">$y/$m</option>";
                            } else {
                                echo "<option value=\"$y$m\">$y/$m</option>";
                            }
                            $m--;
                            if ($m == 0) {
                                $m = 12;
                                $y--;
                            }
                            if ($m < 10) $m = "0" . $m;
                        }
                        ?>
                    </select>
                    <input type="submit" value="Submit" />
                </form>
            </tr>
        </table>

        <div style="text-align:center">
            <br>
            <br>
            <h3 class="heading3">History </h3>

            <table id="Performance"  class="one">
                <tr id="Performance">
                <tr id="Performance">
                    <th id="Performance"  width="50%">Individual Points from Products Selling</th>
                    <td id="Performance"  width="50%"><?php echo getCreditEarnedWithoutRefSGByMemberID($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">Points as Melody's membership referral</th>
                    <td id="Performance"><?php echo getReferringCreditEarnedByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">Points from direct member</th>
                    <td id="Performance"><?php echo getAllCreditFromSubSGByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">Total Points</th>
                    <td id="Performance"><?php echo getAllCreditIncSubSGByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">Total Points redemption</th>
                    <td id="Performance"><?php echo getCreditChangeByMemberID($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">Balance</th>
                    <td id="Performance"><?php echo getBalanceSGByMemberId($userId); ?></td>
                </tr>
            </table>

            <br>
            <br>
            <h3 class="heading3">History Record </h3>

            <table id="Performance"  class="one">
                <tr id="Performance">
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
                        $balanceBroughtForward = getAllCreditIncSubSGByMemberIdANDDateTo($userId, $dateFrom);
                        echo $balanceBroughtForward;
                        ?>
                    </td>
                    <td id="Performance"><?php echo getCreditChangeByMemberIDANDDateFromANDDateTo($userId, "0000-00-00", $dateFrom); ?></td>
                    <td id="Performance"><?php echo (getAllCreditIncSubSGByMemberIdANDDateTo($userId, $dateFrom) + getCreditChangeByMemberIDANDDateFromANDDateTo($userId, "0000-00-00", $dateFrom)); ?></td>
                </tr>
                <?php
                $startYear = substr($dateFrom, 0, 4);
                $startMonth = substr($dateFrom, 5, 2);
                $currentYear = substr($dateTo, 0, 4);
                $currentMonth = substr($dateTo, 5, 2);
                $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
                $AllCreditTotalSum = getAllCreditIncSubSGByMemberId($userId) - getAllCreditIncSubSGByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01");
                $AllCreditChangeTotalSum = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01", $dateTo);
                while ($startYear < $currentYear || $startMonth <= $currentMonth) {

                    $AllCreditByMonth = getAllCreditIncSubSGByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", ($startMonth + 1)) . "-01") - getAllCreditIncSubSGByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01");
                    $AllCreditChangeByMonth = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01", $startYear . "-" . sprintf("%02d", ($startMonth + 1)) . "-01");
                    echo "<tr id=\"Performance\">";
                    echo "<th id=\"Performance\">" . $startYear . "-" . $months[intval($startMonth)] . "</th>";
                    echo "<td id=\"Performance\">" . $AllCreditByMonth . "</td>";
                    echo "<td id=\"Performance\">" . $AllCreditChangeByMonth . "</td>";
                    echo "<td id=\"Performance\">" . ($AllCreditByMonth + $AllCreditChangeByMonth) . "</td>";
                    echo "</tr>";
                    $startMonth++;
                    if ($startMonth > 12) {
                        $startYear++;
                        $startMonth = 01;
                    }
                }
                echo "<tr id=\"Performance\">";
                echo "<th id=\"Performance\">Total Sum</th>";
                echo "<td id=\"Performance\">" . $AllCreditTotalSum . "</td>";
                echo "<td id=\"Performance\">" . $AllCreditChangeTotalSum . "</td>";
                echo "<td id=\"Performance\">" . ($AllCreditTotalSum + $AllCreditChangeTotalSum) . "</td>";
                echo "</tr>";


                ?>

            </table>

            <br>
            <br>
        </div>
    </div>

</body>

</html>
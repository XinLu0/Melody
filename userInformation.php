<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /* 
  		Template Name: userInformation 
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
    if (isset($_POST['Month'])) {
        getDatefromToByMonth($_POST['Month']);
    } else {
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

        /* Style the top welcome bar */
        .topWel {
            overflow: hidden;
            background-color: #333;
        }

        /* Style the topWel links */
        .topWel p {
            float: center;
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

        table.one {
            table-layout: fixed;
            word-break: break-all;
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
        if (isset($_GET['userInfo'])) {
            $userId = $_GET['userInfo'];
        }
        $name = getNameByMemberID($userId);
        $hostName = getNameByMemberID($_SESSION['username']);
        echo "<p>Welcome back: $hostName</p>";
        ?>
    </div>

    <ul>
        <li class="dropdown">
            <?php
            echo "<a class=\"dropbtn\" href=\"https://www.melodysac.com.sg/en/userhome/\" > $hostName</a>";
            ?>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/userinformation/">Information</a>
                <a href="https://www.melodysac.com.sg/en/userhistory/">History</a>
                <a href="http://www.melodysac.com.sg/index.php/en/update_information/">Setting</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="">About Us</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/yuanfen_memberbenifits/">Member Benefits</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="">YuanFen@ info</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/en/yuanfen_level/">YanFen@ Level</a>
                <a href="https://www.melodysac.com.sg/en/yuanfen_pointcollection/">Point Collection</a>
                <a href="https://www.melodysac.com.sg/en/yuanfen_pointredemption/">Point Redemption</a>
                <?php
                $contract = get_template_directory_uri() . "/MemberInfo/" . "/ContractPDF/" . $_SESSION['username'] . ".pdf";
                echo "<a href=\"$contract\" download=\"contract\">Member form download</a>";
                ?>
                <a href="https://www.melodysac.com.sg/en/terms/">Term and Condition</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/en/user_contact_us/">CONTACT US</a>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/en/yuanfen_melodysacproducts/">MelodySAC Products</a>
        </li>
    </ul>

    <div class="row">
        <div style="text-align:center">
            <?php
            $name = getNameByMemberID($userId);
            $creditEarn = getAllCreditIncSubSGByMemberId($userId);
            $gradeName = getGradeNameSGByCredit($creditEarn);
            echo "<h3 class=\"heading3\">Hi,</h3>";
            echo "<h3 class=\"heading3\" style=\"color:dark grey;\">Here is the information for $name, $gradeName</h3>";
            ?>

            <br>
            <br>
            <h3 class="heading3">Points Collection details: </h3>

            <table id="Performance" class="one">
                <tr id="Performance">
                    <th id="Performance" width="8%">Date</th>
                    <th id="Performance" width="18%">Product/ Size/ Model</th>
                    <th id="Performance" width="5%">Quantity</th>
                    <th id="Performance" width="8%">Selling Price</th>
                    <th id="Performance" width="8%">Rental Price</th>
                    <th id="Performance" width="5%">Percentage %</th>
                    <th id="Performance" width="10%">Point Earn</th>
                </tr>
                <?php
                $performanceInfo = getAllPerformanceInfoSGByMemberID($userId);
                if (sizeof($performanceInfo) == 0)
                    echo "<tr id=\"Performance\"><td colspan=\"8\" id=\"Performance\">No Selling History</td></tr>";
                for ($i = 0; $i < sizeof($performanceInfo); $i++) {
                    echo "<tr id=\"Performance\">";
                    echo "<td id=\"Performance\">" . substr($performanceInfo[$i]->dDate, 0, 10) . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->Product_Or_Size_SG . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->qty . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->PricePerItem . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->RentPricePerItem . "</td>";
                    echo "<td id=\"Performance\">" . ($performanceInfo[$i]->props*100) . "%</td>";
                    echo "<td id=\"Performance\">" . ($performanceInfo[$i]->qty * $performanceInfo[$i]->PricePerItem * $performanceInfo[$i]->props + $performanceInfo[$i]->qty * $performanceInfo[$i]->RentPricePerItem * $performanceInfo[$i]->props) . "</td>";
                    echo "</tr>";
                }

                ?>

                <tr id="Performance">
                    <th id="Performance">Total</th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <?php
                    echo "<th id=\"Performance\">" . getCreditEarnedWithoutRefSGByMemberID($userId) . "</th>";
                    ?>
                </tr>
            </table>

            <br>
            <br>
            <h3 class="heading3">Points Collection as Referral for Melody's Membership: </h3>

            <table id="Performance" class="one">
                <tr id="Performance">
                    <th id="Performance" width="10%">Date</th>
                    <th id="Performance" width="40%">Name</th>
                    <th id="Performance" width="40%">Referral Name</th>
                    <th id="Performance" width="10%">Points Award</th>
                </tr>
                <?php
                $RefereeList = getRefereeListByMemberId($userId);
                if (sizeof($RefereeList) == 0)
                    echo "<tr id=\"Performance\"><td colspan=\"4\" id=\"Performance\">No Refer History</td></tr>";
                for ($x = 0; $x < sizeof($RefereeList); $x++) {
                    echo "<tr id=\"Performance\">";
                    echo "<td id=\"Performance\">" . substr($RefereeList[$x]->dDate, 0, 10) . "</td>";
                    echo "<td id=\"Performance\">" . $RefereeList[$x]->Referee . "</td>";
                    echo "<td id=\"Performance\">" . getNameByMemberID($userId) . "</td>";
                    echo "<td id=\"Performance\">" . $RefereeList[$x]->Credit . "</td>";
                    echo "</tr>";
                }
                ?>
                <tr id="Performance">
                    <th id="Performance">Total</th>
                    <th id="Performance"></th>
                    <th id="Performance"></th>
                    <?php
                    echo "<th id=\"Performance\">" . getReferringCreditEarnedByMemberId($userId) . "</th>";
                    ?>

                </tr>
            </table>

            <br>
            <br>
        </div>
    </div>

</body>

</html>

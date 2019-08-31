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
    $totalIncome = 0;
    function getPriceCNByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Price_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Price_CN;
    }
    function getPriceSGByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Price_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Price_SG;
    }
    ?>
    <?php
    session_start();

    function getTotalItemNumber()
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT * FROM Melody_items_New");
        return sizeof($sum);
    }

    function getMajorPropsCNByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_CN;
    }
    function getMinorPropsCNByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_CN FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_CN;
    }
    function getMajorPropsSGByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Major_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Major_Proportion_SG;
    }
    function getMinorPropsSGByItemNo($itemNo)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Minor_Proportion_SG FROM Melody_items_New WHERE Item_no=$itemNo");
        return $result[0]->Minor_Proportion_SG;
    }

    function getNameByMemberID($memberID)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
        return $result[0]->Name;
    }

    function getNumOfItemByItemIDAndMemeberID($memberID, $item_no)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no");


        if (sizeof($sum) == 0)
            return 0;
        else {
            $result;
            for ($x = 0; $x < sizeof($sum); $x++) {
                $result = $result + $sum[$x]->Number;
            }
            return $result;
        }
    }

    function getNumOfItemByItemIDAndMemeberIDAndDate($memberID, $item_no, $dateFrom)
    {
        global $wpdb;

        $sum = $wpdb->get_results("SELECT Number FROM Melody_performance WHERE Member =$memberID AND Item_no=$item_no AND dDate >=\" $dateFrom \"");

        if (sizeof($sum) == 0)
            return 0;
        else {
            $result;
            for ($x = 0; $x < sizeof($sum); $x++) {
                $result = $result + $sum[$x]->Number;
            }
            return $result;
        }
    }

    function getBelowTeacherListFromName($Name)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Major=\"" . $Name . "\"");

        $nameArray;
        $size = sizeof($result);
        for ($x = 0; $x < $size; $x++) {
            $nameArray[$x] = $result[$x]->Name;
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

    function getMemberIDFromName($Name)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Member FROM Teacher_infor WHERE Name=\"$Name\"");
        return $result[0]->Member;
    }

    function getItemNameByItemID($item_id)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT Item FROM Melody_items WHERE item_no=$item_id");
        return $sum[0]->Item;
    }

    function getDatefromToByMonth($yyyymm)
    {
        $month = substr($yyyymm, -2);
        $year = substr($yyyymm, 0, 4);
        $toyear = substr($yyyymm, 0, 4);
        $nextMonth = $month + 1;
        if ($nextMonth > 12) {
            $nextMonth = "01";
            $toyear++;
        } else if ($nextMonth < 10)
            $nextMonth = "0" . $nextMonth;
        global $dateFrom;
        $dateFrom = $year . "-" . $month . "-01";
        global $dateTo;
        $dateTo = $toyear . "-" . $nextMonth . "-01";
    }

    function getDatefromToByCurrent()
    {
        $currentDate = date('Y-m-d');
        $currentMonth = substr($currentDate, 5, 2);
        $nextMonth = $currentMonth + 1;
        $year = substr($currentDate, 0, 4);
        if ($nextMonth > 12) {
            $nextMonth = "01";
            $year++;
        } else if ($nextMonth < 10)
            $nextMonth = "0" . $nextMonth;
        global $dateFrom;
        global $dateTo;
        $dateFrom = substr($currentDate, 0, 7) . "-01";
        $dateTo = $year . "-" . $nextMonth . "-01";
    }
    function getIsInChinaByMemberId($memberId)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT isInChina FROM Teacher_infor WHERE Member=$memberId");
        return $result[0]->isInChina;
    }

    function getCreditChangeByMemberID($memberID)
    {
        global $wpdb;
        $sum = $wpdb->get_results("SELECT CreditChange FROM Melody_Admin_Actions WHERE Member = $memberID");
        if (sizeof($sum) == 0)
            return 0;
        else {
            $result = 0;
            for ($x = 0; $x < sizeof($sum); $x++) {
                $result = $result + $sum[$x]->CreditChange;
            }
            return $result;
        }
    }

    function getGradePropSGByCredit($credit)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Grade_Major_Prop_SG FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $results[sizeof($results) - 1]->Grade_Major_Prop_SG;
    }

    function getCreditEarnedByMemberID($memberID)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Number, PricePerItem FROM Melody_performance WHERE Member = $memberID ORDER BY dDate ASC");

        $sum = 0;
        $prop = getGradePropSGByCredit($sum);
        for ($x = 0; $x < sizeof($results); $x++) {
            $sum += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
            $prop = getGradePropSGByCredit($sum);
        }
        return $sum;
    }

    function getReferringCreditEarnedByMemberId($memberID)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Credit FROM Melody_Referring_Performance WHERE Member = $memberID");
        $sum = 0;
        for ($x = 0; $x < sizeof($results); $x++) {
            $sum += $results[$x]->Credit;
        }
        return $sum;
    }

    function getAllCreditByMemberId($memberID)
    {
        $belowTeacherList = getBelowTeacherListFromName(getNameByMemberID($memberID));
        $CreditEarnedBysubMember = 0;
        $ReferringCreditBySubMember = 0;
        for ($x = 0; $x < sizeof($belowTeacherList); $x++) {
            $subMemberID = getMemberIDFromName($belowTeacherList[$x]);
            $CreditEarnedBysubMember += getCreditEarnedByMemberID($subMemberID);
            $ReferringCreditBySubMember += getReferringCreditEarnedByMemberId($subMemberID);
        }
        $total = $CreditEarnedBysubMember + $ReferringCreditBySubMember;
        $total += getCreditEarnedByMemberID($memberID);
        $total += getReferringCreditEarnedByMemberId($memberID);
        return $total;
    }

    function getGradeNameSGByCredit($credit)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Grade_Name FROM Melody_Teacher_Grade WHERE Grade_Entry_Credit <= $credit");
        return $result[sizeof($result) - 1]->Grade_Name;
    }

    function getAllPerformanceInfoByMemberID($memberId)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Melody_performance.dDate, Melody_items_New.Product_Or_Size_SG, Melody_items_New.Model_SG, Melody_performance.Number, Melody_performance.PricePerItem, Melody_performance.RentPricePerItem, Melody_performance.props FROM Melody_performance INNER JOIN Melody_items_New ON Melody_items_New.Item_no=Melody_performance.Item_no WHERE Member = $memberId ORDER BY dDate");
        return $results;
    }

    function getCreditEarnedWithRefByMemberIDANDDateTo($memberID, $dateTo)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT *, IFNULL(Melody_performance.dDate,\"\") AS FinalDate
        FROM `Melody_performance`
        LEFT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        WHERE Melody_performance.Member = $memberID 
        HAVING FinalDate < \"$dateTo\"
        UNION
        SELECT *, IFNULL(Melody_Referring_Performance.dDate, \"\") AS FinalDate
        FROM `Melody_performance`
        RIGHT JOIN `Melody_Referring_Performance` ON Melody_performance.dDate = Melody_Referring_Performance.dDate
        WHERE Melody_Referring_Performance.Member = $memberID 
        HAVING FinalDate < \"$dateTo\"
        ORDER BY FinalDate ASC");

        $map = array();
        $prop = getGradePropSGByCredit(0);
        for ($x = 0; $x < sizeof($results); $x++) {
            if (!is_null($results[$x]->Item_no)) {
                //sell performance
                $sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
                $currentSum = 0;
                for ($y = 0; $y < sizeof($sublist); $y++) {
                    $subMemberId = getMemberIDFromName($sublist[$y]);
                    if (is_null($map[$subMemberId])) {
                        $map[$subMemberId] = 0;
                    }
                    $currentSum += $map[$subMemberId];
                }
                $currentSum += $map[$results[$x]->FinalMember];
                $prop = getGradePropSGByCredit($currentSum);
                $map[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
            } else {
                $map[$results[$x]->FinalMember] += $results[$x]->Credit;
            }
        }
        return $map[$memberID];
    }

    function getCreditEarnedWithoutRefByMemberID($memberID)
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
        $submap = array();
        $prop = getGradePropSGByCredit(0);
        for ($x = 0; $x < sizeof($results); $x++) {
            if (!is_null($results[$x]->Item_no)) {
                //sell performance
                $sublist = getBelowTeacherListFromName(getNameByMemberID($results[$x]->FinalMember));
                $currentSum = 0;
                for ($y = 0; $y < sizeof($sublist); $y++) {
                    $subMemberId = getMemberIDFromName($sublist[$y]);
                    if (is_null($map[$subMemberId])) {
                        $map[$subMemberId] = 0;
                    }
                    $currentSum += $map[$subMemberId];
                }
                $currentSum += $map[$results[$x]->FinalMember];
                $prop = getGradePropSGByCredit($currentSum);
                if ($results[$x]->props == 0) {
                    $wpdb->update(Melody_performance, array('props' => $prop), array('id' => $results[$x]->id));
                }
                $map[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
                $submap[$results[$x]->FinalMember] += $results[$x]->Number * $results[$x]->PricePerItem * $prop;
            } else {
                $map[$results[$x]->FinalMember] += $results[$x]->Credit;
            }
        }
        return $submap[$memberID];
    }

    function getRefereeListByMemberId($memberID)
    {
        global $wpdb;
        $results = $wpdb->get_results("SELECT Referee, dDate, Credit FROM Melody_Referring_Performance WHERE Member = $memberID");
        return $results;
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
            <a class="dropbtn">About Us</a>
            <div class="dropdown-content">
                <a href="#">Member Benefits</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn">YuanFen@ info</a>
            <div class="dropdown-content">
                <a href="#">YanFen@ Level</a>
                <a href="#">Point Collection</a>
                <a href="#">Point Redemption</a>
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
            <a class="dropbtn" href="#">MelodySAC Products</a>
        </li>
    </ul>

    <div class="row">
        <div style="text-align:center">
            <?php
            $name = getNameByMemberID($userId);
            $creditEarn = getAllCreditByMemberId($userId);
            $gradeName = getGradeNameSGByCredit($creditEarn);
            echo "<h3 class=\"heading3\">Hi, $hostName, $gradeName</h3>";
            echo "<h3 class=\"heading3\">Here is the information for your member $name </h3>";
            ?>

            <br>
            <br>
            <h3 class="heading3">Points Collection details: </h3>

            <table id="Performance" class="one">
                <tr id="Performance">
                    <th id="Performance" width="8%">Date</th>
                    <th id="Performance" width="18%">Product/Size</th>
                    <th id="Performance" width="18%">Model</th>
                    <th id="Performance" width="5%">Quantity</th>
                    <th id="Performance" width="8%">Selling Price</th>
                    <th id="Performance" width="8%">Rental Price</th>
                    <th id="Performance" width="5%">Percentage %</th>
                    <th id="Performance" width="10%">Point Earn</th>
                </tr>
                <?php
                $performanceInfo = getAllPerformanceInfoByMemberID($userId);
                for ($i = 0; $i < sizeof($performanceInfo); $i++) {
                    echo "<tr id=\"Performance\">";
                    echo "<td id=\"Performance\">" . substr($performanceInfo[$i]->dDate, 0, 10) . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->Product_Or_Size_SG . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->Model_SG . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->Number . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->PricePerItem . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->RentPricePerItem . "</td>";
                    echo "<td id=\"Performance\">" . $performanceInfo[$i]->props . "</td>";
                    echo "<td id=\"Performance\">" . ($performanceInfo[$i]->Number * $performanceInfo[$i]->PricePerItem * $performanceInfo[$i]->props + $performanceInfo[$i]->Number * $performanceInfo[$i]->RentPricePerItem * $performanceInfo[$i]->props) . "</td>";
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
                    echo "<th id=\"Performance\">" . getCreditEarnedWithoutRefByMemberID($userId) . "</th>";
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
                if(sizeof($RefereeList) == 0)
                    echo "<tr id=\"Performance\"><td colspan=\"4\" id=\"Performance\">No Refer history</td></tr>";
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
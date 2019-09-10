<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /* 
      Template Name: userHistory_CN
       
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
        <img src="<?php echo get_template_directory_uri(); ?>/test/manlianlogo2.png" width="161" height="137">
    </div>

    <div class="topWel">
        <form action="#" method="get">
            <button name="logout" value=1>登出</button>
        </form>
        <?php
        session_start();
        $userId = $_SESSION['username'];
        kickOutSGUserbyMemberId($userId);
        $name = getNameByMemberID($userId);
        echo "<p>欢迎: $name</p>";
        ?>
    </div>

    <ul>
        <li class="dropdown">
            <?php
            echo "<a class=\"dropbtn\" href=\"https://www.melodysac.com.sg/zh/userhome_cn/\" > $name</a>";
            ?>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/zh/userinformation_cn/">个人详情</a>
                <a href="https://www.melodysac.com.sg/zh/userhistory_cn/">历史记录</a>
                <a href="https://www.melodysac.com.sg/zh/updateinfo_cn/">设置</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/manlian_about_us_cn/">关于我们</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/zh/yuanfen_memberbenifits_cn/">会员福利</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/manlian_info_cn/">蔓联会员说明</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/zh/yuanfen_level_cn/">会员级别</a>
                <a href="https://www.melodysac.com.sg/zh/yuanfen_pointcollection_cn/">会员积分</a>
                <a href="https://www.melodysac.com.sg/zh/yuanfen_pointredemption_cn/">积分兑换</a>
                <?php
                $contract = get_template_directory_uri() . "/MemberInfo/" . "/ContractPDF/" . $_SESSION['username'] . ".pdf";
                echo "<a href=\"$contract\" download=\"contract\">会员表格下载</a>";
                ?>
                <a href="https://www.melodysac.com.sg/zh/yuanfen_terms_cn/">条件与条款</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/yuanfen_contactus_cn/">联系我们</a>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/yuanfen_melodysacproducts_cn/">价格表</a>
        </li>
    </ul>

    <div class="row">
        <div style="text-align:center">
            <?php
            session_start();
            $userId = $_SESSION['username'];
            $name = getNameByMemberID($userId);
            $creditEarn = getAllCreditIncSubCNByMemberId($userId);
            $gradeName = getGradeNameCNByCredit($creditEarn);
            echo "<h3 class=\"heading3\">您好,</h3>";
            echo "<br>";
            echo "<h3 class=\"heading3\" style=\"color:dark grey;\">$name,  $gradeName 的历史记录</h3>";
            ?>
        </div>


        <p></p>
        <p>选择起始查询月份</p>

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
                    <input type="submit" value="确认" />
                </form>
            </tr>
        </table>

        <div style="text-align:center">

            <table id="Performance" class="one">
                <tr id="Performance">
                    <th id="Performance" width="50%">个人销售积分</th>
                    <td id="Performance" width="50%"><?php echo getCreditEarnedWithoutRefCNByMemberID($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">蔓菻德思公众号会员推荐积分</th>
                    <td id="Performance"><?php echo getReferringCreditEarnedByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">直属会员积分(包括销售&推荐会员)</th>
                    <td id="Performance"><?php echo getAllCreditFromSubCNByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">总积分</th>
                    <td id="Performance"><?php echo getAllCreditIncSubCNByMemberId($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">所兑现积分</th>
                    <td id="Performance"><?php echo getCreditChangeByMemberID($userId); ?></td>
                </tr>
                <tr id="Performance">
                    <th id="Performance">积分余额</th>
                    <td id="Performance"><?php echo getBalanceCNByMemberId($userId); ?></td>
                </tr>
            </table>

            <br>
            <br>
            <h3 class="heading3">历史记录</h3>

            <table id="Performance" class="one">
                <tr id="Performance">
                <tr id="Performance">
                    <th id="Performance">月份</th>
                    <th id="Performance">总积分数额</th>
                    <th id="Performance">已兑换的总积分</th>
                    <th id="Performance">现积分余额</th>
                </tr>
                <tr id="Performance">
                    <th id="Performance">上期积分余额</th>
                    <th id="Performance">
                        <?php
                        $balanceBroughtForward = 0;
                        $balanceBroughtForward = getAllCreditIncSubCNByMemberIdANDDateTo($userId, $dateFrom);
                        echo $balanceBroughtForward;
                        ?>
                    </th>
                    <th id="Performance"><?php 
                    $CreditChangeBroughtForward = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, "0000-00-00", $dateFrom);
                    echo $CreditChangeBroughtForward; ?></td>
                    <th id="Performance"><?php echo $balanceBroughtForward + $CreditChangeBroughtForward; ?></td>
                </tr>
                <?php
                $startYear = substr($dateFrom, 0, 4);
                $startMonth = substr($dateFrom, 5, 2);
                $currentYear = substr($dateTo, 0, 4);
                $currentMonth = substr($dateTo, 5, 2);
                $months = array(1 => '一月', 2 => '二月', 3 => '三月', 4 => '四月', 5 => '五月', 6 => '六月', 7 => '七月', 8 => '八月', 9 => '九月', 10 => '十月', 11 => '十一月', 12 => '十二月');
                $AllCreditTotalSum = getAllCreditIncSubCNByMemberId($userId) - getAllCreditIncSubCNByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01");
                $AllCreditChangeTotalSum = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01", $dateTo);
                $AccumulativeCreditSum = $balanceBroughtForward;
                $AccumulativeCreditChange = $CreditChangeBroughtForward;
                while ($startYear < $currentYear || $startMonth <= $currentMonth) {

                    $AllCreditByMonth = getAllCreditIncSubCNByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", ($startMonth + 1)) . "-01") - getAllCreditIncSubCNByMemberIdANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01");
                    $AllCreditChangeByMonth = getCreditChangeByMemberIDANDDateFromANDDateTo($userId, $startYear . "-" . sprintf("%02d", $startMonth) . "-01", $startYear . "-" . sprintf("%02d", ($startMonth + 1)) . "-01");
                    $AccumulativeCreditSum += $AllCreditByMonth;
                    $AccumulativeCreditChange += $AllCreditChangeByMonth;

                    echo "<tr id=\"Performance\">";
                    echo "<th id=\"Performance\">" . $startYear . "-" . $months[intval($startMonth)] . "</th>";
                    echo "<td id=\"Performance\">" . $AllCreditByMonth . "</td>";
                    echo "<td id=\"Performance\">" . $AllCreditChangeByMonth . "</td>";
                    echo "<td id=\"Performance\">" . ($AccumulativeCreditSum + $AccumulativeCreditChange) . "</td>";
                    echo "</tr>";
                    $startMonth++;
                    if ($startMonth > 12) {
                        $startYear++;
                        $startMonth = 01;
                    }
                }
                echo "<tr id=\"Performance\">";
                echo "<th id=\"Performance\">总计</th>";
                echo "<th id=\"Performance\">" . ($AllCreditTotalSum + $balanceBroughtForward) . "</th>";
                echo "<th id=\"Performance\">" . ($AllCreditChangeTotalSum + $CreditChangeBroughtForward). "</th>";
                echo "<th id=\"Performance\">" . ($AllCreditTotalSum + $balanceBroughtForward + $AllCreditChangeTotalSum + $CreditChangeBroughtForward) . "</th>";
                echo "</tr>";


                ?>

            </table>

            <br>
            <br>
        </div>
    </div>

</body>

</html>
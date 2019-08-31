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
            border: 2px;
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

        .img_left {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            width: 220px;
            height: 200px;
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
            $img = get_template_directory_uri() . "/MemberInfo/ProfileImgJPG/" . $_SESSION['username'] . ".jpg";
            $relativeImg = "wp-content/themes/top3themes/MemberInfo/ProfileImgJPG/" . $_SESSION['username'] . ".jpg";
            $defaultImg = get_template_directory_uri() . "/MemberInfo/ProfileImgJPG/default.jpg";
            if (file_exists($relativeImg)) {
                echo "<img class=\"img_left\" src=\"$img\">";
            } else echo "<img class=\"img_left\" src=\"$defaultImg\">";
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
                for ($x = 0; $x < sizeof($belowList); $x++) {
                    // name of sub teacher
                    echo "<tr id=\"Performance\">";
                    echo "<td id=\"Performance\">";
                    echo "<form action=\"http://www.melodysac.com.sg/index.php/en/userinformation/\" method=\"get\">";
                    echo "<button name=\"userInfo\" value = " . getMemberIDFromName($belowList[$x]) . "> ";
                    echo "<div style=\"height:100%;width:100%\">";
                    echo ($x + 1) . ".";
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
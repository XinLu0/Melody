<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /* 
  		Template Name: Contact_Us_CN
  		*/
    session_start();
    require('utils.php');

    $logout = @$_GET['logout'];
    if ($logout == 1)
        $_SESSION['loggedin'] = 0;
    if ($_SESSION['loggedin'] != 1) {
        header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
        exit;
    }
    $mid = $_SESSION['username'];
    if (isset($_POST["Message"])) {
        if (!isset($_POST["Number"]) || !isset($_POST["Email"])) {
            alertWithHistoryBack("Please fill all information");
        }
        //$to = get_option('admin_email');
        $to = array("admin@melodysac.com.sg");
        $subject = "User Request:";
        $message = $_POST["Message"] . " \n\r From: " . $_POST["Number"] . "\n\r Contact number:" . $_POST["Email"] . " \n\r UserName :" . getNameByMemberID($mid) . " UserId :" . $mid;

        sendEmail($subject . " " . $_POST["Subject"], $to, strip_tags($message), False);

        alert("Sent Successfully. We will get back to you soon");
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

        .update {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            max-width: 550px;
            margin: auto;
            border: 1px solid gray;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #A6502D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #8C2A05;
        }


        textarea {
            width: 100%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?php echo get_template_directory_uri(); ?>/test/ArtCenterFederation.jpg">
    </div>

    <div class="topWel">
        <form action="#" method="get">
            <button name="logout" value=1>登出</button>
        </form>
        <?php
        session_start();
        $userId = $_SESSION['username'];
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
            <a class="dropbtn" href="">关于我们</a>
            <div class="dropdown-content">
                <a href="https://www.melodysac.com.sg/zh/yuanfen_memberbenifits_cn/">会员福利</a>
            </div>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="">蔓联会员说明</a>
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
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/yuanfen_contactus_cn/">联系方式</a>
        </li>
        <li class="dropdown">
            <a class="dropbtn" href="https://www.melodysac.com.sg/zh/yuanfen_melodysacproducts_cn/">价格表</a>
        </li>
    </ul>

    <h3>请留下您的信息</h3>
    <br>
    <br>
    <br>
    <div class="update">
        <form action="#" name="send_email" method="post">
            <label for="Email">电子邮箱</label>
            <input type="text" id="Email" name="Email"></text>

            <label for="Number">联系方式</label>
            <input type="text" id="Number" name="Number"></text>

            <label for="Subject">主题</label>
            <input type="text" id="Subject" name="Subject"></text>

            <label for="Message">内容</label>
            <textarea id="Message" name="Message"></textarea>

            <input type="submit" value="提交">
        </form>
    </div>
</body>

</html>
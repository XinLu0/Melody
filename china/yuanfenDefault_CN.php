<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /*
* Template Name: yuanfenDefaultCN
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
    ?>
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

    <div id="container">
        <div id="content" class="pageContent">

            <?php
            // TO SHOW THE PAGE CONTENTS
            while (have_posts()) : the_post(); ?>
                <!--Because the_content() works only inside a WP Loop -->
                <div class="entry-content-page">
                    <?php the_content(); ?>
                    <!-- Page Content -->
                </div><!-- .entry-content-page -->

            <?php
            endwhile; //resetting the page loop
            wp_reset_query(); //resetting the page query
            ?>
        </div><!-- #content -->
    </div><!-- #container -->
</body>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /* 
  		Template Name: yuanfen_contactUs
  		*/
    session_start();


    $logout = @$_GET['logout'];
    if ($logout == 1)
        $_SESSION['loggedin'] = 0;
    if ($_SESSION['loggedin'] != 1) {
        header("Location:http://www.melodysac.com.sg/index.php/zh/melodymemberlogin/");
        exit;
    }
    $mid = $_SESSION['username'];

    function getNameByMemberID($memberID)
    {
        global $wpdb;
        $result = $wpdb->get_results("SELECT Name FROM Teacher_infor WHERE Member=$memberID");
        return $result[0]->Name;
    }
    
    function updateEmailByMID($Mid, $email)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE `Teacher_infor` SET Email=\"$email\" WHERE Member = $Mid"));
    }
    function updatePasswordByMID($Mid, $password)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE `Teacher_infor` SET Password=\"$password\" WHERE Member = $Mid"));
    }
    function updateContactNoByMID($Mid, $Contact_no)
    {
        global $wpdb;
        $wpdb->query($wpdb->prepare("UPDATE `Teacher_infor` SET Contact_no=\"$Contact_no\" WHERE Member = $Mid"));
    }
    function alert($msg)
    {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    if (isset($_POST["Number"])) {
        if ($_POST["Number"] != "") {
            updateContactNoByMID($mid, $_POST["Number"]);
            alert("Successful!");
        }
        if ($_POST["NewPassword1"] != "") {

            if ($_POST["NewPassword1"] != $_POST["NewPassword2"]) {
                alert("Passwords don\'t match");
            } else {
                updatePasswordByMID($mid, $_POST["NewPassword1"]);
                alert("Successful!");
            }
        }
        if ($_POST["Email"] != "") {
            updateEmailByMID($mid, $_POST["Email"]);
            alert("Successful!");
        }
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

    <br>
    <br>
    <br>
    <div class="update">
        <h2>Update Your Profile</h2>
        <form action="#" name="update_profile" method="post">
            <p>
                <label for="Number">Contact Number</label>
                <input type="text" id="Number" name="Number">
            </p>
            <p>
                <label for="Email">Email</label>
                <input type="text" id="Email" name="Email">
            </p>
            <p>
                <label for="NPassword1">New Password</label>
                <input type="text" id="NPassword1" name="NewPassword1">
            </p>
            <p>

                <label for="NPassword2">Confirm New password</label>
                <input type="text" id="NPassword2" name="NewPassword2">

            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>
    </div>
</body>

</html>
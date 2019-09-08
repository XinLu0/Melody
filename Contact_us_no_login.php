<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /* 
  		Template Name: Contact_Us_NoLogin
  		*/
    session_start();
    require('utils.php');

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

        /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: #333;
            width: 100%;
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
        <img src="<?php echo get_template_directory_uri(); ?>/test/manlianlogo2.png" width="161" height="137">
    </div>

    <div class="topnav">
        <a href="https://www.melodysac.com.sg/zh/melodymemberlogin/">Login</a>
        <a href="https://www.melodysac.com.sg/en/yuanfen_contactus_nologin/">Contact Us</a>
    </div>

    <h3>Please Leave Your Message To Us</h3>
    <br>
    <br>
    <br>
    <div class="update">
        <form action="#" name="send_email" method="post">
            <label for="Email">Email</label>
            <input type="text" id="Email" name="Email"></text>

            <label for="Number">Contact Number</label>
            <input type="text" id="Number" name="Number"></text>

            <label for="Subject">Subject</label>
            <input type="text" id="Subject" name="Subject"></text>

            <label for="Message">Message</label>
            <textarea id="Message" name="Message"></textarea>

            <input type="submit" value="Send">
        </form>
    </div>
</body>

</html>
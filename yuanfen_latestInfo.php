<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /*
* Template Name: yuanfen_latestInfo
*/
    session_start();
    require('utils.php');
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
    </style>
</head>

<body>
    <div class="header">
        <img src="<?php echo get_template_directory_uri(); ?>/test/ArtCenterFederation.jpg">
    </div>

    <div class="topnav">
        <a href="https://www.melodysac.com.sg/zh/melodymemberlogin/">Login</a>
        <a href="https://www.melodysac.com.sg/en/yuanfen_contactus_nologin/">Contact Us</a>
    </div>

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
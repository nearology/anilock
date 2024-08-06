<!DOCTYPE html>
<!--
Item Name: SeenBoard - Web App & Admin Dashboard Template
Version: 1.0
Author: Mt.rezaei
-->
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AniLock - @yield("title")</title>
        <meta name="description" content="AniLock">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Iran licence -->
        <link rel="stylesheet" href="assets/css/fontiran.css">
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="/assets/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/vendors/css/base/seenboard-1.0.css">
        @yield("stylesheets")
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body class="@yield("body-class")">
        <!-- Begin Container -->
        @yield("container")
        <!-- End Container -->
        <!-- Begin Vendor Js -->
        <script src="/assets/vendors/js/base/jquery.min.js"></script>
        <script src="/assets/vendors/js/base/core.min.js"></script>
        <!-- End Vendor Js -->
        <!-- Begin Page Vendor Js -->
        <script src="/assets/vendors/js/app/app.min.js?2"></script>
        <!-- End Page Vendor Js -->
        <!-- Begin Page Snippets -->
        @yield("snippets")
        <!-- End Page Snippets -->
    </body>
</html>

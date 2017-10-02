<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title></title>

    <link rel="shortcut icon" href="/favicon.ico">

    <link type="text/css" rel="stylesheet" href="/style/normalize.css">
    <link type="text/css" rel="stylesheet" href="/style/style.css">

    <!-- HTML5 -->
    <script type="text/javascript">
		['header', 'nav', 'section', 'article', 'aside', 'footer', 'time', 'comment']
		.forEach(function( value, key ){ document.createElement(value); });
    </script>

    <?php if(file_exists('jscripts/'.$template.'.js')): ?>
        <script type="text/javascript" src="/jscripts/modules.js"></script>
        <script type="text/javascript" src="/jscripts/core.js"></script>

        <script type="text/javascript" src="/jscripts/<?php echo $template; ?>.js"></script>
    <?php endif; ?>

</head>
<body>

<div id="page" class="page-<?php echo $template; ?>">


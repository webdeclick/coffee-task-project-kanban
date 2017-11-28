<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CoffeeTask ☕<?php echo (!empty($title)?' - '.$title:''); ?></title>

    <link rel="shortcut icon" href="/favicon.ico">

    <link type="text/css" rel="stylesheet" href="/style/normalize.css">
    <link type="text/css" rel="stylesheet" href="/style/style.css">
    <link type="text/css" rel="stylesheet" href="/style/responsive.css">

    <!-- HTML5 -->
    <script type="text/javascript">
        ['header', 'nav', 'section', 'article', 'aside', 'footer', 'time', 'comment']
        .forEach(function( value, key ){ document.createElement(value); });
    </script>

    <?php if(file_exists('jscripts/'.$template.'.js')): ?>

        <?php if( $isLogged ): ?>

            <script type="text/javascript">
                var user = {
                    id: '<?php echo $userId; ?>'
                };
            </script>

        <?php endif; ?>

        <?php if($template=='dashboard'): ?>

            <script type="text/javascript">
                var dashboard = {
                    projectId: '<?php echo $projectId; ?>',
                    is_admin: <?php echo $is_admin ?'true':'false'; ?>,
                    is_manager: <?php echo $is_manager ?'true':'false'; ?>,
                }
            </script>

            <!--3rd party scripts -->
            <script type="text/javascript" src="/jscripts/3rdparty/moment/min/moment.min.js"></script>

            <link type="text/css" rel="stylesheet" href="/jscripts/3rdparty/rome/dist/rome.css">
            <script type="text/javascript" src="/jscripts/3rdparty/rome/dist/rome.standalone.min.js"></script>

        <?php endif; ?>

        <script type="text/javascript" src="/jscripts/modules.js"></script>
        <script type="text/javascript" src="/jscripts/core.js"></script>

        <script type="text/javascript" src="/jscripts/<?php echo $template; ?>.js"></script>
    <?php endif; ?>

</head>
<body>

<div id="page" class="page-<?php echo $template; ?>">


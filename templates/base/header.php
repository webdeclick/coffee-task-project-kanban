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

        <?php if(in_array($template, ['dashboard','photos-folder'])): ?>

            <script type="text/javascript">
                var dashboard = {
                    projectId: '<?php echo $projectId; ?>',
                    is_admin: <?php echo $is_admin ?'true':'false'; ?>,
                    is_manager: <?php echo $is_manager ?'true':'false'; ?>,
                }
            </script>

        <?php endif; ?>

        <?php if($template=='dashboard'): ?>
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


<!-- menu -->

<nav id="menu">

    <input id="nav-trigger" type="checkbox">

    <nav id="hamburger">
        <label for="nav-trigger"></label>

        <span>
            <a id="hamburger-logo" href="/">home</a>
        </span>

    </nav>

    <nav id="nav">

        <?php if( $isLogged ): ?>

            <div class="menu-welcome">
                Bonjour <?php echo $user->fullname; ?> !
            </div>

            <div class="menu-logout">
                <a href="/logout">Déconnexion</a>
            </div>

            <div class="menu-action menu-dashboard">
                <div class="icon"></div>
                <div>Tableau De Bord</div>
            </div>

            <div class="menu-action menu-projects">
                <div class="icon"></div>
                <div>
                    Mes Projets

                    <div class="expander">
                        <?php if(!empty($projects)): foreach($projects as $project): ?>
                            <div>
                                <a href="/dashboard/<?php echo $project['project_id']; ?>"><?php echo $project['title']; ?></a>
                            </div>
                        <?php endforeach; endif; ?>
                    </div>

                </div>
            </div>

        <?php else: ?>

            <a href="/login">Login</a>


        <?php endif; ?>

        <div class="menu-mentions">
            <a href="/mentions">Mentions légales</a> - <a href="/contact">Contact</a>
        </div>

        



    </nav>

</nav>


<!-- page content -->

<div id="page" class="page-<?php echo $template; ?>">
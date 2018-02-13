<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style>
    body {
        background-color: #eaeaea;
        font-family: sans-serif;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
    }
    table {
        border-collapse: separate;
        width: 100%;
    }
    .wrapper {
        background-color: #fff;
        margin-bottom: 15px;
        background-color: #fff;
        padding: 10px;
    }
    .wrapper-inner {
        padding-left: 15px;
    }

    .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px;
    }

    .main {
        width: 100%;
    }

    .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%;
    }
    .footer td,
    .footer p,
    .footer span,
    .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
    }
    .btn {
        background-color: #89C13E;
        border: solid 1px #89C13E;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        padding: 12px 25px;
        text-decoration: none;
    }

    .category-header {
        background-color: #89C13E;
        color: #fff;
        font-size: 16px;
        padding: 6px;
        margin-bottom: 15px;
        text-align: center;
    }
    .component-task {
        padding: 10px;
        box-shadow: 0 0 3px rgba(0,0,0,0.3);
        margin-bottom: 15px;
        background-color: #fff;
    }
    .component-task-inner {
        border-left: 3px solid #89C13E;
        padding-left: 10px;
    }
    .task-title {
        font-size: 15px;
        padding-bottom: 5px;
        border-bottom: 1px solid #cacaca;
    }
    .task-description {
        color: #7d7d7d;
        font-size: 14px;
        margin: 5px 0;
    }
    </style>
</head>

<body>
    <table bgcolor="#eaeaea" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">

                    <table class="main">

                        <tr>
                            <td class="wrapper">
                                
                                <div style="text-align: center">
                                    <img src="<?php echo $logo_blob; ?>" />
                                </div>

                                <p>Cette tâche vient d'être complétée aujourdhui!</p>
                            </td>
                        </tr>

                        <tr>
                            <td height="10"></td>
                        </tr>

                        <tr>
                            <td>

                                <div class="category-header">
                                    <div class="category-title">
                                        <?php echo $category->title; ?>
                                    </div>
                                </div>

                                <div class="component-task">
                                    <div class="component-task-inner">
                                        <div class="task-title">
                                            <?php echo $task->title; ?>
                                        </div>

                                        <div class="task-description">
                                            <?php echo $task->description; ?>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>

                    </table>

                    <div class="footer">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    CoffeeTask
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>


</body>
</html>

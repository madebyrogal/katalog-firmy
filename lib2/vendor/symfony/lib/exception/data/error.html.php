<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="title" content="StgCMS" />
        <title>StgCMS</title>
        <link rel="shortcut icon" href="/favicon.ico" />

        <script type="text/javascript" src="/sfAdminDashPlugin/js/jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="/sfAdminDashPlugin/js/sf_admin_dash.js"></script>
        <script type="text/javascript" src="/backend/themes/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/backend/themes/js/jquery.treeTable.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="/sfAdminDashPlugin/css/default.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="/backend/themes/css/main.css" />
    </head>
    <body>
        
        <div style="text-align: center; line-height: 22px;">
            <!--<img alt="Logo" src="/backend/brands/sell4cms/images/header_text.png" style="margin-top:6em;" />-->
            <h1>Przepraszamy, wystąpił błąd:</h1>
            <h4>"<?php echo $code ?> <?php echo $text ?>"</h4>
            <br />
            <p>
                Skontaktuj się z administratorem:<br /><br />
                <a href="mailto:admin@allf.pl">admin@allf.pl</a>
            </p>
                  
            <a href="javascript:history.go(-1)">Przejdź do strony poprzedniej</a><br />
            <a href="/">Przejdź do strony głównej</a>
                     
            <br />
            <br />
                
            Firmy © <?= date('Y')?> All rights reserved.
        </div>
    </body>
</html>


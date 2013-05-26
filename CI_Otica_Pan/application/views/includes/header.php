<html>
    <head><title><?php echo $titulo; ?></title>
        <link href="../../../../../../../../../CI_otica_pan/favicon.ico" rel="shortcut icon" type="image/ico" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/css/menu.css">
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/css/estilo.css">
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/css/calendario.css">
        <link rel="stylesheet" href="../../../../../../../../../CI_otica_pan/public/css/tabela.css">
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/util.js"></script> 
        <script type="text/javascript" src="../../../../../../../../../CI_otica_pan/public/js/produto.js"></script> 

        <style type="text/css">

        </style>



    </head>
    <body>
        <header>
            <nav>
                <div id="logo"><img src="../../../../../../../../../CI_otica_pan/public/img/logo.png" width="190" height="50"></div>
                <div class="headerInfo">

                    <?
                    echo "<p>";
                    echo 'Data: ' . date('d') . '/' . date('m') . '/' . date('Y');
                    echo "</p>";
                    echo"<br>";
                    echo "<p>";
                    echo 'Usuário: ' . $this->session->userdata('login').' (' . anchor('login/logoff', 'sair') . ')';
                    echo "</p>";
                    ?>
                </div>

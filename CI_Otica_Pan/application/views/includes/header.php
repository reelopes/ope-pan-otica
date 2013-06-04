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
                    echo 'Data: ' . date('d') . '/' . date('m') . '/' . date('Y').'&nbsp; &nbsp; (' . anchor('login/logoff', 'sair') . ')';
                    echo "</p>";
                    echo"<br>";
                    echo '<p>'; // <span id="name_user"> </span>
                    echo 'Usuário: ' . $this->session->userdata('nome').' &nbsp; '."<a href=\"javascript:abrirPopUp('" . base_url('usuario/update/'.$this->session->userdata('id')) . "','706','370');\"> <img src='".base_url('public/img/config.png')."' width='20' style='vertical-align: middle;' title='Alterar dados Pessoais' /></a>";
//                    .anchor("usuario/update/".$this->session->userdata('id')."/", '<img src="'.base_url('public/img/config.png').'" width="20" title="Configuração"/>')
                    echo "</p>";
                    ?>
                </div>

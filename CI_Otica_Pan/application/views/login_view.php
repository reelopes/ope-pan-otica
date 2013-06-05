<head>
  <link href="../../CI_otica_pan/favicon.ico" rel="shortcut icon" type="image/ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SisGO - Login</title>
  <link rel="stylesheet" href="../../CI_otica_pan/public/css/login.css">
</head>
<body>

        
  <section class="container">
    <div class="login">
      <h1>SisGO</h1>
      <form method="post" action="<? echo base_url('login'); ?>">
          <p><input type="text" name="usuario" value="" autocomplete="off" placeholder="Usuário" autofocus required title="O campo usuário é obrigatório"></p>
        <p><input type="password" name="senha" value="" autocomplete="off" placeholder="Senha" required title="O campo senha é obrigatório"></p>
        <p class="remember_me"><img src="..\..\..\../CI_Otica_Pan/public/img/Oculos.png" width="63" height="63" >

        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
      <?
      echo"<div class='erroLogin'>";
      echo validation_errors('<p>','</p>');
      if($this->session->flashdata('erroLogin')){
      echo '<p>'.$this->session->flashdata('erroLogin').'</p>';
      }
    echo"</div>";
            ?>
    </div>
    <div class="login-help">
<?
$atts = array(
              'width'      => '500',
              'height'     => '300',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo "<p>Esqueceu a sua senha? ".anchor_popup('login/esqueciSenha', 'Clique aqui.', $atts)."</p>";
?>
    </div>
  </section>
</body>
</html>

        
        

<head>
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
        <p><input type="text" name="usuario" value="" placeholder="Usuário" autofocus></p>
        <p><input type="password" name="senha" value="" placeholder="Senha"></p>
        <p class="remember_me"><img src="..\..\..\../CI_Otica_Pan/public/img/Oculos.png" width="63" height="63">

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
      <p>Esqueceu a sua senha? <a href="index.html">Clique aqui.</a></p>
    </div>
  </section>
</body>
</html>

        
        

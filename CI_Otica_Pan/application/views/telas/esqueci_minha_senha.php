<head>
  <link href="../../CI_otica_pan/favicon.ico" rel="shortcut icon" type="image/ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SisGO - Esqueci minha senha</title>
  <link rel="stylesheet" href="../../CI_otica_pan/public/css/login.css">
</head>
<body>

        
  <section class="container">
    <div class="login">
      <h1>Qual é a minha senha?</h1>
      <form method="post" action="<? echo base_url('login/esqueciSenha'); ?>">
          <p><input type="text" name="usuario" value="" autocomplete="off" placeholder="Qual o Usuário?" autofocus required title="O campo usuário é obrigatório"></p>
          <p><input type="text" name="lembrete" value="<?if ($this->input->post('usuario') != null) {echo $this->login_model->esqueceuSenha($this->input->post('usuario'));}?>" readonly autocomplete="off" placeholder="Lembrete de senha"></p>
        <p class="remember_me"><img src="..\..\..\../CI_Otica_Pan/public/img/Oculos.png" width="63" height="63" >

        <table>
            <tr><td>
                <p class="submit"><input type="submit" name="commit" value="Exibir lembrete"></p>
            </td><td>
                <a href="login">Voltar</a>
            </td>
        </table>
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
  </section>
</body>
</html>


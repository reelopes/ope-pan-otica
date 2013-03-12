
<!DOCTYPE html>
<html>
    <head>
        <title>Ótica Pan</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        
           <?php echo validation_errors(); 
            echo form_open();
            echo"<br><br><br><br><center><table><tr><td>";//Essa linha pode remover
            echo form_label('Usuário', 'usuario');
            echo"</td><td>"; //Essa linha pode remover
            echo form_input('usuario', '');
            echo"</td></tr><tr><td>";//Essa linha pode remover
            echo form_label('Senha', 'senha');
            echo"</td><td>";//Essa linha pode remover
            echo  form_password('senha', '');   
            echo"</td></tr><tr><td></td><td>";//Essa linha pode remover
            echo form_submit('submit', 'Entrar no sistema');
            echo"</td></tr></table></center>";//Essa linha pode remover
            form_close(); 
            
            if($this->session->flashdata('erroLogin')){
            echo"<center>";//Essa linha pode remover
            echo '<p>'.$this->session->flashdata('erroLogin').'</p>';
            echo"</center>";//Essa linha pode remover
            
            
}   
          
            ?>
    </body>
</html>

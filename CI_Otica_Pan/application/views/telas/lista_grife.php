<?php
echo "<h2>$titulo</h2>";

echo $this->session->flashdata('msg');

echo form_open('grife/pesquisa');
echo form_label('Pesquisa Grife:');
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus');
echo form_submit('', 'Procurar');
echo form_close();

$grife = $grife;//Pega a variavel da Controller (boa pratica)

if($grife==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{
    echo"<br><center><table>";//Essa linha pode remover
    if ($grife != NULL) {
        $this -> table -> set_heading('NOME');
        foreach ($grife as $linha) {

            $this -> table -> add_row($linha -> nome, anchor("grife/update/$linha->id",'Editar').'
                  |  '.anchor("grife/delete/$linha->id",'Excluir'));
        }
        $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">' );
        $this->table->set_template($tmpl);
        echo $this -> table -> generate();
    }
    echo"</br></table>"; //Essa linha pode remover
}
?>
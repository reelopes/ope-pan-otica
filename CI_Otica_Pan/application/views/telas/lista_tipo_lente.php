<?php
echo "<h2>$titulo</h2>";

echo $this->session->flashdata('msg');

echo form_open('tipo_lente/pesquisa');
echo form_label('Pesquisa Tipo de Lente:');
echo form_input(array('name'=>'pesquisa'),  set_value('pesquisa'),'autofocus');
echo form_submit('', 'Procurar');
echo form_close();

$tipo_lente = $tipo_lente;//Pega a variavel da Controller (boa pratica)

if($tipo_lente==NULL){
    echo"Sua pesquisa não encontrou nenhum dado correspondente.";
}else{
    echo"<br><center><table>";//Essa linha pode remover
    if ($tipo_lente != NULL) {
        $this -> table -> set_heading('DESCRICAO');
        foreach ($tipo_lente as $linha) {

            $this -> table -> add_row($linha -> descricao, anchor("tipo_lente/update/$linha->id",'Editar').'
                  |  '.anchor("tipo_lente/delete/$linha->id",'Excluir'));
        }
        $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" width="100%" cellspacing="1" class="mytable">' );
        $this->table->set_template($tmpl);
        echo $this -> table -> generate();
    }
    echo"</br></table>"; //Essa linha pode remover
}
?>
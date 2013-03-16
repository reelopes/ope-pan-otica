<?php

echo "<h2>$titulo</h2>";

echo"<br><center><table>";//Essa linha pode remover
if ($produto != NULL) {
	$this -> table -> set_heading('DESCRIÇÃO', 'PREÇO', 'VALIDADE', 'QUANTIDADE', 'STATUS');
	foreach ($produto as $linha) {
		$this -> table -> add_row($linha -> descricao, $linha -> preco, $linha -> validade, $linha -> quantidade, $linha -> status, anchor("Produto/update/$linha->id_produto",'Editar').'
	      |  '.anchor("Produto/delete/$linha->id_produto",'Excluir'));
	
	}
	echo $this -> table -> generate();
}
echo"</br></table>"; //Essa linha pode remover

?>
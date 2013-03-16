<?php

echo "<h2>$titulo</h2>";

echo"<br><center><table>";//Essa linha pode remover
if ($fornecedor != NULL) {
	$this -> table -> set_heading('NOME', 'EMAIL', 'CNPJ', 'TELEFONE');
	foreach ($fornecedor as $linha) {
		
		$this -> table -> add_row($linha -> nome, $linha -> email, $linha -> cnpj, $linha -> num_telefone, anchor("Fornecedor/update/$linha->id_pessoa/$linha->id_fornecedor",'Editar').'
	      |  '.anchor("Fornecedor/delete/$linha->id_pessoa",'Excluir'));
	
	}
	echo $this -> table -> generate();
}
echo"</br></table>"; //Essa linha pode remover

?>
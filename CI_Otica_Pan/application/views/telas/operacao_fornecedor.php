<!DOCTYPE html>
<html lang="en">
	<head>
	</head>

	<body>
		<div>
			<?php
			
			
			echo"<h2>$titulo</h2>";
			
			
			
			echo validation_errors('<p>','</p>');
			
			if($this->session->flashdata('cadastrook')){
			
			echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
			}
			
			echo form_open('fornecedor/operacao');
			
			echo"<br><center><table>";//Essa linha pode remover
			echo"<tr><td>";//Essa linha pode remover
			
			echo"</td><td>"; //Essa linha pode remover
			echo"</table>"; //Essa linha pode remover
			echo form_close();
			
			?>

			<FORM>
				<INPUT Type="BUTTON" VALUE="Adicionar" ONCLICK="window.location.href='http://localhost/CI_Otica_Pan/index.php/fornecedor/adiciona'">
				<INPUT Type="BUTTON" VALUE="Ler" ONCLICK="window.location.href='http://localhost/CI_Otica_Pan/index.php/fornecedor/le'"> 
			</FORM>
		</div>
	</body>
</html>
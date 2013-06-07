<br>
<br>
<?
    if ($this->session->userdata('id_nivel') == "1") {
?>

<table width="80%" border="0" class="iconesPrincipal">
    <tr>
        <td align="center">
            <a href="<? echo base_url('fluxoFinanceiro'); ?>" >
                <img src="public/img/report.png" width="74px" heigth="74px"/>
                <br />
                Relatório de Fluxo Finaceiro
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('cheque'); ?>" >
                <img src="public/img/cheque_2.png" width="74px" heigth="74px"/>
                <br />
                Gerenciar Cheques
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('venda/listaOrcamentos'); ?>">
                <img src="public/img/orçamentos.png" width="74px" heigth="74px"/>
                <br />
                Gerenciar Orçamentos
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('venda'); ?>">
                <img src="public/img/venda.png" width="74px" heigth="74px"/>
                <br />
                Venda de Produtos/Serviço
            </a>
        </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
        <td align="center">
            <a href="<? echo base_url('agendamento'); ?>">
                <img src="public/img/agendamento.png" width="72px" heigth="72px"/>
                <br />
                Agendamento
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('receita/adicionaReceita'); ?>" >
                <img src="public/img/check_list_1.png" width="65px" heigth="65px"/>
                <br />
                Cadastrar Receita
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('cliente'); ?>" >
                <img src="public/img/cadastro_cliente.png"/>
                <br />
                Cadastro de Clientes
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('cliente/listarClientes'); ?>">
                <img src="public/img/pesquisa_cliente.png"/>
                <br />
                Pesquisa de Clientes  
            </a>
        </td>
        
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="center">
            <a href="<? echo base_url('fornecedor/adiciona'); ?>">
                <img src="public/img/cadastro_fornecedor.png"/>
                <br />
                Cadastro de Fornecedores    
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('fornecedor/lista'); ?>">
                <img src="public/img/pesquisa_fornecedor.png"/>
                <br />
                Pesquisa de Fornecedores    
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('produto'); ?>">
                <img src="public/img/adiciona_produto_1.png" width="74px" heigth="74px"/>
                <br />
                Cadastro de Produtos
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('produto/lista'); ?>" >
                <img src="public/img/lista_produto_1.png" width="74px" heigth="74px"/>
                <br />
                Pesquisa de Produtos
            </a>
        </td>
    </tr>
</table>

<?
    } else if ($this->session->userdata('id_nivel') == "2") {
?>

<table width="80%" border="0" class="iconesPrincipal">
    <tr>
        <td align="center">
            <a href="<? echo base_url('cheque'); ?>" >
                <img src="public/img/cheque_2.png" width="74px" heigth="74px"/>
                <br />
                Gerenciar Cheques
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('agendamento'); ?>">
                <img src="public/img/agendamento.png" width="72px" heigth="72px"/>
                <br />
                Agendamento
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('venda/listaOrcamentos'); ?>">
                <img src="public/img/orçamentos.png" width="74px" heigth="74px"/>
                <br />
                Gerenciar Orçamentos
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('venda'); ?>">
                <img src="public/img/venda.png" width="74px" heigth="74px"/>
                <br />
                Venda de Produtos/Serviço
            </a>
        </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
        <td>&nbsp;</td>
        <td align="center">
            <a href="<? echo base_url('cliente'); ?>" >
                <img src="public/img/cadastro_cliente.png"/>
                <br />
                Cadastro de Clientes
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('dependente'); ?>">
                <img src="public/img/dependente.png"/>
                <br />
                Cadastro de Dependente
            </a>
        </td>
    </tr>
</table>

<?
    } else if ($this->session->userdata('id_nivel') == "3") {
?>

<table width="80%" border="0" class="iconesPrincipal">
    <tr>
    </tr>
    <tr><td><br></td></tr>
    <tr>
        <td align="center">
            <a href="<? echo base_url('consulta'); ?>">
                <img src="public/img/ConsultaMedica.png" width="65px" heigth="65px"/>
                <br />
                Consulta Oftalmológica
            </a>
        </td>
        <td align="center">
            <a href="<? echo base_url('receita/adicionaReceita'); ?>" >
                <img src="public/img/check_list_1.png" width="65px" heigth="65px"/>
                <br />
                Cadastrar Receita
            </a>
        </td>
        <td align="center" style="visibility: hidden;">
            <a href="<? echo base_url(''); ?>" >
                <img src="public/img/nada.png" width="65px" heigth="65px"/>
                <br />
                &nbsp;
            </a>
        </td>
        <td align="center" style="visibility: hidden;">
            <a href="<? echo base_url(''); ?>" >
                <img src="public/img/nada.png" width="65px" heigth="65px"/>
                <br />
                &nbsp;
            </a>
        </td>
        <td align="center" style="visibility: hidden;">
            <a href="<? echo base_url(''); ?>" >
                <img src="public/img/nada.png" width="65px" heigth="65px"/>
                <br />
                &nbsp;
            </a>
        </td>
    </tr>
</table>

<?
    }
?>
<?php
/**
echo anchor('cliente','Cadastro de Clientes');
echo" | ";
echo anchor('cliente/listarClientes','Listar todos os Clientes');
echo" | ";
echo anchor('agendamento','Agendamento');
echo"<hr>"
 * 
 */
?>

      <ul class="nav">
          <li><a href="<? echo base_url('principal'); ?>" class="icon home"> <span>Home</span></a></li>
        <li class="dropdown">
          <a href="#">Cadastro</a>
          <ul>
            <li><a href="<? echo base_url('cliente'); ?>">Cliente</a></li>
            <li><a href="<? echo base_url('dependente'); ?>">Dependente</a></li>
            <li><a href="<? echo base_url('receita/adicionaReceita'); ?>">Receita</a></li>
            <li><a href="<? echo base_url('fornecedor/adiciona'); ?>">Fornecedor</a></li>
            <li><a href="<? echo base_url('produto'); ?>">Produto</a></li>
            <li><a href="<? echo base_url('grife'); ?>">Grife</a></li>
            <li><a href="<? echo base_url('usuario'); ?>">Usuário</a></li>
            <li><a href="<? echo base_url('contasAPagar'); ?>">Contas a Pagar</a></li>
            </ul>
        </li>
        <li class="dropdown">
          <a href="#">Pesquisa</a>
          <ul class="large">
            <li><a href="<? echo base_url('cliente/listarClientes'); ?>">Cliente</a></li>
            <li><a href="<? echo base_url('fornecedor/lista'); ?>">Fornecedor</a></li>
            <li><a href="<? echo base_url('produto/lista'); ?>">Produto</a></li>
            <li><a href="<? echo base_url('grife/lista'); ?>">Grife</a></li>
            <li><a href="<? echo base_url('contasAPagar/lista'); ?>">Contas a Pagar</a></li>
            <li><a href="<? echo base_url('venda/listaOrcamentos'); ?>">Orçamento</a></li>
            <li><a href="<? echo base_url('usuario/lista'); ?>">Usuário</a></li>
            <li><a href="<? echo base_url('cheque'); ?>">Cheques</a></li>
          </ul>
          
          <li class="dropdown">
          <a href="#">Relatórios</a>
          <ul class="large">
            <li><a href="<? echo base_url('fluxoFinanceiro'); ?>">Fluxo Financeiro</a></li>
          </ul>
        </li>
          
        </li>
        <li><a href="<? echo base_url('agendamento'); ?>">Agendamento</a></li>
        <li><a href="<? echo base_url('consulta'); ?>">Consulta Oftalm.</a></li>
        <li><a href="<? echo base_url('venda'); ?>">Venda</a></li>
        
      </ul>
    </nav>
  </header>

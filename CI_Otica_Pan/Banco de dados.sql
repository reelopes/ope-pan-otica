select orcamento.id, orcamento.id_forma_pgto as forma_pagamento, orcamento.vendedor,orcamento.desconto,
sum(itens.preco_unitario*itens.quantidade) as preco_total_itens,sum(distinct on (lente.preco_venda)) as preco_total_lentes ,
sum(servico.preco_venda) as preco_total_servicos
from orcamento
left join itens on itens.id_orcamento = orcamento.id
left join lente on lente.id_orcamento = orcamento.id
left join servico on servico.id_orcamento = orcamento.id
where status=1

group by orcamento.id

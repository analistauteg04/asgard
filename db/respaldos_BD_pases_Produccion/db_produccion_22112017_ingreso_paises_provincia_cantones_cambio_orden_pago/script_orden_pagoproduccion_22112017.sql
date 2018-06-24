update db_facturacion.orden_pago 
set opag_estado = '0', opag_estado_logico = '0'
where opag_id = 21;

update db_facturacion.cliente 
set cli_estado = '0', cli_estado_logico = '0'
where cli_id = 21;
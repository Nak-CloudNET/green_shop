<?php 
	//$this->erp->print_arrays($sales);
	$v = "";
	
	if ($this->input->post('reference_no')) {
		$v .= "&reference_no=" . $this->input->post('reference_no');
	}
	if ($this->input->post('customer')) {
		$v .= "&customer=" . $this->input->post('customer');
	}
	if ($this->input->post('biller')) {
		$v .= "&biller=" . $this->input->post('biller');
	}
	if ($this->input->post('warehouse')) {
		$v .= "&warehouse=" . $this->input->post('warehouse');
	}
	if ($this->input->post('user')) {
		$v .= "&user=" . $this->input->post('user');
	}
	if ($this->input->post('serial')) {
		$v .= "&serial=" . $this->input->post('serial');
	}
	if ($this->input->post('start_date')) {
		$v .= "&start_date=" . $this->input->post('start_date');
	}
	if ($this->input->post('end_date')) {
		$v .= "&end_date=" . $this->input->post('end_date');
	}
	if (isset($biller_id)) {
		$v .= "&biller_id=" . $biller_id;
	}

	$table_header = '<div class="table-responsive">
					<table class="table table-bordered table-condensed table-striped sale_detail_report" id ="slrTable">
						<thead>
							<tr class="info-head">
								<th style="min-width:30px; width: 30px; text-align: center;">
									<input class="checkbox checkth" type="checkbox" name="check"/>
								</th>
								<th style="width:200px;" class="center">Item</th>
								<th style="width:200px;" class="center">Project</th>
								<th style="width:150px;">Warehouse</th>
								<th style="width:150px;">Unit Cost</th>
								<th style="width:150px;">Unit Price</th>
								<th style="width:150px;">Tax</th>
								<th style="width:150px;">Discount</th>
								<th style="width:150px;">Quantity</th>
								<th style="width:150px;">Unit</th>
								<th style="width:150px;">Total_costs</th>
								<th style="width:150px;">Total Price</th>
								<th style="width:150px;">Gross MG</th>
							</tr>
						</thead>
					<tbody>';
	$table_footer = '</tbody>
					    <tfoot>

						</tfoot>
					</table>';
	
foreach($sales as $key => $sale){
	if($sale->type=='2'){
		$sale_id .=$sale->id ."r"."_";
	}else{
		$sale_id .= $sale->id ."_";
	}
?>
<?php } ?>
		<?php
			echo form_open('reports/salesDetail_actions', 'id="action-form"');
		?>
		<div class="box">
			<div class="box-header">
				<h2 class="blue"><i class="fa-fw fa fa-heart"></i><?= lang('sales_detail_report'); ?><?php
					if ($this->input->post('start_date')) {
						echo " From " . $this->input->post('start_date') . " to " . $this->input->post('end_date');
					}
					?></h2>
					
					<?php echo form_hidden('reference_no', (isset($_GET['reference_no']) ? $_GET['reference_no'] : ""), 'class="form-control tip" id="reference_no"'); ?>
					
					<?php echo form_hidden('start_date', (isset($_GET['start_date']) ? $_GET['start_date'] :""), 'class="form-control datetime" id="start_date"'); ?>
				
					<?php echo form_hidden('end_date', (isset($_GET['end_date']) ? $_GET['end_date'] : ""), 'class="form-control datetime" id="end_date"'); ?>
				
				
				<div class="box-icon">
					<ul class="btn-tasks">
						<li class="dropdown"><a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>"><i
									class="icon fa fa-toggle-up"></i></a></li>
						<li class="dropdown"><a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>"><i
									class="icon fa fa-toggle-down"></i></a></li>
					</ul>
				</div>
				<div class="box-icon">
					<ul class="btn-tasks">
						<li class="dropdown"><a href="#" id="pdf" data-action="export_pdf" class="tip" title="<?= lang('download_pdf') ?>"><i
									class="icon fa fa-file-pdf-o"></i></a></li>
						<li class="dropdown"><a href="#" id="excel" data-action="export_excel"  class="tip" title="<?= lang('download_xls') ?>"><i
									class="icon fa fa-file-excel-o"></i></a></li>
						<li class="dropdown"><a href="#" id="image" class="tip" title="<?= lang('save_image') ?>"><i
									class="icon fa fa-file-picture-o"></i></a></li>
					</ul>
				</div>
				
			</div>

			<div style="display: none;">
				<input type="hidden" name="form_action" value="" id="form_action"/>
				<?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
			</div>
		<?= form_close() ?>
			<div class="box-content">
				<div class="row">
					<div class="col-lg-12">
						<p class="introtext"><?= lang('customize_report'); ?></p>
						<input type="hidden" value="helo" name="test">
						<div id="form">
							<?php echo form_open('reports/sales_detail', 'id="action-form" method="GET"'); ?>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<label class="control-label" for="reference_no"><?= lang("reference_no"); ?></label>
										<?php echo form_input('reference_no', (isset($_GET['reference_no']) ? $_GET['reference_no'] : ""), 'class="form-control tip" id="reference_no"'); ?>
									</div>
								</div>
								<?php if($this->session->userdata('view_right')==0){?>
									<div class="col-sm-3" style="display:none">
										<div class="form-group">
											<label class="control-label" for="user"><?= lang("created_by"); ?></label>
											<?php
											$us[""] = "";
											foreach ($users as $user) {
												$us[$user->id] = $user->first_name . " " . $user->last_name;
											}
											echo form_dropdown('user', $us, (isset($_GET['user']) ? $_GET['user'] : ""), 'class="form-control" id="user" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("user") . '"');
											?>
										</div>
									</div>
								<?php }else{ ?>
									<div class="col-sm-3">
										<div class="form-group">
											<label class="control-label" for="user"><?= lang("created_by"); ?></label>
											<?php
											$us[""] = "";
											foreach ($users as $user) {
												$us[$user->id] = $user->first_name . " " . $user->last_name;
											}
											echo form_dropdown('user', $us, (isset($_GET['user']) ? $_GET['user'] : ""), 'class="form-control" id="user" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("user") . '"');
											?>
										</div>
									</div>    
								<?php } ?>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="control-label" for="customer"><?= lang("customer"); ?></label>
										<?php echo form_input('customer', (isset($_GET['customer']) ? $_GET['customer'] : ""), 'class="form-control" id="customer" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("customer") . '"'); ?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="control-label" for="biller"><?= lang("biller"); ?></label>
										<?php
										$bl[""] = "";
										foreach ($billers as $biller) {
											$bl[$biller->id] = $biller->company != '-' ? $biller->company : $biller->name;
										}
										echo form_dropdown('biller', $bl, (isset($_GET['biller']) ? $_GET['biller'] : ""), 'class="form-control" id="biller" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("biller") . '"');
										?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="control-label" for="warehouse"><?= lang("warehouse"); ?></label>
										<?php
										$wh[""] = "";
										foreach ($warehouses as $warehouse) {
											$wh[$warehouse->id] = $warehouse->name;
										}
										echo form_dropdown('warehouse', $wh, (isset($_GET['warehouse']) ? $_GET['warehouse'] : ""), 'class="form-control" id="warehouse" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("warehouse") . '"');
										?>
									</div>
								</div>
								<?php if($this->Settings->product_serial) { ?>
									<div class="col-sm-3">
										<div class="form-group">
											<?= lang('serial_no', 'serial'); ?>
											<?= form_input('serial', '', 'class="form-control tip" id="serial"'); ?>
										</div>
									</div>
								<?php } ?>
								<div class="col-sm-3">
									<div class="form-group">
										<?= lang("start_date", "start_date"); ?>
										<?php echo form_input('start_date', (isset($_GET['start_date']) ? $_GET['start_date'] :""), 'class="form-control datetime" id="start_date"'); ?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<?= lang("end_date", "end_date"); ?>
										<?php echo form_input('end_date', (isset($_GET['end_date']) ? $_GET['end_date'] : ""), 'class="form-control datetime" id="end_date"'); ?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<label class="control-label" for="type"><?= lang("sale_type"); ?></label>
										<?php
											$types = array(""=> "...", 1 => lang("sales"), 2 => lang("return"));
											echo form_dropdown('type', $types, isset($type) ? $type :'', 'class="form-control" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("type") . '"');
										?>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<?= lang("type", "type"); ?>
										<?php
										$sale_types = array('' => '...', 0 => 'SALE', 1 => 'POS');
										echo form_dropdown('types', $sale_types, (isset($_POST['types']) ? $_POST['types'] : ""), 'id="types" class="form-control select" placeholder="Please select Type" style="width:100%;"');
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
							</div>
							<?php echo form_close(); ?>
						</div>
						<div class="clearfix"></div>
						
						<?php
							echo $table_header;
							echo $table_footer;
							
						?>
						<div class=" text-right">
							<div class="dataTables_paginate paging_bootstrap">
								<?= $pagination; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>

<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script type="text/javascript">  
	
	$(document).ready(function () {
		$('#image').click(function (event) {
            event.preventDefault();
            html2canvas($('.box'), {
                onrendered: function (canvas) {
                    var img = canvas.toDataURL()
                    window.open(img);
                }
            });
            return false;
        });
		
		var time = 1;
		var interval = setInterval(function() {
		   if (time <= 1) {
				$.ajax({
				type: 'post',
				url: site.base_url+'reports/getSaleReportData',
				dataType: "json",
				data: { 
				sale_id: '<?php echo $sale_id ?>',
				<?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'
				},
				success: function (data) {
					var sale_footer_data = get_sale_footer_data(data.sales);
					var return_footer_data = get_return_footer_data(data.return_sales);
					render_sale_records(data);
					render_return_records(data);
					render_footer(sale_footer_data,return_footer_data);
				}
			});  
			time++;
		   }
		   else {
			  clearInterval(interval);
		   }
		}, 1000);
		
		
		
		function get_return_footer_data(sales){
			var g_total_costs = 0;
			var g_total = 0;
			var g_gross_margin = 0;
			var g_order_discounts = 0;
			var g_total_shipping = 0;
			if(sales!=null){
				for(var i=0;i < sales.length;i++){
					g_total_costs += parseFloat(sales[i].total_cost);
					g_total+=parseFloat(sales[i].total);
					g_gross_margin = g_total - g_total_costs;
					g_order_discounts += parseFloat(sales[i].order_discount);
					g_total_shipping += parseFloat(sales[i].shipping);
				}
			
				var data = new Array();
				data['g_total_costs'] = g_total_costs;
				data['g_total'] = g_total;
				data['g_gross_margin'] = g_gross_margin;
				data['g_order_discounts'] = g_order_discounts;
				data['g_total_shipping'] = g_total_shipping;

				return data;
			}	
			
		}
		
		function get_sale_footer_data(sales){
			var g_total_costs = 0;
			var g_total = 0;
			var g_gross_margin = 0;
			var g_order_discounts = 0;
			var g_total_shipping = 0;
					
			for(var i=0;i < sales.length;i++){
				g_total_costs += parseFloat(sales[i].total_cost);
				g_total+=parseFloat(sales[i].total);
				g_order_discounts += parseFloat(sales[i].order_discount);
				g_total_shipping += parseFloat(sales[i].shipping);
				g_gross_margin = g_total - g_total_costs;
			}
			
			var data = new Array();
			data['g_total_costs'] = g_total_costs;
			data['g_total'] = g_total;
			data['g_gross_margin'] = g_gross_margin;
			data['g_order_discounts'] = g_order_discounts;
			data['g_total_shipping'] = g_total_shipping;

			return data;	
		}
		
		function render_return_records(data){
			if(data.return_sales != null){
				var l =  data.return_sales.length - 1;
				for(var i=0;i < data.return_sales.length;i++){
					var rd = data.sales_detail_returned[l];
					l--;
					var color = "";
					var newTr = $('<tr class="info-reference_no" ></tr>');
					tr_html = '<td><input type="checkbox" class="checkbox multi-select input-xs" name="val[]" value="'+ data.return_sales[i].id +'" /></td></td><td colspan="12" style="font-size:18px;" class="left"><b style="color:red">'+data.return_sales[i].reference_no+' <i class="fa fa-angle-double-right" aria-hidden="true"></i>'+ data.return_sales[i].customer +'<i class="fa fa-angle-double-right" aria-hidden="true"></i>'+data.return_sales[i].date+'</b></td>';
						newTr.html(tr_html);
						var tr_html_detail = "";
						var total_costs = 0;
						var total_amount = 0;
						var amount=0;
						var total_gross_margin = 0;
						var grand_total = 0;
						for(var j=0;j<rd.length;j++){
							var unit = rd[j].variant ? rd[j].variant : rd[j].unit;
							
							if (rd[j].option_id != 0 && rd[j].option_id != null) {
								var total_cost = (parseFloat(rd[j].unit_cost) * parseFloat(rd[j].qty_unit)) * parseFloat(rd[j].quantity);
								var unit_cost	= parseFloat(rd[j].unit_cost) * parseFloat(rd[j].qty_unit);
								
							} else {
								var total_cost = parseFloat(rd[j].unit_cost) * parseFloat(rd[j].quantity);
								var unit_cost	= parseFloat(rd[j].unit_cost);
							}
							var gross_margin = parseFloat(rd[j].subtotal) - total_cost;
							
							total_costs += total_cost;
							total_amount += (parseFloat(rd[j].subtotal))
							total_gross_margin += gross_margin;
							amount = total_amount - (parseFloat(data.return_sales[i].order_discount) + parseFloat(data.return_sales[i].shipping));
							
							var invoice_gross_margin = (total_gross_margin - parseFloat(data.return_sales[i].order_discount)) + parseFloat(data.return_sales[i].shipping);
							
							grand_total = (total_amount - parseFloat(data.return_sales[i].order_discount)) + parseFloat(data.return_sales[i].shipping) + parseFloat(data.return_sales[i].order_tax);
							
							var newTrTotal = $('<tr style="font-weight:bold;"></tr>');
							var newTrOrderDiscount = $('<tr style="font-weight:bold;"></tr>');
							var newTrShipping = $('<tr style="font-weight:bold;"></tr>');
							var newTrSubtotal = $('<tr style="font-weight:bold;"></tr>');
							var newTrTotalAmount = $('<tr style="font-weight:bold;"></tr>');
							
							tr_html_detail +='<tr><td></td><td>' + rd[j]['product_name'] + '</td><td>' + data.sales[0].biller+ '</td><td class="center">'+ rd[j]['w_name'] +'</td><td class"right>'+ formatDecimal(unit_cost) +'</td><td class="right">'+ formatDecimal(rd[j]['unit_price']) +'</td><td class="right">'+ (rd[j]['item_tax']) +'</td><td class="right">'+ formatDecimal(rd[j]['item_discount']) +'</td><td class="center">'+ formatDecimal(rd[j]['quantity']) +'</td><td class="center">'+unit+'</td><td class="right">'+formatDecimal(total_cost)+'</td><td class="right">'+formatDecimal(rd[j]['subtotal'])+'</td><td class="right">'+formatDecimal(gross_margin)+'</td><tr/>';
							
							tr_html_total = '<td></td><td colspan="8" class="info-reference_no right"></td><td class="right">Grand Total:</td><td class="right">'+formatDecimal(total_costs)+'</td><td class="right">'+formatDecimal(grand_total)+'</td><td class="right">'+formatDecimal(invoice_gross_margin)+'</td></tr>';
							
							tr_html_order_discount = '<td></td><td colspan="9" class="info-reference_no right">Order Discount:</td><td></td><td class="right">'+ formatDecimal(data.return_sales[i].order_discount) +'</td><td class="right"></td>';
							
							tr_html_shipping = '<td></td><td colspan="9" class="info-reference_no right">Shipping :</td><td></td><td class="right">'+formatDecimal(data.return_sales[i].shipping)+'</td><td class="right"></td>';
							
							tr_html_subtotal = '<td></td><td colspan="9" class="info-reference_no right">Subtotal:</td><td class="right">'+formatDecimal(total_costs)+'</td><td class="right">'+formatDecimal(total_amount)+'</td><td class="right">'+ formatDecimal(total_gross_margin) +'</td>';
							
							newTrTotal.html(tr_html_total);
							newTrOrderDiscount.html(tr_html_order_discount);
							newTrSubtotal.html(tr_html_subtotal);
							newTrShipping.html(tr_html_shipping);
							

						}
						
							newTr.appendTo("#slrTable");
							$("#slrTable").append(tr_html_detail);
							newTrSubtotal.appendTo("#slrTable");
							newTrShipping.appendTo("#slrTable");
							newTrOrderDiscount.appendTo("#slrTable");
							newTrTotal.appendTo("#slrTable");
				}
			}
			
		}
		
		function render_sale_records(data){
			var k =  data.sales.length - 1;	
				for(var i=0;i < data.sales.length;i++){
					var rd = data.sales_detail[k];
					k--;
					var color = "";
					
					var newTr = $('<tr class="info-reference_no" ></tr>');
					tr_html = '<td><input class="checkbox checkth" type="checkbox" name="val[]" value="'+ data.sales[i].id +'"/></td></td><td colspan="12" style="font-size:18px;" class="left"><b style="">'+data.sales[i].reference_no+' <i class="fa fa-angle-double-right" aria-hidden="true"></i>'+ data.sales[i].customer +'<i class="fa fa-angle-double-right" aria-hidden="true"></i>'+data.sales[i].date+'</b></td>';
					newTr.html(tr_html);
						var tr_html_detail = "";
						var total_costs = 0;
						var total_amount = 0;
						var amount=0;
						var total_gross_margin = 0;
						var grand_total = 0;
						for(var j=0;j<rd.length;j++){
							var unit = rd[j].variant ? rd[j].
							variant : rd[j].unit;
							if (rd[j].option_id != 0 && rd[j].option_id != null) {
								var total_cost = (parseFloat(rd[j].unit_cost) * parseFloat(rd[j].qty_unit)) * parseFloat(rd[j].quantity);
								var unit_cost	= parseFloat(rd[j].unit_cost) * parseFloat(rd[j].qty_unit);
								
							} else {
								var total_cost = parseFloat(rd[j].unit_cost) * parseFloat(rd[j].quantity);
								var unit_cost	= parseFloat(rd[j].unit_cost);
							}
							var gross_margin = (parseFloat(rd[j].subtotal)) - total_cost;
							total_costs += total_cost;
							total_amount += (parseFloat(rd[j].subtotal))
							total_gross_margin += gross_margin;
							var invoice_gross_margin = (total_gross_margin - parseFloat(data.sales[i].order_discount)) + parseFloat(data.sales[i].shipping);
							amount = total_amount - (parseFloat(data.sales[i].order_discount) + parseFloat(data.sales[i].shipping));
							grand_total = (total_amount - parseFloat(data.sales[i].order_discount)) + parseFloat(data.sales[i].shipping) + parseFloat(data.sales[i].order_tax);
							
							var newTrTotal = $('<tr style="font-weight:bold;"></tr>');
							var newTrOrderDiscount = $('<tr style="font-weight:bold;"></tr>');
							var newTrShipping = $('<tr style="font-weight:bold;"></tr>');
							var newTrSubtotal = $('<tr style="font-weight:bold;"></tr>');
							var newTrTotalAmount = $('<tr style="font-weight:bold;"></tr>');
							
							tr_html_detail +='<tr><td></td><td>' + rd[j]['product_name'] + '</td><td>' + data.sales[0].biller+ '</td><td class="center">'+rd[j]['w_name']+'</td><td class"right>'+ formatDecimal(unit_cost) +'</td><td class="right">'+ formatDecimal(rd[j]['unit_price']) +'</td><td class="right">'+ formatDecimal(rd[j]['item_tax']) +'</td><td class="right">'+ formatDecimal(rd[j]['item_discount']) +'</td><td class="center">'+ formatDecimal(rd[j]['quantity']) +'</td><td class="center">'+unit+'</td><td class="right">'+formatDecimal(total_cost)+'</td><td class="right">'+formatDecimal(parseFloat(rd[j]['subtotal']))+'</td><td class="right">'+formatDecimal(gross_margin)+'</td>';
							
							tr_html_total = '<td></td><td colspan="8" class="info-reference_no right"></td><td class="right">Grand Total:</td><td class="right">'+formatDecimal(total_costs)+'</td><td class="right">'+formatDecimal(grand_total)+'</td><td class="right">'+formatDecimal(invoice_gross_margin)+'</td></tr>';
							
							tr_html_order_discount = '<td></td><td colspan="9" class="info-reference_no right">Order Discount:</td><td></td><td class="right">'+ formatDecimal(data.sales[i].order_discount) +'</td><td class="right"></td>';
							
							tr_html_shipping = '<td></td><td colspan="9" class="info-reference_no right">Shipping :</td><td></td><td class="right">'+formatDecimal(data.sales[i].shipping)+'</td><td class="right"></td>';
							
							tr_html_subtotal = '<td></td><td colspan="9" class="info-reference_no right">Subtotal:</td><td class="right">'+formatDecimal(total_costs)+'</td><td class="right">'+formatDecimal(total_amount)+'</td><td class="right">'+ formatDecimal(total_gross_margin) +'</td>';
							
						}
							newTrTotal.html(tr_html_total);
							newTrOrderDiscount.html(tr_html_order_discount);
							newTrSubtotal.html(tr_html_subtotal);
							newTrShipping.html(tr_html_shipping);
							
							newTr.appendTo("#slrTable");
							$("#slrTable").append(tr_html_detail);
							newTrSubtotal.appendTo("#slrTable");
							newTrShipping.appendTo("#slrTable");
							newTrOrderDiscount.appendTo("#slrTable");
							newTrTotal.appendTo("#slrTable");
							
				}
		}
		
		function render_footer(s,r){
			
			var total_footer = $('<tr></tr>');	
			var total_order_discounts = $('<tr></tr>');
			var total_shippings = $('<tr></tr>');
			var total_gross_margins = $('<tr></tr>');
			if(r!=null){
				var g_total_costs = s['g_total_costs'] - r['g_total_costs'];
				var g_total = s['g_total'] - r['g_total'];
				var g_order_discounts = s['g_order_discounts'] - r['g_order_discounts'];
				var g_total_shipping = s['g_total_shipping'] - r['g_total_shipping'];
				var g_gross_margin = s['g_gross_margin'] - r['g_gross_margin'];
				var g_gross_margins = (s['g_gross_margin'] - r['g_gross_margin']) + (g_total_shipping - g_order_discounts);
			}else{
				var g_total_costs = s['g_total_costs'];
				var g_total = s['g_total'];
				var g_order_discounts = s['g_order_discounts'];
				var g_total_shipping = s['g_total_shipping'];
				var g_gross_margin = s['g_gross_margin'];
				var g_gross_margins = (s['g_gross_margin']) + (g_total_shipping - g_order_discounts);
			}
			
			
			
			var tr_total_footer = '<th colspan="10" style="color:#0586ff" class = "right info-foot"> Total : </th><th class="right" style = "color:#0586ff">'+formatDecimal(g_total_costs)+'</th><th class="right" style="color:#0586ff">'+ formatDecimal(g_total) +'</th> <th class="right" style="color:#0586ff">'+formatDecimal(g_gross_margin)+'</th>';
			
			var tr_total_order_discounts = '<th colspan="10" class="right info-foot" style="color:#0586ff">Total Order Discount: </th><th></th><th class="right" style="color:#0586ff">'+formatDecimal(g_order_discounts)+'</th><th class="right" style="color:#0586ff"></th>';
			
			var tr_total_shippings = '<th colspan="10" class="right info-foot"style="color:#0586ff">Total Shipping : </th><th></th><th class="right" style="color:#0586ff">'+formatDecimal(g_total_shipping)+'</th><th class="right" style="color:#0586ff"></th>';
			
			var tr_total_gross_margins = '<th colspan="10" style="color:#0586ff" class="right info-foot" >Total Gross Margin:</th><th class="right" style="color:#0586ff"></th><th class="right" style="color:#0586ff"></th><th class="right" style="color:#0586ff">'+formatDecimal(g_gross_margins)+'</th>';				
			
			total_footer.html(tr_total_footer);
			total_order_discounts.html(tr_total_order_discounts);
			total_shippings.html(tr_total_shippings);
			total_gross_margins.html(tr_total_gross_margins);
			
			total_footer.appendTo("#slrTable");
			total_order_discounts.appendTo("#slrTable");
			total_shippings.appendTo("#slrTable");
			total_gross_margins.appendTo("#slrTable");
		}
		
		$('#form').hide();
        <?php if ($this->input->post('customer')) { ?>
        $('#customer').val(<?= $this->input->post('customer') ?>).select2({
            minimumInputLength: 1,
            data: [],
            initSelection: function (element, callback) {
                $.ajax({
                    type: "get", async: false,
                    url: site.base_url + "customers/suggestions/" + $(element).val(),
                    dataType: "json",
                    success: function (data) {
                        callback(data.results[0]);
                    }
                });
            },
            ajax: {
                url: site.base_url + "customers/suggestions",
                dataType: 'json',
                quietMillis: 15,
                data: function (term, page) {
                    return {
                        term: term,
                        limit: 10
                    };
                },
                results: function (data, page) {
                    if (data.results != null) {
                        return {results: data.results};
                    } else {
                        return {results: [{id: '', text: 'No Match Found'}]};
                    }
                }
            },
			$('#customer').val(<?= $this->input->post('customer') ?>);
        });

        <?php } ?>
        $('.toggle_down').click(function () {
            $("#form").slideDown();
            return false;
        });
        $('.toggle_up').click(function () {
            $("#form").slideUp();
            return false;
        });
		
    });
	
</script>

<style type="text/css">
	table { 
		white-space: nowrap; 
		font-size:12px !important; 
		overflow-x: scroll; 
		width:100%;
		display:block;
		}
	table .info-head{
		
		text-align:center;
	}
	table .info-reference_no{
		
	}
	table .info-foot{
		text-transform: uppercase; 
		font-weight:100px;
	}
	
</style>

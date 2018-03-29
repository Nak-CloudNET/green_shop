<?php 
	//$this->erp->print_arrays("ss");
?>

<script type="text/javascript">
$(document).ready(function(){
	
	$('body').on('click', '#excel1', function(e) {
	   e.preventDefault();
	   var k = false;
	   $.each($("input[name='val[]']:checked"), function(){
	    k = true;

	   });
	   $('#form_action').val($('#excel1').attr('data-action'));
	   $('#action-form-submit').trigger('click');
  	});
  	$('body').on('click', '#pdf1', function(e) {
	   e.preventDefault();
	   var k = false;
	   $.each($("input[name='val[]']:checked"), function(){
	    
	    k = true;
	   });
	   $('#form_action').val($('#pdf1').attr('data-action'));
	   $('#action-form-submit').trigger('click');
  	});
});
</script>
<style>
	#tbstock .shead th{
		background-color: #428BCA;border-color: #357EBD;color:white;text-align:center;
	}

</style>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-barcode"></i><?= lang('products_in_out') ; ?>
        </h2>
		<div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                        <i class="icon fa fa-toggle-up"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="toggle_down tip" title="<?= lang('show_form') ?>">
                        <i class="icon fa fa-toggle-down"></i>
                    </a>
                </li>
				<li class="dropdown">
					<a href="#" id="pdf" data-action="export_pdf"  class="tip" title="<?= lang('download_pdf') ?>">
						<i class="icon fa fa-file-pdf-o"></i>
					</a>
				</li>
                <li class="dropdown">
					<a href="#" id="excel" data-action="export_excel"  class="tip" title="<?= lang('download_xls') ?>">
						<i class="icon fa fa-file-excel-o"></i>
					</a>
				</li>
            </ul>
        </div>       
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
				<?php
				//echo $this->session->userdata('user_id');
				?>
                <p class="introtext"><?= lang('list_results'); ?></p>
                <div id="form">
				<?php echo form_open('reports/inventory_inout', 'id="action-form"'); ?>
					<div class="row">
                       <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="cat"><?= lang("products"); ?></label>
                                <?php
								$pro[""] = "ALL";
                                foreach ($products as $product) {
                                    $pro[$product->id] = $product->code.' / '.$product->name;
                                }
                                echo form_dropdown('product', $pro, (isset($_POST['product']) ? $_POST['product'] : $product2), 'class="form-control" id="product" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("producte") . '"');
                                ?>
								
                            </div>
                        </div>
						<?php if(isset($biller_idd)){?>
						<!--<div class="col-sm-4">
						 <div class="form-group">
                                    <?= lang("biller", "biller"); ?>
                                    <?php 
									$str = "";
									$q = $this->db->get_where("companies",array("id"=>$biller_idd),1);
									 if ($q->num_rows() > 0) {
										 $str = $q->row()->company.' / '.$q->row()->name;
										echo form_input('biller',$str , 'class="form-control" id="biller"');
									 }
									?>
                                </div>
						 </div>-->
						<?php } ?>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("warehouse", "warehouse") ?>
                                <?php
                                $waee[''] = "ALL";
                                foreach ($warefull as $wa) {
                                    $waee[$wa->id] = $wa->code.' / '.$wa->name;
                                }
                                echo form_dropdown('warehouse', $waee, (isset($_POST['warehouse']) ? $_POST['warehouse'] : ''), 'class="form-control select" id="warehouse" placeholder="' . lang("select") . " " . lang("warehouse") . '" style="width:100%"')
							
                                ?>

                            </div>
                        </div>
						<!--<div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="warehouse"><?= lang("biller"); ?></label>
                                <?php
								$bill[""] = "ALL";
                                foreach ($billers as $biller) {
                                    $bill[$biller->id] =  $biller->code.' / '.$biller->name;
                                }
                                echo form_dropdown('biller', $bill, (isset($_POST['biller']) ? $_POST['biller'] : ""), 'class="form-control" id="biller" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("biller") . '"');
                                ?>
                            </div>
                        </div>-->
						<div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("category", "category") ?>
                                <?php
                                $cat[''] = "ALL";
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                                echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : $category2), 'class="form-control select" id="category" placeholder="' . lang("select") . " " . lang("category") . '" style="width:100%"')
                                ?>

                            </div>
                        </div>
						 <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("from_date", "from_date"); ?>
                                <?php echo form_input('from_date', (isset($_POST['from_date']) ? $_POST['from_date'] : $this->erp->hrsd($from_date2)), 'class="form-control date" id="from_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("to_date", "to_date"); ?>
                                <?php echo form_input('to_date', (isset($_POST['to_date']) ? $_POST['to_date'] : $this->erp->hrsd($to_date2)), 'class="form-control date" id="to_date"'); ?>
                            </div>
                        </div>		
					
						
						</div>
					<div class="form-group">
                        <div
                            class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary sub"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>
					
                </div>
                <div class="clearfix"></div>
				<?php
					$wid = $this->reports_model->getWareByUserID();
					
					if(!$warehouse2){
						$warehouse2 = $wid;
					}
					
					$num = $this->reports_model->getTransuctionsPurIN($product2,$warehouse2,$from_date2,$to_date2,$biller2);
					
					$k = 0;
					if(is_array($num)){
					foreach($num as $r){
						if($r->transaction_type){
							$k++;
						}
					}
					}
					
					$num2 = $this->reports_model->getTransuctionsPurOUT($product2,$warehouse2,$from_date2,$to_date2,$biller2);
					$k2 = 0;
					if(is_array($num2)){
					foreach($num2 as $r2){
						if($r2->transaction_type){
							$k2++;
						}
					}
					}
					
					//$numMonth=1;
					//echo $startDate=date('Y-m-01',strtotime($from_date2 . " + $numMonth month"));
					//echo $endDate=date('Y-m-t',strtotime($from_date2 . " + $numMonth month"));
				?>
                <div class="table-responsive" style="width:100%;overflow:auto;">
                    <table id="tbstock" class="table table-condensed table-bordered table-hover table-striped" >
                        <thead>
							<tr>							
								<th rowspan="2">Location <span style="color:orange;">/</span> Category <span style="color:orange;">/</span> Item</th>
								<th rowspan="2"><?= lang("begin") ?></th>
								<?php if($k){?>
								<!--<th colspan="<?=$k?>"><?= lang("in") ?></th>-->
								<?php } ?>
                                <th colspan="3"><?= lang("in") ?></th>
								<th rowspan="2"><?= lang("total_in") ?></th>
								<?php if($k2){?>
								<!--<th  colspan="<?=$k2?>"><?= lang("out") ?></th>-->
								<?php } ?>
                                <th  colspan="3"><?= lang("out") ?></th>
								<th rowspan="2"><?= lang("total_out") ?></th>
								<th rowspan="2"><?= lang("balance") ?></th>
							</tr>
							<tr class="shead">
                                <th><?= lang("purchase") ?></th>
                                <th><?= lang("adjustment") ?></th>
                                <th><?= lang("transfer") ?></th>
                                <th><?= lang("sale") ?></th>
                                <th><?= lang("adjustment") ?></th>
                                <th><?= lang("transfer") ?></th>
								<?php
									if(is_array($num)){
									foreach($num as $tr){
										if($tr->transaction_type){
											//echo "<th>".lang(strtolower($tr->transaction_type))."</th>";
										}
									}
									}
								?>
								<?php
									if(is_array($num2)){
									foreach($num2 as $tr2){
										if($tr2->transaction_type){
											//echo "<th>".lang(strtolower($tr2->transaction_type))."</th>";
										}
									}
									}

								?>
								
							</tr>
						</thead>
                        <tbody>
							<?php
                            $arr_wh = [];
                            $arr_cat = [];
                            $arr_cat_product = [];

							if(is_array($ware)){


                                foreach($ware as $rw){
                                    $arr_wh[$rw->warehouse_id] = $rw->warehouse_name;
                                    $arr_cat[$rw->warehouse_id][$rw->category_id] = $rw->category_name;
                                    $arr_cat_product[$rw->warehouse_id][$rw->category_id][$rw->product_id] = [
                                                'product_name' => $rw->product_name,
                                                't_in_purchase' => $rw->t_in_purchase,
                                                't_in_transfer' => $rw->t_in_transfer,
                                                't_in_adjustment' => $rw->t_in_adjustment,
                                                't_out_sale' => $rw->t_out_sale,
                                                't_out_adjustment' => $rw->t_out_adjustment,
                                                't_out_transfer' => $rw->t_out_transfer
                                            ];
                                }

                                $arr_bigin = [];
                                if(is_array($begin)){
                                    foreach ($begin as $rb){
                                        $arr_bigin[$rb->warehouse_id][$rb->product_id] = $rb->beggin;
                                    }
                                }

                                $total_all_beggin_qty = 0;
                                $total_all_purchase_qty = 0;
                                $total_all_sale_qty = 0;
                                $total_all_adj_in_qty = 0;
                                $total_all_adj_out_qty = 0;
                                $total_all_transf_in_qty = 0;
                                $total_all_transf_out_qty = 0;

								foreach($arr_wh as $w_id => $w_n){
                                    $tw_begin = 0;
                                    $tw_purchase = 0;
                                    $tw_sale = 0;
                                    $tw_adjustment_in = 0;
                                    $tw_adjustment_out = 0;
                                    $tw_transfer_in = 0;
                                    $tw_transfer_out = 0;
                                ?>
                                    <tr>
                                        <!--<td colspan="<?=$k+$k2+5?>" style="color:green;"><span style="font-size:17px;"><b><?=$w_n;?> </b></span></td>-->
                                        <td colspan="11" style="color:green;"><span style="font-size:17px;"><b><?=$w_n;?> </b></span></td>

                                    </tr>

                                        <?php if(isset($arr_cat[$w_id])){

                                            foreach($arr_cat[$w_id] as $cat_id => $cat_name){
                                                $t_cate_bigin = 0;
                                                $t_cate_purchase = 0;
                                                $t_cate_sale = 0;
                                                $_cate_adjustment = 0;
                                                $_cate_adjustment_out = 0;
                                                $t_cate_transfer = 0;
                                                $t_cate_transfer_out = 0;

                                            ?>
                                                <tr>
                                                    <!--<td colspan="<?=$k+$k2+5?>" style="color:red;padding-left: 10px;"><span style="font-size:15px;"><b><?=$cat_name;?> </b></span></td>-->
                                                    <td colspan="11" style="color:red;padding-left: 10px;"><span style="font-size:15px;"><b><?=$cat_name;?> </b></span></td>
                                                </tr>

                                                <?php if(isset($arr_cat_product[$w_id][$cat_id])){

                                                    foreach($arr_cat_product[$w_id][$cat_id] as $p_id => $rr){
                                                        $begin = isset($arr_bigin[$w_id][$p_id])?$arr_bigin[$w_id][$p_id]:0;

                                                        $total_in = $rr['t_in_purchase'] + $rr['t_in_adjustment'] + $rr['t_in_transfer'];
                                                        $total_out = $rr['t_out_sale'] + $rr['t_out_adjustment'] + $rr['t_out_transfer'];
                                                        $balance = $total_in - $total_out;

                                                        $t_cate_bigin += $begin;
                                                        $t_cate_purchase += $rr['t_in_purchase'];
                                                        $t_cate_sale += $rr['t_out_sale'];
                                                        $_cate_adjustment += $rr['t_in_adjustment'];
                                                        $_cate_adjustment_out += $rr['t_out_adjustment'];
                                                        $t_cate_transfer += $rr['t_in_transfer'];
                                                        $t_cate_transfer_out += $rr['t_out_transfer'];

                                                        $tw_begin += $begin;
                                                        $tw_purchase += $rr['t_in_purchase'];
                                                        $tw_sale += $rr['t_out_sale'];
                                                        $tw_adjustment_in += $rr['t_in_adjustment'];
                                                        $tw_adjustment_out += $rr['t_out_adjustment'];
                                                        $tw_transfer_in += $rr['t_in_transfer'];
                                                        $tw_transfer_out += $rr['t_out_transfer'];


                                                        $total_all_beggin_qty += $begin;
                                                        $total_all_purchase_qty += $rr['t_in_purchase'];
                                                        $total_all_sale_qty += $rr['t_out_sale'];
                                                        $total_all_adj_in_qty += $rr['t_in_adjustment'];
                                                        $total_all_adj_out_qty += $rr['t_out_adjustment'];
                                                        $toal_all_transf_in_qty += $rr['t_in_transfer'];
                                                        $toal_all_transf_out_qty += $rr['t_out_transfer'];


                                                        ?>

                                                        <tr>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$rr['product_name'];?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($begin);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_in_purchase']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_in_adjustment']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_in_transfer']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($total_in);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_out_sale']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_out_adjustment']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($rr['t_out_transfer']);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($total_out);?></b></span></td>
                                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$this->erp->formatQuantity($balance);?></b></span></td>

                                                        </tr>
                                                    <?php }
                                                        $total_qty_in = $t_cate_purchase + $_cate_adjustment + $t_cate_transfer;
                                                        $total_qty_out = $t_cate_sale + $_cate_adjustment_out + $t_cate_transfer_out;

                                                    ?>

                                                    <tr>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?= lang("total") ?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_bigin);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_purchase);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($_cate_adjustment);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_transfer);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_purchase + $_cate_adjustment + $t_cate_transfer);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_sale);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($_cate_adjustment_out);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_transfer_out);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($t_cate_sale + $_cate_adjustment_out + $t_cate_transfer_out);?></b></span></td>
                                                        <td style="color:red;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_qty_in - $total_qty_out );?></b></span></td>

                                                    </tr>


                                              <?php  } ?>

                                            <?php }
                                            $tw_total_in = $tw_purchase + $tw_adjustment_in + $tw_transfer_in;
                                            $tw_total_out = $tw_sale + $tw_adjustment_out + $tw_transfer_out;
                                            $tw_total_balance = $tw_total_in - $tw_total_out;
                                            ?>

                                        <tr>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?= lang("total") ?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_begin);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_purchase);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_adjustment_in);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_transfer_in);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_total_in);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_sale);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_adjustment_out);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_transfer_out);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_total_out);?></b></span></td>
                                            <td style="color:green;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($tw_total_balance);?></b></span></td>

                                        </tr>


                                        <?php } ?>

							        <?php }

							            $all_total_in = $total_all_purchase_qty + $total_all_adj_in_qty + $toal_all_transf_in_qty;
								        $all_total_out = $total_all_sale_qty + $total_all_adj_out_qty + $toal_all_transf_out_qty;
								        $all_qty_balance = $all_total_in - $all_total_out;


							        ?>
                                <tr>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?= lang("total") ?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_all_beggin_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_all_purchase_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_all_adj_in_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($toal_all_transf_in_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($all_total_in);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_all_sale_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($total_all_adj_out_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($toal_all_transf_out_qty);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($all_total_out);?></b></span></td>
                                    <td style="color:blue;padding-left: 30px;"><span style="font-size:16px;"><b><?=$this->erp->formatQuantity($all_qty_balance);?></b></span></td>

                                </tr>
                        <?php } ?>

                        </tbody>                       
                    </table>
                </div>
				
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {

	$(document).on('focus','.date-year', function(t) {
			$(this).datetimepicker({
				format: "yyyy",
				startView: 'decade',
				minView: 'decade',
				viewSelect: 'decade',
				autoclose: true,
			});
	});
    $('#form').hide();
    $('.toggle_down').click(function () {
        $("#form").slideDown();
        return false;
    });
    $('.toggle_up').click(function () {
        $("#form").slideUp();
        return false;
    });
	$('#excel').on('click', function (e) {
		e.preventDefault();
		if ($('.checkbox:checked').length <= 0) {
			window.location.href = "<?= site_url('reports/inventoryInoutReport/0/xls/'.$product1.'/'.$category1.'/'.$warehouse1.'/'.$from_date2.'/'.$to_date2) ?>";
			return false;
		}
	});
	$('#pdf').on('click', function (e) {
		e.preventDefault();
		if ($('.checkbox:checked').length <= 0) {
			window.location.href = "<?= site_url('#') ?>";
			return false;
		}
	});	
});


		
</script>
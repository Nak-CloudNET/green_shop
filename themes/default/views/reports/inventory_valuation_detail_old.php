
<style type="text/css" media="all">
	#PRData{ 
		white-space:nowrap; 
		width:100%; 
		display: block;  
	}
    #PRData td:nth-child(6), #PRData td:nth-child(7) {
        text-align: right;
    }
    <?php if($Owner || $Admin || $this->session->userdata('show_cost')) { ?>
    #PRData td:nth-child(8) {
        text-align: right;
    }
    <?php } ?>
</style>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-barcode"></i><?= lang('inventory_valuation_detail') ; ?>
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
                <p class="introtext"><?= lang('list_results'); ?></p>
                <div id="form">
					<?php echo form_open('reports/inventory_valuation_detail/', 'id="action-form"'); ?>
					<div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="reference_no"><?= lang("reference_no"); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : ""), 'class="form-control tip" id="reference_no"'); ?>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="cat"><?= lang("categories"); ?></label>
                                <?php
                             
								$cat[""] = "ALL";
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                                echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ""), 'class="form-control" id="category" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("category") . '"');
                                ?>
                            </div>
                        </div>
						<div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="cat"><?= lang("products"); ?></label>
                                <?php
                               
								$pro[""] = "ALL";
                                foreach ($products as $product) {
                                    $pro[$product->id] = $product->code.' / '.$product->name;
                                }
                                echo form_dropdown('product', $pro, (isset($_POST['product']) ? $_POST['product'] : ""), 'class="form-control" id="product" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("producte") . '"');
                                ?>
                            </div>
                        </div>
						
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("type", "type"); ?>
                                  <?php $types = array(''=>'ALL','SALE' => lang('SALES'), 'PURCHASE' => lang('PURCHASES'),'TRANSFER' => lang('TRANSFER'),'SALES RETURN' => lang('SALES RETURN'),'USING STOCK' => lang('USING STOCK'),'RETURN USING STOCK' => lang('RETURN USING STOCK'),'EXPENSE' => lang('expanse'),'DELIVERY' => lang('delivery'),'ADJUSTMENT' => lang('ADJUSTMENTS'),'STOCK COUNT' => lang('stock_count'));
                                echo form_dropdown('type', $types, (isset($_POST['type']) ? $_POST['type'] : "") , 'class="form-control input-tip" id="type" data-placeholder="'. $this->lang->line("select type") .'"'); ?>
							</div>
                        </div>
						
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="warehouse"><?= lang("warehouse"); ?></label>
                                <?php
								$wh[""] = "ALL";
                                foreach ($swarehouses as $swarehouse) {
                                    $wh[$swarehouse->id] =  $swarehouse->code.' / '.$swarehouse->name;
                                }
                                echo form_dropdown('swarehouse', $wh, (isset($_POST['swarehouse']) ? $_POST['swarehouse'] : ""), 'class="form-control" id="swarehouse" data-placeholder="' . $this->lang->line("select") . " " . $this->lang->line("warehouse") . '"');
                                ?>
                            </div>
                        </div>
						<div class="col-sm-4">
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
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("from_date", "from_date"); ?>
                                <?php echo form_input('from_date', (isset($_POST['from_date']) ? $_POST['from_date'] : $this->erp->hrsd($from_date1)), 'class="form-control date" id="from_date"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("to_date", "to_date"); ?>
                                <?php echo form_input('to_date', (isset($_POST['to_date']) ? $_POST['to_date'] : $this->erp->hrsd($to_date1)), 'class="form-control date" id="to_date"'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                                <div class="form-group">
                                        <label class="control-label" for="user"><?= lang("home_type"); ?></label>
                                        <?php
                                        $pl = array(""=>"ALL");
                                        foreach ($plans as $plan) {
                                            $pl[$plan->id] = $plan->plan;
                                        }
                                        echo form_dropdown('plan', $pl, (isset($_POST['plan']) ? $_POST['plan'] : ''), 'class="form-control" id="empno2" ');
                                        ?>
                                </div>      
                            </div>
						
						<!--<div class="col-sm-4">
                            <div class="form-group">
                                <?= lang("in_out", "in_out"); ?>
                                <?php $in_out = array(''=>lang('IN\OUT'),'in' => lang('in'), 'out' => lang('out'));
                                echo form_dropdown('in_out', $in_out, (isset($_POST['in_out']) ? $_POST['in_out'] : ""), 'class="form-control input-tip" id="in_out" data-placeholder="'.$this->lang->line("Select_in_out").'"'); ?>
							</div>
                        </div>-->
						
                    </div>
					<div class="form-group">
                        <div
                            class="controls"> <?php echo form_submit('submit_report', $this->lang->line("submit"), 'class="btn btn-primary"'); ?> </div>
                    </div>
                    <?php echo form_close(); ?>
					
                </div>
                <div class="clearfix"></div>

                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
							<tr class="primary">
								<th style="wi"></th>
								<th ><?= lang("type") ?></th>
								<th><?= lang("date") ?></th>
								<th ><?= lang("name") ?></th>
								<th ><?= lang("reference") ?></th>
								<th ><?= lang("biller") ?></th>
								<th ><?= lang("qty") ?></th>
								<th ><?= lang("cost") ?></th>
								<th ><?= lang("on_hand") ?></th>
								<th><?= lang("avg_cost") ?></th>
								<th ><?= lang("asset_value") ?></th>
							</tr>
                        </thead>
                        <body>
                            <?php
                            $arr_wh = [];
                            $arr_cat = [];
                            $arr_cat_product = [];

                            if(is_array($inventoryData)) {
                                foreach ($inventoryData as $rw) {
                                    $arr_wh[$rw->warehouse_id] = $rw->warehouse_name;
                                    $arr_cat[$rw->warehouse_id][$rw->category_id] = $rw->category_name;
                                    $arr_cat_product[$rw->warehouse_id][$rw->category_id][$rw->product_id] = [
                                        'product_name' => $rw->product_name
                                    ];
                                }
                            }
                            foreach($arr_wh as $w_id => $w_n){
                            ?>
                                <tr>
                                    <td colspan="12" style="color:green;"><span style="font-size:17px;"><b><?=$w_n;?> </b></span></td>
                                </tr>

                                <?php if(isset($arr_cat)){ foreach($arr_cat[$w_id] as $cat_id => $cat_name){ ?>
                                    <tr>
                                        <td colspan="11" style="color:red;padding-left: 10px;"><span style="font-size:15px;"><b><?=$cat_name;?> </b></span></td>
                                    </tr>

                                    <?php if(isset($arr_cat_product[$w_id][$cat_id])){
                                        foreach($arr_cat_product[$w_id][$cat_id] as $p_id => $rr){

                                    ?>
                                        <tr>
                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$rr['product_name'];?></b></span></td>
                                            <td style="color:black;padding-left: 30px;"><span style="font-size:12px;"><b><?=$p_id;?></b></span></td>

                                        </tr>

                                    <?php }} ?>

                                <?php }} ?>

                            <?php } ?>
                        <body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#form').hide();
    $('.toggle_down').click(function () {
        $("#form").slideDown();
        return false;
    });
    $('.toggle_up').click(function () {
        $("#form").slideUp();
        return false;
    });
	$(document).ready(function(){
		/*
		$("#excel").click(function(e){
			e.preventDefault();
			window.location.href = "site_url('products/getProductAll/0/xls/')?>";
			return false;
		});
		$('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "site_url('products/getProductAll/pdf/?v=1'.$v)?>";
            return false;
        });
		*/
		$('body').on('click', '#multi_adjust', function() {
			 if($('.checkbox').is(":checked") === false){
				alert('Please select at least one.');
				return false;
			}
			var arrItems = [];
			$('.checkbox').each(function(i){
				if($(this).is(":checked")){
					if(this.value != ""){
						arrItems[i] = $(this).val();   
					}
				}
			});
			$('#myModal').modal({remote: '<?=base_url('products/multi_adjustment');?>?data=' + arrItems + ''});
			$('#myModal').modal('show');
        });
		$('#excel').on('click', function (e) {
			
            e.preventDefault();
                window.location.href = "<?= site_url('reports/inventory/0/xls/'.$reference1.'/'.$wahouse_id1.'/'.$product_id1.'/'.$from_date1.'/'.$to_date1.'/'.$stockType1.'/'.$cate_id1.'/'.$biller1) ?>";
                return false;
        });
        $('#pdf').on('click', function (e) {
            e.preventDefault();
                window.location.href = "<?= site_url('reports/inventory/pdf/0'.$reference1.'/'.$wahouse_id1.'/'.$product_id1.'/'.trim($from_date1).'/'.trim($to_date1).'/'.$stockType1.'/'.$cate_id1.'/'.$biller1) ?>";
                return false;  
        });
	});
</script>


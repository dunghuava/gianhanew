<style type="text/css" media="screen">
	#result{
		display: inline-block;
		width: 100%;
		margin-top: 10px;
		padding-top: 10px;
	}
</style>
<section id="breadcrumb" class="section pb0">
	<div class="container">
		<ol class="breadcrumb mb0">
			<li><a href="<?= $domain; ?>" title="<?= SITENAME; ?>"><i class="fa fa-home fa-fw"></i>Trang chủ</a></li>
			<li class="active"><?= $post['title']; ?></li>
		</ol>
	</div>
</section>
<section id="content" class='section'>
	<div class="container">
		<div class="block-big financial">
			<div class="col-sm-7 col-xs-12">
				<h3 class="header-label"><span class="span_point">Thông tin <span class="color_red">vay vốn</span></span></h3>
				<div class='header_info'>
					<h4>ƯỚC TÍNH KHOẢN VAY</h4>
					<span class="text-danger"><small>(*) Bảng tính chỉ mang tính chất tham khảo.</small></span>
				</div>
				<form id="fFinancial" class='form-horizontal' action="<?= $domain.$this->uri->uri_string()?>" method='post'>
					<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
					<div class='form-group'>
						<div class='col-md-12'>
							<div class="input-group">
								<input type='text' id='money' class='form-control' name='money' onkeyup="convert(this);" placeholder='Số tiền bạn cần vay'>
								<span class="input-group-addon">VNĐ</span>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-md-12'>
							<div class="input-group">
								<input class='form-control' id='time' name='time' placeholder='Thời gian vay/tháng'>
								<span class="input-group-addon">Tháng</span>
							</div>
						</div>
					</div>
					<div class='form-group'>
						<div class='col-md-12'>
							<div class="input-group">
								<input type='text' novalidate id='interest' class='form-control' name='interest' placeholder='Lãi suất % năm'>
								<span class="input-group-addon">%/năm</span>
							</div>
						</div>
					</div>
					<button id='count_interest' type='submit' name='btnPayment' class='btn btn_custom btn-primary'><i class='fa fa-usd'></i> Tính lãi vay</button>
				</form>	
			</div>
			<div class="col-sm-5 hidden-xs">
				<img src="<?= $domain.'public/'.$modules.'/images/ngan-hang.jpg'; ?>" alt="" class="img-responsive bank" />
			</div>
			<script type="text/javascript">
				function convert(field){
				    var strk=field.value.trim();
				    str=clearDot(strk);
				    var stmp="";
				    if (str!=""){
				        var l=str.trim().length-1;
				        k=0;
				        for (i=l;i>=0;i--){
				          k++;
				          stmp= str.trim().substr(i,1) + stmp.trim();
				          if (str.trim().substr(i,1)==","){
				             k=0;
				          }
				          if ((k==3)&&(i>0)){
				              k=0;
				            stmp= "," + stmp.trim();
				          }
				        }
				    }
				    field.value=stmp.trim();
				}
				function clearDot(st){
			       var stmp="";
			       if (st.trim()!=""){
			          var l=st.length;
			          for (i=0;i<l;i++){
			             if ((st.trim().substr(i,1)!=".")&&(st.trim().substr(i,1)!="-")&&(!isNaN(st.trim().substr(i,1))))
			              stmp= stmp.trim()+st.trim().substr(i,1);
			          }
			       }
			     return stmp.trim();
			   }

			</script>
			<div class="clearfix"></div>
			<div id="result">
				<div class="col-xs-12">
					<?php if ($this->input->post('money') && $this->input->post('time') && $this->input->post('interest')) { ?>
					<blockquote style="margin-bottom:15px;font-size:14px;">
					  	<p>Số tiền bạn cần vay : <?= number_format(str_replace(',', '', $this->input->post('money')));?> VNĐ</p>
						<p>Thời gian vay/tháng : <?= $this->input->post('time');?> tháng</p>
						<p>Lãi suất % năm :  <?= $this->input->post('interest');?>%/năm</p>
					</blockquote>
					<?php } ?>
					<div class="table_header">
						<div class="col-xs-2 col-md-1 text-center"><b>Kỳ</b></div>
				        <div class="hidden-xs col-md-3 text-center"><b>Số gốc còn lại</b></div>
				        <div class="hidden-xs col-md-3 text-center"><b>Gốc phải trả</b></div>
				        <div class="col-xs-5 col-md-2 text-center"><b>Lãi phải trả</b></div>
				        <div class="col-xs-5 col-md-3 text-center"><b>Tổng gốc + lãi</b></div>
					</div>
					<?php if (!empty($payments)) { ?>
					<div class="table_body">
						<?php foreach ($payments as $key => $payment) { ?>
						<div class="row_le row_table">
							<div class="col-xs-2 col-md-1 text-center"><?= $payment['t'] ?></div>
					        <div class="hidden-xs col-md-3 text-center"><?= $payment['conlai'] ?></div>
					        <div class="hidden-xs col-md-3 text-center"><?= $payment['goctra'] ?></div>
					        <div class="col-xs-5 col-md-2 text-center"><?= $payment['lai'] ?></div>
					        <div class="col-xs-5 col-md-3 text-center"><?= $payment['total'] ?></div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function() {
		$('#count_interest').on('click',function(){
	        var number = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
	        var money = $('#money').val();
	        var time = $('#time').val();
	        var interest = $('#interest').val();
	        if(money==''){
	            $('#money').parent().parent().addClass('has-error');
	            $('#money').focus();
	            return false;
	        }else{
	            $('#money').parent().parent().removeClass('has-error');
	        }
	        if(time==''){
	            $('#time').parent().parent().addClass('has-error');
	            return false;
	        }else{
	            $('#time').parent().parent().removeClass('has-error');
	        }
	        if(interest==''){
	            $('#interest').parent().parent().addClass('has-error');
	            $('#interest').focus();
	            return false;
	        }else{
	            if(!number.test(interest)){
	                $('#interest').parent().parent().addClass('has-error');
	                $('#interest').focus();
	                return false;
	            }
	            $('#interest').parent().parent().removeClass('has-error');
	        }
	    });
	});
</script>
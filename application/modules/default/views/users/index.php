<div id="trangcanhan">
	<div class="container">
		<div class="top-cart-info" style="position: relative;right: 0;bottom: 0;"></div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row profile">
					<div class="col-md-3">
						<div class="profile-sidebar" style="margin-bottom:5px;">
							<div class="profile-usertitle-name">
								<h3 class="text-center">Trang cá nhân</h3>
							</div>
							<div class="profile-usertitle">
								<?php $this->load->view('default/sidebar_user'); ?>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(document).ready(function() {
							<?php
							if ($this->session->flashdata('success')){
								echo '_toastr("'.$this->session->flashdata('success').'","jGrowl-alert-success")';
							}
							if ($this->session->flashdata('error')){
								echo '_toastr("'.$this->session->flashdata('error').'","jGrowl-alert-danger")';
							}
							?>
						});
					</script>
					<div class="col-md-9 nopadding-lft">
						<div class="profile-content module-user">
							<h1 class="title bar"><span>QUẢN LÝ TIN ĐĂNG</span></h1>
							<div class="module-search">
								<form action="" method="GET" class="form-inline" role="form">
									<div class="form-group">
										<select name="" id="" class="form-control">
											<option value="">-- Loại tin --</option>
											<option value="4" <?= ($this->input->post('sltVipType') == 4) ? 'selected' : ''; ?>>Tin Rao Miễn Phí</option>
                      <!--	<option value="3" <?= ($this->input->post('sltVipType') == 3) ? 'selected' : ''; ?>>Tin vip 3</option>
											<option value="2" <?= ($this->input->post('sltVipType') == 2) ? 'selected' : ''; ?>>Tin vip 2</option>
											<option value="1" <?= ($this->input->post('sltVipType') == 1) ? 'selected' : ''; ?>>Tin vip 1</option>-->
										</select>
									</div>
									<div class="form-group">
										<label class="sr-only" for=""></label>
										<input type="text" class="form-control" id="txttungay" placeholder="Từ ngày" />
									</div>
									<div class="form-group">
										<label class="sr-only" for=""></label>
										<input type="text" class="form-control" id="txtdenngay" placeholder="Đến ngày">
									</div>
									<div class="form-group">
										<select name="sltVipType" class="form-control" id="sltVipType">
											<option value="">Tình trạng</option>
										</select>
									</div>
									<button type="submit" class="btn btn-info btn-blue">Tìm kiếm</button>
								</form>
							</div>
							<!-- End module searhc -->
							<div class="module-search">
								<span class="title">Tìm theo mã tin :</span>
								<form action="" method="GET" class="form-inline" role="form">
									<div class="form-group">
										<label class="sr-only" for=""></label>
										<input type="text" class="form-control" id="matin" placeholder="Nhập mã tin" />
									</div>
									<button type="submit" class="btn btn-info btn-blue">Tìm kiếm</button>
								</form>
							</div>
							<!-- End module searhc -->
							<div class="module-search" style="margin-bottom:0px;">
								<table class="table table-bordered member-table-data">
									<thead>
										<tr>
											<th style="width:12%;" class="text-center">Mã tin</th>
											<th class="text-center">Nội dung</th>
											<th class="text-center" style="width: 10%;">Trạng thái</th>
											<th class="text-center" style="width: 10%;">Ngày đăng</th>
											<th class="text-center" style="width: 10%;">Hết hạn</th>
											<th style="width: 10%;"class="text-center">Thao tác</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!empty($my_realestates)) {
											foreach ($my_realestates as $realestate) {
												?>
												<tr>
													<td class="text-center">
														<?= "<span>".toPublicId($realestate->id)."</span><br><p>".$realestate->type_name."</p>";?>
													</td>
													<td>
														<p><?= ucfirst(mb_convert_case($realestate->title, MB_CASE_LOWER, "UTF-8")); ?></p>
														<div class="form-action text-left">
															<a rel="nofollow" title="Sửa tin" target="_blank" href="<?= $domain.$realestate->slug_cate.'/'.$realestate->title_alias.'-'.toPublicId($realestate->id);?>"><i class="fa fa-eye fa-fw"></i>Xem</a>
															<a title="Sửa tin" href="<?= $domain.'thanh-vien/dang-tin-ban-cho-thue-nha-dat-sua'.toPublicId($realestate->id).'.htm' ?>"><i class="fa fa-pencil fa-fw"></i>Sửa</a>
														</div>
													</td>
													<td class="text-center">Hiển thị</td>
													<td class="text-center"><?= date('d/m/Y',strtotime($realestate->start_date)); ?></td>
													<td class="text-center"><?= date('d/m/Y',strtotime($realestate->end_date)); ?></td>
													<td class="text-center">
														<div class="post_tooltip">
															<a class="btn btn-sm btn-manage rePost" <?= postAgain($realestate->end_date,$realestate->id);?>>
																<i class="fa fa-refresh fa-fw"></i>
															</a>
														</div>
														<div class="post_tooltip">
															<?= upReal($realestate->updated_at,toPublicId($realestate->id));?>
														</div>
														<div class="real-action">
															<a title="Xóa tin" href="javascript:void(0)" rel="<?=toPublicId($realestate->id);?>" onclick="return DeleteNews();" class="btn btn-sm btn-manage btnDelNew">
																<i class="fa fa-trash-o fa-fw"></i>
															</a>
														</div>
													</td>
												</tr>
												<?php
											}
										}else{
											echo "<tr><td colspan='6' class='text-center'>Chưa có tin đăng</td></tr>";
										}
										?>
									</tbody>
								</table>
								<?= isset($link) ? $link : ''; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?= $domain.'public/'.$modules; ?>/js/tips/jquery.bt.css"/>
<script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/tips/jquery.bt.min.js"></script>
<script type="text/javascript" src="<?= $domain.'public/'.$modules; ?>/js/managenews.js"></script>
<script type="text/javascript">
	$(function($) {
		$("button.realUp").click(function(event) {
	    	/* Act on the event */
	    	event.preventDefault();
	        var realestate_id = $(this).attr('data-post');
	        $.post(DIR_ROOT+'default/postting/reset_updated_at', {realestate_id:$(this).attr('data-post')}, function(data, textStatus, xhr) {
	        	/*optional stuff to do after success */
	      		if (data.status == 200){
	      			_toastr(data.message,'jGrowl-alert-sucess');
	      			setTimeout("location.reload(true)", 250);
	      		}else{
	      			_toastr(data.message,'jGrowl-alert-danger');
	      		}
	        },'json');
	    });
	    // this script needs to be loaded on every page where an ajax POST may happen
	    $("a.btnDelNew").click(function() {
	    	/* Act on the event */
	    	__doPostDelete($(this).attr('rel'));
	    });
	    $("a#rePost").click(function(event) {
	    	/* Act on the event */
	    	event.preventDefault();
	    	$.ajax({
	    		url: DIR_ROOT + 'repost.htm',
	    		type: 'POST',
	    		data: {item: $(this).attr('rel')},
	    	})
	    	.done(function(data){
	    		_toastr('Đăng lại thành công','jGrowl-alert-sucess');
	    		setTimeout("location.reload(true)", 2500);
	    	})
	    	.fail(function() {
	    		console.log("error");
	    	});
	    	return false;
	    });
  		// now write your ajax script
  	});
	function __doPostDelete(item)
	{
		$.ajax({
			url: DIR_ROOT + 'destroy.htm',
			type: 'POST',
			async: true,
			dataType:'json',
			data: {item: item}
		})
		.done(function(data) {
			if(data.status == 200){
				location.reload();
				_toastr('Thao tác không thành công vui lòng thử lại sau','jGrowl-alert-sucess');
			}
		})
		.fail(function() {
			console.log("error");
		});

	}
</script>
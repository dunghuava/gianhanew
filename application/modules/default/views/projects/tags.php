<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
				<div class="block-big">
					<div class="col-xs-12">
						<h3 class="title">Tìm kiếm dự án</h3>
						<div class="module-search-project">
							<div class="row clearfix">
								<form action="<?= $domain.'tim-kiem-du-an.htm'; ?>" method="POST" class="form-inline" role="form">
									<div class="form-group col-md-3 nopadding-rgt">
										<select class="form-control" name="sltProjectCate" id="sltProjectCate">
											<?php
												if (!empty($projects_cate)) {
													foreach ($projects_cate as $project_cate) {
											?>
											<option value="<?= $project_cate->id;?>"><?= $project_cate->title; ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>
									<div class="form-group col-md-3 nopadding-rgt">
										<select class="form-control" name="sltProjectProvince" id="sltProjectProvince">
											<option value="-1">-- Tinh/thànhphố --</option>
											<?php
											if (!empty($provinces)) {
												foreach ($provinces as $province) {
											?>
											<option value="<?= $province->province_id ?>"><?= $province->name ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<select class="form-control" name="sltProjectDistrict" id="sltProjectDistrict">
											<option value="-1">-- Quận/huyện --</option>
										</select>
									</div>
									<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
									<input type="submit" name="btnFindProject" class="btn btn-primary btn-blue" value="Tìm kiếm" />
								</form>
								<!-- /.form -->
								<script type="text/javascript">
									function ShowDistrict(elment){
										$.ajax({
											url: DIR_ROOT + 'default/ajax/ajaxShowDistricts',
											type: 'POST',
											data : 'provinceID='+ $("select#sltProjectProvince").val(),
											async : true,
											dataType: 'json'
										})
										.done(function(data){
											if (data != null){
												$(elment).select2('val','Chon danh mục');
												$(elment).html('');
												$(elment).append('<option value="-1">Quận/huyện</option>');
												$.each(data, function(n, t) {
													$(elment).append('<option value="'+t.district_id+'">'+t.name+'</option>');
												});
											}
										})
										.fail(function() {
											console.log("error");
										});
										return false;
									}
									$(function(){
										//ShowDistrict($("#sltProjectDistrict"));
										$("#sltProjectProvince").change(function(event) {
											ShowDistrict($("#sltProjectDistrict"));
										});
										// change
									});
								</script>
							</div>
						</div>
					</div>
					<div class="col-xs-12">
						<h1 class="title bar"><span><?= $meta_title; ?></span></h1>
					</div>
					<!-- Data -->
					<div class="total">
						<?php
						if (!empty($projects)) {
							foreach ($projects as $project) {
						?>
						<div class="col-sm-6 col-md-6 p5">
							<div class="project">
								<div class="post-img">
									<a href="<?= $domain.$project->slug_cate.'/'.$project->title_alias.'.html';?>" title="<?= $project->title ?>">
										<img src="<?= $domain.'uploads/projects/'.$project->image; ?>" class="img-responsive" alt="<?= $project->title ?>" />
									</a>
								</div>
								<h3 class="text-center">
									<a class="post-title" href="<?= $domain.$project->slug_cate.'/'.$project->title_alias.'.html';?>" title="<?= $project->title ?>" title="<?= $project->title ?>"><?= $project->title ?></a>
								</h3>
							</div>
						</div>
						<?php
							}
						}else{
						?>
						<div class="col-xs-12">
							<p class="text-left empty-data">Thông tin đang được cập nhật....</p>
						</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<!-- -->
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="slidebar">
					<?php $this->load->view('default/sidebar'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
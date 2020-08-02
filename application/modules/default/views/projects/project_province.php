<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
				<div class="block-big">
					<div class="col-xs-12">
						<h3 class="sidebar__title">Tìm kiếm dự án</h3>
						<div class="module-search-project">
							<div class="row clearfix">
								<form action="<?= $domain.'tim-kiem-du-an.htm'; ?>" method="POST" class="form-inline" role="form">
									<div class="form-group col-md-3 nopadding-rgt">
										<select class="form-control" name="sltProjectCate" id="sltProjectCate">
											<?php
												if (!empty($projects_cate)) {
													foreach ($projects_cate as $project_cate) {
											?>
											<option value="<?= $project_cate->id;?>" <?= ($project_cate->id == $category->id) ? 'selected' : ''; ?>><?= $project_cate->title; ?></option>
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
											<option value="<?= $province->province_id ?>" <?= ($province_c->province_id == $province->province_id) ? 'selected' : ''; ?>><?= $province->name ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
									<div class="form-group col-md-3">
										<select class="form-control" name="sltProjectDistrict" id="sltProjectDistrict">
											<option value="-1">-- Quận/huyện --</option>
											<?php
											if (!empty($districts)) {
												foreach ($districts as $sltD) {
											?>
											<option value="<?= $sltD->district_id; ?>"><?= $sltD->name;?></option>
											<?php
												}
											}
											?>
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
												$(elment).select2('val','Chọn danh mục');
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
						<h1 class="title bar"><span>Dự án <?= $category->title . ' tại ' . $province_c->name; ?></span></h1>
					</div>
					<!-- Data -->
					<div class="total">
						<?php
						if (!empty($projects)) {
							foreach ($projects as $project) {
						?>
						<div class="col-sm-6 col-md-6">
							<div class="project">
								<div class="post-img">
									<a href="<?= $domain.'du-an/'.$project->title_alias.'-pj'.$project->id; ?>" title="<?= $project->title ?>">
										<img src="<?= image_thumb('uploads/projects/'.$project->image,MAX_WIDTH_PROJECT,MAX_HEIGHT_PROJECT) ?>" class="img-responsive" alt="<?= $project->title ?>" />
									</a>
								</div>
								<h3 class="text-center">
									<a class="post-title" href="<?= $domain.'du-an/'.$project->title_alias.'-pj'.$project->id; ?>" title="<?= $project->title ?>" title="<?= $project->title ?>"><?= $project->title ?></a>
								</h3>
							</div>
						</div>
						<?php
							}
						}else{
						?>
						<div class="col-xs-12">
							<p class="text-center empty-data">Chưa có dữ liệu phù hợp....</p>
						</div>
						<?php
						}
						?>
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-12">
						<?= isset($link) ? $link : ''; ?>
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
<div id="searchs">
    <div class="container">
        <div class="row">
            <section class='filter-search'>
                <div class="col-md02">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul id="tabsearch" class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">TÌM KIẾM DỰ ÁN</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wrap-form bg">
                        <form id="frmsearch" action="<?=$domain.'tim-du-an' ?>" method="get" accept-charset="utf8">
                            <div class="line1">
                                <div class="small-item-s">
                                    <input type="text" name="s" id="tukhoa" placeholder="Từ khóa tìm kiếm" value="">
                                </div>
                                 <div class="small-item-s">
                                    <select name="type" id="type" >
                                    	<option value="0">Chọn kiểu dự án</option>
                                    	<?php if (!empty($projects_cate)) { ?>
	                                    	<?php foreach ($projects_cate as $project_cate) { ?>
	                                    	<option value="<?= $project_cate->id;?>"><?= $project_cate->title; ?></option>
	                                    	<?php } ?>
                                    	<?php } ?>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="city" id="city">
                                    	<option value="0" rel='0' slug=''>-- Tỉnh/Thành phố --</option>
                                    	<?php if (!empty($provinces)) { ?>
	                                    	<?php foreach ($provinces as $province) { ?>
	                                    	<option value="<?= $province->province_id ?>"><?= $province->name ?></option>
	                                    	<?php } ?>
                                    	<?php } ?>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="district" id="district">
                                        <option value="0">-- Quận/huyện --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <button type="submit" class="btn btn-search pull-left" style="width:100%;"><i class="fa fa-search">&nbsp;&nbsp;&nbsp;Tìm kiếm</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
	function ShowDistrict(elment){
		$.ajax({
			url   : DIR_ROOT + 'default/ajax/ajaxShowDistricts',
			type  : 'POST',
			data  : 'provinceID='+ $("select#city").val(),
			async : true,
			dataType: 'json'
		}).done(function(data){
			if (data != null){
				$(elment).select2('val','Chọn kiểu dự án');
				$(elment).html('');
				$(elment).append('<option value="0">Quận/huyện</option>').trigger('change');
				$.each(data, function(n, t) {
					$(elment).append('<option value="'+t.district_id+'">'+t.name+'</option>');
				});
			}
		}).fail(function() {
			console.log("Loading error.....");
		});
		return false;
	}
	$(function(){
		$("#city").change(function(event) {
			ShowDistrict($("#district"));
		});
	});
</script>
<div id="homepage" class="section is_search">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar">
						<span>Dự án <?= ($category->parent_id) ? $category->title : ''; ?></span>
						</h1>
					</div>
					<!-- Data -->
					
					<div class="total">
						<?php if (!empty($projects)) { ?>
						<?php foreach ($projects as $project) { ?>
						<div class="col-sm-6 col-md-6 p5">
							<div class="project">
								<div class="post-img">
									<a href="<?= $domain.$project->category_alias.'/'.$project->title_alias; ?>.html" title="<?= $project->title ?>">
										<img src="<?= image_thumb('uploads/projects/'.$project->image,MAX_WIDTH_PROJECT,MAX_HEIGHT_PROJECT)?>" class="lazy img-responsive" alt="<?= $project->title ?>" />
									</a>
								</div>
								<h3>
									<a class="post-title" href="<?= $domain.$project->category_alias.'/'.$project->title_alias; ?>.html" title="<?= $project->title ?>" title="<?= $project->title ?>"><?= $project->title ?></a>
								</h3>
								<div class="project-desc">
									<?php if (!empty($project->summary)) { ?>
										<p><?php echo stripString($project->summary,160,' [...]') ?></p>
									<?php }else{?>
										<p></p>
									<?php } ?>
								</div>
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
<div class="page-header">
	<div class="page-title text-info text-semibold">
		<h3>
			<span data-icon="&#xe312;"></span>XEM
		</h3>
	</div>
</div>
<!-- /Page header -->
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title"><i class="fa fa-coin"></i> New invoice</h6>
	</div>
	<div class="panel-body">
		<div class="row invoice-header">
			<div class="col-sm-6">
				<h3><?=$realestate->title ?></h3>
				<span><?=$realestate->address?></span>
			</div>
			<div class="col-sm-6">
				<ul class="invoice-details">
					<li>ID # <strong class="text-danger"><?=$realestate->id?></strong></li>
					<li>Start date: <strong><?=$realestate->start_date?></strong></li>
					<li>End date: <strong><?=$realestate->end_date?></strong></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row invoice-payment">
			<form action="<?= $root_site.$this->uri->uri_string() ?>" method="post" accept-charset="utf-8">
				<div class="col-sm-8">
					<h6>Thông tin</h6>
					<?= $realestate->content; ?>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<h6 class="text-success text-uppercase">Duyệt trạng thái</h6>
						<select name="approval" id="approval" class="select-full">
							<?php foreach ($approval as $key => $app) { ?>
							<option value="<?=$app->id;?>"<?= $realestate->approval == $app->id ? 'selected' :'' ?>><?= $app->approval_title ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="btn-group">
						<button type="submit" class="btn btn-info" name="btnUpdate"><i class="icon-checkmark3"></i> Cập nhật!</button>
					</div>
				</div>
				<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash(); ?>" />
			</form>
		</div>
	</div>
</div>
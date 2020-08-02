<?php if ( $advertings = $this->madvertings->getAdvertingInPage(1)){ ?>
	<div class="banner center-block">
		<?php if (count($advertings['top']) == 1) { ?>
			<div class="adverting_top content-banner" style="display:block">
				<?php if ($advertings['top'][0]->adv_type== 'upload'){ ?>
				<a href="<?= $advertings['top'][0]->adv_link ?>" target="_blank" rel='nofollow'>
					<img src="<?= $domain.'/resizer/timthumb.php?src=uploads/advertings/'.$advertings['top'][0]->adv_image?>" class="img-responsive" />
				</a>
				<?php }else{ echo $advertings['top'][0]->adv_code; } ?>
			</div>
		<?php }else{ ?>
			<?php foreach ($advertings['top'] as $key => $top){ ?>
				<div class="adverting_top<?=$key+1?> content-banner" style="display: none">
				<?php if ($top->adv_type== 'upload'){ ?>
					<a href="<?= $top->adv_link ?>" target="_blank" rel='nofollow'>
						<img src="<?= $domain.'/resizer/timthumb.php?src=uploads/advertings/'.$top->adv_image?>" class="img-responsive" />
					</a>
				<?php }else{ echo $top->adv_code; } ?>
				</div>
			<?php } ?>
		<?php } ?>
		
	</div>
<?php } ?>
<?php if (isset($advertings) && count($advertings['top']) > 1) { ?>
	<script type="text/javascript">
		var indexBanner = 1;
		var countBanner = 2;
		if (window.location.pathname === "/") {
			countBanner = 1;
		}else {
			countBanner = 2;
		}
		$('.adverting_top' + indexBanner).show();
		setInterval(function () {
			$('.content-banner').hide();
			indexBanner = indexBanner <= countBanner ? indexBanner + 1 : 1;
			$('.adverting_top' + indexBanner).toggle();
		}, 5000);
	</script>
<?php } ?>

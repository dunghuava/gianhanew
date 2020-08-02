<?php if ($advertings = $this->madvertings->getAdvertingInPage(1)) { ?>
<div class="box">
	<div class="box-content">
		<?php if (count($advertings['bar']) == 1) { ?>
			<?php if ($advertings['bar'][0]->adv_type== 'upload'){ ?>
			<a href="<?= $advertings['bar'][0]->adv_link ?>" target="_blank" rel='nofollow'>
				<img src="<?= $domain.'uploads/advertings/'.$advertings['bar'][0]->adv_image?>" class="img-responsive bar" />
			</a>
			<?php }else{ echo $advertings['bar'][0]->adv_code; } ?>
		<?php }else{ ?>
			<?php foreach ($advertings['bar'] as $key => $bar){ ?>
			<div>
				<?php if ($bar->adv_type== 'upload'){ ?>
				<a href="<?= $bar->adv_link ?>" target="_blank" rel='nofollow'>
					<img src="<?= $domain.'uploads/advertings/'.$bar->adv_image?>" class="img-responsive bar" />
				</a>
				<?php }else{ echo $bar->adv_code; } ?>
			</div>
			<?php } ?>
		<?php } ?>
	</div>
</div>
<?php } ?>

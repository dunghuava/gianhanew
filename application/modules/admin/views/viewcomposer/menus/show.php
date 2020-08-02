<?php $this->load->model('mmenu_groups'); ?>
<div class="form-group">
    <label for="position" class="col-sm-2 control-label text-right">Vị trí:</label>
    <div class="col-sm-10">
        <select class="select-full" id="position" name="position">
            <option <?= isset($content_block->position) && $content_block->position == 'pre-footer-1' ? 'selected' : ''; ?> value="pre-footer-1">pre-footer-1</option>
            <option <?= isset($content_block->position) && $content_block->position == 'pre-footer-2' ? 'selected' : ''; ?> value="pre-footer-2">pre-footer-2</option>
            <option <?= isset($content_block->position) && $content_block->position == 'pre-footer-3' ? 'selected' : ''; ?> value="pre-footer-3">pre-footer-3</option>
            <option <?= isset($content_block->position) && $content_block->position == 'pre-footer-4' ? 'selected' : ''; ?> value="pre-footer-4">pre-footer-4</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Nhóm menu :</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[group_id]">
            <?php  if($this->mmenu_groups->getList()) { ?>
                <?php foreach ($this->mmenu_groups->getList() as $menu_group) { ?>
                <option <?= isset($content_block) && isset(json_decode($content_block->params)->group_id) && json_decode($content_block->params)->group_id == $menu_group->id ? 'selected' : ''; ?> value="<?= $menu_group->id; ?>">|-- <?= $menu_group->title; ?></option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Kiểu hiển thị:</label>
    <div class="col-sm-10">
        <select class="select-full" name="params[template]">
            <option value="vertical_show" <?= isset($content_block) && isset(json_decode($content_block->params)->template) && json_decode($content_block->params)->template == 'vertical_show' ? 'selected' : ''; ?>>|-- Theo chiều dọc</option>
        </select>
    </div>
</div>
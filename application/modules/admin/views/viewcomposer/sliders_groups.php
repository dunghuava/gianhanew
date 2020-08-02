<div class="form-group">
<label for="title" class="col-sm-2 control-label text-right">Nhóm hình ảnh<span class="mandatory">*</span>:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[groups]">
            <?php 
            if (!empty($sliders_groups)) {
                foreach ($sliders_groups as $groups) {
                    ?>
                    <option value="<?= $groups->id; ?>">|-- <?= $groups->title; ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="position" class="col-sm-2 control-label text-right">Vị trí:</label>
    <div class="col-sm-10">
        <select class="select-full" id="position" name="position">
            <option <?= $this->input->post('position') == 'home-block-1' ? 'selected' : ''; ?> value="home-block-1">home-block-1</option>
            <option <?= $this->input->post('position') == 'home-block-2' ? 'selected' : ''; ?> value="home-block-2">home-block-2</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Nhóm dự án :</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[category_id]">
            <?php
            if (isset($content_block) && isset(json_decode($content_block->params)->category_id))
                callMenu($this->mcategory->get_all_categories('project'),0,'|--',json_decode($content_block->params)->category_id);
            else
                callMenu($this->mcategory->get_all_categories('project'));
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Bao gồm nhóm con:</label>
    <div class="col-sm-10">
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type="radio" name="params[include_sub_cates]" class="styled" value="1" checked="checked" /> Có
            </label>
            <label class="radio-inline">
                <input type="radio" name="params[include_sub_cates]" class="styled" value="0" /> Không
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Chỉ bài viết nổi bật:</label>
    <div class="col-sm-10">
        <div class="col-sm-10">
            <label class="radio-inline">
                <input type="radio" <?= isset($content_block) && isset(json_decode($content_block->params)->feature_only) && json_decode($content_block->params)->feature_only == 1 ? "checked" : 'checked' ?> name="params[feature_only]" class="styled" value="1" checked="checked" /> Có
            </label>
            <label class="radio-inline">
                <input type="radio" <?= isset($content_block) && isset(json_decode($content_block->params)->feature_only) && json_decode($content_block->params)->feature_only == 0 ? 'checked' : '' ?> name="params[feature_only]" class="styled" value="0" /> Không
            </label>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="params[amount_of_data]" class="col-sm-2 control-label text-right">Số lượng bài viết:</label>
    <div class="col-sm-10">
        <input class="form-control" name="params[amount_of_data]" value="4" type="text">
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Sắp xếp theo:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[orderBy]">
            <option value="title" <?= isset($content_block) && isset(json_decode($content_block->params)->orderBy) && json_decode($content_block->params)->orderBy == 'title' ? "selected" : '' ?>>|-- Tên bài viết</option>
            <option value="created_at" <?= isset($content_block) && isset(json_decode($content_block->params)->orderBy) && json_decode($content_block->params)->orderBy == 'created_at' ? "selected" : '' ?>>|-- Ngày tạo</option>
            <option value="updated_at" <?= isset($content_block) && isset(json_decode($content_block->params)->orderBy) && json_decode($content_block->params)->orderBy == 'updated_at' ? "selected" : '' ?>>|-- Ngày cập nhật</option>
            <option value="hits" <?= isset($content_block) && isset(json_decode($content_block->params)->orderBy) && json_decode($content_block->params)->orderBy == 'hits' ? "selected" : '' ?>>|-- Lượt xem</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Sắp xếp:</label>
    <div class="col-sm-10">
        <select class="select-full" name="params[direction]">
            <option value="asc" <?=isset($content_block) && json_decode($content_block->params)->direction == 'asc' ? "selected" : '';?>>|-- Tăng dần</option>
            <option value="desc" <?=isset($content_block) && json_decode($content_block->params)->direction == 'desc' ? "selected" : '';?>>|-- Giảm dần</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Nhóm bài viết<span class="mandatory">*</span>:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[category_id]">
           <?php callMenu($category,0,'|--',$this->input->post('category_id')); ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Sắp xếp theo:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[orderBy]">
            <option value="title">Tên bài viết</option>
            <option value="created_at">Ngày tạo</option>
            <option value="updated_at">Ngày cập nhật</option>
            <option value="hits">Lượt xem</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Chiều sắp xếp:</label>
    <div class="col-sm-10">
        <select class="select-full" name="params[direction]">
            <option value="asc">Tăng dần</option>
            <option value="desc">Giảm dần</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="params[amount_of_data]" class="col-sm-2 control-label text-right">Số lượng dữ liệu:</label>
    <div class="col-sm-10">
        <input class="form-control" name="params[amount_of_data]" value="4" type="text">
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Kiểu Layout:</label>
    <div class="col-sm-10">
        <select class="select-full" name="params[kieuLayout]">
            <option value="1">|-- Kiểu 1</option>
            <option value="2">|-- Kiểu 2</option>
            <option value="3">|-- Kiểu 3</option>
        </select>
    </div>
</div>
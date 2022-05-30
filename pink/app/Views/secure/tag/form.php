<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Tag Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Tag Name" value="<?php echo set_value('name', (isset($item) ? $item->name : '')) ?>" onkeyup="convertToSlug(this.value, true, 'slug')" />
        <?php if (isset($validation) && $validation->hasError('name')): ?>
            <span class="text-danger"><?php echo $validation->getError('name'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
        <textarea class="form-control" placeholder="Description" name="description" id="description" value="<?php echo set_value('description', (isset($item) ? $item->description : '')) ?>"><?php echo set_value('description', (isset($item) ? $item->description : '')) ?></textarea>
         <?php if (isset($validation) && $validation->hasError('description')): ?>
            <span class="text-danger"><?php echo $validation->getError('description'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
        <select class="form-control custom-select" id="status" name="status">
            <option disabled="">Select Status</option>
            <option value="ENABLE" <?php echo isset($item) && $item->status == 'ENABLE' ? 'selected' : '' ?>>ENABLE</option>
            <option value="DISABLE" <?php echo isset($item) && $item->status == 'DISABLE' ? 'selected' : '' ?>>DISABLE</option>
            <option value="BLOCK" <?php echo isset($item) && $item->status == 'BLOCK' ? 'selected' : '' ?>>BLOCK</option>
        </select>
         <?php if (isset($validation) && $validation->hasError('status')): ?>
            <span class="text-danger"><?php echo $validation->getError('status'); ?></span>
        <?php endif ?>
    </div>
</div>
<button type="submit" name="submit" value="submit" class="btn btn-primary pl-4 pr-4 mt-3">Submit</button>
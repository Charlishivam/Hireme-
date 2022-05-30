<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo set_value('name', (isset($item) ? $item->name : '')) ?>" onkeyup="convertToSlug(this.value, true, 'slug')" />
        <?php if (isset($validation) && $validation->hasError('name')): ?>
        	<span class="text-danger"><?php echo $validation->getError('name'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Slug</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="<?php echo set_value('slug', (isset($item) ? $item->slug : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('slug')): ?>
        	<span class="text-danger"><?php echo $validation->getError('slug'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-10">
        <select class="form-control" id="category" name="category">
            <option value="" selected="" disabled="" hidden="">Select Category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->slug ?>" <?php echo !empty($item->category_id) && $item->category_id == $category->slug ? 'selected' : ''  ?>><?php echo $category->name ?></option>
            <?php endforeach ?>
        </select>
        <span class="text-danger"><?php echo $validation->getError('category'); ?></span>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Tag</label>
    <div class="col-sm-10">
        <select class="form-control" id="tag" name="tag">
            <option value="" selected="" disabled="" hidden="">Select Tag</option>
            <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag->id ?>" <?php echo !empty($item->tag_id) && $item->tag_id == $tag->id ? 'selected' : ''  ?>><?php echo $tag->name ?></option>
            <?php endforeach ?>
        </select>
        <span class="text-danger"><?php echo $validation->getError('tag'); ?></span>
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
    <label for="" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo set_value('price', (isset($item) ? $item->price : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('price')): ?>
            <span class="text-danger"><?php echo $validation->getError('price'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Discount</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="<?php echo set_value('discount', (isset($item) ? $item->discount : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('discount')): ?>
            <span class="text-danger"><?php echo $validation->getError('discount'); ?></span>
        <?php endif ?>
    </div>
</div>
<?php echo $this->include('partials/backend/imagecrop') ?>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Start Date</label>
    <div class="col-sm-6">
        <input type="date" class="form-control" id="startdate" name="startdate" placeholder="Start Date" value="<?php echo set_value('startdate', (isset($item) ? $item->startdate : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('startdate')): ?>
            <span class="text-danger"><?php echo $validation->getError('startdate'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">End Date</label>
    <div class="col-sm-6">
        <input type="date" class="form-control" id="enddate" name="enddate" placeholder="End Date" value="<?php echo set_value('enddate', (isset($item) ? $item->enddate : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('enddate')): ?>
            <span class="text-danger"><?php echo $validation->getError('enddate'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Icon <br><a href="https://boxicons.com/" target="_blank"><small>Click to check icons</small></a></label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon (e.g <i class='bx bx-category'></i>)" value="<?php echo set_value('icon', (isset($item) ? $item->icon : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('icon')): ?>
        	<span class="text-danger"><?php echo $validation->getError('icon'); ?></span>
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
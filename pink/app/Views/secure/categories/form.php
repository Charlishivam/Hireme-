<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Category Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="<?php echo set_value('name', (isset($item) ? $item->name : '')) ?>" onkeyup="convertToSlug(this.value, true, 'slug')" />
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
    <label for="" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
       <textarea class="form-control" placeholder="Description" name="description" id="description" value="<?php echo set_value('description', (isset($item) ? $item->description : '')) ?>"><?php echo set_value('description', (isset($item) ? $item->description : '')) ?></textarea>

         <?php if (isset($validation) && $validation->hasError('description')): ?>
            <span class="text-danger"><?php echo $validation->getError('description'); ?></span>
        <?php endif ?>
    </div>
</div>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Categeory Type</label>
    <div class="col-sm-10">
        <select class="form-control custom-select" id="type" name="type">
            <option selected="selected" value="" disabled="">Select Type</option>
            <option value="CELEBRATION" <?= set_select('type', 'CELEBRATION') ?><?php echo isset($item) && $item->type == 'CELEBRATION' ? 'selected' : '' ?>>CELEBRATION</option>
            <option value="FESTIVAL" <?= set_select('type', 'FESTIVAL') ?><?php echo isset($item) && $item->type == 'FESTIVAL' ? 'selected' : '' ?>>FESTIVAL</option>
            <option value="POLITICAL" <?= set_select('type', 'POLITICAL') ?><?php echo isset($item) && $item->type == 'POLITICAL' ? 'selected' : '' ?>>POLITICAL</option>
        </select>
         <?php if (isset($validation) && $validation->hasError('type')): ?>
            <span class="text-danger"><?php echo $validation->getError('type'); ?></span>
        <?php endif ?>
    </div>
</div>
<div id="partyDiv" class="hide">
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Party Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="party" name="party" placeholder="Enter Party Name" value="<?php echo set_value('party', (isset($item) ? $item->party : '')) ?>" />
            <?php if (isset($validation) && $validation->hasError('party')): ?>
                <span class="text-danger"><?php echo $validation->getError('party'); ?></span>
            <?php endif ?>
        </div>
    </div>
</div>
<?php echo $this->include('partials/backend/imagecrop') ?>
<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Event Date</label>
    <div class="col-sm-6">
        <input type="date" class="form-control" id="eventdate" name="eventdate" placeholder="Start Date" value="<?php echo set_value('eventdate', (isset($item) ? $item->eventdate : '')) ?>" />
         <?php if (isset($validation) && $validation->hasError('eventdate')): ?>
            <span class="text-danger"><?php echo $validation->getError('eventdate'); ?></span>
        <?php endif ?>
    </div>
</div>
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
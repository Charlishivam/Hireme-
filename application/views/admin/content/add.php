  <!-- Content Wrapper. Contains page content -->

  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>  
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add New Content </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/content'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Content List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart(base_url('admin/content/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="content_title" class="col-md-2 control-label">Content Title</label>

                <div class="col-md-12">
                  <input type="text" name="content_title" class="form-control" id="content_title" placeholder="Enter Content Title">
                </div>
              </div>
              <div class="form-group">
                <label for="customFile" class="col-md-2 control-label">Content Description</label>
                <div class="col-md-12">
                  <textarea name="content_description" class="form-control"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="seo_title" class="col-md-2 control-label">Content Seo Title</label>

                <div class="col-md-12">
                  <input type="text" name="seo_title" class="form-control" id="seo_title" placeholder="Enter Seo Title">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label for="seo_description" class="col-md-6 control-label">Content Seo Description</label>

                  <div class="col-md-12">
                    <textarea name="seo_description" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="seo_keywords" class="col-md-6 control-label">Content Seo Keywords</label>
                  <div class="col-md-12">
                    <textarea name="seo_keywords" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              </div>

               <div class="form-group">
                <label for="customFile" class="col-md-2 control-label">Content Image</label>
                <div class="custom-file col-md-12">
                  <input type="file" name="content_image" class="custom-file-input" id="imgInp_product">
                  <label class="custom-file-label" for="imgInp_product">Choose file</label>
                </div>
              </div>

  
            
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add content" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>

  <script>
    CKEDITOR.replace('editor1')
</script>

 <script>
    CKEDITOR.replace('editor2')
</script>

 <script>
    CKEDITOR.replace('editor3')
</script>
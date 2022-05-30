  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Add Date </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/FoodType'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  Date List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart(base_url('admin/dashboard/adddate'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="cat_name" class="col-md-2 control-label"> Add Date</label>

                <div class="col-md-6">
                  <input type="date" name="start_date" min="1980-01-01" onfocusout="getDate()"  class="form-control" id="start_date" placeholder="">
				</div>
				
				
			  </div>
			  

			  <div class="form-group">
                <label for="cat_name" class="col-md-2 control-label"> End date</label>

                <div class="col-md-6">
                  <input type="date" name="end_date"  class="form-control" id="end_date" placeholder="">
                </div>
              </div>
              
           
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Date" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>

  <script>

function getDate(){

	var start_date=$("#start_date").val();
	console.log(start_date);

	var today = new Date(start_date);
var dd = today.getDate()+1;
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("end_date").setAttribute("min", today);


}
	  
	  
	  
	  
	  
	  </script>

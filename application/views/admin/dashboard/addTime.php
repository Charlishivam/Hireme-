  <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- jQuery timepicker library -->
<link rel="stylesheet" href="jquery-timepicker/jquery.timepicker.min.css">
<script src="jquery-timepicker/jquery.timepicker.min.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Create Schedule</h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/dashboard/time'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Back To List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open_multipart(base_url('admin/dashboard/addTime'), 'class="form-horizontal"');  ?> 
              <div class="form-group row">
                <!--<label for="cat_name" class="col-md-2 control-label text-right"> Start Date</label>-->
                <!--<div class="col-md-4">-->
                <!--  <input type="date" name="strat_date" class="form-control"  id="strat_date"/>-->
                <!--</div>-->

                <label for="cat_name" class="col-md-2 control-label text-right"> Start Time</label>
                <div class="col-md-4">
                  <input type="text" name="strat_time" class="form-control"  id="kt_timepicker_1_validate"/>
                </div>
               </div>
        
              <div class="form-group row">
                <!--<label for="cat_name" class="col-md-2 control-label text-right"> End Date</label>-->
                <!--<div class="col-md-4">-->
                <!--  <input type="date" name="end_date" class="form-control"  id="end_date"/>-->
                <!--</div>-->
                <label for="cat_name" class="col-md-2 control-label text-right"> End Time</label>
                <div class="col-md-4">
                  <input type="text" name="end_time" class="form-control"  id="kt_timepicker_2_validate"/>
                </div>
              </div>
           
              <div class="form-group row">
                <div class="col-md-6 text-right">
                  <input type="submit" name="submit" value="Save Schedule" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>

  <script>
  
  /*$('#input_time').datetimepicker({
        showOn: "button",
        showSecond: true,
        dateFormat: "dd-mm-yy", 
        timeFormat: "HH:mm:ss"
    }); */

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
      $(document).ready(function(){
      $('#start_time').timepicker({
          timeFormat: 'HH:MM:ss',

          minTime: '10',
          maxTime: '8:00pm',
          startTime: '09:00'
      });
  });

      $(document).ready(function(){
      $('#end_time').timepicker({
          timeFormat: 'HH:MM:ss',

          minTime: '10',
          maxTime: '6:00pm',
          startTime: '10:00',
          defaultTime: '11'
      });
  });
</script>


<!--<form className={classes.container} noValidate>
  <TextField
    id="time"
    label="Alarm clock"
    type="time"
    defaultValue="07:30"
    className={classes.textField}
    InputLabelProps={{
      shrink: true,
    }}
    inputProps={{
      step: 300, // 5 min
    }}
  />
</form>-->

<script>

 var KTBootstrapTimepicker = function () {

       // Private functions
       var demos = function () {
        // validation state demos
        // minimum setup
        $('#kt_timepicker_1_validate, #kt_timepicker_2_validate').timepicker({
         minuteStep: 1,
         //showSeconds: true,
         showMeridian: false,
         snapToStep: true
        });
       }

       return {
        // public functions
        init: function() {
         demos();
        }
       };
      }();

      jQuery(document).ready(function() {
       KTBootstrapTimepicker.init();
      });
      
</script>


<?php 
$ticket_id=0;
//print_r($chat );
?>
<div class="">
	
	<div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
		
		<div class="card card-custom">
			
		</div>
		
	</div>
	
	<div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
		
		<div class="card card-custom">
			
			<div class="card-header align-items-center px-4 py-3">
			    
			    
				<div class="text-left flex-grow-1">
				
					
				</div>
				<div class="text-center flex-grow-1">
					<div class="text-dark-75 font-weight-bold font-size-h5">Admin</div>
					<div> <span class="label label-sm label-dot label-success"></span> <span class="font-weight-bold text-muted font-size-sm">Active</span> </div>
				</div>
				<div class="text-right flex-grow-1">
					
					
				</div>
			</div>
			
			<div class="card-body"  style='max-height: 460px;overflow: auto;'>
				
				<div class="scroll scroll-pull" data-mobile-height="350" id="scrl">
					
					<div class="messages">
						
						<?php foreach($chat as $message) { 
						    $ticket_id=$message['ticket_id'];
						if($message['from_type']==1){
						?>
						<!--begin::Message In-->
						<div class="d-flex flex-column mb-5 align-items-start">
							<div class="d-flex align-items-center">
								<div class="symbol symbol-circle symbol-40 mr-3"> <img alt="Pic" src="<?= base_url('uploads/images/avtar.png' ); ?>" /> </div>
								<div> <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">user</a> <span class="text-muted font-size-sm"><?=date('M-d h:i a',strtotime($message['created_at'])) ?></span> </div>
							</div>
							<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px"><?=$message['message'] ?></div>
						</div>
						<!--end::Message In-->
						<?php }else if($message['from_type']==3){
						?>
						<!--begin::Message Out-->
						<div class="d-flex flex-column mb-5 align-items-end">
							<div class="d-flex align-items-center">
								<div> <span class="text-muted font-size-sm"><?=date('M-d h:i a',strtotime($message['created_at'])) ?></span> <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a> </div>
								<div class="symbol symbol-circle symbol-40 ml-3"> <img alt="Pic" src="<?= base_url('uploads/images/avtar.png' ); ?>" /> </div>
							</div>
							<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px"><?=$message['message'] ?></div>
						</div>
						<!--end::Message Out-->
						<?php } } ?>
						
						
					</div>
					<!--end::Messages-->
				</div>
				<!--end::Scroll-->
			</div>
			<!--end::Body-->
			<!--begin::Footer-->
			<div class="card-footer align-items-center">
				<!--begin::Compose-->
				<textarea class="form-control border-0 p-0 typebox" rows="2" placeholder="Type a message" id="message"></textarea>
				<div class="d-flex align-items-center justify-content-between mt-5">
					<div class="mr-3">
						<!--<a href="#" class="btn btn-clean btn-icon btn-md mr-1"> <i class="flaticon2-photograph icon-lg"></i> </a>
						<a href="#" class="btn btn-clean btn-icon btn-md"> <i class="flaticon2-photo-camera icon-lg"></i> </a>-->
					</div>
					<div>
						<button class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6 " id="send" onclick="sendmessage(<?= $ticket_id; ?>)" >Send</button>
					</div>
				</div>
				<!--begin::Compose-->
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Content-->
</div>
<!--end::Chat-->
<script>
//$('#scrl').scrollTop($('#scrl')[0].scrollHeight);
    
       $(document).ready(function() {
               $('#kt_chat_content').scrollTop($('#kt_chat_content').height());
           
      });
    
</script>
    
<script>
    function sendmessage(ticket_id){
        
        var message = $('#message').val();
         $.ajax({
           type: "POST",
          url: "<?= base_url('admin/HelpSupport/chatRepply') ?>",
          data: {'ticket_id':ticket_id,'message':message},
          cache: false,
          success: function(e){
             var data = $.parseJSON(e);
             $('.typebox').val('');
             $('.messages').empty();
              for (var i = 0; i < data.length; i++) {
                  if(data[i].from_type==1){ //user
                      $('.messages').append('<div class="d-flex flex-column mb-5 align-items-start"><div class="d-flex align-items-center"><div class="symbol symbol-circle symbol-40 mr-3"> <img alt="Pic" src="<?= base_url('uploads/images/avtar.png' ); ?>" /> </div><div><a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">user</a> <span class="text-muted font-size-sm">'+data[i].created_at+'</span></div></div><div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">'+data[i].message+'</div></div>');
                  }else if(data[i].from_type==3){//admin
                      $('.messages').append('<div class="d-flex flex-column mb-5 align-items-end"><div class="d-flex align-items-center"><div><span class="text-muted font-size-sm">'+data[i].created_at+'</span> <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a> </div><div class="symbol symbol-circle symbol-40 ml-3"> <img alt="Pic" src="<?= base_url('uploads/images/avtar.png' ); ?>" /> </div></div><div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">'+data[i].message+'</div></div>');
                      
                      
                  }
             }
          }
        });
    }
    
    
  
    
    
</script>
/*var l = window.location;
var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1]+"/";
*/
 $( document ).ready(function() {
	$(".modal").find(".modal-header").css("background", "#696903");
	//$(".modal").find(".modal-content").css("border","4px solid #167ee6");
	$(".modal").find(".modal-title").css("color","white").css({"padding":"5px 15px","line-height":"22px","font-size":"18px","text-align":"left","margin":"0"});
	$(".modal").find(".close").css("margin-top","1%").css("margin-right","1%");
	$('html, body').find("input[type='file']").css("border","none"); 
	$('html, body').find(".c-select").addClass("btn-custom").css("margin-top","18px"); 
	$('.c-select').find('option').css("height", "25px");
	$('html, body').find(".panel_toolbox").css("border-radius","5px").css("background","#169F85"); 
	$('html, body').find(".glyphicon-pencil").css("color","white"); 
	$('html, body').find(".glyphicon-trash").css("color","white"); 
	$('html, body').find(".btn-success").css("border-radius","5px");
	$('.modal').find(".btn-info").css("border-radius","5px");
	$('html, body').find(".btn").css("border-radius","5px");
	$('html, body').find(".disableButton").prop('disabled', false);
	$('#action').hide();
	$('html, body').find("iframe").css("width","500px").css("width","147px");
 //$("#txtEditor").Editor(); 
});

//----------Dynamic Function Start Here-----------------		
	function showModal(modalId){
		$('#'+modalId).modal('show');
		}
		
		function lockModal(modalId){
		$('#'+modalId).modal({
                backdrop: 'static',
                keyboard: false,
            })
	}
	
	function colse_modal(modalId){
		$('#'+modalId).modal('hide');	
		$("#action option:selected").removeAttr("selected");
		$('input[type="checkbox"]:checked').removeAttr('checked');	
		$('#customButton').hide();	
	}
	function close_modal(modalId){
		$('#'+modalId).modal('hide');	
		$("#action option:selected").removeAttr("selected");
		$('input[type="checkbox"]:checked').removeAttr('checked');	
		$('#customButton').hide();	
	}
	
//--------For Select all checkbox--------------------

 function selectAll(selectAllClass,singlClass){
 
	  $('.'+selectAllClass).parent()
			.parent()
			.parent()
			.parent()
			.find('input[class='+singlClass+']:checkbox')
			.each(function(){ 
				if($('input[class='+selectAllClass+']:checkbox:checked').length == 0){ 
					$(this).prop("checked", false );
					 //$('#customButton').hide();	
                    //$(this).val('0');
				} else {
					$(this).prop("checked", true);
					//$('#customButton').show();
                   // $(this).val('1');
				} 
			});
	 
 }
 
 //--------For Select single checkbox--------------------
 
 function singleSelect(){
	if($('input[type="checkbox"]:checked').length>0){
			 
			$('#customButton').show();
			$('#action').show();
		 }else{
			
		 $('#customButton').hide();	
		 $('#action').hide();
		 } 
		if($('input[type="checkbox"]:checked').length>1){
			swal('Please select at least one Record')
			$('input[type="checkbox"]:checked').prop("checked", false );
			$('#customButton').hide();	
		}
		 
         /* $('.surveyorcheck').val('.surveyorcheck'.checked ? "1" : "0" );
		 if($('input[type="checkbox"]:checked').length>0){
			$('#allowActiveButton').show();
		 }else{
		 $('#allowActiveButton').hide();	
		 }  */
 }

function postAndRedirect(url, postData)
	{
		
		var postFormStr = "<form method='POST' action='" + url + "'>\n";

		for (var key in postData)
		{
			if (postData.hasOwnProperty(key))
			{
				postFormStr += "<input type='hidden' name='" + key + "' value='" + postData[key] + "'></input>";
				
			}
		}
		
		postFormStr += "</form>";
		var formElement = $(postFormStr);
		$('body').append(formElement);
		$(formElement).submit();
	}
	
	function resetForm(formId){
			$('.append').remove();
			$('#'+formId)[0].reset();
			$('#'+formId).find('input[type=file]').attr('src',base_url+'assets/admin/assets/images/noimage.png');
			$('.imagePreview').attr('src',base_url+'assets/admin/assets/images/noimage.png')
			$('#updatedId').val('');
		}

	function showLoader(){
			var imgsrc=base_url+"themes/default/admin/assets/images/ajax-loader.gif";
			$.blockUI({message:'<h1><img src='+imgsrc+' align="absmiddle" style="height: auto; width: 42px;" class="loading"/></h1>'});
			$("#flash").show();
		}

	function hideLoader(){
			$("#flash").hide();
			 $(document).ajaxStop($.unblockUI);
		}
	
 
	function appendMessageBody(formId){
		$('.append').remove();
		$('#'+formId+' .messageAppend').remove();
		$('#'+formId).before("<div class='messageAppend'><div class='portlet-body form' id='scr2'>"+
			"<div id='succ2' style='display: none;'>"+
				"<div class='alert alert-success'>"+
					"<strong>Success!</strong><span id='success2'></span>"+ 
				"</div>"+
			"</div>"+
			"<div style='display: none;' id='err2'>"+
				"<div class='alert alert-danger'>"+
					"<strong>Error!</strong> <span id='error2'></span>"+
				"</div>"+
			"</div>"+
			
		"</div></div>");
		}
	 function showSuccessMessage(formId,msg){
	 	$('.append').remove();
				$("#error2").html("");
                $("#success2").html(msg);
                $('#err2').css({'display': 'none'});
                $('#succ2').css({'display': 'block'});
                $('html, body').animate({
                    scrollTop: $("#scr2").first().offset().top - 250
                }, 1000);
                $('#'+formId)[0].reset();
					setTimeout(
                        function ()
                        {	
							$('#succ2').css({'display': 'none'})
							$('.messageAppend').remove();
							//$('#'+formId).find(".btn-default").click();
						//location.reload();
						
                        }, 4000);	
				}
	function showErrorMessage(formId,msg){
		$('.append').remove();
	
		$.each(msg,function (index, val) {
                var type = $("#" + index).prop("tagName");
				
                var parent = $("#" + index).parent();
					//$(parent' .append').remove();
           $('<span class="required err-msg append" id="err-pan" aria-required="true"> ' + val + ' </span>').appendTo(parent);
                    //$("" + type + "[name=" + index + "]").parent().addClass("has-error") 
               });
			   
			   /* setTimeout(function () {
                  $('.err-msg').fadeOut();
				  $('html, body').find(".disableButton").prop('disabled', false);
             }, 5000); */

             	$('html, body').animate({
                    scrollTop: $("#scr2").first().offset().top - 250
                }, 1000);
	}
		
		
	function showDatabaseErrorMessage(formId,msg){
		$('.append').remove();
		$("#error2").html(msg);
		$("#success").html("");
		$('#err2').css({'display': 'block'});
		$('#succ2').css({'display': 'none'});
		
		$('html, body').animate({
			scrollTop: $("#scr2").first().offset().top - 250
		}, 1000);
		setTimeout(
				function ()
				{	
				 $('#err2').css({'display': 'none'})
				
				}, 5000);
		}
	

	//--- it will display only success message where form not available
	 function successMessage(formId,msg){
	 			$('.append').remove();
				$("#error2").html("");
                $("#success2").html(msg);
                $('#err2').css({'display': 'none'});
                $('#succ2').css({'display': 'block'});
                $('html, body').animate({
                    scrollTop: $("#scr2").first().offset().top - 250
                }, 1000);
                //$('#'+formId)[0].reset();
					setTimeout(
                        function ()
                        {	
							$('#succ2').css({'display': 'none'})
							//$('#'+formId).find(".btn-default").click();
						//location.reload();
						
                        }, 4000);	
				}
	//--------For Show selected image --------------->

function showimagepreview(input) {
	
    if (input.files && input.files[0]) {
	    var filerdr = new FileReader();
	    filerdr.onload = function(e) {
	    	$('#imgprvw').attr('src', e.target.result);
			//console.log($('#imgprvw').attr('src', e.target.result));
	    }
	    filerdr.readAsDataURL(input.files[0]);
    }
	
   }
//--------------------------Selected Checkbox id-----------------//
	function getSelectdCheckboxId(clas)
	{
		
		var Ids=[];
			$('input[class="'+clas+'"]:checked').each(function(){
				var Id=$(this).attr("id");
				 Ids.push(Id);
			});	
		
		return Ids
	}


	//--------------------------Selected Checkbox value using class -----------------//
	function getSelectdCheckboxVal(clas)
	{
		var Ids=[];
		$('input:checkbox.'+clas).each(function () {
           	var sThisVal = (this.checked ? $(this).val() : "");
            Ids.push(sThisVal);
      	});
		
		return Ids
	}
	
	
//----------To Save data -----------------		
		
function saveRecord(formId,url)
{
	
	//alert(base_url);
    var form = $('#'+formId)[0]; // You need to use standart javascript object here
    var formData = new FormData(form);

    return $.ajax({
        url: base_url+url,
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
		 beforeSend: function(){
		showLoader();
			}, 
        success: function (obj)
        {
			
		 hideLoader();
        }

    });
}
 
function searchRecord(formId,url)
{
	//alert(base_url);
    var form = $('#'+formId)[0];
    var formData = new FormData(form);
    //console.log(formData);
    return $.ajax({
        url: base_url+url,
        type: "POST",
        //dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
		 beforeSend: function(){
		// showLoader();
			}, 
        success: function (obj)
        {	
		 hideLoader();
        }

    });
}

  //<!--------------For View Data By Selected id------------>
 
 function viewDetailsByData(data,url){
	data=data;
	return $.ajax({
	type:"POST",
	url:base_url+url,
	data:data,
	 beforeSend: function(){
		//showLoader();
			},
		success:function(r){
			 //hideLoader();
		}
	});
}

 //<!--------------For View Data By Selected id------------>
 
 function viewDetails(id,url){

	data={id:id};
	return $.ajax({
	type:"POST",
	url:base_url+url,
	data:data,
	 beforeSend: function(){
		//showLoader();
			},
		success:function(r){
			 //hideLoader();
		}
	});

}


 //<!--------------For View Grid view ------------>

function viewGridView(url){

	return $.ajax({
	type:"POST",
	url:base_url+url,
	 beforeSend: function(){
		//showLoader();
			},
	success:function(r){
			 hideLoader();
		}
	});

} 
 
 
/*var isCtrl = false;
document.onkeyup=function(e)
{
    if(e.which == 17)
    isCtrl=false;
}
document.onkeydown=function(e)
{
    if(e.which == 17)
    isCtrl=true;
    if((e.which == 85) || (e.which == 67) && (isCtrl == true))
    {
        return false;
    }
}
var isNS = (navigator.appName == "Netscape") ? 1 : 0;
if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
function mischandler(){
    return false;
}
function mousehandler(e){
    var myevent = (isNS) ? e : event;
    var eventbutton = (isNS) ? myevent.which : myevent.button;
    if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;  */
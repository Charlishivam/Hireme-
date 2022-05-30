
class customFunction { 
	  constructor() {
			var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1]+"/";
		}
  
  speak() {
   
	//alert(base_url);
  }
  
  viewDetails(){
//alert(base_url);
	/* data={id:id};
	return $.ajax({
	type:"POST",
	url:base_url+url,
	data:data,
	 beforeSend: function(){
		showLoader();
			},
	success:function(r){
			 hideLoader();
		}
		}); */

	} 
	static bar(){ //alert('I am static.'); }
   static get myStaticVariable() {
        //alert("some static variable");
      }
}

class Dog extends customFunction {
  speak() {
    super.speak();
    //console.log(this.name + ' roars.');
  }
}

var d = new customFunction();
//d.viewDetails(); // Mitzie barks.
customFunction.myStaticVariable(); 
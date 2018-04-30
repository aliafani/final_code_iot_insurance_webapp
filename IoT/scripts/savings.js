$(document).ready(function(){
var uid = $('#user_id').val();
$.ajax({
       type:"POST",
        url: "php/fetchsavings.php",
        data :{user_id:uid},
        context: document.body,
        success: function(data){
       var savings = {
		          saving_money: [],
		          date: []
	           };
      var len=data.length;
      console.log(len); 
       for(var i=0; i<len;i++){
        savings.saving_money.push(data[i].savings);
         savings.date.push(data[i].date);
	       }
          var chart1 = $("#line-chartcanvas4");
	var data1={
	labels:savings.date,
  
	datasets:[
	{
  fill: false,
  lineTension: 0,
   backgroundColor: "rgba(25,25,255,0.4)",
  borderColor:"rgb(65, 124, 244)", 
  //pointBackgroundColor:"#f4415b",
	label:'Savings $$',
	data:savings.saving_money
		
	}
	]
	};
	var chart1 = new Chart (chart1,{ 
	type:"line", 
  data:data1,
	options:{
  legend:{
  color:"#f4415b"
  
  }
  }
	
	});
         
        
        
        
        }
        
        });
        
});

 $(document).ready(function(){
 var uid = $('#user_id').val();
$.ajax({ 
        type:"POST",
        url: "php/dashboard.php",
        data :{user_id:uid},
        context: document.body,
        success: function(data){
           var health = {
		          heartrate: [],
		          steps:	 [],
		          healthfactor:   [],
              timestamp: [],
              date: []
	           };
      var len=data.length;
      console.log(len);
      for(var i=0; i<len;i++){
        health.heartrate.push(data[i].heart_rate);
        health.steps.push(data[i].steps_day);
        health.healthfactor.push(data[i].user_health_factor);
        health.timestamp.push(data[i].time_stamp);
         health.date.push(data[i].date);
	}
  var chart1 = $("#line-chartcanvas");
	var data1={
	labels:health.timestamp,
  
	datasets:[
	{
  fill: false,
  lineTension: 0,
   backgroundColor: "rgba(25,25,255,0.4)",
  borderColor:"rgb(65, 124, 244)", 
  //pointBackgroundColor:"#f4415b",
	label:'Heart Rate',
	data:health.heartrate
		
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
    var chart2 = $("#line-chartcanvas2");
	var data2={
	labels:health.date,
  
	datasets:[
	{
  fill: false,
  lineTension: 0,
   backgroundColor: "rgb(0, 204, 0)",
  borderColor:"rgb(0, 204, 0)", 
    pointBackgroundColor:"#663300",
	label:'Steps/day',
	data:health.steps
		
	}
	]
	};
	var chart2 = new Chart (chart2,{ 
	type:"line", 
  data:data2,
	options:{
  
  }
	
	});
    var chart3 = $("#line-chartcanvas3");
	var data3={
	labels:health.date,
  
	datasets:[
	{
  fill: false,
  lineTension: 0,
   backgroundColor: "rgb(0, 204, 0)",
  borderColor:"rgb(0, 204, 0)", 
    pointBackgroundColor:"#663300",
	label:'Health Factor',
	data:health.healthfactor,
  	
		
	}
	]
	};
	var chart3 = new Chart (chart3,{ 
	type:"line", 
  data:data3,
	options:{
  
  }
	
	});
  
  
  
        }});
});
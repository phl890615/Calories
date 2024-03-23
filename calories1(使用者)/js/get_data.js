$(document).ready(function(){  
	// code to get all records from table via select box
	$("#diet_plan").change(function() {    
		var id = $(this).find(":selected").val();
		var dataString = 'diet_plan_id='+ id;    
		$.ajax({
			url: 'get_diet_plan.php',
			dataType: "json",
			data: dataString,  
			cache: false,
			success: function(dietData) {
			   if(dietData) {
				   	$("#errorMassage").addClass
					('hidden').text("");
					$("#recordListing").removeClass
					('hidden');

					
					$("#dietplan_sum").text(dietData.diet_plan_sum);
					$("#dietplan_adv").text(dietData.diet_plan_adv);
					$("#dietplan_dis").text(dietData.diet_plan_dis);
					$("#dietplan_food").text(dietData.diet_plan_food);
					
							 
				} else {

					$("#errorMassage").removeClass
					('hidden').text("請選擇一個飲食法觀看!");
					$("#recordListing").addClass
					('hidden');
					
				}   	
			} 
		});
 	}) 
});
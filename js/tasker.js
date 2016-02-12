//tasker.js
//2016 Novi
//@fb.com/novhz.emo94

$(document).ready(function(){

var taskTitle;
var taskDescr;
var taskID;

//submit task button

	$("#btnAddTask").click(function(){
		taskTitle=$("#title").val();
		taskDescr=$("#descr").val();
		taskDate=$("#txtDate").val();

		if(taskTitle!=='' || taskDescr!==''){
		$.ajax({
			url: 'app/addtask',
			type: 'POST',
			data: 'title='+taskTitle+'&description='+taskDescr+'&date='+taskDate,
			success:function(response){
				if(response==1){
					window.location = window.location.origin+"/calendario";
				}
			}
		});
	}else{
		
		bootbox.alert("Please complete the form!");
	}

	});

//Edit task button

	$("#btnUpdateTask").click(function(){

		taskTitle=$("#title2").val();
		taskDescr=$("#descr2").val();
		taskID=$("#task_id").val();



		$.ajax({
			url: 'app/editask',
			type: 'POST',
			data: 'title='+taskTitle+'&description='+taskDescr+'&id='+taskID,
			success:function(response){
				if(response==1){
					window.location = window.location.origin+"/calendario";
				}
			}
		});


	});

	$("#btnDeleteTask").click(function(){
		


			bootbox.confirm("Are you sure you want to remove this task?",function(response){
				if(response==true){
					$.ajax({
						url: 'app/deletetask',
						type: 'GET',
						data: 'id='+$("#task_id").val(),
						success: function(response){
								if(response==1){
									window.location = window.location.origin+"/calendario";
							  }
						}
					});
				}	
			});
	});

});
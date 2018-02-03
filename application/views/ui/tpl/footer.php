  
 <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
 <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>

  <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/moment.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/fullcalendar.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/tasker.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/bootbox.js');?>"></script>

  <!-- begin calendar !-->
        <script>
            $(window).load(function () {
            	
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();
                var started;
                var categoryClass;

                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    selectable: true,
                    selectHelper: true,
                    droppable:true,
                     drop: function(date) {
                        
                    },

                    eventDrop: function(event, delta, revertFunc, jsEvent, ui, view) {
                    
                        console.log('Event moved on '+event.start.format()+' Original date was '+event.title);
                        update_event_date(event.taskID , event.start.format());

                    },
                    select: function (start, end, allDay) {
                        
                        $('#fc_create').click();

                        started = start;

                        ended = end;

                        $("#txtDate").val(start);

                        $(".antosubmit").on("click", function () {
                            var title = $("#title").val();
                            if (end) {
                                ended = end
                            }
                            categoryClass = $("#event_type").val();

                            if (title) {
                                calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: started,
                                        end: end,
                                        allDay: allDay,
                                        taskID: taskID,
                                        taskDetails: taskDetails
                                    },
                                    true // make the event "stick"
                                );
                            }
                            $('#title').val('');
                            calendar.fullCalendar('unselect');

                            $('.antoclose').click();

                            return false;
                        });
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        //alert(calEvent.title, jsEvent, view);

                        $('#fc_edit').click();
                        $('#title2').val(calEvent.title);
                        $("#task_id").val(calEvent.taskID);
                        $("#descr2").val(calEvent.taskDetails);
                        categoryClass = $("#event_type").val();

                        $(".antosubmit2").on("click", function () {
                            calEvent.title = $("#title2").val();

                            calendar.fullCalendar('updateEvent', calEvent);
                            $('.antoclose2').click();
                        });
                        calendar.fullCalendar('unselect');
                    },
                    editable: true,
                    events: [

                    <?php foreach($tasks as $calendar_tasks): ?>
                        {
                            taskID: "<?php echo $calendar_tasks['task_id']; ?>",
                            title:  "<?php echo $calendar_tasks['task_name']; ?>",
                            taskDetails: "<?php echo $calendar_tasks['task_details']; ?>",
                            start:  "<?php echo $calendar_tasks['date']; ?>"
                    },
                   <?php endforeach; ?>
                ]
                });
            });

            function update_event_date(event_id,new_date){

                    $.ajax({

                        url : 'http://localhost/calendario/app/updatetask_date',
                        type: 'POST',
                        data:{

                            event_id : event_id,
                            new_date : new_date
                        },
                        success:function(response){

                            var resp = JSON.parse(response)

                            if(resp.response    === true){

                                bootbox.dialog({

                                    title: 'Notice',
                                    size: 'medium',
                                    message:'Yeah!! Selected event has been updated'
                                });
                            }

                        }
                    })

            }
        </script>
<hr>
<footer>
	<p style="text-align:center;">&copy; Created by Novi | FullCalendar is made by <a href="http://fullcalendar.io">fullcalendar.io</a></p>
</footer>


  </body>
</html>
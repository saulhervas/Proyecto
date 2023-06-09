$(function () {

    //Date for the calendar events (dummy data)
    /*var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()*/
    
    if (typeof idUsuario !== 'undefined') var url_eventos='/calendar/eventos/'+idUsuario;
    else var url_eventos='/calendar/eventos';

    moment.locale('es');

    var Calendar = FullCalendar.Calendar;
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        locale: 'es', 
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        
        eventLimit: true, // for all non-TimeGrid views
        views: {
            dayGridMonth: {
                eventLimit: 4
            }
        },

        events: url_eventos,

        /*
        events    : [
            {
            id             : 1,
            title          : 'Click for Google',
            start          : new Date(y, m, 28),
            end            : new Date(y, m, 29),
            allDay         : false,
            url            : 'http://google.com/',
            backgroundColor: '#3c8dbc', //Primary (light-blue)
            borderColor    : '#3c8dbc', //Primary (light-blue)
            extendedProps: {personalId: 3},
            }
        ],*/
        editable  : true,           
        droppable : true, 
        selectable: true,
        
        select: (info) => { 
            
            if (info.view.type!="dayGridMonth"){
                
                
                if (info.allDay===false) {

                    $('#eventIniAdd').val(calendar.formatDate(info.start, {year: 'numeric',})+"-"
                    +calendar.formatDate(info.start, {month: '2-digit',})+"-"
                    +calendar.formatDate(info.start, {day: '2-digit',})
                    +"T"+calendar.formatDate(info.start, {
                        hour: '2-digit',
                        minute: '2-digit'
                    }));
                    
                    var f = (info.start.getMonth() + 1) + "/" + info.start.getDate() + "/" + info.start.getFullYear() + " " + (info.start.getHours() + 1) + ":" + info.start.getMinutes() + ":" + info.start.getSeconds()
                    var end = new Date(f);
                    
                    $('#eventFinAdd').val(calendar.formatDate(end, {year: 'numeric',})+"-"
                    +calendar.formatDate(end, {month: '2-digit',})+"-"
                    +calendar.formatDate(end, {day: '2-digit',})
                    +"T"+calendar.formatDate(end, {
                        hour: '2-digit',
                        minute: '2-digit'
                    }));
                    $('input.AllDayAdd[type="checkbox"]').prop("checked", false);
                    AllDayAdd();

                } else {
                    
                    $('input.AllDayAdd[type="checkbox"]').prop("checked", true);
                    AllDayAdd();
                }
                
                $.ajax({
                    url:"/ajax/select/usuario/",
                    type:"GET",
                    success:function(html){
                        $('#personalAdd').html(html);
                    }
                });

                $('#form_add').attr("action", "/calendar/eventos/add");

                $('#addEvent').modal();
            } else {
                var dia=calendar.formatDate(info.start, {
                        day: '2-digit',
                    });
                var mes=calendar.formatDate(info.start, {
                    month: '2-digit',
                });
                var year=calendar.formatDate(info.start, {
                    year: 'numeric',
                });
                        
                calendar.changeView('timeGridDay', year+'-'+mes+'-'+dia);
            }
            
        },
        
        eventClick: (info) => {
            
            $('#modalTitle').html('Información Evento');

            if (info.event.allDay) {
                var body = '<b>Todo el Día:</b> ' + calendar.formatDate(info.event.start, { day: '2-digit', month: '2-digit', year: 'numeric'});
                
                $('input.AllDayMod[type="checkbox"]').prop("checked", true);
                AllDayMod();

            } else {
                var body = '<b>Inicio:</b> ' + calendar.formatDate(info.event.start, { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'})
                    + '<br><b>Fin:</b> ' + calendar.formatDate(info.event.end, { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'});
                
                $('input.AllDayMod[type="checkbox"]').prop("checked", false);
                AllDayMod();
            }
            
            if (info.event.extendedProps.title!=0) { 
                body += '<br><br><b>Evento:</b> '+ info.event.extendedProps.title;
                $('#title').val(info.event.extendedProps.title);
                $('#titleMod').val(info.event.extendedProps.title);
            } else {
                body += '<br><br><b>Evento:</b> '+ info.event.title;
                $('#title').val(info.event.title);
                $('#titleMod').val(info.event.title);
            }

            if (info.event.extendedProps.personalId!=0) { 
                body += '<br><b>Personal:</b> <a href="/personal/'+info.event.extendedProps.usuarioId+'/editar">'+ info.event.extendedProps.personalNom + '</a>';
            }
            
            $('#modalBody').html(body);
            $('#eventUrlDel').attr('href','/admin/calendar/'+info.event.id+'/eliminar'); 
            
            $('#eventIniMod').val(calendar.formatDate(info.event.start, {year: 'numeric',})+"-"
                    +calendar.formatDate(info.event.start, {month: '2-digit',})+"-"
                    +calendar.formatDate(info.event.start, {day: '2-digit',})
                    +"T"+calendar.formatDate(info.event.start, {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
            );

            if (info.event.end) {
                $('#eventFinMod').val(calendar.formatDate(info.event.end, {year: 'numeric',})+"-"
                    +calendar.formatDate(info.event.end, {month: '2-digit',})+"-"
                    +calendar.formatDate(info.event.end, {day: '2-digit',})
                    +"T"+calendar.formatDate(info.event.end, {
                        hour: '2-digit',
                        minute: '2-digit'
                    })
                );
            }

            
            $('#form_edit').attr("action", "/calendar/eventos/"+info.event.id);

            var selected=info.event.extendedProps.usuarioId; 
            $.ajax({
                url:"/ajax/select/usuario/",
                type:"GET",
                success:function(html){
                    $('#personalMod').html(html);
                }
            }).done(function(){
                //aquí insertas todos los scripts que quieres que sean llamados post carga de ajax.
                $('#personalMod option[value='+selected+']').attr('selected','selected');
            });

            $('#formEliminar').attr("action", "/calendar/eventos/"+info.event.id);
            $('#fullCalModal').modal();
        },

        eventResize: (info) => {

            var start = calendar.formatDate(info.event.start, {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            var end = calendar.formatDate(info.event.end, {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            var id = info.event.id;

            $.ajax({
                url:"/calendar/eventos/"+id,
                type:"PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{inicio:start, fin:end, allDay:0},
                success:function(respuesta){

                    if (respuesta.mensaje == "ok") {
                        calendar.refetchEvents();
                        Intranet.notificaciones('El evento fue actualizado correctamente', 'Intranet', 'success');
                    } else {
                        Intranet.notificaciones('El evento no pudo ser actualizado, hay recursos usandolo', 'Intranet', 'error');
                    }
                }
            })
        },

        eventDrop: (info) => {
            
            var start = calendar.formatDate(info.event.start, {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            if (info.event.end!=null) {
                var end = calendar.formatDate(info.event.end, {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
            } /*else {

                var d = new Date(start);
                var end = (d.getMonth() + 1) + "/" + d.getDate() + "/" + d.getFullYear() + " " + (d.getHours() + 1) + ":" + d.getMinutes() + ":" + d.getSeconds()
            }*/

            if (info.event.allDay===false) var allDay = 0;
            else var allDay = 1;
            
            var id = info.event.id;

            $.ajax({
                url:"/calendar/eventos/"+id,
                type:"PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{inicio:start, fin:end, allDay:allDay},
                success:function(respuesta){
                    if (respuesta.mensaje == "ok") {
                        calendar.refetchEvents();
                        Intranet.notificaciones('El evento fue actualizado correctamente', 'Intranet', 'success');
                    } else {
                        Intranet.notificaciones('El evento no pudo ser actualizado, hay recursos usandolo', 'Intranet', 'error');
                    }
                }
            })
        },
        
        
    });

    calendar.render();


    $("#fullCalModal").on('submit', '.form-eliminar', function () {
        event.preventDefault();
        const form = $(this);
        swal({
            title: '¿ Está seguro que desea eliminar el evento?',
            text: "Esta acción no se puede deshacer!",
            icon: 'warning',
            buttons: {
                cancel: "Cancelar",
                confirm: "Aceptar"
            },
        }).then((value) => {
            if (value) {
                ajaxRequest(form);
            }
        });
    });

    function ajaxRequest(form) {
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    $("#fullCalModal").modal('toggle');
                    calendar.refetchEvents();
                    Intranet.notificaciones('El evento fue eliminado correctamente', 'Intranet', 'success');
                    //setTimeout(location.reload(), 3000);
                    
                } else {
                    Intranet.notificaciones('El evento no pudo ser eliminado, hay recursos usandolo', 'Intranet', 'error');
                }
            },
            error: function () {
                //Evitamos el error cuando el destroy devuelve error...
                Intranet.notificaciones('El evento no pudo ser eliminado, no tiene permisos', 'Intranet', 'error');
            }
        });
    }
})

//Cerrar el Modal fullCalModal
$( "#modificarEvento" ).click(function() {
    $("#fullCalModal").modal('toggle');
});


function AllDayAdd () {
    if ($('#AllDayAdd').is(':checked')) {
        $("#eventIniAdd").prop( "readonly", true );
        $("#eventFinAdd").prop( "disabled", true );

        $("#eventIniAdd").removeAttr('required');
        $("#eventFinAdd").removeAttr('required');

        $(".reqAdd").removeClass('requerido');

    }else {
        $("#eventIniAdd").prop( "readonly", false );
        $("#eventFinAdd").prop( "disabled", false );

        $("#eventIniAdd").prop('required',true);
        $("#eventFinAdd").prop('required',true);

        $(".reqAdd").addClass('requerido');
    }
}

function AllDayMod () {
    if ($('#AllDayMod').is(':checked')) {
        $("#eventIniMod").prop( "readonly", true );
        $("#eventFinMod").prop( "disabled", true );

        $("#eventIniMod").removeAttr('required');
        $("#eventFinMod").removeAttr('required');

        $(".reqMod").removeClass('requerido');

    }else {
        $("#eventIniMod").prop( "readonly", false );
        $("#eventFinMod").prop( "disabled", false );

        $("#eventIniMod").prop('required',true);
        $("#eventFinMod").prop('required',true);

        $(".reqMod").addClass('requerido');
    }
}

//AllDay
$( "#AllDayAdd" ).click(function() {
    AllDayAdd();
});

$( "#AllDayMod" ).click(function() {
    AllDayMod();
});
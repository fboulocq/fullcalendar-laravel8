document.addEventListener('DOMContentLoaded', function() {
    
    const rutas = {
        'crear': '/evento/crear',
        'listado': '/evento/listado',
        'editar': 'evento/editar',
        'borrar': '/evento/borrar',
        'actualizar': '/evento/actualizar'
    }

    const POST_Info = async (url, data, token) => {
        const res = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token,
            }
        });
    
        return await res.json();
    }

    
    let formulario = document.querySelector("#formEventos");
    let btnGuardar = document.querySelector("#btnGuardar");
    let btnEliminar = document.querySelector("#btnEliminar");
    let btnModificar = document.querySelector("#btnModificar");
    const token = document.querySelector("#_token").value;
    
    let calendarEl = document.getElementById('agenda');
    
    let calendar = new FullCalendar.Calendar(calendarEl, {
        locale:"es",
        initialView: 'timeGridWeek', //Vista por defecto
        displayEventTime: true,
        headerToolbar: {
            left:'prev,next today',
            center:'title',
            // right:'dayGridMonth,timeGridWeek,listWeek'
            right:'timeGridWeek,listWeek'
        },

        //Horarios mínimos y máximos
        slotMinTime: '08:00:00',
        slotMaxTime: '21:00:00',


        //Trae todos los eventos
        // events: '/evento/listado',
        eventSources: {
            url: rutas.listado,
            method: 'POST',
            extraParams: {
                _token: token
            },
        },
        

        //Cuando hace click en una fecha
        dateClick: function(info)
        {
            formulario.reset();
            console.log(info.dateStr);
            //Obtengo el día y la hora en la vista Semana
            let dia = info.dateStr.substr(0, 10);
            let hora = info.dateStr.substr(11, 5);

            formulario.start.value=dia;
            formulario.end.value=dia;
            formulario.hour.value = hora;
            formulario.dayHour.value = info.dateStr;

            //Cuando da click en un día abro el modal
            $("#evento").modal("show");
        },
        eventClick:function(info)
        {
            const datos = {
                'id': info.event.id
            }
    
            POST_Info(`${rutas.editar}/${datos.id}`, datos, token)
            .then(respuesta => {

                formulario.id.value = respuesta.id;
                formulario.title.value = respuesta.title;
                formulario.descripcion.value = respuesta.descripcion;
                formulario.start.value = respuesta.start;
                formulario.end.value = respuesta.end;
                formulario.hour.value = respuesta.hour;
                formulario.dayHour.value = respuesta.dayHour;

                $("#evento").modal("show");

            })
            .catch(error => {
                console.log(error);
            })
        }
    });

    calendar.render();

    btnGuardar.addEventListener('click', (event) =>{
        
        const datos = {
            'title': formulario.title.value,
            'descripcion': formulario.descripcion.value,
            'start': formulario.start.value,
            'end': formulario.end.value,
            'hour': formulario.hour.value,
            'dayHour': formulario.dayHour.value,
            
        }

        POST_Info(rutas.crear, datos, token)
        .then(respuesta => {
            console.log(respuesta);
            formulario.reset();
            //Actualiza los eventos
            calendar.refetchEvents();
            $("#evento").modal("hide");
        })
        .catch(error => {
            console.log(error);
        })
        
    });

    btnEliminar.addEventListener('click', (event) => {
        const datos = {
            'id': formulario.id.value
        }
        POST_Info(`${rutas.borrar}/${formulario.id.value}`, datos, token)
        .then(respuesta => {
            console.log(respuesta);
            formulario.reset();
            //Actualiza los eventos
            calendar.refetchEvents();
            $("#evento").modal("hide");
        })
        .catch(error => {
            console.log(error);
        })
    })

    btnModificar.addEventListener('click', (event) => {
        const datos = {
            'id': formulario.id.value,
            'title': formulario.title.value,
            'descripcion': formulario.descripcion.value,
            'start': formulario.start.value,
            'end': formulario.end.value
        }
        POST_Info(`${rutas.actualizar}/${formulario.id.value}`, datos, token)
        .then(respuesta => {
            console.log(respuesta);
            formulario.reset();
            //Actualiza los eventos
            calendar.refetchEvents();
            $("#evento").modal("hide");
        })
        .catch(error => {
            console.log(error);
        })
    })
});

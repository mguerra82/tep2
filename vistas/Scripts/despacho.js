console.log("Define despacho");


model.despachoController = {

    despacho: {
     idDespacho: ko.observable(""),
     idAsignacion: ko.observable(""),
     idAlmeja: ko.observable(""),
     idTolva: ko.observable(""),
     codigo: ko.observable(""),
     hora: ko.observable(""),
     minuto: ko.observable(""),
     segundo: ko.observable(""),
     motivo: ko.observableArray([]),
     horat: ko.observableArray([]),
     minutot: ko.observableArray([]),
     segundot: ko.observableArray([]),
     almeja:ko.observable(""),
     tolva: ko.observable(""),
     seccion_bodega: ko.observable(""),
     fecha: ko.observable(""),
 },

 tiempo_muerto: {
    idDespacho: ko.observable(""),
    motivo: ko.observable(""),
    hora: ko.observable(""),
    minuto: ko.observable(""),
    segundo: ko.observable(""),
},

tiempo: {
 hour: ko.observable(""),
 minute: ko.observable(""),
 second: ko.observable("")
},


    infoBodega: {
        producto: ko.observable(""),
        bodega: ko.observable(""),
        consignatario: ko.observable(""),
        peso: ko.observable(""),
    },


asignacion: {
    consignatario: ko.observable(""),
    idBuque: ko.observable(""),
    idConsignatario: ko.observable(""),
    idDetalle_Plano: ko.observable(""),
    idDetalle_asignacion: ko.observable(""),
    idPlano_Estiba: ko.observable(""),
    idTransportista: ko.observable(""),
    no_importacion: ko.observable(""),
    nombre: ko.observable(""),
    peso: ko.observable(""),
    piloto: ko.observable(""),
    producto: ko.observable(""),
    seccion_bodega: ko.observable(""),
    transportista: ko.observable(""),
    buque: ko.observable(""),
    bodega: ko.observable(""),
    transporte: ko.observable(""),
},

despachos: ko.observableArray([]),
almejas: ko.observableArray([]),
tolvas: ko.observableArray([]),
tiemposMuertos: ko.observableArray([]),
secciones_bodegas: ko.observableArray([]),
bodegas: ko.observableArray([]),
tieposMuerto: ko.observable(""),
insertMode: ko.observable(false),
gridMode: ko.observable(true),
viewInfo: ko.observable(false),
isTimeDie: ko.observable(false),
stop: ko.observable(true),
insertInfo: ko.observable(false),
viewInfoDescarga: ko.observable(false),
viewInfoTimeDie: ko.observable(false),
codigo: ko.observable(""),
tiempoDescarga: ko.observable(""),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    map: function (despacho) {
        var eDespacho = model.despachoController.despacho;
        eDespacho.idDespacho(despacho.idDespacho);
        eDespacho.idAsignacion(despacho.idAsignacion);
        eDespacho.idAlmeja(despacho.idAlmeja);
        eDespacho.idTolva(despacho.idTolva);
        eDespacho.hora(despacho.hora);
        eDespacho.minuto(despacho.minuto);
        eDespacho.segundo(despacho.segundo);
        eDespacho.codigo(despacho.codigo);
        eDespacho.tolva(despacho.tolva);
        eDespacho.almeja(despacho.almeja);
	eDespacho.seccion_bodega(despacho.seccion_bodega);
    },

    mapInfobodega: function (infobodega) {
        var eBodega = model.despachoController.infoBodega;
        eBodega.producto("");
        eBodega.bodega("");
        eBodega.consignatario("");
        eBodega.producto(infobodega.producto);
        eBodega.bodega(infobodega.bodega);
        eBodega.consignatario(infobodega.consignatario);
        eBodega.peso(infobodega.peso);
    },

    mapAsignacion: function(asignacion){
        var eAsignacion = model.despachoController.asignacion;
        eAsignacion.consignatario(asignacion.consignatario);
        eAsignacion.idBuque(asignacion.idBuque);
        eAsignacion.idConsignatario(asignacion.idConsignatario);
        eAsignacion.idDetalle_asignacion(asignacion.idDetalle_asignacion);
        eAsignacion.idDetalle_Plano(asignacion.idDetalle_Plano);
        eAsignacion.idPlano_Estiba(asignacion.idPlano_Estiba);
        eAsignacion.idTransportista(asignacion.idTransportista);
        eAsignacion.no_importacion(asignacion.no_importacion);
        eAsignacion.nombre(asignacion.nombre);
        eAsignacion.peso(asignacion.peso);
        eAsignacion.piloto(asignacion.piloto);
        eAsignacion.producto(asignacion.producto);
        eAsignacion.seccion_bodega(asignacion.seccion_bodega);
        eAsignacion.transportista(asignacion.transportista);
        eAsignacion.buque(asignacion.buque);
        eAsignacion.bodega(asignacion.bodega);
        eAsignacion.transporte('Placa: '+asignacion.placa +' Modelo:'+asignacion.modelo)
    },

    nuevo: function () {
        var despacho = {
        };
        model.despachoController.codigo('');
        model.despachoController.asignacion.seccion_bodega(0);
        model.despachoController.asignacion.bodega(0);
        model.despachoController.map(despacho);

        model.despachoController.insertMode(true);
        model.despachoController.gridMode(false);
        
    },


    view: function (despacho){
        var hora = (parseInt(despacho.hora) < 10?'0'+despacho.hora: despacho.hora);
        var minuto = (parseInt(despacho.minuto) < 10?'0'+despacho.minuto: despacho.minuto);
        var segundo = (parseInt(despacho.segundo) < 10?'0'+despacho.segundo: despacho.segundo);

        model.despachoController.tiempoDescarga(hora+':'+minuto+':'+segundo);
        model.despachoController.map(despacho);
       model.despachoController.getAsignacion(despacho.codigo_asignacion);
        model.despachoController.gridMode(false);
        model.despachoController.insertMode(false);
        model.despachoController.viewInfo(true);
        model.despachoController.viewInfoDescarga(true);
        model.despachoController.listarTiemposMuertos(despacho.idDespacho);
        model.despachoController.viewInfoTimeDie(true);
    },

    guardar: function () {
        var despacho = model.despachoController.despacho;
        despacho.idAsignacion(model.despachoController.asignacion.idDetalle_asignacion());
        despacho.seccion_bodega(model.despachoController.asignacion.seccion_bodega());
        despacho.fecha = moment(new Date()).format("YYYY-MM-DD HH:mm:ss"); 

        var despachoParam = ko.toJS(despacho);

        if (!model.validateForm('#despachoForm')) {
            return;
        }
        //call api save
        Despacho.Guardar('guardaryeditar',despachoParam, function (data) {
            model.despachoController.initialize();
            model.despachoController.cancelar();
        });
    },


    remover: function (despacho) {
        bootbox.confirm("¿Esta seguro que quiere anular?", function (result) {
            if (result) {
                //call api remove
                Despacho.Remover('desactivar',despacho, function (data) {
                    model.despachoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.despachoController.insertMode(false);
        model.despachoController.insertInfo(false);
        model.despachoController.gridMode(true);
        model.despachoController.viewInfo(false);
        model.despachoController.viewInfoTimeDie(false);
        model.despachoController.viewInfoDescarga(false);

        model.clearErrorMessage('#despachoForm');
    },

    validateDescarga: function(codigo){
      var isValid = true;
       var despachos = model.despachoController.despachos();

       for(var i = 0; i<despachos.length; i++){
        if(codigo.toUpperCase() == despachos[i].codigo_asignacion){
            isValid = false;
        }
       }

       return isValid;
    },

    obtener: function () {
        var codigo = model.despachoController.codigo();
    /*
        if(!model.despachoController.validateDescarga(codigo)){
            toastr.error("Error! descarga ya se ha realizado");
            return;
        }
     */
        Despacho.ObtenerAsignacion('obtenerA',codigo,function (data){
            var asignacion = JSON.parse(data);
            if(asignacion === null){
                toastr.info("no se encontro ninguna asignacion");
                return;
            }
            model.despachoController.mapAsignacion(asignacion);
            model.despachoController.listarBodegas(asignacion.idPlano_Estiba);
            model.despachoController.viewInfo(true);
            model.despachoController.insertInfo(true);
            model.despachoController.contarDespachos();
        });
    },

    generarCodigo: function(){

     $('#qrcode').empty();
     var codigo = model.despachoController.despacho.codigo()
      if(codigo == "" || codigo === undefined){
         toastr.error("debe ingresar un codigo");
         return;
      }
      jQuery('#qrcode').qrcode({ 
        width: 150,
        height: 150, 
        render  : "table",
        text : model.despachoController.despacho.codigo()
      });
    },

    getAsignacion: function(codigo){
        Despacho.ObtenerAsignacion('obtenerA',codigo,function (data){
            var asignacion = JSON.parse(data);
            model.despachoController.mapAsignacion(asignacion);

        });
    },

    listarTiemposMuertos: function(idDespacho){
        Despacho.ListarTiemposMuertos('listarTiempoM',idDespacho,function (data){
            var tiempos = JSON.parse(data);
            model.despachoController.tiemposMuertos(tiempos);

        });
    },

    listarBodegas: function(idPlano){
        Despacho.ListarBodegas('listarBodegas',idPlano,function (data){
            var secciones = JSON.parse(data);
            model.despachoController.secciones_bodegas(secciones);
            model.despachoController.mapInfobodega(secciones[0]);
        });
    },

    showTimeDie: function(){
       if (!model.validateForm('#formMuerto')) {
            return;
        }

       model.despachoController.isTimeDie(true);
       $("#timeDie").modal('hide');
   },

   addTimeDie: function(){
     var motivo = model.despachoController.tiempo_muerto.motivo();
     var hora = model.despachoController.tiempo.hour();
     var minuto = model.despachoController.tiempo.minute();
     var segundo = model.despachoController.tiempo.second();

     model.despachoController.despacho.motivo.push(motivo);
     model.despachoController.despacho.horat.push(hora);
     model.despachoController.despacho.minutot.push(minuto);
     model.despachoController.despacho.segundot.push(segundo);

     model.despachoController.isTimeDie(false);
     model.despachoController.tiempo_muerto.motivo("");
 },

 selectSeccion: function(seccion){
    var secciones = model.despachoController.secciones_bodegas();

    for(var i = 0; i<secciones.length; i++){
        if(secciones[i].seccion_bodega === seccion){
            model.despachoController.mapInfobodega(secciones[i]);
        }
    }
 },

 contarDespachos: function(){
    Despacho.ContarDespachos('contar', function (data){
      var data = JSON.parse(data);
      var codigo = 0;
      var num = parseInt(data.codigo);
        (num < 10) ? codigo = 'CD-0'+(num+1): codigo='CD-'+(num+1);
        model.despachoController.despacho.codigo(codigo);
    }); 
 },

 initialize: function () {
    console.log("initialize Tipo Buque Controller");

    Despacho.Listar('listar',function (data){
        var despachos = JSON.parse(data);
        model.despachoController.despachos(despachos);
    });

    Equipo.ListarByTipo('listarByTipo','A',function (data){
        var almejas = JSON.parse(data);

        model.despachoController.almejas(almejas);
    });

    Equipo.ListarByTipo('listarByTipo','T',function (data){
        var tolvas = JSON.parse(data);

        model.despachoController.tolvas(tolvas);
    });
}
};


var Chrono = function(id){
    var target = {};
    var isRunning = false;
    var timer;    
    var time = {
        hour: 0,
        second: 0,
        minute: 0
    };
    
    function start(){
        timer = setInterval(function(){
            // seconds
            time.second++;
            if(time.second >= 60)
            {
                time.second = 0;
                time.minute++;
            }      

            // minutes
            if(time.minute >= 60)
            {
                time.minute = 0;
                time.hour++;
            }

            target.hour.innerHTML = time.hour < 10 ? '0' + time.hour : time.hour;
            target.minute.innerHTML = time.minute < 10 ? '0' + time.minute : time.minute;
            target.second.innerHTML = time.second < 10 ? '0' + time.second : time.second;
            
            console.log('Time elapsed: ' + time.hour + ':' + time.minute + ':' + time.second + ' from ' + id);

            if(id == "#chrono-a"){
                model.despachoController.despacho.hora(time.hour);
                model.despachoController.despacho.minuto(time.minute);
                model.despachoController.despacho.segundo(time.second);
            }else{
                model.despachoController.tiempo.hour(time.hour);
                model.despachoController.tiempo.minute(time.minute);
                model.despachoController.tiempo.second(time.second);
            }
            
            isRunning = true;
        }, 1000);
    }
    
    function stop(id)
    {
        if(id == "#chrono-b"){

            bootbox.confirm("¿desea finalizar tiempo muerto?", function (result) {
                if (result) {

                    model.despachoController.addTimeDie();

                    time.hour = 0;
                    time.minute = 0;
                    time.second = 0;

                    target.hour.innerHTML = time.hour < 10 ? '0' + time.hour : time.hour;
                    target.minute.innerHTML = time.minute < 10 ? '0' + time.minute : time.minute;
                    target.second.innerHTML = time.second < 10 ? '0' + time.second : time.second;
                }
            })
        }else{
            model.despachoController.stop(false);
        }

        isRunning = false;
        clearInterval(timer);
        //model.despachoController.stop(false);
    }
    
    function init(id){
        target = {
            hour: document.querySelectorAll(id + " .chrono-hour")[0],
            minute: document.querySelectorAll(id + " .chrono-minute")[0],
            second: document.querySelectorAll(id + " .chrono-second")[0],
        };
        
        var _btnStart = document.querySelectorAll(id + " .chrono-start")[0];
        
        _btnStart.addEventListener('click', function(){
            if(!isRunning) {
                _btnStart.innerHTML = 'Finalizar';
                start();
            }
            else {
                _btnStart.innerHTML = 'Iniciar';
                stop(id);
            }
        })

        $( "#btn_cancelar" ).on( "click", function() {
            clearData();
        });

        $( "#btn_guardar" ).on( "click", function() {
            clearData();
        });


        function clearData(){
            time.hour = 0;
            time.minute = 0;
            time.second = 0;

            target.hour.innerHTML = time.hour < 10 ? '0' + time.hour : time.hour;
            target.minute.innerHTML = time.minute < 10 ? '0' + time.minute : time.minute;
            target.second.innerHTML = time.second < 10 ? '0' + time.second : time.second;

            isRunning = false;
            clearInterval(timer);
            //model.despachoController.stop(false);
        }
    }
    
    init(id);
};

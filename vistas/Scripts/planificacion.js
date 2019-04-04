console.log("planificcion controller ");


model.planificacionController = {

    plano: {
        idPlano_Estiba: ko.observable(""),
        no_importacion: ko.observable(""),
        idBuque: ko.observable(""),
        peso_total: ko.observable(0),
        idProducto: ko.observableArray([]),
        peso: ko.observableArray([]),
        peso_total: ko.observable(0), 
        bodega: ko.observableArray([]),
        peso_bodega: ko.observableArray([]),
        seccion_bodega: ko.observableArray([]),
    },

    detalle: {
      idDetalle_Plano: ko.observable(""),
       idPlano_Estiba: ko.observable(""),
       bodega: ko.observable(0),
       seccion_bodega: ko.observable(""),
       peso_bodega: ko.observable(0),
       idProducto: ko.observable(""),
       idTransportista: ko.observable(""),
       idConsignatario: ko.observable(""),
       bl: ko.observable(""),
       producto: ko.observable(""),
       consignatario: ko.observable(""),
       transportista: ko.observable(""),
       peso: ko.observable(""),
    },


      asignacion: {
       bodega: ko.observable(0),
       seccion_bodega: ko.observable(""),
       idDetalle_asignacion: ko.observable(""),
       idDetalle_Plano: ko.observable(""),
       producto: ko.observable(""),
       idProducto: ko.observable(""),
       idConsignatario: ko.observable(""),
       idTransportista: ko.observable(""),
       idPiloto: ko.observable(""),
       idTransporte: ko.observable(""),
       codigo: ko.observable(""),
       peso: ko.observable(""),
       idPlano_Estiba: ko.observable("")
    },

      equipo: {
       idPlano: ko.observable(""),
       idEquipo: ko.observableArray([])
    },

    planos: ko.observableArray([]),
    detallePlano: ko.observableArray([]),
    detalleBodega: ko.observableArray([]),
    detallesAsignacion: ko.observableArray([]),
    bodegas: ko.observableArray([]),
    bodegasAsignacion: ko.observableArray([]),
    buques: ko.observableArray([]),
    productos: ko.observableArray([]),
    consignatarios: ko.observableArray([]),
    transportistas: ko.observableArray([]),
    pilotos: ko.observableArray([]),
    transportes: ko.observableArray([]),
    equipos: ko.observableArray([]),
    addEquipo: ko.observableArray([]),
    asignaciones: ko.observableArray([]),
    no_bodegas: ko.observable(0),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    paso2: ko.observable(true),
    paso3: ko.observable(true),
    showDetalle: ko.observable(false),
    showHead: ko.observable(false),
    showSelectBodega: ko.observable(false),
    showSave: ko.observable(false),
    saved: ko.observable(false),
    isNew: ko.observable(false),
    buque: ko.observable(""),
    bod: ko.observable(""),
    contador: ko.observable(1),

    detallesAsignacion: ko.observableArray([]),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapPlano: function (plano) {
        model.planificacionController.saved(true);
        if(plano.idPlano_Estiba !=""){
          model.planificacionController.saved(false);
        }

        var ePlano = model.planificacionController.plano;
        ePlano.idPlano_Estiba(plano.idPlano_Estiba);
        ePlano.idBuque(plano.idBuque);
        ePlano.peso_total(parseFloat(plano.peso_total));
        ePlano.no_importacion(plano.no_importacion);
    },

    mapAsignacion: function(asignacion){
        var eAsignacion = model.planificacionController.asignacion;
        eAsignacion.bodega(asignacion.bodega);
        eAsignacion.seccion_bodega(asignacion.seccion_bodega);
        eAsignacion.producto(asignacion.producto);
        eAsignacion.idProducto(asignacion.idProducto);
        eAsignacion.idDetalle_Plano(asignacion.idDetalle_Plano);
        eAsignacion.peso(asignacion.peso);
        eAsignacion.idTransportista(asignacion.idTransportista);
        eAsignacion.idPiloto(asignacion.idPiloto);
        eAsignacion.idTransporte(asignacion.idTransporte);
        eAsignacion.codigo(asignacion.codigo);
        eAsignacion.idDetalle_asignacion(asignacion.idDetalle_asignacion);
        eAsignacion.idTransportista(asignacion.idTransportista);
        eAsignacion.idPlano_Estiba(asignacion.idPlano_Estiba);

        if(eAsignacion.idTransportista() !== undefined){
            Piloto.ListarP('listarT',eAsignacion.idTransportista(), function (data){
            var pilotos = JSON.parse(data);
            model.planificacionController.pilotos(pilotos);
            eAsignacion.idPiloto(asignacion.idPiloto);
        }); 

        Transporte.ListarP('listarT',eAsignacion.idTransportista(), function (data){
            var transportes = JSON.parse(data);
            model.planificacionController.transportes(transportes);
            eAsignacion.idTransportista(asignacion.idTransportista);
        });  
        }
    },

     mapDetalle: function(detalle){
        var eDetalle = model.planificacionController.detalle;
        eDetalle.bodega(detalle.bodega);
        eDetalle.seccion_bodega(detalle.seccion_bodega);
        eDetalle.producto(detalle.nombre);
        eDetalle.idProducto(detalle.idProducto);
        eDetalle.idDetalle_Plano(detalle.idDetalle_Plano);
        eDetalle.peso(detalle.peso);
    },


    disabledFields: function(){
        model.planificacionController.plano.idProducto([]);
        model.planificacionController.plano.peso([]);
        model.planificacionController.plano.bodega([]);
        model.planificacionController.detallesAsignacion([]);
        model.planificacionController.plano.peso_bodega([]);
        model.planificacionController.getAllItems();
        model.planificacionController.detallePlano([]);
        model.planificacionController.bodegas([]);
        model.planificacionController.insertMode(true);
        model.planificacionController.gridMode(false);
        model.planificacionController.showDetalle(false);
        model.planificacionController.showSelectBodega(false);
    },

    nuevo: function () {
        var plano = {
          idPlano_Estiba: "",
          no_importacion: "",
          idBuque: "",
          peso_total: 0, 
        };
       
        //model.planificacionController.mapPlano(plano);
        //model.planificacionController.disabledFields();
        model.planificacionController.listarCorrelativo();
    },

    editarBodega: function(bodega){
       model.planificacionController.mapDetalle(bodega);
    },

    editarAsignacion: function(asignacion){
      console.log(asignacion);
      model.planificacionController.mapAsignacion(asignacion);
    },


    editar: function (plano){
        model.planificacionController.getAllItems();
        plano.peso_total = parseInt(plano.peso_total);
        model.planificacionController.mapPlano(plano);
        model.planificacionController.disabledFields();
        model.planificacionController.showHead(true);
        model.planificacionController.showDetalle(false);
        model.planificacionController.getDataSiguiente();

        model.planificacionController.setNameBuque(plano.idBuque);
    },

    validar: function(){
      
      var idPlano_estiba = model.planificacionController.plano.idPlano_Estiba();

       Planificacion.ListarNoAsignados('listarNoA',idPlano_estiba,function (data) {
           var dataN = JSON.parse(data);
           if(dataN.length > 0){
            toastr.error("error! no se ha terminado de asignar las bodegas");
            return;
           }else{
            model.planificacionController.guardarAsignacionEquipo();
           }
        });
    },

    guardarAsignacionEquipo: function(){
       var equipo = model.planificacionController.equipo;
       var idEquipo = model.planificacionController.addEquipo();

       equipo.idPlano(model.planificacionController.plano.idPlano_Estiba());
       equipo.idEquipo(idEquipo);


        var equipoParams = ko.toJS(equipo);


        //call api save
        Planificacion.GuardarEquipo('guardaryeditar',equipoParams, function (data) {         
          toastr.info(data);
          model.planificacionController.initialize();
          model.planificacionController.cancelar();
        });
       

    },

    guardarAsignacion: function () { 
        var asignacion = model.planificacionController.asignacion;

            if(!model.validateForm('#asignacionForm')) {
                return;
             }

        var asignacionParams = ko.toJS(asignacion);
      	console.log(asignacion);
      	console.log(asignacionParams);

        //call api save
        Planificacion.GuardarAsignacion('guardaryeditar',asignacionParams, function (data) {         
          toastr.info(data);
          model.planificacionController.getDataBodegas();
          model.planificacionController.listarAsigacionSeccion();
        });

    },

    guardarBodega: function(){
        var bodega = model.planificacionController.asignacion;

        var bodegaParam = ko.toJS(bodega);

        //call api save
        Planificacion.editarBodega('editarBodega',bodegaParam, function (data) {         
          toastr.info(data);
          model.planificacionController.getDataBodegas();
        });
    },

   /* guardar: function () { 
        var plano = model.planificacionController.plano;
        var detalle = model.planificacionController.detallePlano();
        var bodega = model.planificacionController.detalle.bodega();

        for(var i=0; i<detalle.length; i++){
          plano.idProducto.push(detalle[i].idProducto);
          plano.peso.push(detalle[i].peso);
          plano.bodega.push(detalle[i].bodega);
          plano.peso_bodega.push(detalle[i].peso_bodega);
          plano.seccion_bodega.push(detalle[i].seccion_bodega);
        }

        
        var planoParams = ko.toJS(plano);

            if(!model.validateForm('#planoForm')) {
                return;
             }

        //call api save
        Planificacion.Guardar('guardaryeditar',planoParams, function (data) {
          console.log(data);
                toastr.info("asignada con exito continue con la siguiente bodega" + plano.bodega());
                model.planificacionController.saved(true);
                $('.nav-tabs a[href="#transporte"]').tab('show');
                var idPlano = JSON.parse(data);
                model.planificacionController.plano.idPlano_estiba(idPlano);
                model.planificacionController.getDataSiguiente();
        });

    },*/

    getDataSiguiente: function(){
      var idPlano = model.planificacionController.plano.idPlano_Estiba();

        Planificacion.ListarBodegas('listarB',idPlano, function (data) {
         var dataP = JSON.parse(data);
         model.planificacionController.bodegasAsignacion(dataP);
      });  
    },

    getDetalleBodega: function(idPlano,bodega){
     Planificacion.ListarDetalles('listarD',idPlano, bodega, function (data) {
         var dataP = JSON.parse(data);
         //model.planificacionController.detallesAsignacion(dataP);
         model.planificacionController.detalleBodega(dataP);
         model.planificacionController.pesoBodega();
      }); 
    },

    getDataBodegas: function(){
      var idPlano = model.planificacionController.plano.idPlano_Estiba();
      var bodega = model.planificacionController.bod();


     Planificacion.ListarDetalles('listarD',idPlano, bodega, function (data) {
         var dataP = JSON.parse(data);
         model.planificacionController.detallesAsignacion(dataP);
      });  

    },

    listarAsigacionSeccion: function(){
      var idPlano = model.planificacionController.asignacion.idPlano_Estiba();
      var bodega = model.planificacionController.asignacion.bodega();
      var seccion_bodega = model.planificacionController.asignacion.seccion_bodega();

      Planificacion.ListarAsignaciones('listarA',idPlano,bodega,seccion_bodega, function (data) {
         var dataP = JSON.parse(data);
         model.planificacionController.asignaciones(dataP);
         model.planificacionController.contarAsignaciones();
      });
    },

    remover: function (plano) {
        bootbox.confirm("¿Esta seguro que quiere anular plano de estiba?", function (result) {
            if (result) {
                //call api remove
                Planificacion.Remover('desactivar',plano, function (data) {
                   toastr.info(data);
                   model.planificacionController.initialize();
                });
            }
        })
    },

  imprimirQR: function (plano) {
    var url = "../reportes/CodigoPlan.php?idPlano="+plano.idPlano_Estiba;
    window.open(url);
  },
  imprimirDes: function (plano) {
    var url = "../reportes/CodigoDes.php?idPlano="+plano.idPlano_Estiba;
    window.open(url);
  },

    cancelar: function () {
        model.planificacionController.insertMode(false);
        model.planificacionController.gridMode(true);
        model.planificacionController.showSelectBodega(false);
        model.planificacionController.showHead(false);
        model.planificacionController.showDetalle(false);
        model.planificacionController.clearDetalle();
    },

  //seleccionamos buque
  Guardar: function(){
     if(!model.validateForm('#planoForm')) {
        return;
     }
     
     var plano = model.planificacionController.plano;
     var planoParams = ko.toJS(plano);

      Planificacion.Guardar('guardaryeditar',planoParams, function (data) {
          toastr.info(data);
          model.planificacionController.initialize(); 
          model.planificacionController.cancelar();
       });
     
    /* model.planificacionController.setNameBuque(buque.idBuque());
     model.planificacionController.setBodegas(buque);
     model.planificacionController.showSelectBodega(true);
     model.planificacionController.showHead(true);*/
  },

  asignacionBodegas: function(plano){  
     model.planificacionController.mapPlano(plano);   
     model.planificacionController.setNameBuque(plano.idBuque);
     model.planificacionController.setBodegas(plano.idBuque);
     model.planificacionController.showSelectBodega(true);
     model.planificacionController.showHead(true);
     model.planificacionController.gridMode(false);
     model.planificacionController.insertMode(true);
     model.planificacionController.getAllItems();
     model.planificacionController.getDataSiguiente();
     model.planificacionController.isNew(true);
  },

//seteamos las bodegas por buque
    setBodegas: function (buque) {
        model.planificacionController.bodegas([]);
        model.planificacionController.detallePlano([]);
        var buques = model.planificacionController.buques();

       for(var i = 0; i< buques.length; i++ ){
         if(buques[i].idBuque == buque){
            model.planificacionController.no_bodegas(buques[i].no_bodegas);
            var b = buques[i].no_bodegas;

            for(var j = 1; j <= b; j++){
                var bo = new Object();
                bo.bodega = j;
                bo.seccion_bodega = "bodega no "+ j;
                model.planificacionController.bodegas.push(bo);
            }
         }
        }
    },

    siguienteBodega: function(){
      //calculamos peso total
      model.planificacionController.detalle.peso_bodega(0);
      model.planificacionController.detalleBodega([]);
      model.planificacionController.showDetalle(false);
      model.planificacionController.showSelectBodega(true);
      model.planificacionController.contador(1);
      var no_bodega = model.planificacionController.detalle.bodega();
      
      //model.planificacionController.removeBodega(bodega);
    },


//seteamos el numero de bodega a asignar detalle
    bodega: function(bodega){
      var detalles = model.planificacionController.detallePlano();
      model.planificacionController.showDetalle(true);
      model.planificacionController.showSelectBodega(false);

       var idPlano_estiba = model.planificacionController.plano.idPlano_Estiba();
       model.planificacionController.getDetalleBodega(idPlano_estiba,bodega.bodega());
    },

//seteamos los nombres para consignatario, producto y transportista
    setNames: function(){
       var productos = model.planificacionController.productos();
       var idProducto = model.planificacionController.detalle.idProducto(); 

        for(var i = 0; i< productos.length; i++ ){
         if(productos[i].idProducto == idProducto){
            model.planificacionController.detalle.producto(productos[i].nombre);
         }
        }   
    },

  //obtenemos el nombre del buque
    setNameBuque: function(idBuque){
     var buques = model.planificacionController.buques();

     for(var i = 0; i < buques.length; i++){
      if(buques[i].idBuque == idBuque){
        model.planificacionController.buque(buques[i].nombre);
      }
     }
    },

    removeBodega: function(bodega){
      var bodegas = model.planificacionController.bodegas();
      var index = bodegas.indexOf(bodega);

      bodegas.splice(index, 1);
    },


//agregamos el detalle de bodega
    addDetalle: function () {

        if (!model.validateForm('#detalleForm')) {
            return;
        }

       

       model.planificacionController.setNames();
       var detalles = model.planificacionController.detallePlano();

       
       var detalle = model.planificacionController.detalle;
       var idPlano_estiba = model.planificacionController.plano.idPlano_Estiba();
       detalle.idPlano_Estiba(idPlano_estiba);

       var detalleParam = ko.toJS(detalle);

       Planificacion.GuardarDetalle('guardardetalle',detalleParam, function (data) {
          toastr.info(data);
          model.planificacionController.getDetalleBodega(idPlano_estiba, detalleParam.bodega);
          model.planificacionController.listarDetalleBodegas(idPlano_estiba);
          model.planificacionController.getDataSiguiente();
          model.planificacionController.clearDetalle();
       });
       
       /*var contador = model.planificacionController.contador();


       var nDetalle = new Object();
       nDetalle.idProducto = detalle.idProducto();
       nDetalle.peso = detalle.peso();
       nDetalle.producto = detalle.producto();
       nDetalle.seccion_bodega = "Bodega no "+detalle.bodega()+contador;
       nDetalle.bodega = detalle.bodega();
       nDetalle.peso_bodega = detalle.peso_bodega();

       model.planificacionController.detallePlano.push(nDetalle);

       model.planificacionController.detalleBodega.push(nDetalle);

      //calculamos peso total
       model.planificacionController.pesoBodega();
       //calculamos peso total
       model.planificacionController.pesoTotal();

       //limpiamos el formulario
       model.planificacionController.clearDetalle();

       model.planificacionController.contador(contador+1);*/
    },

    //lisar detalles de bodegas
    listarDetalleBodegas: function(idPlano){
        Planificacion.ListarDetalleBodegas('listarDetalleBodegas', idPlano, function (data){
            var detalles = JSON.parse(data);
            model.planificacionController.detallePlano(detalles);
            model.planificacionController.pesoTotal();
            model.planificacionController.updateTotal();
        });
    },

    updateTotal: function(){
      var plano = model.planificacionController.plano;
      var planoParam = ko.toJS(plano);
       Planificacion.UpdateTotal('updateTotal',planoParam, function (data) {
          
       });
    },


//limpiamos la data del formulario
    clearDetalle: function(){
       model.planificacionController.detalle.idProducto("");
       model.planificacionController.detalle.peso("");
       model.planificacionController.detalle.bodega("");
       model.planificacionController.detalle.seccion_bodega(""),
       model.planificacionController.detalle.idPlano_Estiba(""),
       model.planificacionController.detalle.idDetalle_Plano("")
    },


//calculamos el peso total por bodega
    pesoBodega: function(){
        var total = model.planificacionController.detalleBodega().reduce(function(a, b) {
            return parseFloat(a) + parseFloat(b.peso);
        },0);

        model.planificacionController.detalle.peso_bodega(total);
     },

//calculamos el peso total por bodega
    pesoTotal: function(){
        var total = model.planificacionController.detallePlano().reduce(function(a, b) {
            return parseFloat(a) + parseFloat(b.peso);
        },0);

        model.planificacionController.plano.peso_total(total);
     },

//removemos un detalle si no se requiere
    removeDetalle: function(detalle){
         Planificacion.EliminarBodega('eliminarBodega',detalle, function (data) {
          toastr.info(data);
          model.planificacionController.getDetalleBodega(detalle.idPlano_Estiba, detalle.bodega);
          model.planificacionController.listarDetalleBodegas(detalle.idPlano_Estiba);
       });
    },

      removeAsignacion: function(asignacion){
        bootbox.confirm("¿Esta seguro que quiere remover esta asignacion?", function (result) {
            if (result) {
                //call api remove
               Planificacion.EliminarAsignacion('eliminar',asignacion, function (data) {
                toastr.info(data);
                model.planificacionController.getDataBodegas();
                model.planificacionController.listarAsigacionSeccion();
             });
            }
        })
    },

//obtenemos todos los items a pintar en los select options
    getAllItems: function(){
       var self = this;

        Producto.Listar('listar', function (data){
            var productos = JSON.parse(data);

            self.productos(productos);
        });

        Empresa.Listar('listar','C', function (data){
            var consignatarios = JSON.parse(data);
            self.consignatarios(consignatarios);
        });

        Empresa.Listar('listar','T', function (data){
            var transportistas = JSON.parse(data);
            self.transportistas(transportistas);
        })
    },

    listarCorrelativo: function(){
        Planificacion.ListarCorrelativo('listarC', function (data){
          var dataP = JSON.parse(data);console.log(dataP);
          var correlativo = parseInt(dataP.correlativo) + 1;
          model.planificacionController.plano.no_importacion(correlativo);
        });      
    },

    contarAsignaciones: function(){
        Planificacion.contarAsignaciones('contar', function (data){
          var data = JSON.parse(data);
          var codigo = 0;
          var num = parseInt(data.codigo);
            (num < 10) ? codigo = 'CA-0'+(num+1): codigo='CA-'+(num+1);
            model.planificacionController.asignacion.codigo(codigo);
        });      
    },

    generarCodigo: function(){

     $('#qrcode').empty();
      if(model.planificacionController.asignacion.codigo() == ""){
         toastr.error("debe ingresar un codigo");
         return;
      }
      jQuery('#qrcode').qrcode({ 
        width: 150,
        height: 150, 
        render  : "table",
        text : model.planificacionController.asignacion.codigo()
      });
    },

    getPilotos: function(transportista){
        Piloto.ListarP('listarT',transportista.idTransportista(), function (data){
            var pilotos = JSON.parse(data);
            model.planificacionController.pilotos(pilotos);
        }); 

        Transporte.ListarP('listarT',transportista.idTransportista(), function (data){
            var transportes = JSON.parse(data);
            model.planificacionController.transportes(transportes);
        });     
    },

    getEquipos: function(){
        Equipo.Listar('listar', function (data){
            var equipos = JSON.parse(data);
            model.planificacionController.equipos(equipos);
        });     
    },

   //asignacion de consignatario, transportista y piloto
    asignacionConsignatario: function(bodega){
      $('#qrcode').empty();
      model.planificacionController.mapAsignacion(bodega);
      model.planificacionController.listarAsigacionSeccion();
      //model.planificacionController.asignacion.codigo("");
      model.planificacionController.contarAsignaciones();
    },


    initialize: function () {
       var self = this;

        Planificacion.Listar('listar', function (data){
            var planos = JSON.parse(data);
            self.planos(planos);
        });

        Buque.Listar('listar', function (data){
            var buques = JSON.parse(data);
            self.buques(buques);
        });

    }
};

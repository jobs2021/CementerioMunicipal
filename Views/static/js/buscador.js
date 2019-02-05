//$(buscar_datos());
    
function buscar_datos(consulta){
    
    var urlb = $('#Urlbuscar').val();
    
    
    $.ajax({
        url: urlb,
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        if (respuesta=='no se puede ejecutar la consulta'){
            $("#datos").html('<h5 align="center" class="mt-4">No hay resultados</h5>');
        } else {
            $("#datos").html(respuesta);
        }
        
    })
    .fail(function(){
        console.log("error");
        })
    }
    
 $("#buscarParcela").keyup(function(){
     var valor = $(this).val();
     
        if(valor != ""){
            buscar_datos(valor);
        } else {
            buscar_datos();
        }  
    });



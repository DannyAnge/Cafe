 $(document).ready(function(){
    $("#password").complexify({},function(valid,complexify){
        console.log(valid,complexify);
        $(".progress-bar").css('width',complexify+'%');
        if (valid) {
            // statement
            $("#btnAgregar").prop('disabled',false);
            $(".progress-bar").addClass('bg-success').removeClass('bg-danger');
            $("#btnAgregar").attr('estado',false);
        }
        else {
            $("#btnAgregar").prop('disabled',true);
            $(".progress-bar").addClass('bg-danger').removeClass('bg-success');
            $("#btnAgregar").attr('estado',true);
        }
    })
 });


$(document).ready(function(){
    $(".editBoton").click(function (){

        var datos= JSON.parse($(this).attr('data-p'));
        $("#id").val(datos['id']);
        $("#nombre").val(datos['nombre']);
        $("#propietario").val(datos['propietario']);
        $("#direccion").val(datos['direccion']);
    })

    // eliminar productos

    $("#tabla tbody").on('click','.delBoton', function(){

                var  id = JSON.parse($(this).attr('data-i'));
                Swal.fire({
                  title: '¿Usted desea eliminar este dato?',
                  showDenyButton: true,
                  confirmButtonText: `Si`,
                  denyButtonText: `No`,
                }).then((result) => {
                  /* Read more about isConfirmed, isDenied below */
                  if (result.isConfirmed) {
                    $.ajax({
                     url:'productos/eliminar',
                     type:'post',
                     data:{'id':id},

                     success: function(respuesta){
                        Swal.fire('Eliminado con exito','','success');

                       $("#tabla tbody").html(respuesta)
                     },

                     error: function(){
                       console.error("Error fatal en el sistema");
                     },
                   })
                  }
                })
            })
    
    //actualizar productos

    $("#formEdit").submit(function(e){
        e.preventDefault();

        var id = $("#id").val();
        var nombre = $("#nombre").val();
        var propietario = $("#propietario").val();
        var direccion = $("#direccion").val();

        $.ajax({
            url:'productos/edit',
            type:'post',

            data:{'id':id,'nombre':nombre,'propietario':propietario,'direccion':direccion},

            success: function(respuesta){

                    Swal.fire({
                    type: "success",
                    title: "Producto Actualizado",
                    text: "¡Éxito!"
                })

                $("#tabla tbody").html(respuesta);
                $("#modalEditar").modal('hide');
            },

            error: function(){
                console.error("Error fatal en el sistema");
            }
        })

    })

});
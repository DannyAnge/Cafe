$(document).ready(function(){
    $(document).on("click",".editBoton",function(){
        let datos = JSON.parse($(this).attr("data-p"));
        $("#id").val(datos['id']);
        $("#nombre").val(datos['nombre']);
        $("#propietario").val(datos['propietario']);
        $("#direccion").val(datos['direccion']);
    })

    $("#formEdit").submit(function(e){
        e.preventDefault();

        let datos = {
            "id" : $("#id").val(),
            "nombre": $("#nombre").val(),
            "propietario": $("#propietario").val(),
            "direccion" : $("#direccion").val() 
        }

        $.ajax({
            url: "edit",
            type: "post",
            data: datos,
            success: function(response){

                
                Swal.fire({
                    type:'success',
                    title:'Producto acualizado',
                    text:'Exito'
                })

                $(".nuevosProductos tbody").html(response)
                $("#modalEditar").modal('hide');
            },
            error : function(){
                console.error(`Error al Actualizar`);
            }
        })
    })
    
    



        $(".nuevosProductos tbody").on('click','.delBoton', function(){

            var id = JSON.parse($(this).attr('data-i'));

            Swal.fire({
            title: 'Desea Eliminar el producto?',
            showDenyButton: true,
            confirmButtonText: `Si`,
            denyButtonText: `No`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: "eliminar",
                    type: "POST",
                    data: {id},
                    success: function(response){
                        Swal.fire('saved','','success');
                        
                        $(".nuevosProductos tbody").html(response)
                    },
                    error: function(){
                        console.error("Error al eliminar");
                    }
                })
            }
            });
        })

    
});





////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////INICIAR SESION//////////////////////////////////
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////

$(".body").on('click', "button#IniciarSesion", function(evt) {
    evt.preventDefault();
    
    IniciarSesion($('input#Pass').val());

});

function IniciarSesion(psd){

   $.ajax({
        method: "POST",
        url: "Ajax/Aj_Usuario.php",
        data: {
            Requerimiento: "IniciarSesion",
            Usuario: $('input#Usuario').val(),
            Pass: psd
        },
        dataType: 'JSON',
    }).done(function(respuesta) {  
        console.log(respuesta);  
    
        if (respuesta[0]=='NuevoUsuario') {
            var primer;
            var segundo;
            swal("Por Favor cambie su contraseña antes de continuar", {
                content: {
                element: "input",
                attributes: {
                    id: "PrimeraPass",
                     placeholder: "Escriba su nueva contraseña",
                     type: "password",
                },
                },
            }).then((value) => {
                if (value) {
                    primer = value;
                    swal("Confirmar Contraseña", {
                        content: {
                        element: "input",
                        attributes: {
                            id: "SegundaPass",
                            placeholder: "Repita su nueva contraseña",
                            type: "password",
                        },
                        },
                    })
                    .then((value1) => {
                        segundo = value1;
                        if (value1==value) {
                            ModificarContra(respuesta[1],segundo);
                        }else{
                             swal("George","Las Contraseñas Ingresadas no Coinciden, Por Favor intente nuevamente", "warning"); 
                        } 
                    }); 
                } 
            });


        }
        if (respuesta[0]=='UsuarioNormal') {
            window.location.href = "index.php";                                   
        }
        if (respuesta[0]=='UsuarioIncorrecto') {
            swal("George", "El Usuario Es Incorrecto", "warning");                                     
        }
        if (respuesta[0]=='PsdIncorrecta') {
            swal("George", "La Contraseña Es Incorrecta", "warning");                                     
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        //swal("Galenos!", "Ocurrio un error !  " + errorThrown, "error");
    }); 
}




function ResetearContra(id, limpiar) {
    $.ajax({
        method: "POST",
        url: "Ajax/Aj_Usuario.php",
        data: {
            Requerimiento: "Resetear",
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        if (respuesta[0] == true) {
            swal("Calzado Leonel", "Contraseña Reseteada!", "success");
            limpiar.trigger('click');
            return;
        }
    });
}
$(".bodyTotal").on('click', "a#CambiarContra", function(evt) {
    var primer='';
    var segundo='';
    var idg = $(this).attr("fol");
    swal("Por Favor cambie su contraseña antes de continuar", {
        content: {
            element: "input",
            attributes: {
                id: "PrimeraPass",
                placeholder: "Escriba su nueva contraseña",
                type: "password",
            },
        },
        buttons: {
            cancel: true,
            confirm: true
        },
    }).then((value) => {
        if (value) {
            primer = value;
            swal("Confirmar Contraseña", {
                content: {
                    element: "input",
                    attributes: {
                        id: "SegundaPass",
                        placeholder: "Repita su nueva contraseña",
                        type: "password",
                    },
                    buttons: {
                        cancel: true,
                        confirm: true
                    },
                },
            }).then((value1) => {
                segundo = value1;
                if (value1 == value) {
                    CambiarContra(idg, segundo);
                } else {
                    swal("Las Contraseñas Ingresadas no Coinciden, Por Favor intente nuevamente")
                }
            });
        }
    });
});

function CambiarContra(id, segundo) {
    $.ajax({
        method: "POST",
        url: "Ajax/Aj_Usuario.php",
        data: {
            Requerimiento: "ModificaContra",
            Segundo: segundo,
            Id: id
        },
        dataType: "JSON",
    }).done(function(respuesta) {
        if (respuesta[0] == true) {
            swal("Pasuca", "Contraseña Cambiada se cerrará la Sesión! ", "success", {
                buttons: {
                    confirm: true,
                },
            }).then((value) => {
                window.location.href = "index.php?pagina=salir";
            });
        } else {
            return;
        }
    })
};

/**********************//////*********//////////***************////////*****************/



function ModificarContra(id,segundo){  
    $.ajax({
        method:"POST",
        url:"Ajax/Aj_Usuario.php",
        data: {Requerimiento:"ModificaContra",Segundo:segundo,Id:id},
        dataType: "JSON",
    }).done(function(respuesta) {
        if(respuesta[0]==true){
          IniciarSesion(segundo);
        }
    });
}

function CerrarSesion(id){  
    console.log(id+" "+$('.body #CambiarContra').attr("fol"));
    if($('.body #CambiarContra').attr("fol")==id){        
        window.location.href = "index.php?pagina=salir";     
    }else{
        if(id!=undefined){
            IniciarSesion($('input#Pass').val());     
        }
        //},1000);
        
    }
}
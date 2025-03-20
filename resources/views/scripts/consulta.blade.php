<script>
    var app_url ='{{env('APP_URL')}}'; 

    function validarCedula(){           
      const url = app_url+'/consultar/'+document.getElementById('txtCedula').value;
      fetch(url)
        .then(respuesta => respuesta.json() )
        .then(respuesta => {let cedula=respuesta.cedula ;
            if (cedula != document.getElementById('txtCedula').value ){
                document.getElementById('AlertaCedula2').innerHTML ="esta cedula no existe debe crear el paciente";                    
                document.getElementById("cedulaDiv").className = "form-group col-md-6 col-sm-12 col-xs-12 has-error";                    
                document.getElementById("btnCrearModal").disabled = true; 
               
               
            }
            else{
                document.getElementById('AlertaCedula2').innerHTML =""
                document.getElementById("cedulaDiv").className = "form-group col-md-6 col-sm-12 col-xs-12 has-success";                   
                document.getElementById("btnCrearModal").disabled = false;


                
                let edad = respuesta.edad;
                let contenido = document.getElementById("contenidoMenor");
           
                if (edad >= 18) {
                    
                    contenido.classList.add("hidden");
                   
                } else {
                   
                    contenido.classList.remove("disabled-div", "hidden");
                }

                
            }                
        });
      
    }


   


</script>

<style>
    .disabled-div {
        pointer-events: none; /* Evita clics e interacción */
        opacity: 0.5; /* Lo hace visualmente tenue */
    }
    .hidden {
        display: none; /* Oculta el div completamente */
    }
</style>
<script>

    function calcularEdad(fechaNacimiento) {
        let fechaNac = new Date(fechaNacimiento);
        let hoy = new Date();
        
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        let mes = hoy.getMonth() - fechaNac.getMonth();
        let dia = hoy.getDate() - fechaNac.getDate();
        
        // Ajustar edad si aún no ha cumplido años este año
        if (mes < 0 || (mes === 0 && dia < 0)) {
            edad--;
        }

        return edad;
    }

    function validarEdad() {
        let fechaNacimiento = document.getElementById("txtfecnac").value;
        console.log(fechaNacimiento);

        let contenido = document.getElementById("contenidoMayor");
        console.log(contenido);
        
        let edad = calcularEdad(fechaNacimiento);
        console.log(edad);
        if (edad >= 18) {
            contenido.classList.remove("disabled-div", "hidden");
            console.log('soy mayor de edad');
        } else {
            contenido.classList.add("hidden");
        }
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
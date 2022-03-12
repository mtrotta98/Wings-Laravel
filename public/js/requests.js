function borrar(id, tipo, dir, vuelta = ''){
  event.preventDefault();
  var opcion = confirm("¿Seguro desea eliminar al " + tipo + "?");
    if (opcion == true) {
      const url = baseUrl + dir + id;
      axios.post(url)
        .then(function(response){
          alert(tipo + " eliminado");
          window.location.href = baseUrl + vuelta;
        })
        .catch(function(error){
          console.log(error);
        });
	  }else {
	    window.location.href = baseUrl + vuelta;
	  }
}


function agregar(tipo, dir, vuelta = ''){
  event.preventDefault();
    let formulario = document.querySelector('#form-agregar');
    const datos = new FormData(formulario);
    const url = baseUrl + dir;
    console.log(url);
    axios.post(url, datos)
    .then(function(response){
        alert(tipo + " agregado");
        window.location.href = baseUrl + vuelta;
    })
    .catch(function(error){
        console.log(error);
    });
}

function modificar(tipo, dir, vuelta = ''){
    event.preventDefault();
    let formulario = document.querySelector('#form-actualizar');
    const datos = new FormData(formulario);
    const url = baseUrl + dir;
    axios.post(url, datos)
      .then(function(response){
        alert(tipo + " actualizado");
        window.location.href = baseUrl + vuelta;
      })
      .catch(function(error){
        console.log(error);
      });
}

function activar(id, tipo, dir, vuelta = ''){
    event.preventDefault();
    const url = baseUrl + dir + id;
    axios.post(url)
    .then(function(response){
      alert(tipo + " activado");
      window.location.href = baseUrl + vuelta;
    })
    .catch(function(error){
      console.log(error);
    });
}
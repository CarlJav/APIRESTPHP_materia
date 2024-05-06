document.addEventListener("DOMContentLoaded", function() {
  
  const boton = document.getElementById('registrar');
  const form = document.getElementById('frm');
  const botonActualizar = document.getElementById('actualizar');

  boton.addEventListener('click', function(event) {
    event.preventDefault(); 

    const formData = new FormData(form);
   
    fetch('http://localhost:81/APIRESTPHP_materia/back-ent/create_materia.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Hubo un problema al enviar el formulario.');
      }
      alert("se creo correctamente")
      window.location.reload();
      return response.json(); 
    })
    .then(data => {
      
      console.log(data);
    })
    .catch(error => {
     
      console.error('Error al enviar el formulario:', error);
    });
  });
  
  botonActualizar.addEventListener('click', function(event) {
    let form = document.getElementById('frm');
    const formData = new FormData(form);
    let id = document.getElementById('valueIdMateria').value;
   
    formData.append('id', id);

    let jsonData = {};
    formData.forEach((value, key) => {
        jsonData[key] = value;
    });

    console.log(jsonData);

    fetch('http://localhost:81/APIRESTPHP_materia/back-ent/update_materia.php', {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(jsonData) 
    })
    .then(response => {
      if (!response.ok) {
        console.log(response);
        throw new Error('Hubo un problema al enviar el formulario.');
      }

      return response.json(); 
    })
    .then(data => {
      console.log(data);
      window.location.reload();
      alert("se actualizo correctamente")
    })
    .catch(error => {
      console.error('Error al enviar el formulario:', error);
    });
});

});

function editarMateria(id) {
  fetch(`http://localhost:81/APIRESTPHP_materia/back-ent/get_by_id_materia.php?id=${id}`, {
    method: 'GET'
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Hubo un problema al obtener los datos de la materia.');
    }
  
    return response.json();
  })
  .then(data => {
    document.getElementById("nombre_materia").value = data.nombre_materia;
    document.getElementById("semestre").value = data.semestre;
    document.getElementById("docente").value = data.docente;
    document.getElementById("descripcion").value = data.descripcion;

    document.getElementById("valueIdMateria").value = id;

    document.getElementById("registrar").style.display = "none";
    document.getElementById("actualizar").style.display = "inline";
  })
  .catch(error => {
    console.error('Error al obtener los datos de la materia:', error);
  });
}
document.addEventListener('DOMContentLoaded', function() {
    const editarBotones = document.querySelectorAll('.editar-btn');
    editarBotones.forEach(function(boton) {
        boton.addEventListener('click', function() {
            const idMateria = boton.getAttribute('data-id');

            editarMateria(idMateria);
        });
    });
});

function eliminarMateria(id) {
  fetch(`http://localhost:81/APIRESTPHP_materia/back-ent/delete_materia.php?id=${id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('no se pudo eliminar .');
    }
    return response.text();
  })
  .then(data => {
    alert("eliminada");
    window.location.reload(); 
    console.log(data); 
  })
  .catch(error => {
    console.error('Error al eliminar la materia:', error);
  });
}


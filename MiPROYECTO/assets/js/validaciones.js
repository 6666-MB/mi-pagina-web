$("#form_categorias").submit(function () {
  var nombre = $.trim($("input[name='categoria']").val());
  
  if ($.trim(nombre) === '') {
    alert("Debe completar el campo 'Nombre de la categoría'." + "\nMarcelo Bogado");
    return false;
  }
});

        
$("#form_productos").submit(function () {
  var nombreProducto = $.trim($("input[name='producto']").val());
  var descripcionProducto = $.trim($("textarea[name='descripcion']").val());
  var categoriaProducto = $.trim($("input[name='categoria']").val());
  var imagenProducto = $.trim($("input[name='imagen']").val());

  var camposVacios = [];

  if (nombreProducto === '') {
    camposVacios.push("Nombre del producto");
  }

  if (descripcionProducto === '') {
    camposVacios.push("Descripción");
  }

  if (categoriaProducto === '') {
    camposVacios.push("Categoría");
  }

  if (imagenProducto === '') {
    camposVacios.push("Imagen");
  }

  if (camposVacios.length > 0) {
    alert("Debe completar los siguientes campos: " + camposVacios.join(", ") + "\nMarcelo Bogado");
    return false;
  }

  return true;
});

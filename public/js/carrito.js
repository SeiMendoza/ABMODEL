class Carrito {

    //Añadir producto al carrito
    comprarProducto(e) {
        e.preventDefault();
        //Delegado para agregar al carrito
        if (e.target.classList.contains('btnCard')) {
            const producto = e.target.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            //this.leerDatosProducto(producto);
            console.log(producto);
        }
    }

}
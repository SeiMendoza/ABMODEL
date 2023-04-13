const carro = new Carrito();
const carrito = document.getElementById('carrito');
const productos = document.getElementsByName("productos");
const listaProductos = document.querySelector("#lista tbody");
cargarEventos();

function cargarEventos() {
    //Se ejecuta cuando se presionar agregar carrito
    productos.addEventListener("click", (e) => {
        carro.comprarProducto(e);
    });

}
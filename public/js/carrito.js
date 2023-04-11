const Clickbutton = document.querySelectorAll('.btnCard');
const tbody = document.querySelector('.tbody');
let lista = [];

Clickbutton.forEach(btn => {
    btn.addEventListener('click', addLista);
});

function addLista(e) {
    const boton = e.target;
    const item = boton.closest('.agregarCarrito');
    const itemTitulo = item.querySelector('.nombre').textContent;
    const itemId = item.querySelector(".btn").getAttribute('data-id');
    const itemCantidad = 1;
    const itemPrecio = item.querySelector('.precio').textContent;
    addItemLista(itemId, itemTitulo, itemCantidad, itemPrecio);
}

function addItemLista(itemId, itemTitulo, itemCantidad, itemPrecio) {
    const elemento = tbody.getElementsByClassName('nombre');
    for (let i = 0; i < elemento.length; i++) {
        if (elemento[i].innerText.trim() === itemTitulo.trim()) {
            const input = elemento[i];
            input.value++;
            total();
            return;
        }
    }
    var i = 0;
    const filaLista = document.createElement('tr');
    filaLista.classList.add('filas');
    const Content = `
    <td class="tipo" name="tipo" style="text-align:center">${itemTitulo}</td>
    <input name="idA" id="idA" class="idA" type="text" data-id="${itemId}" value="${itemId}" readonly style="display:none">
    <td >
        <input class="form-control cant" id="cantidad"
            name="cantidad" type="text" maxlength="3"
            placeholder="Cantidad" value="${itemCantidad}"
        />
    </td>
    <td style="text-align:right">
        <input class="form-control price" id="precio" style="text-align:right"
        name="precioCompra" type="text" maxlength="5"
        placeholder="precio" value="${itemPrecio}" readonly/>
    </td>
    <td style="text-align:center">
        <a class="delete"><i class="fa-solid fa-trash-can text-danger"></i></a>
    </td>
        <input name="detalle-` + i + `" type="text" value="${itemId} ${itemCantidad} ${itemPrecio}" readonly style="display:none">
    `;
    filaLista.innerHTML = Content;
    tbody.append(filaLista);
    filaLista.querySelector('.delete').addEventListener('click', quitarItemCarrito);
    filaLista.querySelector('.cant').addEventListener('change', cambCantidad);
    filaLista.querySelector('.price').addEventListener('change', cambPrecio);
    i++;
    document.formulario.tuplas.value = lista.length;
}

function total() {
    let total = 0;
    const itemTotal = document.querySelector('.total');
    const lista = document.querySelectorAll('.filas');
    lista.forEach((item) => {
        const elemento = item.querySelector('.price');
        const precio = Number(elemento.value.replace("L.", ""));
        const cant = item.querySelector('.cant');
        const cantidad = Number(cant.value);
        subTotal = precio * cantidad;
        total = total + precio * cantidad;
    });
    itemTotal.innerHTML = `<h5>Total: L. ${total.toFixed(2)}</h5> `;
}

function quitarItemCarrito(e) {
    const botonEliminar = e.target;
    const tr = botonEliminar.closest(".filas");
    const id = tr.querySelector('.idA').getAttribute('data-id');
    for (let i = 0; i < lista.length; i++) {
        if (lista[i].id.trim() === id.trim()) {
            lista.splice(i, 1);
        }
    }
    tr.remove();
    total()
}

function cambCantidad(e) {
    const cambio = e.target;
    cambio.value <= 0 ? (cambio.value = 1) : null;
    total();
}

function cambPrecio(e) {
    const cambio = e.target;
    cambio.value <= 0 ? (cambio.value = 1) : null;
    total();
}

function addLocalStorage() {
    localStorage.setItem('lista', JSON.stringify(lista))
}

window.onload = function() {
    const storage = JSON.parse(localStorage.getItem('lista'));
    if (storage) {
        lista = storage;
        addItemLista();
    }
}

function guardar() {
    var formul = document.getElementById("formulario");
    formul.submit();
    tbody.innerHTML = '';
    localStorage.clear();
}

function cancelar(ruta) {
    // var c = document.getElementById('cancelar');
    Swal
        .fire({
            title: "¿Cancelar registro?",
            text: "¿Desea cancelar lo que esta haciendo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
        })
        .then(resultado => {
            if (resultado.value) {
                // Hicieron click en "Sí"
                window.location.href = '/' + ruta;
            } else {
                // Dijeron que no
            }
        });
    localStorage.clear();
}
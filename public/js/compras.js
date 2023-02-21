const Clickbutton = document.querySelectorAll('.button')
const tbody = document.querySelector('.tbody')
let carrito = []

Clickbutton.forEach(btn => {
    btn.addEventListener('click', addToCarritoItem)
})


function addToCarritoItem(e) {
    const button = e.target
    const item = button.closest('.items')
    const itemTitle = item.querySelector('.title').textContent;
    const itemPrice = item.querySelector('.precio').textContent;
    const itemid = item.querySelector('.button').getAttribute('data-id');

    const newItem = {
        id: itemid,
        title: itemTitle,
        precio: itemPrice,
        cantidad: 1
    }

    addItemCarrito(newItem)
}

function addItemCarrito(newItem) {

    const InputElemnto = tbody.getElementsByClassName('input_Element');
    for (let i = 0; i < carrito.length; i++) {
        if (carrito[i].id.trim() === newItem.id.trim()) {
            carrito[i].cantidad++;
            const inputValue = InputElemnto[i]
            inputValue.value++;
            CarritoTotal()
            renderCarrito()
            return null;
        }
    }

    carrito.push(newItem);
    renderCarrito();
}

function renderCarrito() {
    tbody.innerHTML = '';
    var i = 0;
    factura.map(item => {
        const tr = document.createElement('tr');
        tr.classList.add('itemCarrito');
        var total_producto = Number(item.precio.replace("L.", "")) * Number(item.cantidad);
        const Content = `
                    <td colspan="3" class="titulo">${item.title}</td>
                    <td>
                        <input type="number" min="1" style ="width :40px;" value ="${item.cantidad}"
                         class="input_Element"> </input>
                    </td>
                    <td  width="140">${item.precio}</td>
                    <td  width="140">${total_producto.toFixed(2)}</td>
                    <td  width="140">
                        <a href="#" class="borrar-producto   fas fa-times-circle" data-id="${item.id}"></a>
                    </td>
                        <input name="detalle-` + i + `" type="text" value="${item.id} ${item.cantidad}" readonly style="display:none">
                    `;
        tr.innerHTML = Content;
        tbody.append(tr);
        tr.querySelector(".borrar-producto").addEventListener('click', removeItemCarrito);
        tr.querySelector(".input_Element").addEventListener('change', sumaCantidad);
        i++;
    });
    document.formulario_ventas.tuplas.value = factura.length;
    CarritoTotal()
}

function CarritoTotal() {
    let Total = 0;
    const itemCartTotal = document.querySelector('.total')
    carrito.forEach((item) => {
        const precio = Number(item.precio.replace("$", ''))
        Total = Total + precio * item.cantidad
    })

    itemCartTotal.innerHTML = `Total $${Total}`
    addLocalStorage()
}

function removeItemCarrito(e) {
    const buttonDelete = e.target
    const tr = buttonDelete.closest(".itemCarrito")
    const title = tr.querySelector('.title').textContent;
    for (let i = 0; i < carrito.length; i++) {

        if (carrito[i].title.trim() === title.trim()) {
            carrito.splice(i, 1)
        }
    }

    const alert = document.querySelector('.remove')

    setTimeout(function() {
        alert.classList.add('remove')
    }, 2000)
    alert.classList.remove('remove')

    tr.remove()
    CarritoTotal()
}

function sumaCantidad(e) {
    const sumaInput = e.target
    const tr = sumaInput.closest(".itemCarrito")
    const title = tr.querySelector('.title').textContent;
    carrito.forEach(item => {
        if (item.title.trim() === title) {
            sumaInput.value < 1 ? (sumaInput.value = 1) : sumaInput.value;
            item.cantidad = sumaInput.value;
            CarritoTotal()
        }
    })
}

function addLocalStorage() {
    localStorage.setItem('carrito', JSON.stringify(carrito))
}

window.onload = function() {
    const storage = JSON.parse(localStorage.getItem('carrito'));
    if (storage) {
        carrito = storage;
        renderCarrito()
    }
}
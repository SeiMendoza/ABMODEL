const Clickbutton = document.querySelectorAll('.button')
const tbody = document.querySelector('.tbody')
let carrito = []

Clickbutton.forEach(btn => {
    btn.addEventListener('click', addToCarritoItem)
})


function addToCarritoItem(e) {
    const button = e.target;
    const item = button.closest('.c')
    const itemTitle = item.querySelector(".title").textContent;
    const itemPrice = item.querySelector('.precio').textContent;
    const itemImg = item.querySelector('.imag').src;
    const itemId = item.querySelector(".idcard").getAttribute('data-id');

    const newItem = {
        id: itemId,
        title: itemTitle,
        precio: itemPrice,
        img: itemImg,
        cantidad: 1
    }

    addItemCarrito(newItem)
}


function addItemCarrito(newItem) {
    const inputCantidad = tbody.getElementsByClassName('cant')
    for (let i = 0; i < carrito.length; i++) {
        if (carrito[i].title.trim() === newItem.title.trim()) {
            carrito[i].cantidad++;
            const inputValue = inputCantidad[i]
            inputValue.value++;
            CarritoTotal()
            renderCarrito()
            return null;
        }
    }

    carrito.push(newItem)

    renderCarrito()
}


function renderCarrito() {
    tbody.innerHTML = '';
    var i = 0;
    carrito.map(item => {
        const tr = document.createElement('tr');
        tr.classList.add('ItemCarrito');
        var total = Number(item.cantidad) * Number(item.precio.replace("L", ""));
        const Content = `
    
    <th scope="row">1</th>
            <td class="table__productos">
              <img src=${item.img}  alt="" style="width: 100px">
              <h6 class="title">${item.title}</h6>
            </td>
            <td class="table_price"><p>${item.precio}</p></td>
            <td class="table_cantidad">
              <input onchange="renderCarrito()" type="number" min="1" style ="width :70px;" value=${item.cantidad} class="cant">
            </td>
            <td>${total}</td>
            <td><a href="#" class="delete btn btn-danger" data-id="${item.id}">Quitar</a></td>
            <input name="det-` + i + `" type="number" value=${item.cantidad} readonly style="display:none">
    
    `
        tr.innerHTML = Content;
        tbody.append(tr);

        tr.querySelector(".delete").addEventListener('click', removeItemCarrito);
        tr.querySelector(".cant").addEventListener('change', sumaCantidad);
    });
    document.formulario.tuplas.value = carrito.length;
    CarritoTotal()
    i++;
}

function CarritoTotal() {
    let Total = 0;
    let sub = 0;
    const itemCartTotal = document.querySelector('.itemCartTotal')
    carrito.forEach((item) => {
        let precio = Number(item.precio.replace("L", ""));
        let cant = Number(item.cantidad);
        sub = precio * cant;
        Total = Total + precio * cant;
    });

    itemCartTotal.innerHTML = `Total L ${Total.toFixed(2)}`;
    addLocalStorage()
}

function removeItemCarrito(e) {
    const buttonDelete = e.target
    const tr = buttonDelete.closest(".ItemCarrito")
    const title = tr.querySelector('.title').textContent;
    for (let i = 0; i < carrito.length; i++) {

        if (carrito[i].title.trim() === title.trim()) {
            carrito.splice(i, 1)
        }
    }

    tr.remove();
    CarritoTotal()
}

function sumaCantidad(e) {
    const sumaInput = e.target
    const tr = sumaInput.closest(".ItemCarrito")
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
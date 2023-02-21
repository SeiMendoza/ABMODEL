const ClickButton = document.querySelectorAll('.button')
let carrito = []

ClickButton .forEach(btn => {
  btn.addEventListener('click', addToCarritoItem)  
});
function addToCarritoItem(e){
const button = e.target
const item = button.closest('card')
const itemTitle = item.querySelector('.card-title').textContent;
const itemPrice = item.querySelector('.precio').textContent;
const itemImg = item.querySelector('.rounded float-start image-center image-fluid').src;

const newCarrito = {
    nombre: itemTitle,
    precio: itemPrice,
    imagen: itemImg,
    cantidad: 1,
}
addItemCarrito(newCarrito)
}
function addItemCarrito(newCarrito){
carrito.push(newCarrito)
}
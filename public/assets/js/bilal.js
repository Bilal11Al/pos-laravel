let currentCategory = "all";
let products = [];
function filterCategory(category, event) {
    currentCategory = category;
    let buttons = document.querySelectorAll('.category-btn');
    buttons.forEach((btn) => {
        btn.classList.remove('active');
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-outline-primary');
    })
    event.classList.add('active');
    event.classList.remove('btn-outline-primary');
    event.classList.add('btn-primary');
    console.log({ category: category, currentCategory: currentCategory, event: event, target: event.target });
    renderProducts();
}

async function renderProducts(searchProduct = '') {
    let productGrid = document.getElementById('productGrid');
    productGrid.innerHTML = "";
    const response = await fetch("/get-products");
    products = await response.json();
    // console.log(products);
    //filter
    const filtered = products.filter((p) => {
        //shorthand
        const matchCategory = currentCategory === 'all' || p.category.name === currentCategory;
        const matchSearch = p.product_name.toLowerCase().includes(searchProduct);
        return matchCategory && matchSearch;
    });

    //tamppilkan data ke card
    filtered.forEach((product) => {
        const col = document.createElement('div');
        col.className = ('col-md-4 sm-6');
        col.innerHTML = `
    <div class="card product-card" onclick ="addToCard(${product.id})">
        <div class="product-img">
        <img src="/storage/${product.product_photo}" alt="Belum ada foto" style="width:100%;">
        </div>
        <div class="card-body">
          <span class="badge bg-secondary badge-category">${product.category.name}</span>
          <h6 class="card-title mt-2 mb-2">${product.product_name}</h6>
          <p class="card-text text-primary fw-bold">
            ${Number(product.product_price).toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        })}
          </p>
        </div>
      </div>
    `;
        // console.log(product.id);
        productGrid.appendChild(col);
    });
    // console.log(products);
}
let cart = [];
function addToCard(id) {
    const product = products.find((p) => p.id == id);
    const existing = cart.find((item) => item.id == id);
    if (existing) {
        existing.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    // console.log(product);
    renderCart();
}

function renderCart() {
    const cartContainer = document.querySelector("#cardItems");
    cartContainer.innerHTML = "";
    // console.log(cartContainer);
    if (cart.length === 0) {
        cartContainer.innerHTML = `
      <div class="text-center text-muted mt-5">
        <i class="fa-solid fa-cart-shopping"></i>
        <p>Cart is empty</p>
      </div>
    `;
        updateTotal();
    }
    cart.forEach((item, index) => {
        const div = document.createElement("div");
        // console.log(item);
        div.className = "cart-item d-flex justify-content-between align-items-center mb-3";
        div.innerHTML = `
      <div class="">
          <img src="/storage/${item.product_photo}" alt="Belum ada foto" style="width:100px;">
          <strong>${item.product_name}</strong>
          <small>Rp.${item.product_price.toLocaleString('id-ID')}</small>
        </div>
        <div class="d-flex align-items-center">
          <button class="btn btn-outline-danger me-2" onclick="changQty(${item.id}, -1)">-</button>
          <span>${item.quantity}</span>
          <button class="btn btn-outline-success ms-2" onclick="changQty(${item.id}, 1)">+</button>
          <button class=" btn btn-danger ms-3"><i class="fa-solid fa-trash" onclick="removeItems(${item.id})"></i></button>
        </div>
    `;
        cartContainer.appendChild(div);
    })
    updateTotal();
}

function removeItems(id) {
    cart = cart.filter((p) => p.id != id);
    renderCart();
}
function changQty(id, x) {
    const item = cart.find((p) => p.id == id);
    if (!item) {
        return;
    }
    item.quantity += x;
    if (item.quantity <= 0) {
        confirm('Minimum harus ada 1 product')
        cart = filter((p) => p.id != id);
    }
    renderCart();
}
function updateTotal() {
    const subtotal = cart.reduce((sum, item) => sum + item.product_price * item.quantity, 0);
    const tax = subtotal * 0.1;
    const total = tax + subtotal;
    document.getElementById('subtotal').textContent = `${Number(subtotal).toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    })}`;
    document.getElementById('tax').textContent = `${Number(tax).toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    })}`;
    document.getElementById('total').textContent = `${Number(total).toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    })}`;

    document.getElementById('subtotal_value').value = subtotal;
    document.getElementById('tax_value').value = tax;
    document.getElementById('total_value').value = total;


    // console.log("ini subtotal :", subtotal);
    // console.log("ini tax :", tax);
    // console.log("ini total :", total);
}
let clearCard = document.getElementById('clearCard');
// console.log(clearCard);
clearCard.addEventListener('click', (e) => {
    e.preventDefault();
    cart = [];
    renderCart();
});
async function prosesPay() {
    if (cart.length === 0) {
        alert('keranjang kosong ni mas,isi dong');
        return;
    }
    const modal = new bootstrap.Modal(document.getElementById("exampleModal"));
    modal.show();
}
async function handelPayment() {
    // alert('duar');
    const paymentMethod = document.getElementById('payment_method').value;
    const orderCode = document.querySelector('.orderNumber').textContent.trim();
    const subtotal = document.getElementById('subtotal_value').value.trim();
    const tax = document.getElementById('tax_value').value.trim();
    const grandTotal = document.getElementById('total_value').value.trim();

    if (paymentMethod == 'cash') {
        try {
            const res = await fetch("/order", {
                method: "POST",
                headers: {
                    "X-CSRF_TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-type": "application/json",
                },
                body: JSON.stringify({
                    cart,
                    orderCode,
                    subtotal,
                    tax,
                    grandTotal
                }),
            });
            console.log(res);
            const data = await res.json();
            console.log(data);
            if (data.status == 'success') {
                alert('Transaction success');
                window.location.href = "order";
            } else {
                alert('Transaction failed', data.massage)
            }
        } catch (error) {
            alert('upss Transction failed');
            console.log("error", error);
        }
    } else if (paymentMethod == 'cashless') {
        try {
            const res = await fetch("/cashless", {
                method: "POST",
                headers: {
                    "X-CSRF_TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-type": "application/json",
                },
                body: JSON.stringify({
                    cart,
                    orderCode,
                    subtotal,
                    tax,
                    grandTotal
                }),
            });
            // console.log(res);
            const data = await res.json();
            console.log(data);
            if (data.status == 'success') {
                window.snap.pay(data.snapToken);
            } else {
                alert('Transaction failed', data.massage)
            }
        } catch (error) {
            alert('upss Transction failed');
            console.log("error", error);
        }
    }
}

renderProducts();

document.getElementById('searchProduct').addEventListener('input', (e) => {
    const searchProduct = e.target.value.toLowerCase();
    renderProducts(searchProduct);
    console.log(searchProduct);
});

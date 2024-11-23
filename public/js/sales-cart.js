const products = window.productsData || [];
let cart = [];

document.getElementById('barcode_search').addEventListener('input', function() {
    const barcode = this.value.replace(/\s+/g, '');
    if (barcode.length > 0) {
        const product = products.find(p => p.barcode === barcode);
        if (product) {
            addToCart(product);
            this.value = '';
        }
    }
});

function addToCart(product) {
    const existingItem = cart.find(item => item.id === product.id);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.unshift({
            ...product,
            quantity: 1
        });
    }
    beepSound.play();
    updateCartDisplay();

    const firstCartItem = document.querySelector('#cart-items > div:first-child');
    if (firstCartItem) {
        firstCartItem.classList.add('fade-in-down');
        setTimeout(() => {
            firstCartItem.classList.remove('fade-in-down');
        }, 500);
    }
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart-items');
    cartContainer.innerHTML = '';

    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.className =
            'flex flex-col min-[500px]:flex-row min-[500px]:items-center gap-5 py-6 border-b border-gray-200 group';
            itemElement.innerHTML = `
                <div class="w-full md:max-w-[126px]">
                    <img src="${item.image_url || 'https://via.placeholder.com/126'}" alt="${item.name}" class="mx-auto rounded-xl object-cover">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 w-full">
                    <div class="md:col-span-2">
                        <div class="flex flex-col max-[500px]:items-center gap-3">
                            <h6 class="font-semibold text-base leading-7 text-black">${item.name}</h6>
                            <h6 class="font-normal text-base leading-7 text-gray-500">${item.categories.map(cat => cat.name).join(', ')}</h6>
                            <h6 class="font-medium text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-indigo-600">S/.${(Number(item.sale_price) || 0).toFixed(2)}</h6>
                        </div>
                    </div>
                    <div class="flex items-center max-[500px]:justify-center h-full max-md:mt-3">
                        <div class="flex items-center h-full">
                            <button onclick="updateQuantity(${item.id}, -1)" class="group rounded-l-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 hover:shadow-gray-300 focus-within:outline-gray-300">
                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </button>
                            <input type="text" value="${item.quantity}" class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[73px] min-w-[60px] placeholder:text-gray-900 py-[15px] text-center bg-transparent" readonly>
                            <button onclick="updateQuantity(${item.id}, 1)" class="group rounded-r-xl px-5 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-gray-50 hover:border-gray-300 hover:shadow-gray-300 focus-within:outline-gray-300 z-10">
                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center max-[500px]:justify-center md:justify-end max-md:mt-3 h-full">
                        <p class="font-bold text-lg leading-8 text-gray-600 text-center transition-all duration-300 group-hover:text-indigo-600">S/.${Number((item.sale_price * item.quantity) || 0).toFixed(2)}</p>
                    </div>
                </div>
            `;
        cartContainer.appendChild(itemElement);
    });

    updateTotalItems();
    updateTotalAmount();
}

function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            cart = cart.filter(i => i.id !== productId);
        }
        updateCartDisplay();
    }
}

function updateTotalItems() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalItemsElements = document.getElementsByClassName('total_items');
    Array.from(totalItemsElements).forEach(element => {
        element.textContent = `${totalItems} Items`;
    });
}

function updateTotalAmount() {
    const totalAmount = cart.reduce((sum, item) => sum + (item.sale_price * item.quantity), 0);
    const totalAmountElements = document.getElementsByClassName('total_amount');
    Array.from(totalAmountElements).forEach(element => {
        element.textContent = `S/.${totalAmount.toFixed(2)}`;
    });
}

document.getElementById('register-sale').addEventListener('click', function(e) {
    e.preventDefault();

    if (cart.length === 0) {
        alert('El carrito está vacío. Agregue productos antes de registrar la venta.');
        return;
    }

    let saleDateTime = document.getElementById('sale-datetime').value;

    /* Fecha y hora */
    if (!saleDateTime) { // si no se seleccionó, usar la fecha y hora actual
        saleDateTime = new Date();
    } else { // si se seleccionó, parsear la fecha y hora de d-m-Y H:i:s a Y-m-d H:i:s
        const [datePart, timePart] = saleDateTime.split(' ');
        const [day, month, year] = datePart.split('-');
        saleDateTime = `${year}-${month}-${day} ${timePart}`;
        saleDateTime = new Date(saleDateTime);
    }
    saleDateTime.setHours(saleDateTime.getHours() - 5); // GMT-5
    saleDateTime = saleDateTime.toISOString().slice(0, 19).replace('T', ' '); 
    
    const saleData = {
        products: cart.map(item => ({
            id: item.id,
            quantity: item.quantity,
            price: item.sale_price
        })),
        total_amount: calculateTotalAmount(),
        sale_date: saleDateTime
    };

    fetch(window.salesStoreUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            },
            body: JSON.stringify(saleData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cart = [];
                updateCartDisplay();
                setLoading(false);
                showSuccessAlert();
            } else {
                showFailAlert(data.message || 'Error al procesar la venta');
                setLoading(false);
            }
        })
        .catch(error => {
            alert('Error en la solicitud: ' + error);
            setLoading(false);
        });
});

function calculateTotalAmount() {
    return cart.reduce((total, item) => total + (item.sale_price * item.quantity), 0);
}

const registerSaleButton = document.getElementById('register-sale');
const buttonText = document.getElementById('button-text');
const buttonLoader = document.getElementById('button-loader');

registerSaleButton.addEventListener('click', function(e) {
    e.preventDefault();
    if (cart.length > 0) {
        setLoading(true);
    }
});

function setLoading(isLoading) {
    if (isLoading) {
        buttonText.classList.add('hidden');
        buttonLoader.classList.remove('hidden');
        registerSaleButton.disabled = true;
        registerSaleButton.classList.add('button-disabled');
    } else {
        buttonText.classList.remove('hidden');
        buttonLoader.classList.add('hidden');
        registerSaleButton.disabled = false;
        registerSaleButton.classList.remove('button-disabled');
    }
}

function showSuccessAlert() {
    const alert = document.getElementById('sucessAlert');
    alert.style.opacity = '1';
    alert.style.transform = 'translate(-50%, 0) scale(1)';
    alert.style.pointerEvents = 'auto';

    setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transform = 'translate(-50%, 20px) scale(0.9)';
        alert.style.pointerEvents = 'none';
    }, 3000);
}

function showFailAlert(message) {
    const failAlert = document.getElementById('failAlert');
    failAlert.querySelector('.text-sm').innerHTML = message;
    failAlert.style.opacity = '1';
    failAlert.style.transform = 'translate(-50%, 0) scale(1)';
    failAlert.style.pointerEvents = 'auto';

    setTimeout(() => {
        failAlert.style.opacity = '0';
        failAlert.style.transform = 'translate(-50%, 20px) scale(0.9)';
        failAlert.style.pointerEvents = 'none';
    }, 6000);
}
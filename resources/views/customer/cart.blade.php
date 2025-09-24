@extends('layouts.customer.app')

@section('content')
<!-- Cart Header -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="section-title">Shopping Cart</h1>
        <p class="lead">Review your selected items before checkout</p>
    </div>
</section>

<!-- Cart Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Cart Items</h5>
                    </div>
                    <div class="card-body">
                        <div id="cartItems">
                            <!-- Cart items will be loaded dynamically -->
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Your cart is empty</p>
                                <a href="{{ route('customer.products') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="subtotal">P0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span id="shipping">P0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span id="tax">P0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="total">P0</strong>
                        </div>
                        <a href="{{ route('customer.checkout') }}" class="btn btn-primary w-100" id="checkoutBtn" style="display: none;">Proceed to Checkout</a>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Secure Checkout</h6>
                        <p class="small text-muted">
                            <i class="fas fa-lock me-2"></i>Your payment information is secure and encrypted.
                        </p>
                        <div class="d-flex justify-content-between">
                            <i class="fab fa-cc-visa fa-2x text-muted"></i>
                            <i class="fab fa-cc-mastercard fa-2x text-muted"></i>
                            <i class="fab fa-cc-paypal fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadCartItems();
    });

    function loadCartItems() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const cartItemsContainer = document.getElementById('cartItems');
        const checkoutBtn = document.getElementById('checkoutBtn');

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Your cart is empty</p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            `;
            checkoutBtn.style.display = 'none';
            return;
        }

        let cartHTML = '';
        let subtotal = 0;

        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            cartHTML += `
                <div class="cart-item">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="/images/tire-${item.id}.jpg" alt="${item.name}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-0">${item.name}</h6>
                            <small class="text-muted">Product ID: ${item.id}</small>
                        </div>
                        <div class="col-md-2">
                            <span class="product-price">P${item.price}</span>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, -1)">-</button>
                                <input type="text" class="form-control text-center" value="${item.quantity}" readonly>
                                <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <span class="product-price">P${itemTotal}</span>
                            <button class="btn btn-sm btn-outline-danger ms-2" onclick="removeFromCart(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItemsContainer.innerHTML = cartHTML;
        updateOrderSummary(subtotal);
        checkoutBtn.style.display = 'block';
    }

    function updateQuantity(index, change) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart[index].quantity += change;

        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        loadCartItems();
        updateCartCount();
    }

    function removeFromCart(index) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCartItems();
        updateCartCount();
    }

    function updateOrderSummary(subtotal) {
        const shipping = subtotal > 0 ? 200 : 0;
        const tax = subtotal * 0.12;
        const total = subtotal + shipping + tax;

        document.getElementById('subtotal').textContent = 'P' + subtotal;
        document.getElementById('shipping').textContent = 'P' + shipping;
        document.getElementById('tax').textContent = 'P' + tax.toFixed(2);
        document.getElementById('total').textContent = 'P' + total.toFixed(2);
    }
</script>
@endsection
@endsection

@extends('layouts.customer.app')

@section('content')
<!-- Checkout Header -->
<section class="py-5 bg-light">
    <div class="container">
        <h1 class="section-title">Checkout</h1>
        <p class="lead">Complete your purchase with secure payment</p>
    </div>
</section>

<!-- Checkout Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="shippingFirstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="shippingFirstName" value="John" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="shippingLastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="shippingLastName" value="Doe" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="shippingAddress" class="form-label">Address</label>
                                <textarea class="form-control" id="shippingAddress" rows="3" required>123 Main Street, Davao City</textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="shippingCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="shippingCity" value="Davao City" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="shippingProvince" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="shippingProvince" value="Davao del Sur" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="shippingZip" class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" id="shippingZip" value="8000" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="shippingPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="shippingPhone" value="0912-345-6789" required>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="billingSame">
                                <label class="form-check-label" for="billingSame">
                                    Billing address is the same as shipping address
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label" for="creditCard">
                                    Credit/Debit Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                <label class="form-check-label" for="paypal">
                                    PayPal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer">
                                <label class="form-check-label" for="bankTransfer">
                                    Bank Transfer
                                </label>
                            </div>
                        </div>

                        <div id="creditCardForm">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="cardNumber" class="form-label">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="123" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cardName" class="form-label">Name on Card</label>
                                <input type="text" class="form-control" id="cardName" required>
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
                        <div id="checkoutItems">
                            <!-- Checkout items will be loaded dynamically -->
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span id="checkoutSubtotal">P0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <span id="checkoutShipping">P0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <span id="checkoutTax">P0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong id="checkoutTotal">P0</strong>
                        </div>
                        <button type="button" class="btn btn-primary w-100" onclick="processPayment()">Complete Purchase</button>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h6><i class="fas fa-shield-alt me-2"></i>Secure Payment</h6>
                        <p class="small text-muted mb-0">
                            Your payment information is encrypted and secure. We do not store your credit card details.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadCheckoutItems();
    });

    function loadCheckoutItems() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const checkoutItemsContainer = document.getElementById('checkoutItems');

        if (cart.length === 0) {
            window.location.href = "{{ route('customer.cart') }}";
            return;
        }

        let checkoutHTML = '';
        let subtotal = 0;

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;

            checkoutHTML += `
                <div class="d-flex justify-content-between mb-2">
                    <span>${item.name} x${item.quantity}</span>
                    <span>P${itemTotal}</span>
                </div>
            `;
        });

        checkoutItemsContainer.innerHTML = checkoutHTML;

        const shipping = subtotal > 0 ? 200 : 0;
        const tax = subtotal * 0.12;
        const total = subtotal + shipping + tax;

        document.getElementById('checkoutSubtotal').textContent = 'P' + subtotal;
        document.getElementById('checkoutShipping').textContent = 'P' + shipping;
        document.getElementById('checkoutTax').textContent = 'P' + tax.toFixed(2);
        document.getElementById('checkoutTotal').textContent = 'P' + total.toFixed(2);
    }

    function processPayment() {
        // Simulate payment processing
        alert('Payment processed successfully! Your order has been placed.');
        localStorage.removeItem('cart');
        updateCartCount();
        window.location.href = "{{ route('customer.orders') }}";
    }
</script>
@endsection
@endsection

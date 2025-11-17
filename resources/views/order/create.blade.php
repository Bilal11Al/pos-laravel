<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/bilal.css') }}">
    <title>Point of Sale</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container-fluid container-pos">
        <div class="row h-100">
            <div class="col-md-7 product-section">
                <div class="mb-4">
                    <h4 class="mb-3 " id="productTitle">
                        <i class="fas fa-store"></i>
                        Product
                    </h4>
                    <input type="text" id="searchProduct" class="form-control search-box"
                        placeholder="Search Product...">
                </div>
                <div class="mb-4">
                    <button class="btn btn-primary category-btn active" onclick="filterCategory('all',this)">All
                        Menu</button>
                    @foreach ($category as $s)
                        <button class="btn btn-outline-primary category-btn"
                            onclick="filterCategory('{{ $s->name }}',this)">{{ $s->name }}</button>
                    @endforeach
                </div>
                <div class="row" id="productGrid">
                </div>
            </div>
            <div class="col-md-5 cart-section ">
                <div class="card-header">
                    <h4>Cart</h4>
                    <small>Order #<span class="orderNumber">{{ $order_code ?? '' }}</span></small>
                </div>
                <div class="card-items" id="cardItems">
                    <div class="text-center text-muted mt-5">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Cart is empty</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="total-section">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal : </span>
                            <span id="subtotal">0</span>
                            <input type="hidden" id="subtotal_value">
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Pajak(10%) : </span>
                            <span id="tax">0</span>
                            <input type="hidden" id="tax_value">
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total : </span>
                            <span id="total">0</span>
                            <input type="hidden" id="total_value">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger btn-checkout w-100" id="clearCard">
                                <i class="fa-solid fa-trash"></i>
                                <span>Clear Cart</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-checkout btn-primary w-100" onclick=" prosesPay()">
                                <i class="fa-solid fa-money-bill"></i>
                                <span>Payment Process</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="">---Select a payment method-----</option>
                            <option value="cash">Cash</option>
                            <option value="cashless">Cashless</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-process" onclick="handelPayment() ">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- <script>  const products = <?php echo json_encode($fetchProducts); ?></script> --}}
    <script src="{{ asset('assets/js/bilal.js') }}"></script>

</body>

</html>
</body>

</html>

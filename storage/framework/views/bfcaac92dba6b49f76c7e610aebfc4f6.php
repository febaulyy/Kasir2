
<?php $__env->startSection('title', 'Checkout'); ?>

<?php $__env->startSection('content'); ?>

<style>
    body { background:#f2f6ff !important; }

    .box {
        background:#fff;
        padding:18px;
        border-radius:14px;
        margin-bottom:18px;
        border:1px solid #dbe4ff;
        box-shadow:0 2px 5px rgba(0,56,255,.05);
    }

    .product {
        display:flex;
        gap:14px;
        padding:12px 0;
        border-bottom:1px solid #eef2ff;
    }

    .product:last-child { border-bottom:none; }

    .product img {
        width:80px;
        height:80px;
        object-fit:cover;
        border-radius:10px;
        border:1px solid #d7e3ff;
    }

    .pay-option {
        display:flex;
        align-items:center;
        gap:12px;
        padding:12px;
        border:1px solid #dbe4ff;
        border-radius:12px;
        background:#f8faff;
        cursor:pointer;
    }

    .pay-option:hover {
        background:#eef4ff;
        border-color:#a8c1ff;
    }

    .qris-box {
        display:none;
        margin-top:14px;
        padding:16px;
        background:#f0f4ff;
        border:1px solid #c8d6ff;
        border-radius:14px;
        text-align:center;
    }

    .total-box {
        background:#fff;
        padding:18px;
        border-radius:14px;
        border-top:1px solid #d0dcff;
        box-shadow:0 -2px 5px rgba(0,0,0,.08);
    }

    .btn-blue {
        background:#2458ff;
        color:white;
        font-weight:600;
        border-radius:10px;
    }

    .text-blue { color:#2458ff; }
</style>

<div class="container mt-3 mb-5">

    
    <div class="box">
        <h5 class="fw-bold mb-3">Produk Dipesan</h5>

        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product">
            <img src="<?php echo e(asset('storage/'.$item['foto'])); ?>">
            <div class="flex-grow-1">
                <div class="fw-semibold"><?php echo e($item['nama']); ?></div>
                <small class="text-muted">Qty <?php echo e($item['qty']); ?></small>
            </div>
            <div class="fw-bold text-blue">
                Rp <?php echo e(number_format($item['harga'] * $item['qty'],0,',','.')); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <form method="POST" action="<?php echo e(route('user.checkout.process')); ?>">
        <?php echo csrf_field(); ?>

        
        <input type="hidden" name="uang_dibayar" id="uang_dibayar_input">
        <input type="hidden" name="kembalian" id="kembalian_input">

        
        <div class="box">
            <h5 class="fw-bold mb-3">Metode Pembayaran</h5>

            <label class="pay-option mb-2 d-none">
                <input type="radio" name="metode_pembayaran" value="Transfer Bank" checked>
                Transfer Bank
            </label>

            <label class="pay-option mb-2 d-none">
                <input type="radio" name="metode_pembayaran" value="E-Wallet">
                E-Wallet
            </label>

            <label class="pay-option">
                <input type="radio" name="metode_pembayaran" value="Cash">
                Cash
            </label>

            
            <div id="qrisBox" class="qris-box d-none">
                <img src="<?php echo e(asset('assets/qris.jpg')); ?>" width="200">
            </div>

            
            <div id="cashBox" class="qris-box">
                <div class="mb-2 fw-semibold">Uang Dibayar</div>
                <input type="number" id="uangInput" class="form-control mb-3" placeholder="0">

                <div class="d-flex justify-content-between p-2 border rounded">
                    <span>Kembalian</span>
                    <span id="kembalianText" class="fw-bold text-blue">Rp 0</span>
                </div>
            </div>
        </div>

        
        <div class="total-box">
            <div class="d-flex justify-content-between mb-3">
                <span class="fw-semibold">Total</span>
                <span class="fw-bold text-blue">
                    Rp <?php echo e(number_format($total = collect($cart)->sum(fn($c)=>$c['harga']*$c['qty']),0,',','.')); ?>

                </span>
            </div>

            <button id="submitBtn" class="btn btn-blue w-100 py-2 fs-5">
                Buat Pesanan
            </button>
        </div>

    </form>
</div>

<script>
const total = <?php echo e($total); ?>;
const qrisBox = document.getElementById('qrisBox');
const cashBox = document.getElementById('cashBox');
const uangInput = document.getElementById('uangInput');
const kembalianText = document.getElementById('kembalianText');
const submitBtn = document.getElementById('submitBtn');

const uangDB = document.getElementById('uang_dibayar_input');
const kembaliDB = document.getElementById('kembalian_input');

function format(n){ return 'Rp ' + n.toLocaleString('id-ID'); }

function updateUI(){
    const metode = document.querySelector("input[name='metode_pembayaran']:checked").value;

    if(metode === 'Cash'){
        qrisBox.style.display = 'none';
        cashBox.style.display = 'block';
        submitBtn.disabled = true;
    }else{
        qrisBox.style.display = 'block';
        cashBox.style.display = 'none';
        submitBtn.disabled = false;
        uangDB.value = 0;
        kembaliDB.value = 0;
    }
}

function hitung(){
    const bayar = parseInt(uangInput.value || 0);
    const kembali = bayar - total;

    uangDB.value = bayar;
    kembaliDB.value = kembali > 0 ? kembali : 0;

    if(kembali < 0){
        kembalianText.innerText = 'Uang kurang';
        submitBtn.disabled = true;
    }else{
        kembalianText.innerText = format(kembali);
        submitBtn.disabled = false;
    }
}

document.querySelectorAll("input[name='metode_pembayaran']")
    .forEach(r => r.addEventListener('change', updateUI));

uangInput?.addEventListener('input', hitung);

updateUI();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Kasir2\resources\views/user/checkout.blade.php ENDPATH**/ ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<button id="pay-button">Bayar Sekarang</button>

<script>
document.getElementById('pay-button').onclick = function(){
    fetch('/payment')
        .then(response => response.json())
        .then(data => {
            snap.pay(data.snap_token);
        })
        .catch(error => console.error(error));
};
</script>

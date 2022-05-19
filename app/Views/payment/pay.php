<html>

<body>
    <button id="pay-button">Pay!</button>
    <div class="test-text" id="test-text" value="text-val">text-inner</div>


    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

    <script>
    document.getElementById('result-json').innerHTML += document.getElementById('test-text').innerHTML;
    </script>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-d6P8m8frZJGFVDPz">
    </script>

    <script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
            // Optional
            onSuccess: function(result) {
                alert('Pembayaran sukses...');
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onPending: function(result) {
                alert('Pembayaran pending...');
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result) {
                alert('Pembayaran error...');
                /* You may add your own js here, this is just example */
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
    </script>
</body>

</html>
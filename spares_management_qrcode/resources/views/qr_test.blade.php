@extends('layout.app')
@section('content')
<div style="display: flex; justify-content: center; gap: 40px;">

    <div id="qrcode"></div>
    <br>
    <br>
    <div  id="generate_button">
        <button onclick="generateQRCode_parent();" >generate QR</button>
    </div>
    <br><br>
    <div>
        <button onclick="printQR('qrcode');">Print QR</button>
    </div>
</div>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
function generateQRCode(data, elementId) {
    var qr = new QRCode(document.getElementById(elementId), {
        text: data,
        width: 128,
        height: 128,
    });
    // console.log(qrElement);
    qrElement.innerHTML = qr.createImgTag();
}

function printQR(divId)
{
    var content = document.getElementById(divId).innerHTML;
    var printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<html><head><title>Print</title></head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}
// Example usage
function generateQRCode_parent()
{
    var information = window.location.href;
    // document.getElementById('generate_button').style.display = none;
    generateQRCode(information, "qrcode");
    // document.addEventListener("DOMContentLoaded", function() {
// });
}
</script>

@endsection
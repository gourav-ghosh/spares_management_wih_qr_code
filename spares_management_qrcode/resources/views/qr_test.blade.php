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
    <!-- <script src="https://cdn.rawgit.com/papnkukn/qrcode-svg/gh-pages/qrcode.min.js"></script>    -->
<script>
function generateQRCode(data, elementId) {
    var logoUrl = '/dist/assets/logo.png';
    var qr = new QRCode(
        document.getElementById(elementId),
        {
            text: data,
            width: 256,
            height: 256,
            logo: {
                src: '/dist/assets/logo.png',
                logoSize: 0.2, // Adjust the size of the logo (percentage of the QR code size)
                borderSize: 4, // Adjust the border size around the logo
            },
        }
    );
    // console.log(qrElement);
    qrElement.innerHTML = qr.createImgTag();
}
// function generateQRCode(data, elementId) {
//     var qrCode = new QRCode(document.getElementById(elementId), {
//         text: data,
//         width: 256,
//         height: 256,
//     });

//     return qrCode;
// }

// function addLogoToQRCode(qrCode, logoUrl) {
//     var svg = qrCode._htOption.container.querySelector("svg");
//     var logoSize = qrCode._htOption.width * 0.2; // Adjust the logo size as a percentage of QR code width

//     var image = document.createElementNS("http://www.w3.org/2000/svg", "image");
//     image.setAttributeNS(null, "href", logoUrl);
//     image.setAttributeNS(null, "width", logoSize);
//     image.setAttributeNS(null, "height", logoSize);
//     image.setAttributeNS(null, "x", (qrCode._htOption.width - logoSize) / 2); // Center the logo horizontally
//     image.setAttributeNS(null, "y", (qrCode._htOption.height - logoSize) / 2); // Center the logo vertically

//     svg.appendChild(image);
// }
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
    var qrCode = generateQRCode(information, "qrcode");
    // addLogoToQRCode(qrCode, '/dist/assets/logo.png');
    // document.getElementById('generate_button').style.display = none;
    // generateQRCode(information, "qrcode");
    // document.addEventListener("DOMContentLoaded", function() {
// });
}
</script>

@endsection
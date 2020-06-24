<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงลายเซ็น - med.nu.ac.th</title>

</head>
<body>

    <div id="qrcode"></div>

    <script src="<?php echo base_url(load_file('assets/js/qrcodejs/jquery.min.js'));?>"></script>
    <script src="<?php echo base_url(load_file('assets/js/qrcodejs/qrcode.min.js'));?>"></script>
    <script>

        var qrcode = new QRCode("qrcode", {
            text: "http://jindo.dev.naver.com/collie",
            width: 300,
            height: 300,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

    </script>
</body>
</html>
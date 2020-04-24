<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงลายเซ็น - med.nu.ac.th</title>

    <style>
        body{
            padding:0px;
            margin:0px;
        }
        .signature{
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow-x: scroll;
        }
        .line{
            border: 1px solid #cccccc;
            width: calc(100vw - 90px);
            position: absolute;
            left: 0;
            right: 0;
            top: calc(100vh - 200px);
            margin: auto;
        }
        .text-sig{
            width: calc(100vw - 90px);
            position: absolute;
            left: 0;
            right: 0;
            top: calc(100vh - 190px);
            margin: auto;
            text-align: center;
            color: #555555;
        }
        .box-sig {
            position: relative;
            width: 100vw;
            height: calc(100vh - 160px);
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .box-button {
            position: relative;
            width: calc(100vw - 22px);
            height: calc(100vh - 36px);
            margin: auto;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .box-button button{
            border: 1px solid;
            border-radius: 5px;
            padding: 5px;
            font-size: 0.8em;
            min-width: 50px;
        }

        .signature-pad {
            position: absolute;
            left: 0;
            right: 0;
            top: 10px;
            width: calc(100vw - 22px);
            height: calc(100vh - 180px);
            border: 1px dotted;
            margin: auto;
            z-index: 2;
        }    
    </style>
</head>
<body>

    <div class="signature">
        <div class="box-sig">
            <canvas id="signature-pad" class="signature-pad"></canvas>
        </div>
        <div class="line"></div>
        <div class="text-sig">* กรณุาปรับอุปกร์ของท่านให้อยู่ในแนวนอน</div>
        <div style="position: absolute;top: 6px;right:0;left:0;margin:auto;"><center><img src="<?php echo base_url(load_file('assets/img/logo.med.single.png'));?>" style="max-width: calc(100vw - 80%);opacity: 0.15;"></center></div>
        <div class="box-button">
            <button id="clear">ลบ</button>&nbsp;&nbsp;&nbsp;
            <button id="save-png">บันทึกลายเซ็น</button>
        </div>
    </div>

    <script src="<?php echo base_url(load_file('assets/js/signature_pad/signature_pad.min.js'));?>"></script>
    <script>

        var canvas = document.getElementById('signature-pad');
        function resizeCanvas() {
            var ratio =  Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        var signaturePad = new SignaturePad(canvas);
        document.getElementById('clear').addEventListener('click', function () {
            signaturePad.clear();
        });
        document.getElementById('save-png').addEventListener('click', function () {


            if (signaturePad.isEmpty()) {
                return alert("กรุณาลงลายเซ็น");
                return false;
            }
            var con = confirm('ต้องการบันทึกลายเซ็นใช่หรือไม่');
            if(con){
                var data = signaturePad.toDataURL('image/png');
                console.log(data);
            }

        });

    </script>
</body>
</html>
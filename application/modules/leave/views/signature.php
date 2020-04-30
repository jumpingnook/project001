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
            background-color: #863920;
        }
        .signature{
            position: relative;
            width: 568px;
            height: 100vh;
            overflow-x: scroll;
            margin: auto;
        }
        .line{
            border: 1px solid #cccccc;
            width: 480px;
            position: absolute;
            left: 0;
            right: 0;
            top: 120px;
            margin: auto;
        }
        .text-sig{
            width: 478px;
            position: absolute;
            left: 0;
            right: 0;
            top: 135px;
            margin: auto;
            text-align: center;
            color: #555555;
            font-size: 0.8em;
        }
        .box-sig {
            position: relative;
            width: 568px;
            height: 160px;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .box-button {
            position: relative;
            width: 560px;
            margin: auto;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            margin-top: 10px;
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
            width: 548px;
            height: 142px;
            border: 1px dotted;
            margin: auto;
            z-index: 2;
            max-width: 548px;
            max-height: 142px;
        } 
        input[type=text]{
            border: 1px solid #555555;
            border-radius: 5px;
            height: 30px;
            width: 556px;
            font-size: 0.8em;
            padding-left:4px;
        }
        table{
            width: calc(100% - 20px);
            margin: auto;
            
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        table,tr,td{
            border: 1px solid #555;
        }
        table td{
            padding:2px;
            background-color: #ffffff;
        }
        table tr td:first-child{
            background-color: #ccc;
        }

    </style>
</head>
<body>

    <div class="signature">
        
        <div style="position: relative;background-color: #fff;">
            <div class="box-sig">
                <canvas id="signature-pad" class="signature-pad"></canvas>
            </div>
            <div class="line"></div>
            <div class="text-sig">* กรณุาปรับอุปกร์ของท่านให้อยู่ในแนวนอน</div>
            <div style="position: absolute;top: 6px;right:0;left:0;margin:auto;"><center><img src="<?php echo base_url(load_file('assets/img/logo.med.single.png'));?>" style=" max-width: 120px;opacity: 0.3;"></center></div>
        </div>

        <div class="box-button">
            <?php if($signature_type==3){?>
                <input type="text" name="boss_comment" value="" form="form" placeholder="บันทึกความเห็นการลาที่นี่" ><br/><br/>
            <?php } ?>

            <a href="<?php echo base_url(url_index().'leave');?>"><button type="button" style="background-color: #cccccc;">< กลับไปที่ระบบลา</button></a>&nbsp;&nbsp;

            <button type="button" id="clear" style="background-color: #cccccc;">ลบลายเซ็น</button>&nbsp;&nbsp;
            <button type="button" id="save-png" style="background-color: #FF9800;color: #222222;"><?php echo $signature_type==3?'อนุญาติและให้':'';?>บันทึกลายเซ็น</button>&nbsp;&nbsp;

            <?php if($signature_type==3){?>
                <button type="button" id="cancel" style="background-color: #e02525;color: #ffffff;">ไม่อนุญาติให้ลา</button>
            <?php } ?>
        </div>

        <div id="detail">
            <table>
                <tr>
                    <td colspan="2" style="background-color: #fff;font-weight: bold;padding: 5px;">รายละเอียดข้อมูลการลา</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">ข้อมูลผู้ลา</td>
                </tr>
                <tr>
                    <td>รหัสพนักงาน</td>
                    <td><?php echo isset($personnel['personnel_code'])?$personnel['personnel_code']:'-';?></td>
                </tr>
                <tr>
                    <td width="150px">ชื่อ - นามสกุล</td>
                    <td><?php 
                        echo isset($personnel['title'])?$personnel['title']:'-'; 
                        echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                        echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                      ?></td>
                </tr>
                <tr>
                    <td>ตำแหน่ง</td>
                    <td><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></td>
                </tr>
                <tr>
                    <td>ประเภทงานพนักงาน</td>
                    <td><?php echo isset($personnel['emp_type_name'])?$personnel['emp_type_name']:'-';?></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><?php echo isset($personnel['data']['phone'])?$personnel['data']['phone']:'-';?></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์ภายใน</td>
                    <td><?php echo isset($personnel['data']['internal_tel'])?$personnel['data']['internal_tel']:'-';?></td>
                </tr>
                <tr>
                    <td>อีเมล</td>
                    <td><?php echo isset($personnel['data']['email'])?$personnel['data']['email']:'-';?></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">ข้อมูลการลา</td>
                </tr>
                <tr>
                    <td>ประเภทการลา</td>
                    <td><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></td>
                </tr>
                <tr>
                    <td>เลขที่</td>
                    <td><?php echo isset($data['leave_no'])?$data['leave_no']:'0';?></td>
                </tr>
                <?php if(isset($data['title']) and trim($data['title'])!=''){ ?>
                <tr>
                    <td>เรื่อง</td>
                    <td><?php echo isset($data['title'])?htmlspecialchars_decode($data['title']):'-';?></td>
                </tr>
                <?php } ?>
                <?php if(isset($data['detail']) and trim($data['detail'])!=''){ ?>
                <tr>
                    <td>รายละเอียด</td>
                    <td><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></td>
                </tr>
                <?php } ?>
                <?php if(isset($data['contact']) and trim($data['contact'])!=''){ ?>
                <tr>
                    <td>ข้อมูลการติดต่อ</td>
                    <td><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>ลาช่วงวันที่</td>
                    <td><?php echo date('Y/m/d',strtotime($data['period_start'])).($data['period_end']!=''?' - '.date('Y/m/d',strtotime($data['period_end'])):'');?></td>
                </tr>
                <tr>
                    <td>จำนวนวันลารวม</td>
                    <td><?php echo isset($data['period_count'])?floatval($data['period_count']).(($data['period_type']!='a'?$data['period_type']=='p'?' (บ่าย)':' (วัน)':' (เช้า)')):'-';?></td>
                </tr>
                <tr>
                    <td>ลงข้อมูลลาวันที่</td>
                    <td><?php echo date('Y/m/d',strtotime($data['create_date']));?></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-weight: bold;">ข้อมูลผู้อนุมัติ</td>
                </tr>
                <?php if(isset($workmate) && is_array($workmate) && count($workmate)>0){ ?>
                <tr>
                    <td>ผู้ทำงานแทน</td>
                    <td><?php echo isset($workmate) && is_array($workmate)?$workmate['title'].$workmate['name_th'].' '.$workmate['surname_th']:' - ';?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td>ผู้บังคับบัญชา</td>
                    <td><?php echo isset($boss) && is_array($boss)?$boss['title'].$boss['name_th'].' '.$boss['surname_th']:' - ';?></td>
                </tr>
                <tr>
                    <td>ผู้บริหารระดับสูง</td>
                    <td><?php 
                        if(isset($data['to']) and $data['to']==1){
                          echo 'คณะบดีคณะแพทยศาสตร์';
                        }elseif(isset($data['to']) and $data['to']==2){
                          echo 'อธิกาารบดี';
                        }else{
                          echo 'อธิกาารบดี (คณะบดีคณะแพทยศาสตร์)';
                        }
                      ?></td>
                </tr>

            </table>
        </div>
        
        
    </div>

    <form id="form" action="<?php echo base_url(url_index().'leave/save_signature');?>" method="post">
        <input type="hidden" name="personnel_id" value="<?php echo $personnel_id;?>">
        <input type="hidden" name="type" value="<?php echo $signature_type;?>">
        <input type="hidden" name="leave_id" value="<?php echo $leave_id;?>">
        <input type="hidden" id="signature_gen" name="signature" value="">
    </form>

    <script src="<?php echo base_url(load_file('assets/vendor/jquery/jquery.min.js'));?>"></script>
    <script src="<?php echo base_url(load_file('assets/js/helper-js.js'));?>"></script>
    <script src="<?php echo base_url(load_file('assets/js/signature_pad/signature_pad.min.js'));?>"></script>
    <script>
        $(document).ready(function(){
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
                    $('#signature_gen').val(data);
                    $('#form').submit();
                }
            });

            $('#cancel').click(function(){
                var con = confirm('ต้องการบันทึกใช่หรือไม่');
                if(con){
                    $('#form').submit();
                }
            });
        });
    </script>
</body>
</html>
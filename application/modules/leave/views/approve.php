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

        <div class="box-button">
            <a href="<?php echo base_url(url_index().'leave');?>"><button type="button" style="background-color: #cccccc;">< กลับไปที่ระบบลา</button></a>&nbsp;&nbsp;
            <?php if($signature_type>=2 and $signature_type!=5){?>
                <button type="submit" name="approve" form="form" value="1">เห็นควรอนุญาติ</button>
                <button type="submit" name="approve" form="form" value="2">เห็นควรไม่อนุญาติ</button>
            <?php } ?>
        </div>

    </div>

    <form id="form" action="<?php echo base_url(url_index().'leave/save_approve');?>" method="post">
        <input type="hidden" name="personnel_id" value="<?php echo $personnel_id;?>">
        <input type="hidden" name="type" value="<?php echo $signature_type;?>">
        <input type="hidden" name="leave_id" value="<?php echo $leave_id;?>">
    </form>

    <script src="<?php echo base_url(load_file('assets/vendor/jquery/jquery.min.js'));?>"></script>
    <script src="<?php echo base_url(load_file('assets/js/helper-js.js'));?>"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
</body>
</html>
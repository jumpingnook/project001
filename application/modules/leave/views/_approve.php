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
            width: 800px;
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
        @font-face {
            font-family: 'th-sarabun';
            src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>');
            src: url('<?php echo base_url(load_file('assets/font/THSarabun.ttf'));?>')  format('truetype'), /* Safari, Android, iOS */
        }
        .document{
            position:relative;
            font-family:'th-sarabun';
            color:#000000;
        }
        .document span{
            padding-top:0.5%;
            position:absolute;
            font-size:1.4vw;
        }
        .overflow-text{
            display: block;
            overflow: hidden;
            height:2% !important;
        }
        .img-sig{
            max-width: 16vw;
            margin-left: -8%;
            margin-top: -11%;
        }
        /* table{
            width: calc(100% - 20px);
            margin: auto;
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
        } */
    </style>
    


</head>
<body>

    <div class="signature">

        <!-- <div id="detail">
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
                          echo 'คณบดีคณะแพทยศาสตร์';
                        }elseif(isset($data['to']) and $data['to']==2){
                          echo 'อธิการบดี';
                        }else{
                          echo 'อธิการบดี (คณบดีคณะแพทยศาสตร์)';
                        }
                      ?></td>
                </tr>

            </table>
        </div> -->

        <div id="document" class="row mb-2" style="border: 1px solid #ccc;">
            <div class="col-lg-12 document" >
                <?php $doc = []; if(isset($data['leave_type_id']) and intval($data['leave_type_id'])==1){$doc[0] = 'document/leave/1.jpg';?>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 42%);"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 32%);"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 17%);"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: 18%;left: 18%;">
                    <?php 
                    if(isset($data['to']) and $data['to']==1){
                        echo 'คณบดีคณะแพทยศาสตร์';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี (คณบดีคณะแพทยศาสตร์)';
                    }
                    ?>
                </span>
                <span style="top: calc(100% - 78.7%);left: calc(100% - 69%);">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: calc(100% - 78.7%);left: calc(100% - 36%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: calc(100% - 76.6%);left: calc(100% - 80%);"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

                <span style="top: calc(100% - 74.6%);left: calc(100% - 72%);">99*</span>
                <span style="top: 25.4%;left: 60%;">99*</span>
                <span style="top: calc(100% - 74.6%);left: calc(100% - 23%);">99*</span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 70%);">
                    <?php echo date_th($data['period_start'],2);?>
                </span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 44%);">
                    <?php echo date_th($data['period_end'],2);?>
                </span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 17%);"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

                <span class="overflow-text" style="top: calc(100% - 70.1%);left: calc(100% - 63%);width: 51%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                <span style="top: 41%;left: 15%;">*99</span>
                <span style="top: 41%;left: 25%;">*99</span>
                <span style="top: 41%;left: 35%;">*99</span>

                <span style="top: 45%;left: 35%;">*99</span>
                <span style="top: 46.8%;left: 35%;">*99</span>
                <span style="top: 48.8%;left: 35%;">*99</span>
                <span style="top: 50.4%;left: 35%;">*99</span>
                <span style="top: 52.4%;left: 35%;">*99</span>
                <span style="top: 54.4%;left: 35%;">*99</span>

                <span style="top: 38%;left: 58%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 40.2%;left: 58%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 46.6%;left: 58%;"><img src="<?php echo isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])?$personnel_list['data'][$data['worker_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 48.7%;left: 58%;">
                    <?php 
                    if(isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['worker_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                
                <span style="top: 59.2%;left: 21%;">
                    <?php 
                    if(isset($data['hr_personnel_id']) and intval($data['hr_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['hr_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 62.2%;left: 18%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>

                <span style="top: 54.4%;left: 51.5%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 54.4%;left: 68.5%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 58%;left: 58%;"><img src="<?php echo isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])?$personnel_list['data'][$data['head_unit_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 60.2%;left: 58%;">
                    <?php 
                    if(isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])){
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 62.2%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['head_unit_position']) && trim($data['head_unit_position'])!=''?$data['head_unit_position']:''; ?></span>
                <span style="top: 64.2%;left: 58%;"><?php echo isset($data['signature_head_unit_date']) && trim($data['signature_head_unit_date'])!=''?date('d/m/',strtotime($data['signature_head_unit_date'])).(date("Y",strtotime($data['signature_head_unit_date']))+543):''; ?></span>





                <span style="top: 69.4%;left: 14%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.4%;left: 31%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 72.5%;left: 21%;"><img src="<?php echo isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])?$personnel_list['data'][$data['head_dept_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 74.5%;left: 21%;">
                    <?php 
                    if(isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 76.8%;left: 21%;width: 28%;height: 2.5%;"><?php echo isset($data['head_dept_position']) && trim($data['head_dept_position'])!=''?$data['head_dept_position']:''; ?></span>
                <span style="top: 78.8%;left: 21%;"><?php echo isset($data['signature_head_dept_date']) && trim($data['signature_head_dept_date'])!=''?date('d/m/',strtotime($data['signature_head_dept_date'])).(date("Y",strtotime($data['signature_head_dept_date']))+543):''; ?></span>







                <span style="top: 69.4%;left: 51.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.4%;left: 68.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 72.2%;left: 58%;"><img src="<?php echo isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['supervisor_personnel_id']])?$personnel_list['data'][$data['supervisor_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 74.5%;left: 58%;">
                    <?php 
                    if(isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 76.6%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['supervisor_position']) && trim($data['supervisor_position'])!=''?$data['supervisor_position']:''; ?></span>
                <span style="top: 78.8%;left: 58%;"><?php echo isset($data['signature_supervisor_date']) && trim($data['signature_supervisor_date'])!=''?date('d/m/',strtotime($data['signature_supervisor_date'])).(date("Y",strtotime($data['signature_supervisor_date']))+543):''; ?></span>




                <span style="top: 83.4%;left: 51.5%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83.4%;left: 62%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 83.4%;left: 74%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==3?'&#10003;':''; ?></span>
                <span style="top: 87.6%;left: 58%;"><img src="<?php echo isset($data['deputy_dean_personnel_id']) and intval($data['deputy_dean_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])?$personnel_list['data'][$data['deputy_dean_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 89.8%;left: 58%;">
                    <?php 
                    if(isset($data['deputy_dean_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])){
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 91.8%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['deputy_dean_position']) && trim($data['deputy_dean_position'])!=''?$data['deputy_dean_position']:''; ?></span>
                <span style="top: 94%;left: 58%;"><?php echo isset($data['signature_deputy_dean_date']) && trim($data['signature_deputy_dean_date'])!=''?date('d/m/',strtotime($data['signature_deputy_dean_date'])).(date("Y",strtotime($data['signature_deputy_dean_date']))+543):''; ?></span>



                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])>=2 and intval($data['leave_type_id'])<=3){ $doc[0] = 'document/leave/2-3.jpg';?>
                <span style="top: 10.6%;left: 58%;"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: 10.6%;left: 68%;"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: 10.6%;left: 83%;"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: 13%;left: 22%;"><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
                <span style="top: 18.8%;left: 28%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 18.8%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: 21.4%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

                <span style="top: 24.5%;left: 19%;"><?php echo $data['leave_type_id']==3?'&#10003':'';?></span>
                <span style="top: 24.5%;left: 28%;"><?php echo $data['leave_type_id']==2?'&#10003':'';?></span>
                <span style="top: 24.5%;left: 43%;"></span>

                <span class="overflow-text" style="top: 27%;left: 21%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

                <span style="top: 29.8%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

                <span style="top: 29.8%;left: 48%;"><?php echo date_th($data['period_end'],2);?></span>

                <span style="top: 29.8%;left: 77%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

                <span style="top: 32.5%;left: 28%;">&#10003;</span>
                <span style="top: 32.5%;left: 43.4%;">&#10003;</span>
                <span style="top: 32.5%;left: 61.4%;">&#10003;</span>

                <span style="top: 34.8%;left: 30%;">*99</span>

                <span style="top: 34.8%;left: 52%;">*99</span>

                <span style="top: 34.8%;left: 81%;">*99</span>

                <span class="overflow-text" style="top: 37.4%;left: 38%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                <span style="top: 48%;left: 26%;">*99</span>
                <span style="top: 48%;left: 35%;">*99</span>
                <span style="top: 48%;left: 43%;">*99</span>
                <span style="top: 50%;left: 26%;">*99</span>
                <span style="top: 50%;left: 35%;">*99</span>
                <span style="top: 50%;left: 43%;">*99</span>
                <span style="top: 52.4%;left: 26%;">*99</span>
                <span style="top: 52.4%;left: 35%;">*99</span>
                <span style="top: 52.4%;left: 43%;">*99</span>
                <span style="top: 54.8%;left: 43%;">*99</span>

                <span style="top: 49.2%;left: 60%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 51.4%;left: 60%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 60.4%;left: 60%;"><img src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 62.4%;left: 60%;">
                    <?php 
                    if(isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['worker_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>

                <span style="top: 60%;left: 21%;">
                    <?php 
                    if(isset($data['hr_personnel_id']) and intval($data['hr_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['hr_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 62.8%;left: 18%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>


                <span style="top: 68%;left: 15%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 68%;left: 32%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 70.8%;left: 21%;"><img src="<?php echo isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])?$personnel_list['data'][$data['head_unit_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 72.8%;left: 21%;">
                    <?php 
                    if(isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])){
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 75%;left: 21%;"><?php echo isset($data['head_unit_position']) && trim($data['head_unit_position'])!=''?$data['head_unit_position']:''; ?></span>
                <span style="top: 77%;left: 21%;"><?php echo isset($data['signature_head_unit_date']) && trim($data['signature_head_unit_date'])!=''?date('d/m/',strtotime($data['signature_head_unit_date'])).(date("Y",strtotime($data['signature_head_unit_date']))+543):''; ?></span>


                <span style="top: 68%;left: 53%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 68%;left: 70%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 70.8%;left: 60%;"><img src="<?php echo isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])?$personnel_list['data'][$data['head_dept_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 72.8%;left: 60%;">
                    <?php 
                    if(isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 75%;left: 60%;"><?php echo isset($data['head_dept_position']) && trim($data['head_dept_position'])!=''?$data['head_dept_position']:''; ?></span>
                <span style="top: 77%;left: 60%;"><?php echo isset($data['signature_head_dept_date']) && trim($data['signature_head_dept_date'])!=''?date('d/m/',strtotime($data['signature_head_dept_date'])).(date("Y",strtotime($data['signature_head_dept_date']))+543):''; ?></span>


                <span style="top: 83%;left: 32%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 15%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 86.4%;left: 21%;"><img src="<?php echo isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['supervisor_personnel_id']])?$personnel_list['data'][$data['supervisor_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 88.8%;left: 21%;">
                    <?php 
                    if(isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 90.8%;left: 21%;"><?php echo isset($data['supervisor_position']) && trim($data['supervisor_position'])!=''?$data['supervisor_position']:''; ?></span>
                <span style="top: 93%;left: 21%;"><?php echo isset($data['signature_supervisor_date']) && trim($data['signature_supervisor_date'])!=''?date('d/m/',strtotime($data['signature_supervisor_date'])).(date("Y",strtotime($data['signature_supervisor_date']))+543):''; ?></span>


                <span style="top: 83%;left: 53%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 64%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 76%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==3?'&#10003;':''; ?></span>
                <span style="top: 86.4%;left: 60%;"><img src="<?php echo isset($data['deputy_dean_personnel_id']) and intval($data['deputy_dean_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])?$personnel_list['data'][$data['deputy_dean_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 88.8%;left: 60%;">
                    <?php 
                    if(isset($data['deputy_dean_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])){
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 90.8%;left: 60%;"><?php echo isset($data['deputy_dean_position']) && trim($data['deputy_dean_position'])!=''?$data['deputy_dean_position']:''; ?></span>
                <span style="top: 93%;left: 60%;"><?php echo isset($data['signature_deputy_dean_date']) && trim($data['signature_deputy_dean_date'])!=''?date('d/m/',strtotime($data['signature_deputy_dean_date'])).(date("Y",strtotime($data['signature_deputy_dean_date']))+543):''; ?></span>








                
                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==4){ $doc[0] = 'document/leave/4-2.jpg';$doc[1] = 'document/leave/4.jpg';?>
                <span style="top: 10.6%;left: 58%;"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: 10.6%;left: 68%;"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: 10.6%;left: 83%;"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: 13%;left: 22%;"><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
                <span style="top: 18.8%;left: 28%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 18.8%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: 21.4%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

                <span style="top: 24.5%;left: 19%;">&#10003;</span>
                <span style="top: 24.5%;left: 28%;">&#10003;</span>
                <span style="top: 24.5%;left: 43%;">&#10003;</span>

                <span class="overflow-text" style="top: 27%;left: 21%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

                <span style="top: 29.8%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

                <span style="top: 29.8%;left: 48%;"><?php echo date_th($data['period_end'],2);?></span>

                <span style="top: 29.8%;left: 77%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

                <span style="top: 32.5%;left: 28%;">&#10003;</span>
                <span style="top: 32.5%;left: 43.4%;">&#10003;</span>
                <span style="top: 32.5%;left: 61.4%;">&#10003;</span>

                <span style="top: 34.8%;left: 30%;">*99</span>

                <span style="top: 34.8%;left: 52%;">*99</span>

                <span style="top: 34.8%;left: 81%;">*99</span>

                <span class="overflow-text" style="top: 37.4%;left: 38%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                <span style="top: 48%;left: 26%;">*99</span>
                <span style="top: 48%;left: 35%;">*99</span>
                <span style="top: 48%;left: 43%;">*99</span>
                <span style="top: 50%;left: 26%;">*99</span>
                <span style="top: 50%;left: 35%;">*99</span>
                <span style="top: 50%;left: 43%;">*99</span>
                <span style="top: 52.4%;left: 26%;">*99</span>
                <span style="top: 52.4%;left: 35%;">*99</span>
                <span style="top: 52.4%;left: 43%;">*99</span>
                <span style="top: 54.8%;left: 43%;">*99</span>

                <span style="top: 49.2%;left: 60%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 51.4%;left: 60%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 60.4%;left: 60%;"><img src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 62.4%;left: 60%;">
                    <?php 
                    if(isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['worker_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                
                <span style="top: 60%;left: 21%;">
                    <?php 
                    if(isset($data['hr_personnel_id']) and intval($data['hr_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['hr_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 62.8%;left: 18%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>


                <span style="top: 68%;left: 15%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 68%;left: 32%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 70.8%;left: 21%;"><img src="<?php echo isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])?$personnel_list['data'][$data['head_unit_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 72.8%;left: 21%;">
                    <?php 
                    if(isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])){
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 75%;left: 21%;"><?php echo isset($data['head_unit_position']) && trim($data['head_unit_position'])!=''?$data['head_unit_position']:''; ?></span>
                <span style="top: 77%;left: 21%;"><?php echo isset($data['signature_head_unit_date']) && trim($data['signature_head_unit_date'])!=''?date('d/m/',strtotime($data['signature_head_unit_date'])).(date("Y",strtotime($data['signature_head_unit_date']))+543):''; ?></span>


                <span style="top: 68%;left: 53%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 68%;left: 70%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 70.8%;left: 60%;"><img src="<?php echo isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])?$personnel_list['data'][$data['head_dept_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 72.8%;left: 60%;">
                    <?php 
                    if(isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 75%;left: 60%;"><?php echo isset($data['head_dept_position']) && trim($data['head_dept_position'])!=''?$data['head_dept_position']:''; ?></span>
                <span style="top: 77%;left: 60%;"><?php echo isset($data['signature_head_dept_date']) && trim($data['signature_head_dept_date'])!=''?date('d/m/',strtotime($data['signature_head_dept_date'])).(date("Y",strtotime($data['signature_head_dept_date']))+543):''; ?></span>


                <span style="top: 83%;left: 32%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 15%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 86.4%;left: 21%;"><img src="<?php echo isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['supervisor_personnel_id']])?$personnel_list['data'][$data['supervisor_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 88.8%;left: 21%;">
                    <?php 
                    if(isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 90.8%;left: 21%;"><?php echo isset($data['supervisor_position']) && trim($data['supervisor_position'])!=''?$data['supervisor_position']:''; ?></span>
                <span style="top: 93%;left: 21%;"><?php echo isset($data['signature_supervisor_date']) && trim($data['signature_supervisor_date'])!=''?date('d/m/',strtotime($data['signature_supervisor_date'])).(date("Y",strtotime($data['signature_supervisor_date']))+543):''; ?></span>


                <span style="top: 83%;left: 53%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 64%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 83%;left: 76%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==3?'&#10003;':''; ?></span>
                <span style="top: 86.4%;left: 60%;"><img src="<?php echo isset($data['deputy_dean_personnel_id']) and intval($data['deputy_dean_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])?$personnel_list['data'][$data['deputy_dean_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 88.8%;left: 60%;">
                    <?php 
                    if(isset($data['deputy_dean_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])){
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 90.8%;left: 60%;"><?php echo isset($data['deputy_dean_position']) && trim($data['deputy_dean_position'])!=''?$data['deputy_dean_position']:''; ?></span>
                <span style="top: 93%;left: 60%;"><?php echo isset($data['signature_deputy_dean_date']) && trim($data['signature_deputy_dean_date'])!=''?date('d/m/',strtotime($data['signature_deputy_dean_date'])).(date("Y",strtotime($data['signature_deputy_dean_date']))+543):''; ?></span>
                









                
                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==5){ $doc[0] = 'document/leave/5.jpg';?>
                <span style="top: calc(100% - 91.8%);left: calc(100% - 29%);"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                <span style="top: calc(100% - 89.2%);left: calc(100% - 39%);"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: calc(100% - 89.2%);left: calc(100% - 31%);"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: calc(100% - 89.2%);left: calc(100% - 15%);"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: calc(100% - 84.2%);left: calc(100% - 83%);">
                    <?php 
                    if(isset($data['to']) and $data['to']==1){
                        echo 'คณบดีคณะแพทยศาสตร์';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี (คณบดีคณะแพทยศาสตร์)';
                    }
                    ?>
                </span>

                <span style="top: calc(100% - 78.9%);left: calc(100% - 69%);">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: calc(100% - 78.9%);left: calc(100% - 36%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: calc(100% - 76.3%);left: calc(100% - 82%);">99*</span>

                <span style="top: calc(100% - 76.3%);left: calc(100% - 67%);"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

                <span class="overflow-text" style="top: calc(100% - 73.8%);left: calc(100% - 69%);width: 46%;height:3%;"><?php echo isset($personnel['wife_name']) && trim($personnel['wife_name'])!=''?$personnel['wife_name']:'-';?></span>

                <span style="top: calc(100% - 71.2%);left: calc(100% - 71%);"><?php echo date('d',strtotime($data['child_birthdate']));?></span>
                <span style="top: calc(100% - 71.2%);left: calc(100% - 64%);"><?php echo date_th($data['child_birthdate'],9);?></span>
                <span style="top: calc(100% - 71.2%);left: calc(100% - 51.7%);"><?php echo date_th($data['child_birthdate'],10);?></span>

                <span style="top: 31.3%;left: 17.3%;"><?php echo date('d',strtotime($data['period_start']));?></span>
                <span style="top: 31.3%;left: 24.3%;"><?php echo date_th($data['period_start'],9);?></span>
                <span style="top: 31.3%;left: 35.3%;"><?php echo date_th($data['period_start'],10);?></span>
                <span style="top: 31.3%;left: 47.3%;"><?php echo date('d',strtotime($data['period_end']));?></span>
                <span style="top: 31.3%;left: 55.3%;"><?php echo date_th($data['period_end'],9);?></span>
                <span style="top: 31.3%;left: 66%;"><?php echo date_th($data['period_end'],10);?></span>
                <span style="top: 31.3%;left: 77.5%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'0';?></span>
                
                <span class="overflow-text" style="top: calc(100% - 66.1%);left: calc(100% - 63%);width: 26%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                <span style="top: calc(100% - 66.1%);left: calc(100% - 23%);"><?php echo isset($personnel['data']['phone'])?$personnel['data']['phone']:'-';?></span>

                <span style="top: 40%;left: 60%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>

                <span style="top: 42.8%;left: 64%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>

                <span style="top: 50.8%;left: 15%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 50.8%;left: 32%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 54.4%;left: 22%;"><img src="<?php echo isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])?$personnel_list['data'][$data['head_unit_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 57%;left: 22%;">
                    <?php 
                    if(isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])){
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 59.6%;left: 22%;"><?php echo isset($data['head_unit_position']) && trim($data['head_unit_position'])!=''?$data['head_unit_position']:''; ?></span>
                <span style="top: 62.2%;left: 23.5%;"><?php echo isset($data['signature_head_unit_date']) && trim($data['signature_head_unit_date'])!=''?date('d/m/',strtotime($data['signature_head_unit_date'])).(date("Y",strtotime($data['signature_head_unit_date']))+543):''; ?></span>



                <span style="top: 50.8%;left: 56%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 50.8%;left: 73%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 54.4%;left: 63%;"><img src="<?php echo isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])?$personnel_list['data'][$data['head_dept_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 57%;left: 63%;">
                    <?php 
                    if(isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 59.6%;left: 63%;"><?php echo isset($data['head_dept_position']) && trim($data['head_dept_position'])!=''?$data['head_dept_position']:''; ?></span>
                <span style="top: 62.2%;left: 64.5%;"><?php echo isset($data['signature_head_dept_date']) && trim($data['signature_head_dept_date'])!=''?date('d/m/',strtotime($data['signature_head_dept_date'])).(date("Y",strtotime($data['signature_head_dept_date']))+543):''; ?></span>



                <span style="top: 69.2%;left: 15.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.2%;left: 32.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 73.2%;left: 22.5%;"><img src="<?php echo isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['supervisor_personnel_id']])?$personnel_list['data'][$data['supervisor_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 76.2%;left: 22.5%;">
                    <?php 
                    if(isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 78.6%;left: 22.5%;"><?php echo isset($data['supervisor_position']) && trim($data['supervisor_position'])!=''?$data['supervisor_position']:''; ?></span>
                <span style="top: 81%;left: 23.5%;"><?php echo isset($data['signature_supervisor_date']) && trim($data['signature_supervisor_date'])!=''?date('d/m/',strtotime($data['signature_supervisor_date'])).(date("Y",strtotime($data['signature_supervisor_date']))+543):''; ?></span>



                <span style="top: 69.2%;left: 55.5%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.2%;left: 66.5%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 69.2%;left: 78.5%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==3?'&#10003;':''; ?></span>
                <span style="top: 73.2%;left: 62.5%;"><img src="<?php echo isset($data['deputy_dean_personnel_id']) and intval($data['deputy_dean_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])?$personnel_list['data'][$data['deputy_dean_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 76.2%;left: 62.5%;">
                    <?php 
                    if(isset($data['deputy_dean_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])){
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 78.6%;left: 62.5%;"><?php echo isset($data['deputy_dean_position']) && trim($data['deputy_dean_position'])!=''?$data['deputy_dean_position']:''; ?></span>
                <span style="top: 81%;left: 63.5%;"><?php echo isset($data['signature_deputy_dean_date']) && trim($data['signature_deputy_dean_date'])!=''?date('d/m/',strtotime($data['signature_deputy_dean_date'])).(date("Y",strtotime($data['signature_deputy_dean_date']))+543):''; ?></span>
                
                
                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==6){$doc[0] = 'document/leave/6.jpg';?>
                <span style="top: 13%;left: 16%;"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                <span style="top: 13%;left: 55%"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: 13%;left: 58%;"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: 13%;left: 67%;">พ.ศ. <?php echo date_th($data['create_date'],10);?></span>

                <span style="top: 22.6%;left: 35%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>

                <span style="top: 25%;left: 14.5%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='ข้าราชการ'?'&#10003;':''; ?></span>
                <span style="top: 25%;left: 39.6%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานมหาวิทยาลัย (เงินรายได้)'?'&#10003;':''; ?></span>
                <span style="top: 25%;left: 61.8%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินแผ่นดิน)'?'&#10003;':''; ?></span>
                <span style="top: 27.2%;left: 14.5%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินแผ่นดิน)'?'&#10003;':''; ?></span>
                <span style="top: 27.2%;left: 38.6%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินรายได้)'?'&#10003;':''; ?></span>
                <span style="top: 27.2%;left: 61.8%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='ลูกจ้างประจำ'?'&#10003;':''; ?></span>
                
                <span style="top: 22.6%;left: 70%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
                <span style="top: 31.2%;left: 31%;"><?php echo date('d',strtotime($data['child_birthdate_start']));?></span>
                <span style="top: 31.2%;left: 40%;"><?php echo date_th($data['child_birthdate_start'],9);?></span>
                <span style="top: 31.2%;left: 52%;"><?php echo date_th($data['child_birthdate_start'],10);?></span>
                <span style="top: 31.2%;left: 67%;"><?php echo date('d',strtotime($data['child_birthdate_end']));?></span>
                <span style="top: 31.2%;left: 76%;"><?php echo date_th($data['child_birthdate_end'],9);?></span>
                <span style="top: 33.4%;left: 18%;"><?php echo date_th($data['child_birthdate_end'],10);?></span>
                <span style="top: 33.4%;left: 39%;">
                    <?php
                    $d1 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_start'])));
                    $d2 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_end'])));
                    $diff=date_diff($d1,$d2);
                    echo $diff->format('%m');
                    ?>
                </span>
                <span style="top: 33.4%;left: 46%;">
                    <?php echo $diff->format('%d')+1; ?>
                </span>
                <span style="top: 38.6%;left: 22%;"><?php echo date('d',strtotime($data['period_start']));?></span>
                <span style="top: 38.6%;left: 29%;"><?php echo date_th($data['period_start'],9);?></span>
                <span style="top: 38.6%;left: 44%;"><?php echo date_th($data['period_start'],10);?></span>
                <span style="top: 38.6%;left: 56%;"><?php echo date('d',strtotime($data['period_end']));?></span>
                <span style="top: 38.6%;left: 66%;"><?php echo date_th($data['period_end'],9);?></span>
                <span style="top: 38.6%;left: 80%;"><?php echo date_th($data['period_end'],10);?></span>
                <span style="top: 40.8%;left: 28%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):''; ?></span>

                <span style="top: 48%;left: 50%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 50.6%;left: 52%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 52.8%;left: 58%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==7){$doc[0] = 'document/leave/7-1.jpg';$doc[1] = 'document/leave/7.jpg';?>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 42%);"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 32%);"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: calc(100% - 87.4%);left: calc(100% - 17%);"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: 18%;left: 18%;">
                    <?php 
                    if(isset($data['to']) and $data['to']==1){
                        echo 'คณบดีคณะแพทยศาสตร์';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี';
                    }elseif(isset($data['to']) and $data['to']==2){
                        echo 'อธิการบดี (คณบดีคณะแพทยศาสตร์)';
                    }
                    ?>
                </span>
                <span style="top: calc(100% - 78.7%);left: calc(100% - 69%);">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: calc(100% - 78.7%);left: calc(100% - 36%);"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: calc(100% - 76.6%);left: calc(100% - 80%);"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

                <span style="top: calc(100% - 74.6%);left: calc(100% - 72%);">99*</span>
                <span style="top: 25.4%;left: 60%;">99*</span>
                <span style="top: calc(100% - 74.6%);left: calc(100% - 23%);">99*</span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 70%);">
                    <?php echo date_th($data['period_start'],2);?>
                </span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 44%);">
                    <?php echo date_th($data['period_end'],2);?>
                </span>

                <span style="top: calc(100% - 72.3%);left: calc(100% - 17%);"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'0';?></span>

                <span class="overflow-text" style="top: calc(100% - 70.1%);left: calc(100% - 63%);width: 51%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

                <span style="top: 41%;left: 15%;">*99</span>
                <span style="top: 41%;left: 25%;">*99</span>
                <span style="top: 41%;left: 35%;">*99</span>

                <span style="top: 45%;left: 35%;">*99</span>
                <span style="top: 46.8%;left: 35%;">*99</span>
                <span style="top: 48.8%;left: 35%;">*99</span>
                <span style="top: 50.4%;left: 35%;">*99</span>
                <span style="top: 52.4%;left: 35%;">*99</span>
                <span style="top: 54.4%;left: 35%;">*99</span>

                <span style="top: 38%;left: 58%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 40.2%;left: 58%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 46.6%;left: 58%;"><img src="<?php echo isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])?$personnel_list['data'][$data['worker_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 48.7%;left: 58%;">
                    <?php 
                    if(isset($data['worker_personnel_id']) and intval($data['worker_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['worker_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['worker_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                
                <span style="top: 59.2%;left: 21%;">
                    <?php 
                    if(isset($data['hr_personnel_id']) and intval($data['hr_personnel_id'])!=0 and isset($personnel_list['data'][$data['worker_personnel_id']])){
                        echo $personnel_list['data'][$data['hr_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['hr_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span style="top: 62.2%;left: 18%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>

                <span style="top: 54.4%;left: 51.5%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 54.4%;left: 68.5%;"><?php echo isset($data['head_unit_approve']) && intval($data['head_unit_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 58%;left: 58%;"><img src="<?php echo isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])?$personnel_list['data'][$data['head_unit_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 60.2%;left: 58%;">
                    <?php 
                    if(isset($data['head_unit_personnel_id']) and intval($data['head_unit_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_unit_personnel_id']])){
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_unit_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 62.2%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['head_unit_position']) && trim($data['head_unit_position'])!=''?$data['head_unit_position']:''; ?></span>
                <span style="top: 64.2%;left: 58%;"><?php echo isset($data['signature_head_unit_date']) && trim($data['signature_head_unit_date'])!=''?date('d/m/',strtotime($data['signature_head_unit_date'])).(date("Y",strtotime($data['signature_head_unit_date']))+543):''; ?></span>





                <span style="top: 69.4%;left: 14%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.4%;left: 31%;"><?php echo isset($data['head_dept_approve']) && intval($data['head_dept_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 72.5%;left: 21%;"><img src="<?php echo isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])?$personnel_list['data'][$data['head_dept_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 74.5%;left: 21%;">
                    <?php 
                    if(isset($data['head_dept_personnel_id']) and intval($data['head_dept_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['head_dept_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 76.8%;left: 21%;width: 28%;height: 2.5%;"><?php echo isset($data['head_dept_position']) && trim($data['head_dept_position'])!=''?$data['head_dept_position']:''; ?></span>
                <span style="top: 78.8%;left: 21%;"><?php echo isset($data['signature_head_dept_date']) && trim($data['signature_head_dept_date'])!=''?date('d/m/',strtotime($data['signature_head_dept_date'])).(date("Y",strtotime($data['signature_head_dept_date']))+543):''; ?></span>







                <span style="top: 69.4%;left: 51.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 69.4%;left: 68.5%;"><?php echo isset($data['supervisor_approve']) && intval($data['supervisor_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 72.2%;left: 58%;"><img src="<?php echo isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['supervisor_personnel_id']])?$personnel_list['data'][$data['supervisor_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 74.5%;left: 58%;">
                    <?php 
                    if(isset($data['supervisor_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['head_dept_personnel_id']])){
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['supervisor_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 76.6%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['supervisor_position']) && trim($data['supervisor_position'])!=''?$data['supervisor_position']:''; ?></span>
                <span style="top: 78.8%;left: 58%;"><?php echo isset($data['signature_supervisor_date']) && trim($data['signature_supervisor_date'])!=''?date('d/m/',strtotime($data['signature_supervisor_date'])).(date("Y",strtotime($data['signature_supervisor_date']))+543):''; ?></span>




                <span style="top: 83.4%;left: 51.5%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==1?'&#10003;':''; ?></span>
                <span style="top: 83.4%;left: 62%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==2?'&#10003;':''; ?></span>
                <span style="top: 83.4%;left: 74%;"><?php echo isset($data['deputy_dean_approve']) && intval($data['deputy_dean_approve'])==3?'&#10003;':''; ?></span>
                <span style="top: 87.6%;left: 58%;"><img src="<?php echo isset($data['deputy_dean_personnel_id']) and intval($data['deputy_dean_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])?$personnel_list['data'][$data['deputy_dean_personnel_id']]['signature']:'';?>" class="img-sig"/></span>
                <span style="top: 89.8%;left: 58%;">
                    <?php 
                    if(isset($data['deputy_dean_personnel_id']) and intval($data['supervisor_personnel_id'])!=0 and isset($personnel_list['data'][$data['deputy_dean_personnel_id']])){
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['title']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['name_th']; 
                        echo $personnel_list['data'][$data['deputy_dean_personnel_id']]['surname_th'];
                    }
                    ?>
                </span>
                <span class="overflow-text" style="top: 91.8%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['deputy_dean_position']) && trim($data['deputy_dean_position'])!=''?$data['deputy_dean_position']:''; ?></span>
                <span style="top: 94%;left: 58%;"><?php echo isset($data['signature_deputy_dean_date']) && trim($data['signature_deputy_dean_date'])!=''?date('d/m/',strtotime($data['signature_deputy_dean_date'])).(date("Y",strtotime($data['signature_deputy_dean_date']))+543):''; ?></span>

                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==8){$doc[0] = 'document/leave/8.jpg';?>

                <span style="top: 7.5%;left: 69%;"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                <span style="top: 10%;left: 59%;"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: 10%;left: calc(100% - 31%);"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: 10%;left: 82%;"><?php echo date_th($data['create_date'],10);?></span>

                <span style="top: 20.8%;left: 31%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 20.8%;left: 68%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

                <span style="top: 23.4%;left: 18%;">คณะแพทยศาสตร์</span>

                <span style="top: 26%;left: 20%;"><?php echo date_th($personnel['data']['brithdate'],2);?></span>
                <span style="top: 26%;left: 59%;">99*</span>

                <span style="top: 28.5%;left: 21%;"><?php echo isset($data['ordination_status']) && intval($data['ordination_status'])==0?'&#10003;':''; ?></span>
                <span style="top: 28.5%;left: 35%;"><?php echo isset($data['ordination_status']) && intval($data['ordination_status'])==1?'&#10003;':''; ?></span>


                <span class="overflow-text" style="top: 31.1%;left: 14.3%;width:23%;height:3%;"><?php echo isset($data['temple_name'])?$data['temple_name']:'-';?></span>
                <span class="overflow-text" style="top: 33.8%;left: 14.3%;width:66%;height:3%;"><?php echo isset($data['temple_address'])?$data['temple_address']:'-';?></span>

                <span style="top: 36.5%;left: 23%;"><?php echo date_th($data['ordination_date'],2);?></span>

                <span class="overflow-text" style="top: 36.4%;left: 63.3%;width:23%;height:3%;"><?php echo isset($data['temple_name2'])?$data['temple_name2']:'-';?></span>
                <span class="overflow-text" style="top: 39%;left: 20.3%;width:66%;height:3%;"><?php echo isset($data['temple_address2'])?$data['temple_address2']:'-';?></span>

                <span style="top: 41.6%;left: 38%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'-';?></span>

                <span style="top: 41.6%;left: 55%;"><?php echo date_th($data['period_start'],2);?></span>
                <span style="top: 44.2%;left: 19%;"><?php echo date_th($data['period_end'],2);?></span>

                <span style="top: 53.5%;left: 54%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>

                <span style="top: 56%;left: 54%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                
                <?php }elseif(isset($data['leave_type_id']) and intval($data['leave_type_id'])==9){$doc[0] = 'document/leave/9.jpg';?>
                <span style="top: 7.9%;left: 79%;">20</span>
                <span style="top: 10.1%;left: 70%;"><?php echo date('d',strtotime($data['create_date']));?></span>
                <span style="top: 10.1%;left: 78%;"><?php echo date_th($data['create_date'],9);?></span>
                <span style="top: 10.1%;left: 89%;"><?php echo date_th($data['create_date'],10);?></span>
                <span style="top: 14.2%;left: 22%;"><?php echo isset($data['title'])?$data['title']:'-';?></span>

                <span style="top: 20.8%;left: 38%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 20.8%;left: 73%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
                <span style="top: 22.8%;left: 22%;">99*</span>
                <span style="top: 22.8%;left: 44%;">คณะแพทยศาสตร์</span>
                <span style="top: 25%;left: 31%;"><?php echo isset($data['call_soldier'])?$data['call_soldier']:'-';?></span>
                <span class="overflow-text" style="top: 27.2%;left: 19%;width: 37%;height:3%;"><?php echo isset($data['call_soldier_form'])?$data['call_soldier_form']:'-';?></span>
                <span style="top: 27.2%;left: 63%;"><?php echo date('d',strtotime($data['call_date']));?></span>
                <span style="top: 27.2%;left: 71%;"><?php echo date_th($data['call_date'],8);?></span>
                <span style="top: 27.2%;left: 85%;"><?php echo date_th($data['call_date'],10);?></span>
                <span class="overflow-text" style="top: 29.4%;left: 25.6%;width: 40%;height:3%;"><?php echo isset($data['call_soldier_detail'])?$data['call_soldier_detail']:'-';?></span>
                <span class="overflow-text" style="top: 31.4%;left: 16.6%;width: 40%;height:3%;"><?php echo isset($data['train_address'])?$data['train_address']:'-';?></span>
                <span style="top: 31.4%;left: 65.6%;"><?php echo date_th($data['period_start'],2);?></span>
                <span style="top: 33.6%;left: 22.6%;"><?php echo date('d',strtotime($data['period_end']));?></span>
                <span style="top: 33.6%;left: 31.2%;"><?php echo date_th($data['period_end'],8);?></span>
                <span style="top: 33.6%;left: 44%;"><?php echo date_th($data['period_end'],10);?></span>
                <span style="top: 33.6%;left: 58%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'0';?></span>

                <span style="top: 44.4%;left: 58%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                <span style="top: 46.4%;left: 58%;">
                    <?php 
                    echo isset($personnel['title'])?$personnel['title']:'-'; 
                    echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                    echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                    ?>
                </span>
                <span style="top: 48.6%;left: 56%;"><?php echo date('d/m/',strtotime($data['create_date'])).(date('Y',strtotime($data['create_date']))+543);?></span>
                <?php } ?>
                <img src="<?php echo base_url(load_file($doc[0]));?>" style="width:100%;">
                
            </div>
            <?php if(isset($doc[1])){ ?>
                <div class="col-lg-12 document" >

                    <?php if(isset($data['leave_type_id']) and intval($data['leave_type_id'])==4){ ?>
                        <span style="top: 13%;left: 16%;"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                        <span style="top: 13%;left: 54%"><?php echo date('d',strtotime($data['create_date']));?></span>
                        <span style="top: 13%;left: 57%;"><?php echo date_th($data['create_date'],9);?></span>
                        <span style="top: 13%;left: 66%;">พ.ศ. <?php echo date_th($data['create_date'],10);?></span>

                        <span style="top: 19.5%;left: 20%;">
                        <?php 
                            if(isset($data['to']) and $data['to']==1){
                            echo 'คณบดีคณะแพทยศาสตร์';
                            }elseif(isset($data['to']) and $data['to']==2){
                            echo 'อธิการบดี';
                            }elseif(isset($data['to']) and $data['to']==2){
                            echo 'อธิการบดี (คณบดีคณะแพทยศาสตร์)';
                            }
                        ?>
                        </span>

                        <span style="top: 22.6%;left: 35%;">
                        <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                        ?>
                        </span>

                        <span style="top: 25%;left: 14.5%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='ข้าราชการ'?'&#10003;':''; ?></span>
                        <span style="top: 25%;left: 38.6%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานมหาวิทยาลัย (เงินรายได้)'?'&#10003;':''; ?></span>
                        <span style="top: 25%;left: 61.8%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินแผ่นดิน)'?'&#10003;':''; ?></span>
                        <span style="top: 27.2%;left: 14.5%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินแผ่นดิน)'?'&#10003;':''; ?></span>
                        <span style="top: 27.2%;left: 38.6%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='พนักงานราชการ (เงินรายได้)'?'&#10003;':''; ?></span>
                        <span style="top: 27.2%;left: 61.8%;"><?php echo isset($personnel['emp_type_name']) && $personnel['emp_type_name']=='ลูกจ้างประจำ'?'&#10003;':''; ?></span>
                        
                        <span style="top: 22.6%;left: 70%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
                        <span style="top: 31.2%;left: 31%;"><?php echo date('d',strtotime($data['child_birthdate_start']));?></span>
                        <span style="top: 31.2%;left: 40%;"><?php echo date_th($data['child_birthdate_start'],9);?></span>
                        <span style="top: 31.2%;left: 52%;"><?php echo date_th($data['child_birthdate_start'],10);?></span>
                        <span style="top: 31.2%;left: 67%;"><?php echo date('d',strtotime($data['child_birthdate_end']));?></span>
                        <span style="top: 31.2%;left: 76%;"><?php echo date_th($data['child_birthdate_end'],9);?></span>
                        <span style="top: 33.4%;left: 18%;"><?php echo date_th($data['child_birthdate_end'],10);?></span>
                        <span style="top: 33.4%;left: 39%;">
                        <?php
                            $d1 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_start'])));
                            $d2 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_end'])));
                            $diff=date_diff($d1,$d2);
                            echo $diff->format('%m');
                        ?>
                        </span>
                        <span style="top: 33.4%;left: 46%;">
                        <?php echo $diff->format('%d')+1; ?>
                        </span>
                        <span style="top: 37%;left: 55%;"><?php echo date('d',strtotime($data['period_start']));?></span>
                        <span style="top: 37%;left: 63%;"><?php echo date_th($data['period_start'],9);?></span>
                        <span style="top: 37%;left: 78%;"><?php echo date_th($data['period_start'],10);?></span>
                        <span style="top: 39%;left: 18%;"><?php echo date('d',strtotime($data['period_end']));?></span>
                        <span style="top: 39%;left: 28%;"><?php echo date_th($data['period_end'],9);?></span>
                        <span style="top: 39%;left: 42%;"><?php echo date_th($data['period_end'],10);?></span>
                        <span style="top: 39%;left: 63%;">
                        <?php
                            $d1 = new DateTime(date('Y-m-d',strtotime($data['period_start'])));
                            $d2 = new DateTime(date('Y-m-d',strtotime($data['period_end'])));
                            $diff=date_diff($d1,$d2);
                            echo $diff->format('%m');
                        ?>
                        </span>
                        <span style="top: 39%;left: 71%;">
                        <?php echo $diff->format('%d')+1; ?>
                        </span>

                        <span style="top: 49%;left: 50%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                        <span style="top: 51%;left: 52%;">
                        <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                        ?>
                        </span>
                        <span style="top: 53.4%;left: 58%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>


                        <?php if(isset($data['to']) and $data['to']==1){?>
                        <span style="top: 71%;left: 13%; width: 22%; height: 7%; background-color: #ffffff;"></span>
                        <?php } ?>

                    

                    <?php }else if(isset($data['leave_type_id']) and intval($data['leave_type_id'])==7){ ?>
                        <span style="top: 11.5%;left: 67%;"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
                        <span style="top: 15%;left: 58%;"><?php echo date('d',strtotime($data['create_date']));?></span>
                        <span style="top: 15%;left: 65%;"><?php echo date_th($data['create_date'],9);?></span>
                        <span style="top: 15%;left: 80%;"><?php echo date_th($data['create_date'],10);?></span>
                        <span style="top: 18.2%;left: 20%;"><?php echo isset($data['title'])?$data['title']:'-';?></span>
                        <span style="top: 28.2%;left: 26%;">
                        <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                        ?>
                        </span>
                        <span style="top: 28.2%;left: 55%;"><?php echo date('d',strtotime($personnel['data']['brithdate']));?></span>
                        <span style="top: 28.2%;left: 65%;"><?php echo date_th($personnel['data']['brithdate'],9);?></span>
                        <span style="top: 28.2%;left: 80%;"><?php echo date_th($personnel['data']['brithdate'],10);?></span>
                        <span style="top: 31.8%;left: 17%;">99*</span>
                        <span style="top: 31.8%;left: 42%;">99*</span>
                        <span style="top: 31.8%;left: 53%;">99*</span>
                        <span style="top: 31.8%;left: 70%;">99*</span>
                        <span style="top: 35%;left: 37%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
                        <span style="top: 35%;left: 71%;">99*</span>
                        <span style="top: 38.5%;left: 19%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>
                        <span style="top: 38.5%;left: 54%;">ตณะแพทยศาสตร์</span>

                        <span style="top: 42%;left: 17%;">99*</span>
                        <span style="top: 42%;left: 58%;">99*</span>
                        <span class="overflow-text" style="top: 45.2%;left: 14%;width:28%;height:3%;"><?php echo isset($data['detail'])?$data['detail']:'-';?></span>
                        <span style="top: 45.2%;left: 52%;"><?php echo isset($data['county_name'])?$data['county_name']:'-';?></span>
                        <?php
                        $d1 = new DateTime(date('Y-m-d',strtotime($data['period_start'])));
                        $d2 = new DateTime(date('Y-m-d',strtotime($data['period_end'])));
                        $diff=date_diff($d1,$d2);
                        
                        ?>
                        <span style="top: 45.2%;left: 79%;"><?php echo $diff->format('%y');?></span>
                        <span style="top: 48.8%;left: 14%;"><?php echo $diff->format('%m');?></span>
                        <span style="top: 48.8%;left: 30%;"><?php echo $diff->format('%d')+1;?></span>
                        <span style="top: 48.8%;left: 48%;"><?php echo date('d',strtotime($data['period_start']));?></span>
                        <span style="top: 48.8%;left: 59%;"><?php echo date_th($data['period_start'],9);?></span>
                        <span style="top: 48.8%;left: 76%;"><?php echo date_th($data['period_start'],10);?></span>
                        <span style="top: 52%;left: 20%;"><?php echo date('d',strtotime($data['period_end']));?></span>
                        <span style="top: 52%;left: 30%;"><?php echo date_th($data['period_end'],9);?></span>
                        <span style="top: 52%;left: 41%;"><?php echo date_th($data['period_end'],10);?></span>
                        <span style="top: 55.5%;left: 39%;">99*</span>
                        <span style="top: 59%;left: 23%;">99*</span>
                        <span style="top: 59%;left: 50%;">99*</span>
                        <span style="top: 59%;left: 62%;">99*</span>
                        <span style="top: 59%;left: 76%;">99*</span>
                        <span style="top: 62.2%;left: 29%;">99*</span>
                        <span style="top: 62.2%;left: 42%;">99*</span>
                        <span style="top: 62.2%;left: 58%;">99*</span>
                        <span style="top: 62.2%;left: 78%;">99*</span>
                        <span style="top: 65.6%;left: 18%;">99*</span>
                        <span style="top: 65.6%;left: 35%;">99*</span>

                        <span style="top: 82.4%;left: 61%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:'';?>"/></span>
                        <span style="top: 85.8%;left: 56%;">
                        <?php 
                            echo isset($personnel['title'])?$personnel['title']:'-'; 
                            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
                            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
                        ?>
                        </span>


                    <?php } ?>

                    <img src="<?php echo base_url(load_file($doc[1]));?>" style="width:100%;">
                </div>
            <?php } ?>
        </div>

        <div class="box-button">
            <a href="<?php echo base_url(url_index().'leave');?>"><button type="button" style="background-color: #cccccc;">< กลับไปที่ระบบลา</button></a>&nbsp;&nbsp;
            <?php if($signature_type>=2 and $signature_type!=5){?>
                <button type="submit" name="approve" form="form" value="1">เห็นควรอนุญาต</button>
                <button type="submit" name="approve" form="form" value="2">เห็นควรไม่อนุญาต</button>
            <?php }elseif($signature_type==1){ ?>
                <button type="submit" name="approve" form="form" value="1">ยอมรับการปฏิบัติงานแทน</button>
                <button type="submit" name="approve" form="form" value="2">ไม่ยอมรับการปฏิบัติงานแทน</button>
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
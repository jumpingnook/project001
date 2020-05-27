<?php //echo '<pre>';print_r($url_type); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="padding:0px;margin:0px;background-color:#ffffff;">
    <div style="width:800px;height:100vh;background-color:#ffffff;margin:auto;position: relative;">
        <div style="border-bottom:1px solid #863920;height: 154px;position:relative;">
            <div class="logo" style="float:left;">
                <a href="med.nu.ac.th" target="_blank"><img src="<?php echo base_url(load_file('assets/img/logo.med.single.png'));?>" alt="" width="150px"></a>
            </div>
            <div class="text" style="margin-left:20px;float:left;font-size: 22px;font-family: sans-serif;color:#222222;padding-top: 20px;">
                <div style="font-weight:bold;">My Med - ระบบลา</div>
                <div style="font-size: 18px;">คณะแพทยศาสตร์ มหาวิทยาลัยนเรศวร</div>
                <div style="font-size: 18px;">Faculty of Medicine Naresuan University</div>
                <a href="med.nu.ac.th" target="_blank" style="font-size: 18px;color:#555555;text-decoration:none;">med.nu.ac.th</a>
            </div>
        </div><br/><br/>
        <div>
            <p style="font-size:18px;">
                เรียน  <?php echo $personnel_receive['data'][0]['title'].$personnel_receive['data'][0]['name_th'].' '.$personnel_receive['data'][0]['surname_th'];?><br/><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เนื่องจาก <?php echo $personnel['data']['title'].$personnel['data']['name_th'].' '.$personnel['data']['surname_th'];?> ตำแหน่ง <?php echo $personnel['position_name'];?> มีความประสงค์ยกเลิกวันลา <u><?php echo $leave_type[$leave_data['leave_type_id']]['leave_name'];?></u> ตั้งแต่วันที่ <u><?php echo date_th($leave_data['period_start'],11).(trim($leave_data['period_end'])!=''?' - '.date_th($leave_data['period_end'],11):''); ?></u> จึงขอให้ท่านช่วยพิจารณาการลานี้ 
            </p>
        </div><br/><br/>
        <div>
            <center><a href="<?php echo $leave_data['url_'.$url_type].'/n29gknk626e3gh';?>"><button style="padding: 10px;border-radius: 5px;background-color: #4CAF50;color: #ffffff;font-size: 24px;">คลิกที่นี่ เพื่อดูรายละเอียดการลา</button></a></center>
        </div>
        <!-- <div style="width: 100%;height: 20px;background-color: #863920;position: absolute;bottom: 0;"></div> -->
    </div>
</body>
</html>
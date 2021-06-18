<style>
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
    position:absolute;
    font-size:1.4vw;
  }
  .overflow-text{
    display: block;
    overflow: hidden;
  }
  .img-sig{
    max-width: 14vw;
    margin-left: -14%;
    margin-top: -14%;
  }
  #qrcode1 img,#qrcode2 img,#qrcode3 img{
    display:none;
    max-width: 5vw;
  }
  .leave_no{
    margin-top: -5px;
  }
  @media print{

  }
</style>
<div id="document" class="row mb-2" style="border: 1px solid #ccc;">
  <div class="col-lg-12 document" >
    <?php $doc = []; if(!isset($cancel_approve) or (isset($cancel_approve) and !$cancel_approve)){ ?>

    <?php if(isset($data['leave_type_id']) && intval($data['leave_type_id'])==1){$doc[0] = 'document/leave/1.1.png';?>
      <span style="top: 9%;left: 56%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 9%;left: 65%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 9%;left: 79%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 18%;left: 18%;"></span>
      <span style="top: 16.8%;left: 31%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 16.8%;left: 62%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 19%;left: 19%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span style="top: 21.2%;left: 27%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
      <span style="top: 21.2%;left: 56%;"><?php echo isset($leave_quota) && count($leave_quota)>0?10:0;?></span>
      <span style="top: 21.2%;left: 72%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>

      <span style="top: 23.4%;left: 28%;">
        <?php echo date_th($data['period_start'],2);?>
      </span>

      <span style="top: 23.4%;left: 55%;">
        <?php echo date_th($data['period_end'],2);?>
      </span>

      <span style="top: 23.4%;left: 82%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

      <span class="overflow-text" style="top: 25.6%;left: 34%;width: 51%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>
      <span class="overflow-text" style="top: 27.6%;left: 30%;width: 57%;height: 3%;"><?php echo isset($data['emergency_note'])?htmlspecialchars_decode($data['emergency_note']):'-';?></span>

      <span style="top: 39%;left: 18%;"><?php echo isset($old_leave_count)?floatval($old_leave_count):0;?></span>
      <span style="top: 39%;left: 28%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
      <span style="top: 39%;left: 37%;"><?php echo isset($old_leave_count)?floatval($data['period_count'])+floatval($old_leave_count):floatval($data['period_count']);?></span>

      <span style="top: 42.8%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
      <span style="top: 45%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?10:0;?></span>
      <span style="top: 47.2%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
      <span style="top: 49.4%;left: 36%;"><?php echo isset($old_leave_count)?$old_leave_count:0;?></span>
      <span style="top: 51.6%;left: 36%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
      <span style="top: 53.8%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']-floatval($data['period_count']):'0';?></span>


      <span style="top: 34%;left: 58%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 36.2%;left: 58%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 38.2%;left: 58%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      
      <!-- <span style="top: 43.6%;left: 58%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <span style="top: 44.7%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
            echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
          }
        ?>
      </span>

      <span style="top: 46.7%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
            echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
          }
        ?>
      </span>
      
      <!-- <span style="top: 55.2%;left: 20%;"><img src="<?php //echo isset($data['hr_personnel_id']) && intval($data['hr_personnel_id'])!=0 && $data['hr_approve']!=0 && isset($personnel_list['data'][$data['hr_personnel_id']])?$personnel_list['data'][$data['hr_personnel_id']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if($data['hr_approve']!=0){ ?>
      <span style="top: 57.8%;left: 21%;">นางสาววรารัตน์ สมนิยาม</span>
      <?php } ?>
      <span style="top: 62.2%;left: 21%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>




      <?php $i=2; if(isset($approve_list[$i])){ ?>
      <span style="top: 52%;left: 51%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 52%;left: 64.4%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>

      <!-- <span style="top: 55%;left: 58%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 55.6%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>

      <span style="top: 57.8%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span class="overflow-text" style="top: 60%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 62.2%;left: 58%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php } ?>


      <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
      <span style="top: 67.2%;left: 51%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 67.2%;left: 64.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 70%;left: 58%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 71%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 73%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span class="overflow-text" style="top: 75.2%;left: 58%;width: 28%;height: 2.5%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 77.4%;left: 58%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>


      <?php for($i=5;$i<=6;$i++){if(isset($approve_list[$i])){ ?>
      <span style="top: 82.6%;left: 51.6%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 82.6%;left: 60.2%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
      <span style="top: 82.6%;left: 70.4%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==3?'&#10003;':''; ?></span>

      <span class="overflow-text" style="top: 85%;left: 52.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_'.$i])?trim($data['note_personnel_'.$i]):''; ?></span>

      <!-- <span style="top: 87.4%;left: 58%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 88.8%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>

      <span style="top: 91%;left: 58%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span class="overflow-text" style="top: 93%;left: 58%;width: 30%;height: 2.5%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 95.4%;left: 58%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>









    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==2){ ?>

        <?php
          $doc[0] = 'document/leave/2.1.png';
        ?>

        <span style="top: 8.6%;left: 63%;"><?php echo date('d',strtotime($data['create_date']));?></span>
        <span style="top: 8.6%;left: 72%;"><?php echo date_th($data['create_date'],9);?></span>
        <span style="top: 8.6%;left: 84%;"><?php echo date_th($data['create_date'],10);?></span>
        <span style="top: 13%;left: 22%;"><?php //echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
        <span style="top: 17.2%;left: 28%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 17.2%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

        <span style="top: 19.4%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

        <span style="top: 22.2%;left: 33%;"><?php echo $data['leave_type_id']==3?'&#10003':'';?></span>
        <span style="top: 24.2%;left: 33%;"><?php echo $data['leave_type_id']==2?'&#10003':'';?></span>
        <span style="top: 26.4%;left: 33%;"></span>

        <span class="overflow-text" style="top: 21.6%;left: 58%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

        <span style="top: 29%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

        <span style="top: 29%;left: 50%;"><?php echo date_th($data['period_end'],2);?></span>

        <span style="top: 29%;left: 80%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

        <span style="top: 31.4%;left: 30.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==3?'&#10003':'';?></span>
        <span style="top: 31.4%;left: 45.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==2?'&#10003':'';?></span>
        <span style="top: 31.4%;left: 63.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==4?'&#10003':'';?></span>

        <span style="top: 33.8%;left: 27%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],2):' - ';?></span>

        <span style="top: 33.8%;left: 52%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],2):' - ';?></span>

        <span style="top: 33.8%;left: 81%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['period_count']:' - ';?></span>

        <span class="overflow-text" style="top: 36.4%;left: 35%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>
        <span class="overflow-text" style="top: 38.5%;left: 30%;width: 57%;height: 3%;"><?php echo isset($data['emergency_note'])?htmlspecialchars_decode($data['emergency_note']):'-';?></span>

        <span style="top: 48.9%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[3]):0;?></span>
        <span style="top: 48.9%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($data['period_count']):0;?></span>
        <span style="top: 48.9%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($old_leave_type[3])+floatval($data['period_count']):0;?></span>
        <span style="top: 51.1%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[2]):0;?></span>
        <span style="top: 51.1%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
        <span style="top: 51.1%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($old_leave_type[2])+floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
        <span style="top: 53.3%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[4]):0;?></span>
        <span style="top: 53.3%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($data['period_count']):0;?></span>
        <span style="top: 53.3%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($old_leave_type[4])+floatval($data['period_count']):0;?></span>
        <span style="top: 55.5%;left: 46%;"><?php echo floatval($old_leave_type[2])+floatval($old_leave_type[3])+floatval($old_leave_type[4])+floatval($data['period_count']);?></span>






        <!-- <span style="top: 45.6%;left: 60%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!='' && $data['to']==1?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span> -->
        <span style="top: 48%;left: 60%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title'].'':'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 50%;left: 60%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title'].'':'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <!-- <span style="top: 57.6%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <span style="top: 60.4%;left: 60%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 62.6%;left: 60%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>



        <!-- <span style="top: 57%;left: 21%;"><img src="<?php //echo isset($data['hr_personnel_id']) && intval($data['hr_personnel_id'])!=0 && $data['hr_approve']!=0 && isset($personnel_list['data'][$data['hr_personnel_id']])?$personnel_list['data'][$data['hr_personnel_id']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if($data['hr_approve']!=0){ ?>
        <span style="top: 58.4%;left: 21%;">นางสาววรารัตน์ สมนิยาม</span>
        <?php } ?>
        <span style="top: 62.8%;left: 22%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>


        <?php $i=2; if(isset($approve_list[$i])){ ?>
        <span style="top: 67.6%;left: 15%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
        <span style="top: 67.6%;left: 28.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>

        <!-- <span style="top: 68.8%;left: 21%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

        <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' ){ ?>
        <span style="top: 71.4%;left: 21%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 73.6%;left: 21%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 75.8%;left: 21%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
        <span style="top: 78%;left: 21%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
        <?php } ?>


        <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
        <span style="top: 67.6%;left: 54.2%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
        <span style="top: 67.6%;left: 67.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
        <!-- <span style="top: 68.8%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

        <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
        <span style="top: 71.4%;left: 60%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>

        <span style="top: 73.6%;left: 60%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 75.8%;left: 60%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
        <span style="top: 78%;left: 60%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
        <?php break;}} ?>


        <?php for($i=5;$i<=6;$i++){if(isset($approve_list[$i])){ ?>
        <span style="top: 83%;left: 54.6%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
        <span style="top: 83%;left: 63.4%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
        <span style="top: 83%;left: 73.6%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==3?'&#10003;':''; ?></span>

        <span class="overflow-text" style="top: 85.4%;left: 55.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_'.$i])?trim($data['note_personnel_'.$i]):''; ?></span>
        
        <!-- <span style="top: 86.4%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
        <span style="top: 89.2%;left: 61%;">
          <?php
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>

        <span style="top: 91.4%;left: 61%;">
          <?php
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 93.6%;left: 61%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
        <span style="top: 95.8%;left: 61%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
        <?php break;}} ?>















    
    
    
    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==3){ ?>

      <?php
        if($data['leave_type_id']==3 && $data['to']==1){
          $doc[0] = 'document/leave/3.1.png';
        }elseif($data['leave_type_id']==3 && $data['to']==2){
          $doc[0] = 'document/leave/3.2.png';
        }
      ?>

      <span style="top: 8.6%;left: 63%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 8.6%;left: 72%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 8.6%;left: 84%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 13%;left: 22%;"><?php //echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
      <span style="top: 17.2%;left: 28%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 17.2%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 19.4%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span style="top: 22.2%;left: 33%;"><?php echo $data['leave_type_id']==3?'&#10003':'';?></span>
      <span style="top: 24.2%;left: 33%;"><?php echo $data['leave_type_id']==2?'&#10003':'';?></span>
      <span style="top: 26.4%;left: 33%;"></span>

      <span class="overflow-text" style="top: 21.6%;left: 58%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

      <span style="top: 29%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

      <span style="top: 29%;left: 50%;"><?php echo date_th($data['period_end'],2);?></span>

      <span style="top: 29%;left: 80%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

      <span style="top: 31.4%;left: 30.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==3?'&#10003':'';?></span>
      <span style="top: 31.4%;left: 45.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==2?'&#10003':'';?></span>
      <span style="top: 31.4%;left: 63.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==4?'&#10003':'';?></span>

      <span style="top: 33.8%;left: 27%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],2):' - ';?></span>

      <span style="top: 33.8%;left: 52%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],2):' - ';?></span>

      <span style="top: 33.8%;left: 81%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['period_count']:' - ';?></span>

      <span class="overflow-text" style="top: 36.4%;left: 35%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

      <span style="top: 46.4%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[3]):0;?></span>
      <span style="top: 46.4%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($data['period_count']):0;?></span>
      <span style="top: 46.4%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($old_leave_type[3])+floatval($data['period_count']):0;?></span>
      <span style="top: 48.6%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[2]):0;?></span>
      <span style="top: 48.6%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($data['period_count']):0;?></span>
      <span style="top: 48.6%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($old_leave_type[2])+floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
      <span style="top: 50.8%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[4]):0;?></span>
      <span style="top: 50.8%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($data['period_count']):0;?></span>
      <span style="top: 50.8%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($old_leave_type[4])+floatval($data['period_count']):0;?></span>
      <span style="top: 53%;left: 46%;"><?php echo floatval($old_leave_type[2])+floatval($old_leave_type[3])+floatval($old_leave_type[4])+floatval($data['period_count']);?></span>






      <!-- <span style="top: 45.6%;left: 60%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!='' && $data['to']==1?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span> -->
      <?php if($data['to']==1){ ?>
      <span style="top: 46.2%;left: 60%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title'].'':'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <?php } ?>
      <span style="top: 48.4%;left: 60%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title'].'':'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>

      
      <!-- <span style="top: 57.6%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if($data['to']==1){ ?>
      <span style="top: 58.6%;left: 60%;">
        <?php 
          if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
            echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 60.8%;left: 60%;">
        <?php 
          if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
            echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
          }
        ?>
      </span>



      <!-- <span style="top: 57%;left: 21%;"><img src="<?php //echo isset($data['hr_personnel_id']) && intval($data['hr_personnel_id'])!=0 && $data['hr_approve']!=0 && isset($personnel_list['data'][$data['hr_personnel_id']])?$personnel_list['data'][$data['hr_personnel_id']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
      <span style="top: 60%;left: 21%;"></span> -->
      <?php if($data['hr_approve']!=0 and $data['to']==1){ ?>
        <span style="top: 56.4%;left: 21%;">นางสาววรารัตน์ สมนิยาม</span>
      <?php } ?>
      <span style="top: 60.8%;left: 22%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>

      <?php if($data['to']==1){ ?>

      <?php $i=2; if(isset($approve_list[$i])){ ?>
      <span style="top: 66.4%;left: 15%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 66.4%;left: 28.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 68.8%;left: 21%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 70%;left: 21%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 72%;left: 21%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 74%;left: 21%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 76.2%;left: 21%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php } ?>


      <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
      <span style="top: 66.4%;left: 54.2%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 66.4%;left: 67.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 68.8%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 70%;left: 60%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 72%;left: 60%;">
        <?php 
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 74%;left: 60%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 76.2%;left: 60%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>


      <?php for($i=5;$i<=6;$i++){if(isset($approve_list[$i])){ ?>
      <span style="top: 82.4%;left: 54.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==1?'&#10003;':''; ?></span>
      <span style="top: 82.4%;left: 63.6%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==2?'&#10003;':''; ?></span>
      <span style="top: 82.4%;left: 73.8%;"><?php echo isset($data['approve_personnel_'.$i]) && intval($data['approve_personnel_'.$i])==3?'&#10003;':''; ?></span>
      <!-- <span style="top: 86.4%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <span class="overflow-text" style="top: 84.6%;left: 55.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_'.$i])?trim($data['note_personnel_'.$i]):''; ?></span>

      <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_date_personnel_'.$i]!=''){ ?>
      <span style="top: 88.4%;left: 61%;">
        <?php
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 90.6%;left: 61%;">
        <?php
          if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 92.6%;left: 61%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
      <span style="top: 94.8%;left: 61%;"><?php echo isset($data['signature_date_personnel_'.$i]) && trim($data['signature_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_date_personnel_'.$i])).(date("Y",strtotime($data['signature_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>
      <?php } ?>














    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==4){ $doc[0] = 'document/leave/4.1.1.png';$doc[1] = 'document/leave/4.1.2.png';?>
      <?php
        if($data['to']==2){
          $doc[0] = 'document/leave/4.2.1.png';
          $doc[1] = 'document/leave/4.2.2.png';
        }
      ?>

      <span style="top: 8.2%;left: 65%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 8.2%;left: 73%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 8.2%;left: 84%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 13%;left: 22%;"><?php //echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
      <span style="top: 16.6%;left: 28%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 16.6%;left: 66%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 18.6%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span style="top: 21%;left: 20.4%;"></span>
      <span style="top: 21%;left: 29.4%;">&#10003</span>
      <span style="top: 21%;left: 42.4%;"></span>

      <span class="overflow-text" style="top: 20.6%;left: 59%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

      <span style="top: 23.4%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

      <span style="top: 23.4%;left: 50%;"><?php echo date_th($data['period_end'],2);?></span>

      <span style="top: 23.4%;left: 80%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'0';?></span>

      <span style="top: 26.4%;left: 31.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==3?'&#10003':'';?></span>
      <span style="top: 26.4%;left: 46.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==2?'&#10003':'';?></span>
      <span style="top: 26.4%;left: 63.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==4?'&#10003':'';?></span>

      <span style="top: 28.2%;left: 27%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],2):' - ';?></span>

      <span style="top: 28.2%;left: 52%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],2):' - ';?></span>

      <span style="top: 28.2%;left: 81%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['period_count']:' - ';?></span>

      <span class="overflow-text" style="top: 30.4%;left: 35%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

      <span style="top: 39.8%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[3]):0;?></span>
      <span style="top: 39.8%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($data['period_count']):0;?></span>
      <span style="top: 39.8%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($old_leave_type[3])+floatval($data['period_count']):0;?></span>
      <span style="top: 41.8%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[2]):0;?></span>
      <span style="top: 41.8%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
      <span style="top: 41.8%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($old_leave_type[2])+floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
      <span style="top: 44%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[4]):0;?></span>
      <span style="top: 44%;left: 37%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($data['period_count_all']):0;?></span>
      <span style="top: 44%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($old_leave_type[4])+floatval($data['period_count_all']):0;?></span>
      <span style="top: 46%;left: 46%;"><?php echo floatval($old_leave_type[2])+floatval($old_leave_type[3])+floatval($old_leave_type[4])+floatval($data['period_count_all']);?></span>



      <!-- <span style="top: 39.6%;left: 60%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!='' && $data['to']==1?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span> -->
      <?php if($data['to']==1){ ?>
      <span style="top: 40.4%;left: 63%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <?php } ?>
      <span style="top: 42.4%;left: 63%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>



      <?php if($data['to']==1){ ?>
        <!-- <span style="top: 49.6%;left: 61%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <span style="top: 50.8%;left: 61%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 52.8%;left: 61%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>
      <?php }else{ ?>
        <!-- <span style="top: 49.6%;left: 61%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <!-- <span style="top: 50.8%;left: 61%;">
          <?php /*
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }*/
          ?>
        </span> -->
        <span style="top: 52.2%;left: 61%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>
      <?php } ?>

      <!-- <span style="top: 49.5%;left: 21%;"><img src="<?php //echo isset($data['hr_personnel_id']) && intval($data['hr_personnel_id'])!=0 && $data['hr_approve']!=0 && isset($personnel_list['data'][$data['hr_personnel_id']])?$personnel_list['data'][$data['hr_personnel_id']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
      <span style="top: 60%;left: 21%;"></span> -->
      <?php if($data['hr_approve']!=0){ ?>
        <span style="top: 49.2%;left: 21%;">นางสาววรารัตน์ สมนิยาม</span>
      <?php } ?>
      <span style="top: 53.2%;left: 22%;"><?php echo isset($data['signature_hr_date']) && trim($data['signature_hr_date'])!=''?date('d/m/',strtotime($data['signature_hr_date'])).(date("Y",strtotime($data['signature_hr_date']))+543):''; ?></span>


      <?php if($data['to']==1){ ?>

        <?php if(isset($approve_list[2])){ ?>
        <span style="top: 58.8%;left: 14.4%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==1?'&#10003;':''; ?></span>
        <span style="top: 58.8%;left: 27%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==2?'&#10003;':''; ?></span>
        <!-- <span style="top: 59.6%;left: 21%;"><img src="<?php //echo isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_date_personnel_2']!='' && isset($personnel_list['data'][$data['personnel_id_2']])?$personnel_list['data'][$data['personnel_id_2']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_date_personnel_2']!=''){ ?>
        <span style="top: 63%;left: 21%;">
          <?php 
            if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
              echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 65%;left: 21%;">
          <?php 
            if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
              echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 67%;left: 21%;"><?php echo isset($data['position_personnel_2']) && trim($data['position_personnel_2'])!=''?$data['position_personnel_2']:''; ?></span>
        <span style="top: 69%;left: 21%;"><?php echo isset($data['signature_date_personnel_2']) && trim($data['signature_date_personnel_2'])!=''?date('d/m/',strtotime($data['signature_date_personnel_2'])).(date("Y",strtotime($data['signature_date_personnel_2']))+543):''; ?></span>
        <?php } ?>


        <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
        <span style="top: 58.8%;left: 57%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==1?'&#10003;':''; ?></span>
        <span style="top: 58.8%;left: 69.6%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==2?'&#10003;':''; ?></span>
        <!-- <span style="top: 59.6%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_date_personnel_3']!='' && isset($personnel_list['data'][$data['personnel_id_3']])?$personnel_list['data'][$data['personnel_id_3']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_date_personnel_3']!=''){ ?>
        <span style="top: 63%;left: 62%;">
          <?php 
            if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
              echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 65%;left: 62%;">
          <?php 
            if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
              echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 67%;left: 62%;"><?php echo isset($data['position_personnel_3']) && trim($data['position_personnel_3'])!=''?$data['position_personnel_3']:''; ?></span>
        <span style="top: 69%;left: 62%;"><?php echo isset($data['signature_date_personnel_3']) && trim($data['signature_date_personnel_3'])!=''?date('d/m/',strtotime($data['signature_date_personnel_3'])).(date("Y",strtotime($data['signature_date_personnel_3']))+543):''; ?></span>
        <?php break;}} ?>


        <?php if(isset($approve_list[5])){ ?>
        <span style="top: 75.4%;left: 15%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==1?'&#10003;':''; ?></span>
        <span style="top: 75.4%;left: 27.4%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==2?'&#10003;':''; ?></span>
        <!-- <span style="top: 73.4%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && $data['signature_date_personnel_5']!='' && isset($personnel_list['data'][$data['personnel_id_5']])?$personnel_list['data'][$data['personnel_id_5']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && $data['signature_date_personnel_5']!=''){ ?>
        <span style="top: 79.4%;left: 21%;">
          <?php
            if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
              echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 81.4%;left: 21%;">
          <?php
            if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
              echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 83.4%;left: 21%;"><?php echo isset($data['position_personnel_5']) && trim($data['position_personnel_5'])!=''?$data['position_personnel_5']:''; ?></span>
        <span style="top: 85.4%;left: 21%;"><?php echo isset($data['signature_date_personnel_5']) && trim($data['signature_date_personnel_5'])!=''?date('d/m/',strtotime($data['signature_date_personnel_5'])).(date("Y",strtotime($data['signature_date_personnel_5']))+543):''; ?></span>
        <?php } ?>


        <span style="top: 75%;left: 57%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==1?'&#10003;':''; ?></span>
        <span style="top: 75%;left: 65.4%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==2?'&#10003;':''; ?></span>
        <span style="top: 75%;left: 75.8%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==3?'&#10003;':''; ?></span>
        <!-- <span style="top: 89.4%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && $data['signature_date_personnel_6']!='' && isset($personnel_list['data'][$data['personnel_id_6']])?$personnel_list['data'][$data['personnel_id_6']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

        <span class="overflow-text" style="top: 77%;left: 57.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_6'])?trim($data['note_personnel_6']):''; ?></span>

        <?php if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && $data['signature_date_personnel_6']!=''){ ?>
        <span style="top: 81%;left: 62%;">
          <?php
            if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
              echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 83%;left: 62%;">
          <?php
            if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
              echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 85%;left: 62%;"><?php echo isset($data['position_personnel_6']) && trim($data['position_personnel_6'])!=''?$data['position_personnel_6']:''; ?></span>
        <span style="top: 87%;left: 62%;"><?php echo isset($data['signature_date_personnel_6']) && trim($data['signature_date_personnel_6'])!=''?date('d/m/',strtotime($data['signature_date_personnel_6'])).(date("Y",strtotime($data['signature_date_personnel_6']))+543):''; ?></span>
      <?php } ?>
      
    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==5){ $doc[0] = 'document/leave/5.1.png';?>
      <span style="top: calc(100% - 84.2%);;left: 64%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
      <span style="top: 8.8%;left: 64%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 8.8%;left: 72%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 8.8%;left: 84%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: calc(100% - 84.2%);left: calc(100% - 83%);"></span>

      <span style="top: 17.2%;left: 27%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 17.2%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: calc(100% - 76.3%);left: calc(100% - 82%);"></span>

      <span style="top: 19.4%;left: 32%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span class="overflow-text" style="top: 21.6%;left: 29%;width: 46%;height:3%;"><?php echo isset($data['wife_name']) && trim($data['wife_name'])!=''?$data['wife_name']:'-';?></span>

      <span style="top: 23.6%;left: 27.3%;"><?php echo date('d',strtotime($data['child_birthdate']));?></span>
      <span style="top: 23.6%;left: 36.3%;"><?php echo date_th($data['child_birthdate'],9);?></span>
      <span style="top: 23.6%;left: 50.3%;"><?php echo date_th($data['child_birthdate'],10);?></span>

      <span style="top: 26%;left: 17.3%;"><?php echo date('d',strtotime($data['period_start']));?></span>
      <span style="top: 26%;left: 24.3%;"><?php echo date_th($data['period_start'],9);?></span>
      <span style="top: 26%;left: 37.6%;"><?php echo date_th($data['period_start'],10);?></span>
      <span style="top: 26%;left: 47.3%;"><?php echo date('d',strtotime($data['period_end']));?></span>
      <span style="top: 26%;left: 55.3%;"><?php echo date_th($data['period_end'],9);?></span>
      <span style="top: 26%;left: 68%;"><?php echo date_th($data['period_end'],10);?></span>
      <span style="top: 26%;left: 79.5%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
      
      <span class="overflow-text" style="top: 28.2%;left: 34%;width: 26%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>
      <span style="top: 28.2%;left:77%;"><?php echo isset($personnel['data']['phone'])?$personnel['data']['phone']:'-';?></span>









      <!-- <span style="top: 36.4%;left: 60%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span> -->
      <span style="top: 36.8%;left: 60.5%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 38.8%;left: 60.5%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>





      <?php if(isset($approve_list[2])){ ?>
      <span style="top: 46%;left: 14.2%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==1?'&#10003;':''; ?></span>
      <span style="top: 46%;left: 27.8%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 48.4%;left: 18%;"><img src="<?php //echo isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_date_personnel_2']!='' && isset($personnel_list['data'][$data['personnel_id_2']])?$personnel_list['data'][$data['personnel_id_2']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_date_personnel_2']!=''){ ?>
      <span style="top: 49.8%;left: 19.5%;">
        <?php 
          if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
            echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 52%;left: 19.5%;">
        <?php 
          if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
            echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 54%;left: 19.5%;"><?php echo isset($data['position_personnel_2']) && trim($data['position_personnel_2'])!=''?$data['position_personnel_2']:''; ?></span>
      <span style="top: 56.2%;left: 19.5%;"><?php echo isset($data['signature_date_personnel_2']) && trim($data['signature_date_personnel_2'])!=''?date('d/m/',strtotime($data['signature_date_personnel_2'])).(date("Y",strtotime($data['signature_date_personnel_2']))+543):''; ?></span>
      <?php } ?>


      <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
      <span style="top: 46%;left: 54%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==1?'&#10003;':''; ?></span>
      <span style="top: 46%;left: 67.8%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 48.2%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_date_personnel_3']!='' && isset($personnel_list['data'][$data['personnel_id_3']])?$personnel_list['data'][$data['personnel_id_3']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <?php if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_date_personnel_3']!=''){ ?>
      <span style="top: 49.6%;left: 60.5%;">
        <?php 
          if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
            echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 51.8%;left: 60.5%;">
        <?php 
          if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
            echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 54%;left: 60.5%;"><?php echo isset($data['position_personnel_3']) && trim($data['position_personnel_3'])!=''?$data['position_personnel_3']:''; ?></span>
      <span style="top: 56.2%;left: 60.5%;"><?php echo isset($data['signature_date_personnel_3']) && trim($data['signature_date_personnel_3'])!=''?date('d/m/',strtotime($data['signature_date_personnel_3'])).(date("Y",strtotime($data['signature_date_personnel_3']))+543):''; ?></span>
      <?php break;}} ?>





      <?php if(isset($approve_list[5])){ ?>
      <span style="top: 63%;left: 14.8%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==1?'&#10003;':''; ?></span>
      <span style="top: 63%;left: 28.4%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==2?'&#10003;':''; ?></span>
      <!-- <span style="top: 65.2%;left: 22.5%;"><img src="<?php //echo isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && $data['signature_date_personnel_5']!='' && isset($personnel_list['data'][$data['personnel_id_5']])?$personnel_list['data'][$data['personnel_id_5']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
      <?php if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && $data['signature_date_personnel_5']!=''){ ?>
      <span style="top: 67%;left: 21.5%;">
        <?php 
          if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
            echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 69%;left: 21.5%;">
        <?php 
          if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
            echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 71.4%;left: 21.5%;"><?php echo isset($data['position_personnel_5']) && trim($data['position_personnel_5'])!=''?$data['position_personnel_5']:''; ?></span>
      <span style="top: 73.6%;left: 21.5%;"><?php echo isset($data['signature_date_personnel_5']) && trim($data['signature_date_personnel_5'])!=''?date('d/m/',strtotime($data['signature_date_personnel_5'])).(date("Y",strtotime($data['signature_date_personnel_5']))+543):''; ?></span>
      <?php } ?>




      <span style="top: 63%;left: 55%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==1?'&#10003;':''; ?></span>
      <span style="top: 63%;left: 64%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==2?'&#10003;':''; ?></span>
      <span style="top: 63%;left: 74%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==3?'&#10003;':''; ?></span>
      <!-- <span style="top: 85.8%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && $data['signature_date_personnel_6']!='' && isset($personnel_list['data'][$data['personnel_id_6']])?$personnel_list['data'][$data['personnel_id_6']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->

      <span class="overflow-text" style="top: 65%;left: 57.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_6'])?trim($data['note_personnel_6']):''; ?></span>

      <?php if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && $data['signature_date_personnel_6']!=''){ ?>
      <span style="top: 68.8%;left: 61%;">
        <?php
          if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
            echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
          }
        ?>
      </span>
      <?php } ?>
      <span style="top: 71%;left: 61%;">
        <?php
          if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
            echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
          }
        ?>
      </span>
      <span style="top: 73%;left: 61%;"><?php echo isset($data['position_personnel_6']) && trim($data['position_personnel_6'])!=''?$data['position_personnel_6']:''; ?></span>
      <span style="top: 75.4%;left: 61%;"><?php echo isset($data['signature_date_personnel_6']) && trim($data['signature_date_personnel_6'])!=''?date('d/m/',strtotime($data['signature_date_personnel_6'])).(date("Y",strtotime($data['signature_date_personnel_6']))+543):''; ?></span>










    
    
    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==6){$doc[0] = 'document/leave/6.2.png';?>
      <span style="top: 13%;left: 16%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
      <span style="top: 14.6%;left: 55%"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 14.6%;left: 58%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 14.6%;left: 67%;">พ.ศ. <?php echo date_th($data['create_date'],10);?></span>

      <span style="top: 25.4%;left: 35%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>

      <span style="top: 25.4%;left: 70%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 28%;left: 14.4%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==1?'&#10003;':''; ?></span>
      <span style="top: 28%;left: 39.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==4?'&#10003;':''; ?></span>
      <span style="top: 28%;left: 63.8%;"><?php echo isset($personnel['data']['emp_type_id']) && ($personnel['data']['emp_type_id']==2 || $personnel['data']['emp_type_id']==3)?'&#10003;':''; ?></span>
      <span style="top: 30.6%;left: 14.4%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==5?'&#10003;':''; ?></span>
      <span style="top: 30.6%;left: 39.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==6?'&#10003;':''; ?></span>
      <span style="top: 30.6%;left: 63.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==7?'&#10003;':''; ?></span>

      <span style="top: 33.2%;left: 22%;"><?php echo isset($personnel['department_name']) && trim($personnel['department_name'])!=''?$personnel['department_name']:''; ?></span>
      <span style="top: 33.2%;left: 50%;"><?php echo isset($personnel['data']['internal_tel']) && trim($personnel['data']['internal_tel'])!=''?$personnel['data']['internal_tel']:''; ?></span>
      
      <span style="top: 35.6%;left: 31%;"><?php echo date('d',strtotime($data['child_birthdate_start']));?></span>
      <span style="top: 35.6%;left: 40%;"><?php echo date_th($data['child_birthdate_start'],9);?></span>
      <span style="top: 35.6%;left: 52%;"><?php echo date_th($data['child_birthdate_start'],10);?></span>
      <span style="top: 35.6%;left: 67%;"><?php echo date('d',strtotime($data['child_birthdate_end']));?></span>
      <span style="top: 35.6%;left: 76%;"><?php echo date_th($data['child_birthdate_end'],9);?></span>
      <span style="top: 38%;left: 18%;"><?php echo date_th($data['child_birthdate_end'],10);?></span>
      <span style="top: 38%;left: 39%;">
        <?php
          $d1 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_start'])));
          $d2 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_end'])));
          $diff=date_diff($d1,$d2);
          echo '-';//$diff->format('%m');
        ?>
      </span>
      <span style="top: 38%;left: 46%;">
        <?php echo $diff->format('%a')+1; ?>
      </span>
      <span style="top: 44.4%;left: 22%;"><?php echo date('d',strtotime($data['period_start']));?></span>
      <span style="top: 44.4%;left: 29%;"><?php echo date_th($data['period_start'],9);?></span>
      <span style="top: 44.4%;left: 44%;"><?php echo date_th($data['period_start'],10);?></span>
      <span style="top: 44.4%;left: 56%;"><?php echo date('d',strtotime($data['period_end']));?></span>
      <span style="top: 44.4%;left: 66%;"><?php echo date_th($data['period_end'],9);?></span>
      <span style="top: 44.4%;left: 80%;"><?php echo date_th($data['period_end'],10);?></span>
      <span style="top: 46.8%;left: 28%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):''; ?></span>

      <span style="top: 55%;left: 50%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 57.8%;left: 52%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 60.4%;left: 58%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==7){$doc[0] = 'document/leave/7.2.1.png';$doc[1] = 'document/leave/7.2.2.png';?>
      <span style="top: 9%;left: 56%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 9%;left: 65%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 9%;left: 79%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 18%;left: 18%;">
        <?php 
          // if(isset($data['to']) && $data['to']==1){
          //   echo 'คณบดีคณะแพทยศาสตร์';
          // }elseif(isset($data['to']) && $data['to']==2){
          //   echo 'อธิการบดี มหาวิทยาลัยนเรศวร';
          // }
        ?>
      </span>
      <span style="top: 16.8%;left: 31%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 16.8%;left: 62%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 19%;left: 19%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span style="top: 21.2%;left: 27%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
      <span style="top: 21.2%;left: 56%;"><?php echo isset($leave_quota) && count($leave_quota)>0?10:0;?></span>
      <span style="top: 21.2%;left: 72%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>

      <span style="top: 23.4%;left: 28%;">
        <?php echo date_th($data['period_start'],2);?>
      </span>

      <span style="top: 23.4%;left: 55%;">
        <?php echo date_th($data['period_end'],2);?>
      </span>

      <span style="top: 23.4%;left: 82%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

      <span class="overflow-text" style="top: 25.6%;left: 34%;width: 51%;height: 3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>


      <span style="top: 2.2%;left: 0.5%;width: 100%;height: 100%;display: block;">

        <span style="top: 37%;left: 18%;"><?php echo isset($old_leave_count)?floatval($old_leave_count):0;?></span>
        <span style="top: 37%;left: 28%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
        <span style="top: 37%;left: 37%;"><?php echo isset($old_leave_count)?floatval($data['period_count'])+floatval($old_leave_count):floatval($data['period_count']);?></span>

        <span style="top: 40.8%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
        <span style="top: 43%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?10:0;?></span>
        <span style="top: 45.2%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']:0;?></span>
        <span style="top: 47.4%;left: 36%;"><?php echo isset($old_leave_count)?$old_leave_count:0;?></span>
        <span style="top: 49.6%;left: 36%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
        <span style="top: 51.8%;left: 36%;"><?php echo isset($leave_quota) && count($leave_quota)>0?$leave_quota[0]['quota_total']-floatval($data['period_count']):'0';?></span>

        <span style="top: 34%;left: 58%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
        <span style="top: 36%;left: 58%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>

        <span style="top: 43.6%;left: 58%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
        <span style="top: 48.7%;left: 58%;">
          <?php 
            if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
              echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
            }
          ?>
        </span>
        

        <span style="top: 59.2%;left: 21%;">
          <?php 
            // if(isset($data['hr_personnel_id']) && intval($data['hr_personnel_id'])!=0 && isset($personnel_list['data'][$data['hr_personnel_id']])){
            //   echo $personnel_list['data'][$data['hr_personnel_id']]['title']; 
            //   echo $personnel_list['data'][$data['hr_personnel_id']]['name_th'].'&nbsp;'; 
            //   echo $personnel_list['data'][$data['hr_personnel_id']]['surname_th'];
            // }
          ?>
        </span>

      </span>

    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==8){$doc[0] = 'document/leave/8.2.png';?>

      <span style="top: 7.5%;left: 69%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
        <span style="top: 11%;left: 62%;"><?php echo date('d',strtotime($data['create_date']));?></span>
        <span style="top: 11%;left: 71%;"><?php echo date_th($data['create_date'],9);?></span>
        <span style="top: 11%;left: 81%;"><?php echo date_th($data['create_date'],10);?></span>

        <span style="top: 19.8%;left: 31%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 19.8%;left: 68%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

        <span style="top: 22.4%;left: 18%;">คณะแพทยศาสตร์</span>

        <span style="top: 25.2%;left: 20%;"><?php echo date_th($personnel['data']['brithdate'],2);?></span>
        <span style="top: 25.2%;left: 59%;"><?php echo date_th($personnel['work_start_date'],2);?></span>

        <span style="top: 28.8%;left: 21.2%;"><?php echo isset($data['ordination_status']) && intval($data['ordination_status'])==0?'&#10003;':''; ?></span>
        <span style="top: 28.8%;left: 33%;"><?php echo isset($data['ordination_status']) && intval($data['ordination_status'])==1?'&#10003;':''; ?></span>


        <span class="overflow-text" style="top: 31.4%;left: 18.3%;width:23%;height:3%;"><?php echo isset($data['temple_name'])?$data['temple_name']:'-';?></span>
        <span class="overflow-text" style="top: 33.8%;left: 14.3%;width:66%;height:3%;"><?php echo isset($data['temple_address'])?$data['temple_address']:'-';?></span>

        <span style="top: 36.5%;left: 23%;"><?php echo date_th($data['ordination_date'],2);?></span>

        <span class="overflow-text" style="top: 36.4%;left: 63.3%;width:23%;height:3%;"><?php echo isset($data['temple_name2'])?$data['temple_name2']:'-';?></span>
        <span class="overflow-text" style="top: 39.4%;left: 20.3%;width:66%;height:3%;"><?php echo isset($data['temple_address2'])?$data['temple_address2']:'-';?></span>

        <span style="top: 41.6%;left: 38%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'-';?></span>

        <span style="top: 41.8%;left: 55%;"><?php echo date_th($data['period_start'],2);?></span>
        <span style="top: 44.4%;left: 19%;"><?php echo date_th($data['period_end'],2);?></span>

        <span style="top: 53.5%;left: 54%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>

        <span style="top: 56.8%;left: 60%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>


      <!-- <span style="top: 13%;left: 16%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
      <span style="top: 14.6%;left: 55%"><?php //echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 14.6%;left: 58%;"><?php //echo date_th($data['create_date'],9);?></span>
      <span style="top: 14.6%;left: 67%;">พ.ศ. <?php //echo date_th($data['create_date'],10);?></span>

      <span style="top: 27.8%;left: 20%;">
        <?php 
          // echo isset($personnel['title'])?$personnel['title']:'-'; 
          // echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          // echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>

      <span style="top: 28%;left: 60%;"><?php //echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 30.4%;left: 14.4%;"><?php //echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==1?'&#10003;':''; ?></span>
      <span style="top: 30.4%;left: 38%;"><?php //echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==4?'&#10003;':''; ?></span>
      <span style="top: 30.4%;left: 61.4%;"><?php //echo isset($personnel['data']['emp_type_id']) && ($personnel['data']['emp_type_id']==2 || $personnel['data']['emp_type_id']==3)?'&#10003;':''; ?></span>
      <span style="top: 33.2%;left: 14.4%;"><?php //echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==5?'&#10003;':''; ?></span>
      <span style="top: 33.2%;left: 38.4%;"><?php //echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==6?'&#10003;':''; ?></span>
      <span style="top: 33.2%;left: 61.4%;"><?php //echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==7?'&#10003;':''; ?></span>

      <span style="top: 35.6%;left: 18%;"><?php //echo isset($personnel['subdepartment_name']) && trim($personnel['subdepartment_name'])!=''?$personnel['subdepartment_name']:''; ?></span>
      <span style="top: 35.6%;left: 36%;"><?php //echo isset($personnel['department_name']) && trim($personnel['department_name'])!=''?$personnel['department_name']:''; ?></span>
      <span style="top: 35.6%;left: 60%;"><?php //echo isset($personnel['data']['internal_tel']) && trim($personnel['data']['internal_tel'])!=''?$personnel['data']['internal_tel']:''; ?></span>
      
      <span style="top: 38%;left: 59%;"><?php //echo date_th($data['period_start'],2);?></span>
      <span style="top: 40.4%;left: 61%;">
        <?php
          // $d1 = new DateTime(date('Y-m-d',strtotime($data['period_start'])));
          // $d2 = new DateTime(date('Y-m-d',strtotime($data['period_end'])));
          // $diff=date_diff($d1,$d2);
          // echo '-';//$diff->format('%m');
        ?>
      </span>
      <span style="top: 40.4%;left: 70%;">
        <?php //echo $diff->format('%a')+1; ?>
      </span>
      <span style="top: 40.4%;left: 20%;"><?php //echo date_th($data['period_end'],2);?></span>

      <span style="top: 55%;left: 50%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 57.8%;left: 52%;">
        <?php 
          // echo isset($personnel['title'])?$personnel['title']:'-'; 
          // echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          // echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 60.4%;left: 58%;"><?php //echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span> -->











    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==9){$doc[0] = 'document/leave/9.2.png';?>

      <span style="top: 13%;left: 70%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
      <span style="top: 11.4%;left: 70%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 11.4%;left: 77%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 11.4%;left: 88%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 16.2%;left: 22%;"><?php echo isset($data['title'])?$data['title']:'-';?></span>

      <span style="top: 21.8%;left: 38%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 21.8%;left: 73%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
      <span style="top: 22.8%;left: 22%;"></span>
      <span style="top: 24.4%;left: 44%;">คณะแพทยศาสตร์</span>
      <span style="top: 27%;left: 31%;"><?php echo isset($data['call_soldier'])?$data['call_soldier']:'-';?></span>
      <span class="overflow-text" style="top: 29.4%;left: 19%;width: 37%;height:3%;"><?php echo isset($data['call_soldier_form'])?$data['call_soldier_form']:'-';?></span>
      <span style="top: 29.4%;left: 63%;"><?php echo date('d',strtotime($data['call_date']));?></span>
      <span style="top: 29.4%;left: 71%;"><?php echo date_th($data['call_date'],8);?></span>
      <span style="top: 29.4%;left: 85%;"><?php echo date_th($data['call_date'],10);?></span>
      <span class="overflow-text" style="top: 31.8%;left: 25.6%;width: 40%;height:3%;"><?php echo isset($data['call_soldier_detail'])?$data['call_soldier_detail']:'-';?></span>
      <span class="overflow-text" style="top: 34.4%;left: 16.6%;width: 40%;height:3%;"><?php echo isset($data['train_address'])?$data['train_address']:'-';?></span>
      <span style="top: 34.4%;left: 65.6%;"><?php echo date_th($data['period_start'],2);?></span>
      <span style="top: 36.8%;left: 22.6%;"><?php echo date('d',strtotime($data['period_end']));?></span>
      <span style="top: 36.8%;left: 25.2%;"><?php echo date_th($data['period_end'],8);?></span>
      <span style="top: 36.8%;left: 28%;"><?php echo date_th($data['period_end'],10);?></span>
      <span style="top: 36.8%;left: 58%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):'0';?></span>

      <span style="top: 48.4%;left: 58%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 51.8%;left: 58%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 54.2%;left: 56%;"><?php echo date('d/m/',strtotime($data['create_date'])).(date('Y',strtotime($data['create_date']))+543);?></span>

    <?php }elseif(isset($data['leave_type_id']) && intval($data['leave_type_id'])==10){$doc[0] = 'document/leave/10.2.1.png';$doc[1] = 'document/leave/10.2.2.png';?>

      <span style="top: 8.6%;left: 63%;"><?php echo date('d',strtotime($data['create_date']));?></span>
      <span style="top: 8.6%;left: 72%;"><?php echo date_th($data['create_date'],9);?></span>
      <span style="top: 8.6%;left: 84%;"><?php echo date_th($data['create_date'],10);?></span>
      <span style="top: 13%;left: 22%;"><?php //echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
      <span style="top: 17.2%;left: 28%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 17.2%;left: 64%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

      <span style="top: 19.4%;left: 25%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>

      <span style="top: 22.2%;left: 33%;"></span>
      <span style="top: 24.2%;left: 33%;">&#10003</span>
      <span style="top: 26.4%;left: 33%;"></span>

      <span class="overflow-text" style="top: 21.6%;left: 58%;width:66%;height:3%;"><?php echo isset($data['detail'])?htmlspecialchars_decode($data['detail']):'-';?></span>

      <span style="top: 29%;left: 22%;"><?php echo date_th($data['period_start'],2);?></span>

      <span style="top: 29%;left: 50%;"><?php echo date_th($data['period_end'],2);?></span>

      <span style="top: 29%;left: 80%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

      <span style="top: 31.4%;left: 30.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==3?'&#10003':'';?></span>
      <span style="top: 31.4%;left: 45.8%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==2?'&#10003':'';?></span>
      <span style="top: 31.4%;left: 63.2%;"><?php echo isset($last_leave) && $last_leave['leave_type_id']==4?'&#10003':'';?></span>

      <span style="top: 33.8%;left: 27%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],2):' - ';?></span>

      <span style="top: 33.8%;left: 52%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],2):' - ';?></span>

      <span style="top: 33.8%;left: 81%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['period_count']:' - ';?></span>

      <span class="overflow-text" style="top: 36.4%;left: 35%;width:50%;height:3%;"><?php echo isset($data['contact'])?htmlspecialchars_decode($data['contact']):'-';?></span>

      <span style="top: 47.4%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[3]):0;?></span>
      <span style="top: 47.4%;left: 38%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($data['period_count']):0;?></span>
      <span style="top: 47.4%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==3?floatval($old_leave_type[3])+floatval($data['period_count']):0;?></span>
      <span style="top: 49.6%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[2]):0;?></span>
      <span style="top: 49.6%;left: 38%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
      <span style="top: 49.6%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==2?floatval($old_leave_type[2])+floatval($data['period_count']):floatval($old_leave_type[2]);?></span>
      <span style="top: 51.8%;left: 28%;"><?php echo isset($old_leave_type)?floatval($old_leave_type[4]):0;?></span>
      <span style="top: 51.8%;left: 38%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($data['period_count']):0;?></span>
      <span style="top: 51.8%;left: 46%;"><?php echo isset($data['leave_type_id']) && $data['leave_type_id']==4?floatval($old_leave_type[4])+floatval($data['period_count']):0;?></span>
      <span style="top: 54%;left: 46%;"><?php echo floatval($old_leave_type[2])+floatval($old_leave_type[3])+floatval($old_leave_type[4])+floatval($data['period_count']);?></span>

      <span style="top: 45.6%;left: 60%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 48.4%;left: 60%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 57.6%;left: 60%;"><img src="<?php //echo isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && $data['signature_date_personnel_1']!='' && isset($personnel_list['data'][$data['personnel_id_1']])?$personnel_list['data'][$data['personnel_id_1']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
      <span style="top: 60.2%;left: 60%;">
        <?php 
          if(isset($data['personnel_id_1']) && intval($data['personnel_id_1'])!=0 && isset($personnel_list['data'][$data['personnel_id_1']])){
            echo $personnel_list['data'][$data['personnel_id_1']]['title']; 
            echo $personnel_list['data'][$data['personnel_id_1']]['name_th'].'&nbsp;'; 
            echo $personnel_list['data'][$data['personnel_id_1']]['surname_th'];
          }
        ?>
      </span>

    <?php } if(isset($doc[0])){ ?>
      <?php /*if(isset($data['leave_type_id']) && intval($data['leave_type_id'])!=8){ ?>
        <span style="top: 4.2%;left: 13.6%;"><div id="qrcode1"></div><div class="leave_no"><?php echo $data['leave_no']; ?></div></span>
      <?php }else{ ?>
        <span style="bottom: 20%;left: 80%;"><div id="qrcode1"></div><div class="leave_no"><?php echo $data['leave_no']; ?></div></span>
      <?php }*/ //sanan ?>
    <img src="<?php echo base_url(load_file($doc[0]));?>" style="width:100%;">
    <?php }} ?>
  </div>
  <?php if(!isset($cancel_approve) or (isset($cancel_approve) and !$cancel_approve)){ if(isset($doc[1])){?>
    <div class="col-lg-12 document" >

      <?php if(isset($data['leave_type_id']) && (intval($data['leave_type_id'])==7 || intval($data['leave_type_id'])==10)){ ?>
        <span style="bottom: 20%;left: 80%;"><div id="qrcode2"></div><div class="leave_no"><?php //echo $data['leave_no']; ?></div></span>
      <?php } ?>

      <?php if(isset($data['leave_type_id']) && intval($data['leave_type_id'])==4){ ?>
        <span style="top: 13%;left: 16%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
        <span style="top: 14.6%;left: 55%"><?php echo date('d',strtotime($data['create_date']));?></span>
        <span style="top: 14.6%;left: 58%;"><?php echo date_th($data['create_date'],9);?></span>
        <span style="top: 14.6%;left: 67%;">พ.ศ. <?php echo date_th($data['create_date'],10);?></span>
        <span style="top: 25.4%;left: 35%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>

        <span style="top: 25.4%;left: 70%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>

        <span style="top: 28%;left: 14.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==1?'&#10003;':''; ?></span>
        <span style="top: 28%;left: 38.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==4?'&#10003;':''; ?></span>
        <span style="top: 28%;left: 61.8%;"><?php echo isset($personnel['data']['emp_type_id']) && ($personnel['data']['emp_type_id']==2 || $personnel['data']['emp_type_id']==3)?'&#10003;':''; ?></span>
        <span style="top: 30.4%;left: 14.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==5?'&#10003;':''; ?></span>
        <span style="top: 30.4%;left: 38.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==6?'&#10003;':''; ?></span>
        <span style="top: 30.4%;left: 61.8%;"><?php echo isset($personnel['data']['emp_type_id']) && $personnel['data']['emp_type_id']==7?'&#10003;':''; ?></span>

        <span style="top: 33.2%;left: 22%;"><?php echo isset($personnel['department_name']) && trim($personnel['department_name'])!=''?$personnel['department_name']:''; ?></span>
        <span style="top: 33.2%;left: 50%;"><?php echo isset($personnel['data']['internal_tel']) && trim($personnel['data']['internal_tel'])!=''?$personnel['data']['internal_tel']:''; ?></span>
        
        <!-- <span style="top: 35.6%;left: 31%;"><?php //echo date('d',strtotime($data['child_birthdate_start']));?></span>
        <span style="top: 35.6%;left: 40%;"><?php //echo date_th($data['child_birthdate_start'],9);?></span>
        <span style="top: 35.6%;left: 52%;"><?php //echo date_th($data['child_birthdate_start'],10);?></span>
        <span style="top: 35.6%;left: 67%;"><?php //echo date('d',strtotime($data['child_birthdate_end']));?></span>
        <span style="top: 35.6%;left: 76%;"><?php //echo date_th($data['child_birthdate_end'],9);?></span>
        <span style="top: 38%;left: 18%;"><?php //echo date_th($data['child_birthdate_end'],10);?></span>
        <span style="top: 38%;left: 39%;">
          <?php
            // $d1 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_start'])));
            // $d2 = new DateTime(date('Y-m-d',strtotime($data['child_birthdate_end'])));
            // $diff=date_diff($d1,$d2);
            // echo '-';//$diff->format('%m');
          ?>
        </span>
        <span style="top: 38%;left: 46%;">
          <?php //echo $diff->format('%a')+1; ?>
        </span> -->

        <span style="top: 35.6%;left: 31%;"><?php echo date('d',strtotime($data['period_start']));?></span>
        <span style="top: 35.6%;left: 40%;"><?php echo date_th($data['period_start'],9);?></span>
        <span style="top: 35.6%;left: 53%;"><?php echo date_th($data['period_start'],10);?></span>
        <span style="top: 35.6%;left: 67%;"><?php echo date('d',strtotime($data['period_end']));?></span>
        <span style="top: 35.6%;left: 77%;"><?php echo date_th($data['period_end'],9);?></span>
        <span style="top: 38.2%;left: 18%;"><?php echo date_th($data['period_end'],10);?></span>

        <span style="top: 38.2%;left: 39%;">-</span>
        <span style="top: 38.2%;left: 46%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):''; ?></span>

        <span style="top: 42%;left: 56%;"><?php echo date('d',strtotime($data['period_start']));?></span>
        <span style="top: 42%;left: 66%;"><?php echo date_th($data['period_start'],9);?></span>
        <span style="top: 42%;left: 80%;"><?php echo date_th($data['period_start'],10);?></span>
        <span style="top: 44.4%;left: 19%;"><?php echo date('d',strtotime($data['period_end']));?></span>
        <span style="top: 44.4%;left: 27%;"><?php echo date_th($data['period_end'],9);?></span>
        <span style="top: 44.4%;left: 42%;"><?php echo date_th($data['period_end'],10);?></span>

        <!-- <span style="top: 44.4%;left: 19%;"><?php echo date('d',strtotime($data['period_start']));?></span>
        <span style="top: 44.4%;left: 27%;"><?php echo date_th($data['period_start'],9);?></span>
        <span style="top: 44.4%;left: 42%;"><?php echo date_th($data['period_start'],10);?></span>
        <span style="top: 42%;left: 56%;"><?php echo date('d',strtotime($data['period_end']));?></span>
        <span style="top: 42%;left: 66%;"><?php echo date_th($data['period_end'],9);?></span>
        <span style="top: 42%;left: 80%;"><?php echo date_th($data['period_end'],10);?></span> -->


        <span style="top: 44.4%;left: 63%;">-</span>
        <span style="top: 44.4%;left: 70%;"><?php echo isset($data['period_count_all'])?floatval($data['period_count_all']):''; ?></span>




        <!-- <span style="top: 52%;left: 50%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span> -->
        <?php if($data['to']==1){ ?>
        <span style="top: 54%;left: 56%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 56.2%;left: 56%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 58.4%;left: 60%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
        <?php }else{ ?>
          <span style="top: 55.6%;left: 53%;">
            <?php 
              echo isset($personnel['title'])?$personnel['title']:'-'; 
              echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
              echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
            ?>
          </span>
          <span style="top: 58%;left: 58%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
        <?php } ?>
        


        <?php if($data['to']==1){ ?>
        <?php if(isset($approve_list[2])){ ?>
          <span style="top: 64.8%;left: 14.4%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==1?'&#10003;':''; ?></span>
          <span style="top: 64.8%;left: 28%;"><?php echo isset($data['approve_personnel_2']) && intval($data['approve_personnel_2'])==2?'&#10003;':''; ?></span>
          <?php if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_date_personnel_2']!=''){ ?>
          <span style="top: 68.2%;left: 21%;">
            <?php 
              if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
                echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
              }
            ?>
          </span>
          <?php } ?>
          <span style="top: 70.6%;left: 21%;">
            <?php 
              if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
                echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
              }
            ?>
          </span>
          <span style="top: 72.8%;left: 21%;"><?php echo isset($data['position_personnel_2']) && trim($data['position_personnel_2'])!=''?$data['position_personnel_2']:''; ?></span>
          <span style="top: 74.8%;left: 21%;"><?php echo isset($data['signature_date_personnel_2']) && trim($data['signature_date_personnel_2'])!=''?date('d/m/',strtotime($data['signature_date_personnel_2'])).(date("Y",strtotime($data['signature_date_personnel_2']))+543):''; ?></span>
        <?php } ?>

        <?php for($i=3;$i<=4;$i++){if(isset($approve_list[$i])){ ?>
          <span style="top: 64.2%;left: 52.4%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==1?'&#10003;':''; ?></span>
          <span style="top: 64.2%;left: 65.8%;"><?php echo isset($data['approve_personnel_3']) && intval($data['approve_personnel_3'])==2?'&#10003;':''; ?></span>
          <?php if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_date_personnel_3']!=''){ ?>
          <span style="top: 68.4%;left: 57.4%;">
            <?php 
              if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
                echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
              }
            ?>
          </span>
          <?php } ?>
          <span style="top: 70.6%;left: 57.4%;">
            <?php 
              if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
                echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
              }
            ?>
          </span>
          <span style="top: 72.8%;left: 57.4%;"><?php echo isset($data['position_personnel_3']) && trim($data['position_personnel_3'])!=''?$data['position_personnel_3']:''; ?></span>
          <span style="top: 75%;left: 57.4%;"><?php echo isset($data['signature_date_personnel_3']) && trim($data['signature_date_personnel_3'])!=''?date('d/m/',strtotime($data['signature_date_personnel_3'])).(date("Y",strtotime($data['signature_date_personnel_3']))+543):''; ?></span>
        <?php break;}} ?>

        <?php if(isset($approve_list[5])){ ?>
          <span style="top: 80.6%;left: 14.6%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==1?'&#10003;':''; ?></span>
          <span style="top: 80.6%;left: 28%;"><?php echo isset($data['approve_personnel_5']) && intval($data['approve_personnel_5'])==2?'&#10003;':''; ?></span>
          <?php if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && $data['signature_date_personnel_5']!=''){ ?>
          <span style="top: 84.6%;left: 21%;">
            <?php
              if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
                echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
              }
            ?>
          </span>
          <?php } ?>
          <span style="top: 86.6%;left: 21%;">
            <?php
              if(isset($data['personnel_id_5']) && intval($data['personnel_id_5'])!=0 && isset($personnel_list['data'][$data['personnel_id_5']])){
                echo $personnel_list['data'][$data['personnel_id_5']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_5']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_5']]['surname_th'];
              }
            ?>
          </span>
          <span style="top: 88.8%;left: 21%;"><?php echo isset($data['position_personnel_5']) && trim($data['position_personnel_5'])!=''?$data['position_personnel_5']:''; ?></span>
          <span style="top: 91%;left: 21%;"><?php echo isset($data['signature_date_personnel_5']) && trim($data['signature_date_personnel_5'])!=''?date('d/m/',strtotime($data['signature_date_personnel_5'])).(date("Y",strtotime($data['signature_date_personnel_5']))+543):''; ?></span>
        <?php } ?>

        <span style="top: 82.8%;left: 53%;"><?php echo isset($data['approve_personnel_6']) && intval($data['approve_personnel_6'])==1?'&#10003;':''; ?></span>
        <span style="top: 82.8%;left: 62%;"><?php echo isset($data['approve_personnel_6']) && (intval($data['approve_personnel_6'])==2 || intval($data['approve_personnel_6'])==3)?'&#10003;':''; ?></span>

        <span class="overflow-text" style="top: 84.8%;left: 54.4%;width: 29%;height: 3%;"><?php echo isset($data['note_personnel_6'])?trim($data['note_personnel_6']):''; ?></span>

        <?php if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && $data['signature_date_personnel_6']!=''){ ?>
        <span style="top: 89%;left: 59%;">
          <?php
            if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
              echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 91.4%;left: 59%;">
          <?php
            if(isset($data['personnel_id_6']) && intval($data['personnel_id_6'])!=0 && isset($personnel_list['data'][$data['personnel_id_6']])){
              echo $personnel_list['data'][$data['personnel_id_6']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_6']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_6']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 93.4%;left: 59%;"><?php echo isset($data['position_personnel_6']) && trim($data['position_personnel_6'])!=''?$data['position_personnel_6']:''; ?></span>
        <span style="top: 95.6%;left: 59%;"><?php echo isset($data['signature_date_personnel_6']) && trim($data['signature_date_personnel_6'])!=''?date('d/m/',strtotime($data['signature_date_personnel_6'])).(date("Y",strtotime($data['signature_date_personnel_6']))+543):''; ?></span>
        <?php } ?>






















        
      <?php }elseif(isset($data['leave_type_id']) && (intval($data['leave_type_id'])==7 || intval($data['leave_type_id'])==10)){ ?>
        <span style="top: 11.5%;left: 67%;"><?php //echo isset($data['write_at'])?$data['write_at']:'-';?></span>
        <span style="top: 14%;left: 61%;"><?php echo date('d',strtotime($data['create_date']));?></span>
        <span style="top: 14%;left: 69%;"><?php echo date_th($data['create_date'],9);?></span>
        <span style="top: 14%;left: 80%;"><?php echo date_th($data['create_date'],10);?></span>
        <span style="top: 18.2%;left: 20%;"><?php //echo isset($data['title'])?$data['title']:'-';?></span>
        <span style="top: 24.8%;left: 29%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>
        <span style="top: 24.8%;left: 58%;"><?php echo intval(date('d',strtotime($personnel['data']['brithdate'])));?></span>
        <span style="top: 24.8%;left: 66%;"><?php echo date_th($personnel['data']['brithdate'],9);?></span>
        <span style="top: 24.8%;left: 78%;"><?php echo date_th($personnel['data']['brithdate'],10);?></span>
        <span style="top: 27.2%;left: 20%;"><?php echo date('Y')-date('Y',strtotime($personnel['data']['brithdate']));?></span>
        <span style="top: 27.2%;left: 46%;"><?php echo intval(date('d',strtotime($personnel['data']['work_start_date'])));?></span>
        <span style="top: 27.2%;left: 57%;"><?php echo date_th($personnel['data']['work_start_date'],9);?></span>
        <span style="top: 27.2%;left: 74%;"><?php echo date_th($personnel['data']['work_start_date'],10);?></span>
        <span style="top: 29.8%;left: 38%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
        <span style="top: 35%;left: 71%;"></span>
        <span style="top: 32.2%;left: 22%;"><?php echo isset($personnel['department_name'])?$personnel['department_name']:'-';?></span>
        <span style="top: 32.2%;left: 58%;">คณะแพทยศาสตร์</span>

        <span style="top: 34.8%;left: 20%;">มหาวิทยาลัยนเรศวร</span>
        <span style="top: 42%;left: 58%;"></span>
        <span class="overflow-text" style="top: 37.2%;left: 16%;width:28%;height:3%;"><?php echo isset($data['detail'])?$data['detail']:'-';?></span>
        <span style="top: 37.2%;left: 48%;"><?php echo isset($data['county_name'])?$data['county_name']:'-';?></span>
        <?php
          $d1 = new DateTime(date('Y-m-d',strtotime($data['period_start'])));
          $d2 = new DateTime(date('Y-m-d',strtotime($data['period_end'])));
          $diff=date_diff($d1,$d2);
        ?>
        <span style="top: 37.2%;left: 74%;"><?php echo $diff->format('%y');?></span>
        <span style="top: 39.6%;left: 16%;"><?php echo $diff->format('%m');?></span>
        <span style="top: 39.6%;left: 37%;"><?php echo $diff->format('%d')+1;?></span>
        <span style="top: 39.6%;left: 57%;"><?php echo date('d',strtotime($data['period_start']));?></span>
        <span style="top: 39.6%;left: 68%;"><?php echo date_th($data['period_start'],9);?></span>
        <span style="top: 39.6%;left: 80%;"><?php echo date_th($data['period_start'],10);?></span>
        <span style="top: 42.2%;left: 22%;"><?php echo intval(date('d',strtotime($data['period_end'])));?></span>
        <span style="top: 42.2%;left: 32%;"><?php echo date_th($data['period_end'],9);?></span>
        <span style="top: 42.2%;left: 46%;"><?php echo date_th($data['period_end'],10);?></span>
        <span style="top: 44.5%;left: 40%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['leave_type_name']:'-';?></span>
        <span style="top: 47.2%;left: 24%;"><?php echo isset($last_leave) && count($last_leave)>0?$last_leave['county_name']:'-';?></span>
        <?php
          $date_old = [];
          if(isset($last_leave) && count($last_leave)>0){
            $d1 = new DateTime(date('Y-m-d',strtotime($last_leave['period_start'])));
            $d2 = new DateTime(date('Y-m-d',strtotime($last_leave['period_end'])));
            $diff=date_diff($d1,$d2);
            $date_old['d'] = $diff->format('%d')+1;
            $date_old['m'] = $diff->format('%m');
            $date_old['y'] = $diff->format('%y');
          }
          
        ?>
        <span style="top: 47.2%;left: 52%;"><?php echo count($date_old)>0?$date_old['y']:'-';?></span>
        <span style="top: 47.2%;left: 61%;"><?php echo count($date_old)>0?$date_old['m']:'-';?></span>
        <span style="top: 47.2%;left: 74%;"><?php echo count($date_old)>0?$date_old['d']:'-';?></span>
        <span style="top: 49.6%;left: 22%;"><?php echo isset($last_leave) && count($last_leave)>0?date('d',strtotime($last_leave['period_start'])):'-';?></span>
        <span style="top: 49.6%;left: 33%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],9):'-';?></span>
        <span style="top: 49.6%;left: 44%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_start'],10):'-';?></span>
        <span style="top: 49.6%;left: 56%;"><?php echo isset($last_leave) && count($last_leave)>0?date('d',strtotime($last_leave['period_end'])):'-';?></span>
        <span style="top: 49.6%;left: 69%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],9):'-';?></span>
        <span style="top: 49.6%;left: 78%;"><?php echo isset($last_leave) && count($last_leave)>0?date_th($last_leave['period_end'],10):'-';?></span>

        <span style="top: 59.4%;left: 49%;"><img class="img-sig" src="<?php //echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
        <span style="top: 62.8%;left: 48%;">
          <?php 
            echo isset($personnel['title'])?$personnel['title']:'-'; 
            echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
            echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
          ?>
        </span>


      <?php } ?>

      <img src="<?php echo base_url(load_file($doc[1]));?>" style="width:100%;">


    </div>
  <?php }} ?>
  <?php if(isset($data['status']) && intval($data['status'])==98){ ?>
    <div class="col-lg-12 document">

      <span style="top: 4.2%;left: 13.6%;"><div id="qrcode3"></div><div class="leave_no"><?php //echo $data['leave_no']; ?></div></span>

      <span style="top: 7.8%;left: 68%;"><?php echo isset($data['write_at'])?$data['write_at']:'-';?></span>
      <span style="top: 10.5%;left: 60%;"><?php echo date('d',strtotime($data['cancel_date']));?></span>
      <span style="top: 10.5%;left: 68%;"><?php echo date_th($data['cancel_date'],9);?></span>
      <span style="top: 10.5%;left: 79%;"><?php echo date_th($data['cancel_date'],10);?></span>

      <span style="top: 20.8%;left: 28%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 20.8%;left: 67%;"><?php echo isset($personnel['position_name'])?$personnel['position_name']:'-';?></span>
      <span style="top: 23.6%;left: 18%;">คณะแพทยศาสตร์</span>
      <span style="top: 26.5%;left: 28%;"><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
      <span style="top: 26.5%;left: 64%;"><?php echo date_th($data['period_start'],2);?></span>
      <span style="top: 29.4%;left: 20%;"><?php echo date_th($data['period_end'],2);?></span>
      <span style="top: 29.4%;left: 47%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>

      <span style="top: 32.2%;left: 26%;"><?php echo isset($data['cancel_detail'])?$data['cancel_detail']:'-';?></span>
      <span style="top: 35.2%;left: 28%;"><?php echo isset($data['leave_type_id']) && isset($leave_type[$data['leave_type_id']])?$leave_type[$data['leave_type_id']]['leave_name']:' - ';?></span>
      <span style="top: 35.2%;left: 78%;"><?php echo isset($data['period_count'])?floatval($data['period_count']):'0';?></span>
      <span style="top: 37.8%;left: 23%;"><?php echo date_th($data['period_start'],2);?></span>
      <span style="top: 37.8%;left: 61%;"><?php echo date_th($data['period_end'],2);?></span>
      
      <span style="top: 46.2%;left: 58%;"><img class="img-sig" src="<?php echo isset($personnel['data']['signature']) && trim($personnel['data']['signature'])!=''?$personnel['data']['signature']:base_url(load_file('assets/img/emp.png'));?>"/></span>
      <span style="top: 46.8%;left: 56%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>
      <span style="top: 49.4%;left: 56%;">
        <?php 
          echo isset($personnel['title'])?$personnel['title']:'-'; 
          echo isset($personnel['name_th'])?$personnel['name_th'].' ':'-'; 
          echo isset($personnel['surname_th'])?$personnel['surname_th']:'-'; 
        ?>
      </span>

      <?php if(isset($approve_list[2])){ ?>
        <span style="top: 58%;left: 10.8%;"><?php echo isset($data['approve_cancel_personnel_2']) && intval($data['approve_cancel_personnel_2'])==1?'&#10003;':''; ?></span>
        <span style="top: 58%;left: 23.4%;"><?php echo isset($data['approve_cancel_personnel_2']) && intval($data['approve_cancel_personnel_2'])==2?'&#10003;':''; ?></span>
        <span style="top: 61%;left: 15.5%;"><img src="<?php echo isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_cancel_date_2']!='' && isset($personnel_list['data'][$data['personnel_id_2']])?$personnel_list['data'][$data['personnel_id_2']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
        <?php if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && $data['signature_cancel_date_personnel_2']!=''){ ?>
          <span style="top: 62.6%;left: 16.4%;">
            <?php 
              if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
                echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
                echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
              }
            ?>
          </span>
        <?php } ?>
        <span style="top: 65%;left: 16.4%;">
          <?php 
            if(isset($data['personnel_id_2']) && intval($data['personnel_id_2'])!=0 && isset($personnel_list['data'][$data['personnel_id_2']])){
              echo $personnel_list['data'][$data['personnel_id_2']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_2']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_2']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 67.6%;left: 16.4%;"><?php echo isset($data['position_personnel_2']) && trim($data['position_personnel_2'])!=''?$data['position_personnel_2']:''; ?></span>
        <span style="top: 70%;left: 16.4%;"><?php echo isset($data['signature_cancel_date_personnel_2']) && trim($data['signature_cancel_date_personnel_2'])!=''?date('d/m/',strtotime($data['signature_cancel_date_personnel_2'])).(date("Y",strtotime($data['signature_cancel_date_personnel_2']))+543):''; ?></span>
      <?php } ?>

      <?php if(isset($approve_list[3])){ ?>
        <span style="top: 58%;left: 50.8%;"><?php echo isset($data['approve_cancel_personnel_3']) && intval($data['approve_cancel_personnel_3'])==1?'&#10003;':''; ?></span>
        <span style="top: 58%;left: 63.4%;"><?php echo isset($data['approve_cancel_personnel_3']) && intval($data['approve_cancel_personnel_3'])==2?'&#10003;':''; ?></span>
        <span style="top: 61%;left: 55%;"><img src="<?php echo isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_cancel_date_3']!='' && isset($personnel_list['data'][$data['personnel_id_3']])?$personnel_list['data'][$data['personnel_id_3']]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
        <?php if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && $data['signature_cancel_date_personnel_3']!=''){ ?>
        <span style="top: 62.6%;left: 57%;">
          <?php 
            if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
              echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 65%;left: 57%;">
          <?php 
            if(isset($data['personnel_id_3']) && intval($data['personnel_id_3'])!=0 && isset($personnel_list['data'][$data['personnel_id_3']])){
              echo $personnel_list['data'][$data['personnel_id_3']]['title']; 
              echo $personnel_list['data'][$data['personnel_id_3']]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_3']]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 67.6%;left: 57%;"><?php echo isset($data['position_personnel_3']) && trim($data['position_personnel_3'])!=''?$data['position_personnel_3']:''; ?></span>
        <span style="top: 70%;left: 57%;"><?php echo isset($data['signature_cancel_date_personnel_3']) && trim($data['signature_cancel_date_personnel_3'])!=''?date('d/m/',strtotime($data['signature_cancel_date_3'])).(date("Y",strtotime($data['signature_cancel_date_personnel_3']))+543):''; ?></span>
      <?php } ?>


      <?php for($i=4;$i<=(isset($approve_list[6])?5:4);$i++){if(isset($approve_list[$i])){ ?>
        <span style="top: 78.6%;left: 10.8%;"><?php echo isset($data['approve_cancel_personnel_'.$i]) && intval($data['approve_cancel_personnel_'.$i])==1?'&#10003;':''; ?></span>
        <span style="top: 78.6%;left: 23.4%;"><?php echo isset($data['approve_cancel_personnel_'.$i]) && intval($data['approve_cancel_personnel_'.$i])==2?'&#10003;':''; ?></span>
        <span style="top: 79.5%;left: 15.5%;"><img src="<?php echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_cancel_date_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span>
        <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_cancel_date_personnel_'.$i]!=''){ ?>
        <span style="top: 83.8%;left: 16.4%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <?php } ?>
        <span style="top: 86.2%;left: 16.4%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 89%;left: 16.4%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
        <span style="top: 91.2%;left: 16.4%;"><?php echo isset($data['signature_cancel_date_personnel_'.$i]) && trim($data['signature_cancel_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_cancel_date_personnel_'.$i])).(date("Y",strtotime($data['signature_cancel_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>

      <?php for($i=(isset($approve_list[6])?6:5);$i<=6;$i++){if(isset($approve_list[$i])){ ?>
        <span style="top: 78.6%;left: 50.8%;"><?php echo isset($data['approve_cancel_personnel_'.$i]) && intval($data['approve_cancel_personnel_'.$i])==1?'&#10003;':''; ?></span>
        <span style="top: 78.6%;left: 58.8%;"><?php echo isset($data['approve_cancel_personnel_'.$i]) && intval($data['approve_cancel_personnel_'.$i])==2?'&#10003;':''; ?></span>
        <!-- <span style="top: 78.6%;left: 68.4%;"><img src="<?php //echo isset($data['personnel_id_'.$i]) && intval($data['personnel_id_5'])!=0 && $data['signature_cancel_date_'.$i]!='' && isset($personnel_list['data'][$data['personnel_id_'.$i]])?$personnel_list['data'][$data['personnel_id_'.$i]]['signature']:base_url(load_file('assets/img/emp.png'));?>" class="img-sig"/></span> -->
        <?php if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && $data['signature_cancel_date_personnel_'.$i]!=''){ ?>
          <span style="top: 85%;left: 57%;">
            <?php 
              if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
                echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
                echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
                echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
              }
            ?>
          </span>
        <?php } ?>






        

        <span style="top: 87.4%;left: 57%;">
          <?php 
            if(isset($data['personnel_id_'.$i]) && intval($data['personnel_id_'.$i])!=0 && isset($personnel_list['data'][$data['personnel_id_'.$i]])){
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['title']; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['name_th'].'&nbsp;'; 
              echo $personnel_list['data'][$data['personnel_id_'.$i]]['surname_th'];
            }
          ?>
        </span>
        <span style="top: 90%;left: 57%;"><?php echo isset($data['position_personnel_'.$i]) && trim($data['position_personnel_'.$i])!=''?$data['position_personnel_'.$i]:''; ?></span>
        <span style="top: 92.6%;left: 57%;"><?php echo isset($data['signature_cancel_date_personnel_'.$i]) && trim($data['signature_cancel_date_personnel_'.$i])!=''?date('d/m/',strtotime($data['signature_cancel_date_personnel_'.$i])).(date("Y",strtotime($data['signature_cancel_date_personnel_'.$i]))+543):''; ?></span>
      <?php break;}} ?>


      <img src="<?php echo base_url(load_file('document/leave/0.jpg'));?>" style="width:100%;">
    </div>
  <?php } ?>
</div>
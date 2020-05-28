<script>
    $(document).ready(function(){

        var status = getUrlParam('status',false);
        var msg = decodeURIComponent(getUrlParam('msg',false));
        if(status=='validate_msg' && msg!=''){
            $('#_alert .modal-title').text('ผิดพลาด');
            $('#_alert .modal-body').text(replaceAll(msg, '+', ' '));
            $('#modal-alert').click();
        }

        function getUrlParam(parameter, defaultvalue){
        var urlparameter = defaultvalue;
        if(window.location.href.indexOf(parameter) > -1){
            urlparameter = getUrlVars()[parameter];
            }
        return urlparameter;
        }
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        function replaceAll(string, search, replace) {
            return string.split(search).join(replace);
        }

        
        
    });
    
</script>
<!-- Alert Modal-->
<a id="modal-alert" class="dropdown-item" href="#" data-toggle="modal" data-target="#_alert" style="display:none;"></a>
<div class="modal fade" id="_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body"></div>

        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">ปิด</button>
        </div>
        </div>
    </div>
</div>

<!-- Confirm Modal-->
<a id="modal-confirm" class="dropdown-item" href="#" data-toggle="modal" data-target="#_confirm" style="display:none;"></a>
<div class="modal fade" id="_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="display:none;">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body"></div>

        <div class="modal-footer">
            <button class="answer-btn btn btn-secondary" answer="0" type="button" data-dismiss="modal">ยกเลิก</button>
            <button class="answer-btn btn btn-primary" answer="1" type="button" data-dismiss="modal">ตกลง</button>
        </div>
        </div>
    </div>
</div>
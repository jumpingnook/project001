
$(document).ready(function(){
    re();
    function re(){
        var body_html = $('body').html();
        var result = body_html.search("mysqli");
        if(result!==-1){
            window.location.reload();
        }
    }
});


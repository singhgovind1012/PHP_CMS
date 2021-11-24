
$(document).ready(function() {
    $('#summernote').summernote({
        height: 200
    });
    $('#selectAllBoxes').click(function(event){
    if(this.checked){
    $('.checkBoxes').each(function(){
        this.checked =true;
    });
    }else{
    $('.checkBoxes').each(function(){
        this.checked =false;
    });

}
    });


});
function loadUsersOnline() {
    $.get("functions.php?onlineusers=result",function(data){
        $(".useronline").text(data);
    });
}
setInterval(function(){
loadUsersOnline();
},500);
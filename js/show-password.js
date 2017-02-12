$(document).ready(function() {
  $("#showPassword").click(function() {
    if ($(".showpassword").attr("type") == "password") {
        $(".showpassword").attr("type", "text");
        $(".show-off").attr("class", "fa fa-eye show-on");
    } else {
        $(".showpassword").attr("type", "password");
        $(".show-on").attr("class", "fa fa-eye show-off");
    }
  });
    
    $("#showPassword2").click(function() {
    if ($(".showpassword2").attr("type") == "password") {
        $(".showpassword2").attr("type", "text");
        $(".show-off2").attr("class", "fa fa-eye show-on2");
    } else {
        $(".showpassword2").attr("type", "password");
        $(".show-on2").attr("class", "fa fa-eye show-off2");
    }
  });
    
     $("#showPassword3").click(function() {
    if ($(".showpassword3").attr("type") == "password") {
        $(".showpassword3").attr("type", "text");
        $(".show-off3").attr("class", "fa fa-eye show-on3");
    } else {
        $(".showpassword3").attr("type", "password");
        $(".show-on3").attr("class", "fa fa-eye show-off3");
    }
  });
});

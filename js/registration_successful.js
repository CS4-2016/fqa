bootstrap_alert = function() {}
bootstrap_alert.warning = function(message) {
            $('#alert_placeholder').html('<div class="alert"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
        }
    

$('#btnSubmit').on('click', function() {
            bootstrap_alert.warning('Registration Successful');
});
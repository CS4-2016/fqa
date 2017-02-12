$(function() {    
    $(".delete-exhibit").confirm({
    text: "Are you sure you want to continue?",
    title: "Confirmation required",
    confirm: function(input) {
         $( "#form").submit();
    },
    cancel: function(input) {

    },
    confirmButton: "Yes",
    cancelButton: "No",
    post: true,
    confirmButtonClass: "btn-info",
    cancelButtonClass: "btn-default",
    dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
    });
              

}); 
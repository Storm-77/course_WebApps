$(document).ready(function () {
    
    $("#loginBtn").click(function (e) { 

        
        $.ajax({
            type: "post",
            url: "server/login.php",
            dataType: "dataType",
            data: {
                login:$("#login").val(),
                passwd:$("#password").val()
            },
            success: function (response) {
                console.log(response);
            }            
        });

    });

});
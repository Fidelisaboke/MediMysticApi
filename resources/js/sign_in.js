setTimeout(function(){
    if(document.getElementById("error_msg") != null){
        document.getElementById("error_msg").style.display = "none";
    }else if(document.getElementById("success_msg") != null){
        document.getElementById("success_msg").style.display = "none";
    }
}, 3000);
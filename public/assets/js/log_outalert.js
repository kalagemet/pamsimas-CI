var LogoutAlert={
    init:function(){
        $("#m_sweetalert_logout").click(function(e){
            swal({
                title:"Anda yakin ?",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Keluar!"
            })
            .then(function(e){
                e.value?window.location="logout":"cancel"===e.dismiss
            })
        })
    }
};

jQuery(document).ready(function(){LogoutAlert.init()});
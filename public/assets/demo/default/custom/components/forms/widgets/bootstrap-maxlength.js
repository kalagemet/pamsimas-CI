
    var BootstrapMaxlength={
        init:function(){
            $("#m_maxlength_1").maxlength({
                warningClass:"m-badge m-badge--warning m-badge--rounded m-badge--wide",
                limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide"
            }),
            $("#m_maxlength_2").maxlength({
                threshold:5,warningClass:"m-badge m-badge--danger m-badge--rounded m-badge--wide",
                limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide"
            }),
            $("#m_maxlength_3").maxlength({
                alwaysShow:!0,
                threshold:5,
                warningClass:"m-badge m-badge--primary m-badge--rounded m-badge--wide",
                limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"
            }),
            $("#m_maxlength_4").maxlength({
                threshold:3,
                warningClass:"m-badge m-badge--danger m-badge--rounded m-badge--wide",
                limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide",
                separator:" of ",preText:"You have ",postText:" chars remaining.",validate:!0
            }),
            $("#m_maxlength_5").maxlength({threshold:5,warningClass:"m-badge m-badge--primary m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"}),$("#m_maxlength_6_1").maxlength({alwaysShow:!0,threshold:5,placement:"top-left",warningClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"}),$("#m_maxlength_6_2").maxlength({alwaysShow:!0,threshold:5,placement:"top-right",warningClass:"m-badge m-badge--success m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"}),$("#m_maxlength_6_3").maxlength({alwaysShow:!0,threshold:5,placement:"bottom-left",warningClass:"m-badge m-badge--warning m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"}),$("#m_maxlength_6_4").maxlength({alwaysShow:!0,threshold:5,placement:"bottom-right",warningClass:"m-badge m-badge--danger m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide"}),$("#m_maxlength_1_modal").maxlength({warningClass:"m-badge m-badge--warning m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide",appendToParent:!0}),$("#m_maxlength_2_modal").maxlength({threshold:5,warningClass:"m-badge m-badge--danger m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide",appendToParent:!0}),$("#m_maxlength_5_modal").maxlength({threshold:5,warningClass:"m-badge m-badge--primary m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide",appendToParent:!0}),$("#m_maxlength_4_modal").maxlength({threshold:3,warningClass:"m-badge m-badge--danger m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--success m-badge--rounded m-badge--wide",appendToParent:!0,separator:" of ",preText:"You have ",postText:" chars remaining.",validate:!0})
        }
    };

    jQuery(document).ready(function(){
        BootstrapMaxlength.init()
    });


    jQuery.extend(jQuery.validator.messages, {
        required: "Field tidak boleh kosong !!!",
        remote: "isi field tidak sesuai.",
        email: "Alamat email tidak valid.",
        url: "URL tidak valid.",
        date: "Tanggal tidak valid.",
        dateISO: "(ISO) Tanggal tidak valid.",
        number: "masukan nomor yang valid.",
        digits: "Hanya digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Batas Maksimal {0} characters."),
        minlength: jQuery.validator.format("Masukan Minimal {0} characters."),
        rangelength: jQuery.validator.format("Masukan nilai antara {0} dan {1} characters long."),
        range: jQuery.validator.format("Masukan nilai antara {0} dan {1}."),
        max: jQuery.validator.format("Masukan nilai lebih kecil atau sama dengan {0}."),
        min: jQuery.validator.format("Masukan nilai lebih besar atau sama dengan {0}.")
    });
window.addEventListener("DOMContentLoaded", (event) => {
    console.log(1)
    let aioa_license_key = document.querySelector('[name="aioa_license_key"]');
    let aioa_license_key_val = document.querySelector('[name="aioa_license_key"]').value;

    const iconTypeArrSize = document.querySelectorAll('input[name="aioa_icon_type"]:checked');
    const iconSizeArrSize = document.querySelectorAll('input[name="aioa_icon_size"]:checked');

    if(iconTypeArrSize.length == 0) {
        document.getElementById("opt_aioa_icon_type_0").checked = true;
    }

    if(iconSizeArrSize.length == 0) {
        document.getElementById("opt_aioa_icon_size_1").checked = true;
    }

    if(aioa_license_key_val.length >= 18){

        var IconType = document.getElementById('ctrl_aioa_icon_type');
        var IconSize = document.getElementById('ctrl_aioa_icon_size');
        var Msg = document.getElementById('license_key_msg');
        var selectedValue = document.querySelector('input[name="aioa_icon_type"]:checked').value;

        IconType.classList.remove('d-none');
        IconSize.classList.remove('d-none');
        Msg.classList.add('d-none');

        const arrSize = document.querySelectorAll(".icon-img");
        arrSize.forEach(function(item){
            item.setAttribute("src","https://skynettechnologies.com/sites/default/files/python/"+selectedValue+".svg");
        });
    }else{

        var IconType = document.getElementById('ctrl_aioa_icon_type');
        var IconSize = document.getElementById('ctrl_aioa_icon_size');
        var Msg = document.getElementById('license_key_msg');

        IconType.classList.add('d-none');
        IconSize.classList.add('d-none');
        Msg.classList.remove('d-none');
    }


});

function GetValue(val){
    if(val.length >= 18){
        var elementIconType = document.getElementById('ctrl_aioa_icon_type');
        var elementIconSize = document.getElementById('ctrl_aioa_icon_size');
        var elementMsg = document.getElementById('license_key_msg');

        elementIconType.classList.remove('d-none');
        elementIconSize.classList.remove('d-none');
        elementMsg.classList.add('d-none');
    }else{
        var elementIconType = document.getElementById('ctrl_aioa_icon_type');
        var elementIconSize = document.getElementById('ctrl_aioa_icon_size');
        var elementMsg = document.getElementById('license_key_msg');

        elementIconType.classList.add('d-none');
        elementIconSize.classList.add('d-none');
        elementMsg.classList.remove('d-none');
        }
}

function ChangeIcon(val){
    const arrSize = document.querySelectorAll(".icon-img");
    arrSize.forEach(function(item){
        item.setAttribute("src","https://skynettechnologies.com/sites/default/files/python/"+val+".svg");
    });
}



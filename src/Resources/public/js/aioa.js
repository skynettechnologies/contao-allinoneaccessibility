/* default form setting set when load the form */
window.addEventListener("DOMContentLoaded", function() {
    let aioa_license_key = document.querySelector('[name="aioa_license_key"]');
    let aioa_icontype = document.querySelector( 'input[name="aioa_icon_type"]:checked');
    let iconColor = document.getElementsByName("aioa_color")[0].value;
    var validKeyMsg = document.getElementById('invalid-key-msg');
     
    if(document.querySelector('[name="aioa_license_key"]').value == ''){
        validKeyMsg.classList.remove('d-none');
    }else{
        validKeyMsg.classList.remove('d-none');
    }

    if(iconColor == ''){
        document.getElementsByName("aioa_color")[0].value = '600b96';
    }

    if(aioa_license_key != null){
        checkLicenseKey(aioa_license_key.value);
    }

    if(aioa_icontype != null){
        if(aioa_icontype.value != ''){
            ChangeIcon(aioa_icontype.value)
        }
    }

});

/* set icon-size img url as per change icon type */
function ChangeIcon(val){
    console.log(val);
    const arrSize = document.querySelectorAll(".icon-img");
    arrSize.forEach(function(item){
        item.setAttribute("src","https://skynettechnologies.com/sites/default/files/python/"+val+".svg");
    });
    saveData();
}

/* add Div for Loder*/
let add_element = () => {
    const template = document.createElement('div');
    template.innerHTML = "Loading data …";
    template. setAttribute("id", "tl_CusLoaderBox");
    template.style.display = 'none';
    template.style.top = '900px';
    document.body.appendChild(template);

    const bgtemplate = document.createElement('div');
    bgtemplate. setAttribute("id", "tl_CusLoaderOverlay");
    bgtemplate.style.display = 'none';
    bgtemplate.style.top = '800px';
    document.body.appendChild(bgtemplate);
}

/* here check the key valid or not */
function checkLicenseKey(key){
    
    add_element();

    var server_name = window.location.hostname;
    var request = new XMLHttpRequest();
    var url =  'https://www.skynettechnologies.com/add-ons/license-api.php?';
    var params = "token=" + key +"&server_name=" + server_name;

    request.open('POST', url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        document.getElementById("tl_CusLoaderBox").style.display = "none";
        document.getElementById("tl_CusLoaderOverlay").style.display = "none";
        if (request.readyState === XMLHttpRequest.DONE) {
          if (request.status === 200) {

            saveData();
            var response = JSON.parse(request.response);
            var elementMsg = document.getElementById('license_key_msg');
            var elementvalidKeyMsg = document.getElementById('invalid-key-msg');
            var elements = document.querySelectorAll('.common-class');

            if (response.valid == 1) {
                
                const iconTypeArrSize = document.querySelectorAll('input[name="aioa_icon_type"]:checked');
                const iconSizeArrSize = document.querySelectorAll('input[name="aioa_icon_size"]:checked');
                

                if(iconTypeArrSize.length == 0) {
                    if(document.getElementById("opt_aioa_icon_type_0") != null){
                        document.getElementById("opt_aioa_icon_type_0").checked = true;
                    }
                }

                if(iconSizeArrSize.length == 0) {
                    if(document.getElementById("opt_aioa_icon_type_0") != null){
                        document.getElementById("opt_aioa_icon_size_1").checked = true;
                    }
                }
                elementMsg.classList.add('d-none');
                elementvalidKeyMsg.classList.add('d-none');

                elements.forEach(el => {
                    el.style.display = 'block';
                });
            }else{
                if(document.querySelector('[name="aioa_license_key"]').value == ''){
                    elementvalidKeyMsg.classList.add('d-none');
                }else{
                    elementvalidKeyMsg.classList.remove('d-none');
                }

                elementMsg.classList.remove('d-none');
                elements.forEach(el => {
                    el.style.display = 'none';
                });
            }
          }
        }
      };
      document.getElementById("tl_CusLoaderBox").style.display = "block";
      document.getElementById("tl_CusLoaderOverlay").style.display = "block";
      request.send(params);
}

 
/* Save the setting data in Dashboard */
function saveData(){
    
    var server_name = window.location.origin;
    var color = document.getElementsByName("aioa_color")[0].value;
    var position = document.getElementById("ctrl_aioa_position").value;
    var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked').value;
    var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked').value;
    
    var request = new XMLHttpRequest();
    var url =  'https://ada.skynettechnologies.us/api/widget-setting-update-platform';
    var params = "u=" + server_name +"&widget_position=" + position +"&widget_color_code=" + color +"&widget_icon_type=" + icon_type +"&widget_icon_size="+ icon_size;
   
    request.open('POST', url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {

        if (request.readyState === XMLHttpRequest.DONE) {
          if (request.status === 200) {
           
            }
        }
      };
      request.send(params);
}




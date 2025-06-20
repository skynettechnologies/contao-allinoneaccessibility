
// Get the fieldset container

document.addEventListener('DOMContentLoaded', function() {
    // Get the fieldset container
    const fieldset = document.getElementById('ctrl_aioa_icon_type');
    
    // Get all the inputs and labels inside the fieldset
    const inputs = fieldset.querySelectorAll('input');
    const labels = fieldset.querySelectorAll('label');
    
    // Loop through each input and its associated label
    inputs.forEach((input, index) => {
        // Create a new div container for each input and label
        const wrapper = document.createElement('div');
        wrapper.classList.add('aioa-single-radio');
    
        // Move the input and label into the new wrapper
        wrapper.appendChild(input);
        wrapper.appendChild(labels[index]);
    
        // Append the wrapper back into the fieldset
        fieldset.appendChild(wrapper);
    });
    
    // Remove the original line breaks to prevent extra spacing
    fieldset.querySelectorAll('br').forEach(br => br.remove());
    
    
    
    // Select all elements with the 'custom-position-field' class
const positionFields = document.querySelectorAll('.custom-position-field');

// Create a new wrapper div
const wrapper = document.createElement('div');
wrapper.classList.add('aioa-icon-position-wrapper'); // Add a class to the wrapper if needed

// Loop through each element and append it to the wrapper
positionFields.forEach(field => {
  wrapper.appendChild(field);
});

// Select the .position-field element inside #sub_aioa_enable
const positionField = document.querySelector('#sub_aioa_enable .position-field');

// Insert the wrapper after the .position-field element
if (positionField) {
  positionField.parentNode.insertBefore(wrapper, positionField.nextSibling);
}
});

window.addEventListener("DOMContentLoaded", function() {
    let aioa_icontype = document.querySelector('input[name="aioa_icon_type"]:checked');
    let iconColor = document.getElementsByName("aioa_color")[0].value;
    
    if (iconColor == '') {
        document.getElementsByName("aioa_color")[0].value = '600b96';
    }

    if (aioa_icontype != null) {
        if (aioa_icontype.value != '') {
            ChangeIcon(aioa_icontype.value);
        }
    }

    // Show all elements that were previously hidden due to license check
    var elements = document.querySelectorAll('.common-class');
    elements.forEach(el => {
        el.style.display = 'block';
    });
});



// fetch data from ADA dashboard 

document.addEventListener("DOMContentLoaded", function () {
    fetchApiResponse("contaodemo.skynettechnologies.us");
});

function fetchApiResponse(domain_name) {
    const apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";

    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ website_url: domain_name })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then((result) => {
        console.log("Full API Response:", result); // Log full response
  
        if (result && result.Data && "widget_size" in result.Data) {
            let widgetSize = String(result.Data.widget_size).trim(); // Convert to string and remove spaces
            
            console.log("Extracted widget_size:", widgetSize); // Log extracted value
            
            updateWidgetSize(widgetSize);
        } else {
            console.error("Invalid API response: widget_size not found.");
        }
    })
    .catch(error => {
        console.error("Error fetching API:", error);
    });
}

//Function to update the widget size field based on API response
function updateWidgetSize(value) {
    

    const widgetSizeField = document.querySelector("input[name='aioa_widget_size'][value='Oversize']");
    const regularSizeField = document.querySelector("input[name='aioa_widget_size'][value='Regular Size']");

    if (!widgetSizeField || !regularSizeField) {
        console.error("Radio buttons not found!");
        return;
    }

    if (value === "1") {
        widgetSizeField.checked = true; // Set to "Oversize"
    } else {
        regularSizeField.checked = true; // Set to "Regular Size"
    }
}

// fetch data

// hide show position and icon 
document.addEventListener("DOMContentLoaded", function () {
    function toggleFields() {
        var checkbox = document.getElementById("opt_aioa_position_enable_0");
        var positionField = document.querySelector(".position-field");
        var customPositionFields = document.querySelectorAll(".custom-position-field");

        if (checkbox && checkbox.checked) {
           positionField.style.display = "none"; // Hide position field
            customPositionFields.forEach(field => field.style.display = "block"); // Show all custom position fields
            
        } else {
            positionField.style.display = "block"; // Show position field
            customPositionFields.forEach(field => field.style.display = "none"); // Hide all custom position fields
        }
    }

    // Get checkbox and add event listener
    var checkbox = document.getElementById("opt_aioa_position_enable_0");
    if (checkbox) {
        checkbox.addEventListener("change", toggleFields);
        toggleFields(); // Run on page load
    }
    
 
    
  });    
  document.addEventListener("DOMContentLoaded", function () {
     function icontoggleFields() {
        var iconcheckbox = document.getElementById("opt_aioa_customsize_enable_0");
        var iconsizeField = document.querySelector(".custom-icon-size");
        var customsizeFields = document.querySelectorAll(".custom-size-field");

        if (iconcheckbox && iconcheckbox.checked) {
           iconsizeField.style.display = "none"; // Hide position field
            customsizeFields.forEach(field => field.style.display = "block"); // Show all custom position fields
            
        } else {
            iconsizeField.style.display = "block"; // Show position field
            customsizeFields.forEach(field => field.style.display = "none"); // Hide all custom position fields
        }
    }

    // Get checkbox and add event listener
    var iconcheckbox = document.getElementById("opt_aioa_customsize_enable_0");
    if (iconcheckbox) {
        iconcheckbox.addEventListener("change", icontoggleFields);
        icontoggleFields(); // Run on page load
    }
});
function ChangeIcon(val) {
    console.log(val);
    const arrSize = document.querySelectorAll(".icon-img");
    arrSize.forEach(function(item) {
        item.setAttribute("src", "bundles/skynettechnologiescontaoallinoneaccessibility/icons/" + val + ".svg");
    });
    saveData();
}

/* Add Loader Div */
let add_element = () => {
    const template = document.createElement('div');
    template.innerHTML = "Loading data …";
    template.setAttribute("id", "tl_CusLoaderBox");
    template.style.display = 'none';
    document.body.appendChild(template);

    const bgtemplate = document.createElement('div');
    bgtemplate.setAttribute("id", "tl_CusLoaderOverlay");
    bgtemplate.style.display = 'none';
    document.body.appendChild(bgtemplate);
};

 
    
function saveData() {
    var server_name = window.location.hostname;
    var color = document.getElementsByName("aioa_color")[0]?.value || "";
    var position = document.getElementById("ctrl_aioa_position")?.value || "";

    // Ensure widget position is updated before sending the request
    const customPositionX = document.getElementById("ctrl_aioa_custom_position_lr")?.value || 0; // X position value
    const customPositionY = document.getElementById("ctrl_aioa_custom_position_bt")?.value || 0; // Y position value
    const xPositionDirection = document.getElementById("ctrl_aioa_custom_position_rl")?.value; // Left/Right select
    const yPositionDirection = document.getElementById("ctrl_aioa_custom_position_tb")?.value; // Top/Bottom select

    let widget_position_right = null;
    let widget_position_left = null;
    let widget_position_top = null;
    let widget_position_bottom = null;

    if (xPositionDirection === "To the right") {
        widget_position_right = customPositionX;
    } else if (xPositionDirection === "To the left") {
        widget_position_left = customPositionX;
    }

    if (yPositionDirection === "To the top") {
        widget_position_top = customPositionY;
    } else if (yPositionDirection === "To the bottom") {
        widget_position_bottom = customPositionY;
    }


    var is_widget_custom_position = document.getElementById("opt_aioa_position_enable_0").checked ? 1 : 0;
   var is_widget_custom_size = document.getElementById("opt_aioa_customsize_enable_0").checked ? 1 : 0;
    //  var widget_icon_size_custom = document.getElementById("ctrl_aioa_custom_size")?.value || "";
       var widget_icon_size_custom = document.querySelector('.custom-size-field input')?.value || "";
  
  
   
    var icon_type = document.querySelector('input[name="aioa_icon_type"]:checked')?.value || "";
    var icon_size = document.querySelector('input[name="aioa_icon_size"]:checked')?.value || "";
    var selectedValue = document.querySelector("input[name='aioa_widget_size']:checked")?.value;
        var aioa_widget_size = (selectedValue === "Oversize") ? 1 : 0;
       
    var request = new XMLHttpRequest();
    var url = 'https://ada.skynettechnologies.us/api/widget-setting-update-platform';
    
   
    var params = `u=${server_name}&widget_position=${position}&widget_color_code=${color}&widget_icon_type=${icon_type}&widget_icon_size=${icon_size}&widget_position_right=${widget_position_right}&widget_position_left=${widget_position_left}&widget_position_top=${widget_position_top}&widget_position_bottom=${widget_position_bottom}&is_widget_custom_position=${is_widget_custom_position}&is_widget_custom_size=${is_widget_custom_size}&widget_size=${aioa_widget_size}&widget_icon_size_custom=${widget_icon_size_custom}`;

    request.open('POST', url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            console.log("Settings updated successfully.");
        }
    };

    request.send(params);
}

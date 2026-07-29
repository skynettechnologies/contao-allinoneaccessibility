(function () {



    var domain = window.location.origin;

    var domain_base64 = btoa(domain);



    var apiUrl = "https://ada.skynettechnologies.us/api/widget-settings";



    var postData = new URLSearchParams();

    postData.append("website_url", domain);



    fetch(apiUrl, {

        method: "POST",

        body: postData

    })

    .then(function (response) {

        return response.json();

    })

    .then(function (apiResponse) {



        console.log("ADA Full API Response:", apiResponse);



        var no_required_eu = "1";



        if (apiResponse.website_data && apiResponse.website_data.no_required_eu) {

            no_required_eu = apiResponse.website_data.no_required_eu;

        }



        console.log("ADA no_required_eu:", no_required_eu);



        setTimeout(function () {



            if (document.getElementById("aioa-adawidget")) {

                return;

            }



            const scriptEle = document.createElement("script");

            scriptEle.id = "aioa-adawidget";

            scriptEle.async = true;



          

            if (no_required_eu === "0") {



                // EU SCRIPT

                scriptEle.src =

                    "https://eu.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js" +

                    "?colorcode=%23420083" +

                    "&token=ADAAIOA-17D072C78FFE5F0A7121B2401AAD261A" +

                    "&position=bottom_right";



            } else {



                // NON-EU SCRIPT

                const licensekey = ""; // replace

                const color = "#420083";

                const position = "bottom_right";

                const icon_type = "aioa-icon-type-1";

                const icon_size = "aioa-medium-icon";



                scriptEle.src =

                    "https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js" +

                    `?colorcode=${encodeURIComponent(color)}` +

                    `&token=${licensekey}` +

                    `&position=${position}.${icon_type}.${icon_size}`;

            }



            document.body.appendChild(scriptEle);



        }, 3000);



    })

    .catch(function (error) {

        console.error("API Error:", error);

    });



})();
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

            // ✅ FIXED CONDITION
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
 
 
//  const SESSION_KEY = "visitor_data";

// function getVisitorData() {
//   const storedData = sessionStorage.getItem(SESSION_KEY);

//   if (storedData) {
//     console.log("[AIOA] Visitor data fetched from SESSION:", JSON.parse(storedData));
//     return Promise.resolve(JSON.parse(storedData));
//   }

//   console.log("[AIOA] Visitor data NOT found in session. Calling ipapi.");

//   return fetch("https://ipapi.co/json/")
//     .then(res => {
//       console.log("[AIOA] ipapi raw response:", res);
//       return res.json();
//     })
//     .then(data => {
//       console.log("[AIOA] ipapi JSON response:", data);

//       const visitorData = {
//         country_code: data.country_code || "Unknown",
//         in_eu: data.in_eu || false
//       };

//       console.log("[AIOA] Parsed visitor data:", visitorData);

//       sessionStorage.setItem(SESSION_KEY, JSON.stringify(visitorData));
//       return visitorData;
//     })
//     .catch(err => {
//       console.error("[AIOA] ipapi error:", err);

//       const fallbackData = {
//         country_code: "Unknown",
//         in_eu: false
//       };

//       sessionStorage.setItem(SESSION_KEY, JSON.stringify(fallbackData));
//       return fallbackData;
//     });
// }

//       getVisitorData().then(visitorData => {

//         const countryCode = visitorData.country_code || "Unknown";
//         const inEU = visitorData.in_eu || false;

//         // Same as PHP logic
//         const is_eu = inEU ? 0 : 1;

//         console.log("[AIOA] Country:", countryCode);
//         console.log("[AIOA] in_eu:", inEU);
//         console.log("[AIOA] is_eu:", is_eu);

//         /* -------------------------------------------
//            LOAD SCRIPT BASED ON EU STATUS
//         ----------------------------------------------*/
//         setTimeout(function () {

//           if (document.getElementById("aioa-adawidget")) {
//             return;
//           }

//           const scriptEle = document.createElement("script");
//           scriptEle.id = "aioa-adawidget";
//           scriptEle.async = true;

//           if (inEU) {
//             // EU SCRIPT
//             scriptEle.src =
//               "https://skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js" +
//               "?colorcode=%23420083" +
//               "&token=ADAAIOA-17D072C78FFE5F0A7121B2401AAD261A" +
//               "&position=bottom_right";
//           } else {
//             // NON-EU SCRIPT
//             const licensekey = ""; // replace
//             const color = "#420083";
//             const position = "bottom_right";
//             const icon_type = "aioa-icon-type-1";
//             const icon_size = "aioa-medium-icon";

//             scriptEle.src =
//               "https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js" +
//               `?colorcode=${encodeURIComponent(color)}` +
//               `&token=${licensekey}` +
//               `&position=${position}.${icon_type}.${icon_size}`;
//           }

//           document.body.appendChild(scriptEle);

//         }, 3000); // Same delay behavior

//       });
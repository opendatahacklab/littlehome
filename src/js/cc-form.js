/**
 * This was written by CC as a demonstration of how to interoperate
 * with the Creative Commons JsWidget.  No rights reserved.
 *
 * See README for a little more detail.
 */
document.addEventListener("DOMContentLoaded", function() {
  var licenseUriSrc = document.getElementById("cc_js_result_uri");
  var licenseNameSrc = document.getElementById("cc_js_result_name");
  var licenseImgSrc = document.getElementById("cc_js_result_img");

  var jsWidgetContainer = document.getElementById("cc_js_widget_container");

  var licenseUriDest = document.getElementById("licenseUriDest");
  var licenseNameDest = document.getElementById("licenseNameDest");
  var licenseImgDest = document.getElementById("licenseImgDest");

  jsWidgetContainer.addEventListener("change", updateValues);

  /**
   * Updates the values of license details list when a new license is selected.
   */
  function updateValues() {
    licenseUriDest.value = licenseUriSrc.value;
    licenseNameDest.value = licenseNameSrc.value;
    licenseImgDest.value = licenseImgSrc.value;
  }
});

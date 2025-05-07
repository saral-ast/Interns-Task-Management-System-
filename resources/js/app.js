import "./bootstrap";
import jQuery from "jquery";
import "jquery-validation";

// Make jQuery available globally immediately
global.jQuery = jQuery;
global.$ = jQuery;
window.jQuery = jQuery;
window.$ = jQuery;

// Initialize jQuery Validation plugin
if (typeof jQuery.validator === "undefined") {
    console.error("jQuery Validation plugin is not loaded!");
} else {
    console.log("jQuery Validation plugin is loaded successfully");
}

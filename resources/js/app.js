require("admin-lte");
import "sweetalert2/src/sweetalert2.scss";
import "bootstrap-icons/font/bootstrap-icons.css";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic/build/ckeditor";

window.Noty = require("noty");

window.Swal = require("sweetalert2");

window.moment = require("moment");

window.showNotification = function (text, type, timeout) {
    var noty = new Noty({
        theme: "nest",
        text: text,
        timeout: timeout,
        type: type,
    });
    noty.show();
    return noty;
};

var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
};

ready(() => {
    ClassicEditor.create(document.querySelector(".wysiwyg")).catch((error) => {
        console.log(`error`, error);
    });
});

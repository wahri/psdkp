require("admin-lte");
import "sweetalert2/src/sweetalert2.scss";

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

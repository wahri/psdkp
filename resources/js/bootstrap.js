window._ = require("lodash");

try {
    require("bootstrap");
    require("admin-lte");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

window.Noty = require("noty");

function showErrorMessage(error) {
    showNoty(error, "error", 3000);
}

function showSuccessMessage(message) {
    showNoty(message, "success", 3000);
}

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

window.registerSelect2 = function (
    elmt,
    tag,
    clear,
    postUrl,
    key,
    additionalData,
    value,
    placeholder
) {
    elmt.select2({
        allowClear: clear,
        tags: tag,
        createTag: function createTag(params) {
            var term = $.trim(params.term);

            if (term === "") {
                return null;
            }

            return {
                id: "new-" + term,
                text: term,
                newTag: true, // add additional parameters
            };
        },
        placeholder: placeholder ? placeholder : "",
        ajax: {
            url: postUrl,
            dataType: "json",
            delay: 250,
            data: function data(params) {
                var newParam;

                if (additionalData) {
                    if (typeof additionalData === "function")
                        newParam = additionalData();
                    else newParam = additionalData;
                } else newParam = {};

                newParam.q = params.term;
                newParam.page = params.page;
                return newParam;
            },
            processResults: function processResults(response, params) {
                return {
                    results: response.data.data.map(function (item) {
                        return {
                            id: item.id,
                            text: item[key],
                        };
                    }),
                    pagination: {
                        more: null != response.data.next_page_url,
                    },
                };
            },
            cache: true,
        },
    });

    if (!elmt.prop("multiple")) {
        elmt.data("querying", true);
        elmt.data("select2").dropdown.$search.on("keydown", function (e) {
            if (
                elmt.data("select2").selection.container.isOpen() &&
                e.which === 13 &&
                elmt.data("querying")
            ) {
                elmt.data("pendingSelect", true);
                e.preventDefault();
                e.stopImmediatePropagation();
            }
        });
        elmt.data("select2").selection.container.on("query", function (e) {
            elmt.data("querying", true);
        });
        elmt.data("select2").selection.container.on(
            "results:all",
            function (e) {
                elmt.data("querying", false);

                if (elmt.data("pendingSelect")) {
                    elmt.data("select2").selection.container.trigger(
                        "results:select",
                        {}
                    );
                }

                elmt.data("pendingSelect", false);
            }
        );
        elmt.data("select2").selection.container.on(
            "results:message",
            function (e) {
                elmt.data("pendingSelect", false);
            }
        );

        var evts = $._data(elmt.data("select2").dropdown.$search[0], "events")[
            "keydown"
        ];

        evts.unshift(evts.pop());
    }

    if (value) {
        if (Array.isArray(value)) {
            value.forEach(function (data) {
                appendSelectOption(elmt, data.id, data[key]);
            });
        } else {
            appendSelectOption(elmt, value.id, value[key]);
        }
    }
};

function appendSelectOption(selector, id, name, additionalData) {
    var newParam;

    if (additionalData) {
        if (typeof additionalData === "function") newParam = additionalData();
        else newParam = additionalData;
    } else newParam = {};

    newParam.id = id;
    newParam.text = name;
    var option = new Option(name, id, true, true);
    selector.append(option).trigger("change");
    selector.trigger({
        type: "select2:select",
        params: {
            data: newParam,
        },
    });
}

window.appendSelectOption = appendSelectOption;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

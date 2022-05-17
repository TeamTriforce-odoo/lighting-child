var orgWpcf7cScroll = wpcf7c_scroll;
wpcf7c_scroll = function(unit_tag) {
};

!function ($) {
    var spinner;
    var forms = $(".wpcf7-form");
    forms.each(function () {
        var form = this;
        var buttons = {
            "submit": $(".wpcf7-submit"),
            "back": $(".wpcf7-back"),
            "confirm": $(".wpcf7-confirm")
        };
        $(form).on("submit", function () {
            for (var i in buttons) {
                buttons[i].prop("disabled", true);
            }
            onLoading(form);
        });
        var onLoading = function (form) {
            $(form).animate({ opacity: 0 }, 100);
            if (spinner) {
                spinner.show();
            }
        }
        var offLoading = function (form) {
            if (spinner) {
                spinner.hide();
            }
            $(form).animate({ opacity: 100 }, 500);
        }

        var setWindowTop = function (top) {
            $("html,body").animate({ scrollTop: top }, 0);
        }

        buttons.back.on("click", function () {
            onLoading(form);
            setTimeout(function () {
                offLoading(form);
                if(forms.hasClass("custom-wpcf7c-confirmed")){
                    forms.removeClass("custom-wpcf7c-confirmed");
                }
                setWindowTop($('.contents').offset().top);
            }, 200);
        });
        // ajax通信後の処理
        document.addEventListener("wpcf7submit", function (evt) {
            var ancestors = $(form).parents();
            var found = $(form)[0] === evt.target;
			if (!found) {
                for (var i in ancestors) {
                    if (evt.target === ancestors[i]) {
                        found = true;
                    }
                }
			}
            if (!found) {
                return;
            }
            switch (evt.detail.status) {
                case "mail_sent":
                    break;

                case "wpcf7c_confirmed":

                default:
                    setTimeout(function () {
                        for (var i in buttons) {
                            buttons[i].prop("disabled", false);
                        }
                    }, 1000);

                    offLoading(form);
                    //setWindowTop($('.contents').offset().top);
                    break;
            }
        });
        var getFormatTextareaValue = function (strValue) {
            return strValue.replace(/\r\n/g, '<br/>').replace(/\n/g, '<br/>').replace(/\s/g, '&nbsp;');
        }
        var escapeHtml = function (string) {
            if (typeof string !== 'string') {
                return string;
            }
            return string.replace(/[&'`"<>]/g, function (match) {
                return {
                    '&': '&amp;',
                    "'": '&#x27;',
                    '`': '&#x60;',
                    '"': '&quot;',
                    '<': '&lt;',
                    '>': '&gt;',
                }[match]
            });
        }
    });
}(jQuery);

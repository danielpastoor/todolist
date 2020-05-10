var acc = document.getElementsByClassName("accordion");
var i;

var firstAccordion = acc[0];
var firstPanel = firstAccordion.nextElementSibling;
firstAccordion.classList.add("active");
firstPanel.style.maxHeight = firstPanel.scrollHeight + "px";

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function () {
        var isActive = this.classList.contains("active");

        var allAccordions = document.getElementsByClassName("accordion");
        for (j = 0; j < allAccordions.length; j++) {
            var panel = allAccordions[j].nextElementSibling;
            var maxHeightValue = getStyle(panel, "maxHeight");
        }

        isActive ? this.classList.remove("active") : this.classList.add("active");

        var panel = this.nextElementSibling;
        var maxHeightValue = getStyle(panel, "maxHeight");

        if (maxHeightValue !== "0px") {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    };
}

function getStyle(el, styleProp) {
    var value, defaultView = (el.ownerDocument || document).defaultView;
    if (defaultView && defaultView.getComputedStyle) {
        styleProp = styleProp.replace(/([A-Z])/g, "-$1").toLowerCase();
        return defaultView.getComputedStyle(el, null).getPropertyValue(styleProp);
    } else if (el.currentStyle) {
        styleProp = styleProp.replace(/\-(\w)/g, function (str, letter) {
            return letter.toUpperCase();
        });
        value = el.currentStyle[styleProp];
        if (/^\d+(em|pt|%|ex)?$/i.test(value)) {
            return (function (value) {
                var oldLeft = el.style.left,
                    oldRsLeft = el.runtimeStyle.left;
                el.runtimeStyle.left = el.currentStyle.left;
                el.style.left = value || 0;
                value = el.style.pixelLeft + "px";
                el.style.left = oldLeft;
                el.runtimeStyle.left = oldRsLeft;
                return value;
            })(value);
        }
        return value;
    }
}
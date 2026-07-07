document.addEventListener("DOMContentLoaded", function() {

    var langSwitcher = document.querySelector(".language-switcher select");
    if (!langSwitcher) return;

    if ( !langSwitcher.classList.contains("clpl-wrapped")) {

        var wrapper = document.createElement("span");
        wrapper.className = "clpl-lang-wrap";

        langSwitcher.parentNode.insertBefore(wrapper, langSwitcher);
        wrapper.appendChild(langSwitcher);

        langSwitcher.classList.add("clpl-wrapped");
    }

});
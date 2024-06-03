$(document).ready(function() {
    var themeToggleDarkIcon = $("#theme-toggle-dark-icon");
    var themeToggleLightIcon = $("#theme-toggle-light-icon");
    var themeToggleDeviceIcon = $("#theme-toggle-device-icon");

    // function updateThemeIcons(theme) {
    //     if (theme === "dark") {
    //         themeToggleDarkIcon.addClass("hidden");
    //         themeToggleLightIcon.removeClass("hidden");
    //     } else {
    //         themeToggleDarkIcon.removeClass("hidden");
    //         themeToggleLightIcon.addClass("hidden");
    //     }
    // }



    // Applying theme
    function applyTheme(theme) {
        if (theme === "dark") {
            $("html").addClass("dark");
        } else {
            $("html").removeClass("dark");
        }
    }

    var storedTheme = localStorage.getItem("theme");
    var theme;

    if (storedTheme === "light" || storedTheme === "dark") {
        theme = storedTheme;
    } else {
        theme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        localStorage.setItem("theme", "device");
    }

    applyTheme(theme);

    // Dark button click
    themeToggleDarkIcon.on("click", function() {
        theme = "dark" ;
        localStorage.setItem("theme", theme);
        applyTheme(theme);
    });

    // Dark button click
    themeToggleLightIcon.on("click", function() {
        theme =  "light";
        localStorage.setItem("theme", theme);
        applyTheme(theme);
    });

    // Device button click
    themeToggleDeviceIcon.on("click", function() {
        var prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;
        theme = prefersDarkScheme ? "dark" : "light";
        localStorage.setItem("theme", "device");
        applyTheme(theme);
    });


    // Device preference logic
    window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", function(e) {
        if (localStorage.getItem("theme") === "device") {
            theme = e.matches ? "dark" : "light";
            applyTheme(theme);
        }
    });
});

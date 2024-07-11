function show_hide_password(containerId) {
    var passwordInput = document.querySelector("#" + containerId + " input");
    var icon = document.querySelector("#" + containerId + " i");

    if (passwordInput.type === "text") {
        passwordInput.type = "password";
        icon.classList.remove("bx-show");
        icon.classList.add("bx-hide");
    } else if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bx-hide");
        icon.classList.add("bx-show");
    }
}

function emailChangeListner(initialValue) {
    const input = event.target;

    const send_otp_btn = document.getElementById("send_otp_btn");
    const submit_btn = document.getElementById("submit_btn");

    if (input.value === initialValue) {
        send_otp_btn.classList.add("d-none");
        submit_btn.classList.remove("d-none");
    } else {
        submit_btn.classList.add("d-none");
        send_otp_btn.classList.remove("d-none");
    }
}

var timerInterval;
const timerTime = 60;

function send_otp() {
    document.getElementById("otp").setAttribute("required", "true");
    document.getElementById("send_otp_btn").classList.add("d-none");
    document.getElementById("submit_btn").classList.remove("d-none");
    document.getElementById("timer").classList.remove("d-none");
    document
        .getElementById("email_id_validate")
        .setAttribute("readonly", "readonly");
    document.getElementById("otp_admin").classList.remove("d-none");
    startTimer(timerTime, document.getElementById("timer"));
    document.getElementById("timer").textContent =
        "Time remaining: " + timerTime + " seconds";
}

function startTimer(duration, display) {
    var timer = duration;
    timerInterval = setInterval(function () {
        display.textContent = "Time remaining: " + timer + " seconds";

        if (--timer < 0) {
            clearInterval(timerInterval);
            document.getElementById("submit_btn").classList.add("d-none");
            document.getElementById("otp_admin").classList.add("d-none");
            document.getElementById("send_otp_btn").classList.remove("d-none");
            document
                .getElementById("email_id_validate")
                .removeAttribute("readonly");
            display.classList.add("d-none");
        }
    }, 1000);
}

function resendOTP() {
    clearInterval(timerInterval);
    document.getElementById("send_otp_btn").classList.add("d-none");
    startTimer(timerTime, document.getElementById("timer"));
}

function noDataMessage() {
    if (document.getElementById("thead-html")) {
        var theadHtml = document.getElementById("thead-html");
        var noData = document.getElementById("no-data");
        var thElements = theadHtml.getElementsByTagName("th");
        var totalCount = thElements.length;
        noData.setAttribute("colspan", totalCount);
    }
}

noDataMessage();

// create ajax page load functionality

function changeURLAndLoadPage(pageName) {
    window.history.pushState({}, "", pageName);
    loadPageContent(pageName);
}

function loadPageContent(pageName) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("content").innerHTML = xhr.responseText;
            } else {
                console.error("Failed to load page content");
            }
        }
    };
    xhr.open("GET", pageName, true);
    xhr.send();
}

function loadPageFromURL() {
    var currentPage = window.location.pathname.split("/").pop();
    if (currentPage !== "") {
        loadPageContent(currentPage);
    }
}

window.onpopstate = function () {
    loadPageFromURL();
};




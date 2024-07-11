function callAjax(url, data, callback, method = "POST") {
    const xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const responseText = xhr.responseText;
                callback(responseText);
            } else {
                alert(xhr.status);
            }
        }
    };
    xhr.send(data);
}

function print_response(url, data, responseId, method = "POST") {
    callAjax(
        url,
        data,
        function (responseText) {
            document.querySelector(responseId).innerHTML = responseText;
        },
        method
    );
}

function ajaxModal(url, data, modalType = "", method = "POST") {
    var original_content = event.currentTarget;
    var oldHtml = original_content.innerHTML;
    original_content.innerHTML =
        '<div class="spinner-border spinner-border-sm" role="status"></div>';
    original_content.classList.add("disabled", "true");
    callAjax(
        url,
        data,
        function (responseText) {
            $("#basicModal").modal("show");
            if (modalType) {
                document
                    .getElementById("ajaxModalClass")
                    .classList.add(modalType);
            }
            original_content.classList.remove("disabled");
            original_content.innerHTML = oldHtml;
            document.getElementById("ajax_response").innerHTML = responseText;
        },
        method
    );
}

function ajaxSend(url, data, responseId = "") {
    callAjax(url, data, function (responseText) {
        if (responseId) {
            const resId = document.querySelector(responseId);
            resId.innerHTML = responseText;
        }
    });
}

function sendObj(obj) {
    var formData = new FormData();
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            formData.append(key, obj[key]);
        }
    }
    return formData;
}

function getValueToForm(inputName) {
    const inputValue = document.querySelector(
        `input[name='${inputName}']`
    ).value;
    return inputValue;
}

function formToObj(formId, reset = false) {
    const formElement = document.getElementById(formId);
    const formData = new FormData(formElement);
    if (reset === true) {
        formElement.reset();
    }
    return formData;
}

function sendData(thisValue) {
    const name = thisValue.name;
    const value = thisValue.value;
    const formData = new FormData();
    formData.append(name, value);
    return formData;
}

// image validation
function imageValidate(element, maxWidth, maxHeight, sizeKb) {
    const file = element.files[0];
    const maxSizeInKbytes = sizeKb * 1024; // Maximum file size allowed (5MB)
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"]; // Allowed image types
    const fileType = file.type;
    if (!allowedTypes.includes(fileType)) {
        var nextSibling = element.nextElementSibling;
        nextSibling.textContent =
            "Allowed types are: " + allowedTypes.join(", ");
        element.value = "";
        return;
    }

    if (file.size > maxSizeInKbytes) {
        var nextSibling = element.nextElementSibling;
        nextSibling.textContent =
            "Image size exceeds the maximum limit of " +
            maxSizeInKbytes / 1024 +
            " Kbytes.";
        element.value = "";
        return;
    }

    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            const width = this.width;
            const height = this.height;
            if (width <= maxWidth && height <= maxHeight) {
                var nextSibling = element.nextElementSibling;
                nextSibling.textContent = "";
                return;
            } else {
                var nextSibling = element.nextElementSibling;
                nextSibling.textContent = `Image dimensions should not exceed ${maxWidth}x${maxHeight} pixels.`;
                element.value = "";
                return;
            }
        };
        img.src = event.target.result;
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}

function validateSquareImage(element, sizeKb) {
    const file = element.files[0];
    const maxSizeInKbytes = sizeKb * 1024; // Maximum file size allowed (5MB)
    const allowedTypes = ["image/jpeg", "image/png", "image/jpg"]; // Allowed image types
    const fileType = file.type;
    if (!allowedTypes.includes(fileType)) {
        var nextSibling = element.nextElementSibling;
        nextSibling.textContent =
            "Allowed types are: " + allowedTypes.join(", ");
        element.value = "";
        return;
    }

    if (file.size > maxSizeInKbytes) {
        var nextSibling = element.nextElementSibling;
        nextSibling.textContent =
            "Image size exceeds the maximum limit of " +
            maxSizeInKbytes / 1024 +
            " Kbytes.";
        element.value = "";
        return;
    }

    const reader = new FileReader();
    reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
            const width = this.width;
            const height = this.height;
            if (width === height) {
                var nextSibling = element.nextElementSibling;
                nextSibling.textContent = "";
                return;
            } else {
                var nextSibling = element.nextElementSibling;
                nextSibling.textContent = `Image dimensions must be square not ${width}x${height} pixels.`;
                element.value = "";
                return;
            }
        };
        img.src = event.target.result;
    };
    if (file) {
        reader.readAsDataURL(file);
    }
}


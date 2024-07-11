function copyVideoURL() {
    // Get the video element
    var videoElement = document.getElementById("videoToCopy");

    // Get the source URL of the video
    var videoURL = videoElement.src;

    // Copy the URL to the clipboard using the Clipboard API
    navigator.clipboard.writeText(videoURL).catch((err) => {
        console.error("Failed to copy: ", err);
    });
}
function copyVideoURLTd() {
    // Get the video element
    // console.log(item);
    var td = document.getElementById("videoToCopy");

    // Get the source URL of the video
    var td_url = td.textContent;

    // Copy the URL to the clipboard using the Clipboard API
    navigator.clipboard.writeText(td_url).catch((err) => {
        console.error("Failed to copy: ", err);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    var maxLength = 25;

    // book titles
    var titleElements = document.querySelectorAll("#book-title");
    titleElements.forEach(function (element) {
        if (element.innerText.length > maxLength) {
            element.innerText = element.innerText.substring(0, maxLength) + "...";
        }
    });

    // book authors
    var authorElements = document.querySelectorAll("#book-author");
    authorElements.forEach(function (element) {
        if (element.innerText.length > maxLength) {
            element.innerText = element.innerText.substring(0, maxLength) + "...";
        }
    });
});

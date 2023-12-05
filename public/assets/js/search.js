document.addEventListener("DOMContentLoaded", function () {
    var searchForm = document.getElementById("searchForm");
    var searchInput = document.getElementById("searchInput");
    var booksContainer = document.getElementById("booksContainer");

    searchForm.addEventListener("submit", function (event) {
        event.preventDefault();

        var searchTerm = searchInput.value.toLowerCase();

        Array.from(booksContainer.children).forEach(function (book) {
            var titleElement = book.querySelector(".book-title #book-title");
            var authorElement = book.querySelector(".book-title #book-author");

            if (!titleElement || !authorElement) {
                return;
            }

            var title = titleElement.innerText.toLowerCase();
            var author = authorElement.innerText.toLowerCase();

            var matchesTitle = title.includes(searchTerm) || title.charAt(0) === searchTerm || title.slice(-1) === searchTerm;
            var matchesAuthor = author.includes(searchTerm) || author.charAt(0) === searchTerm || author.slice(-1) === searchTerm;

            if (matchesTitle || matchesAuthor) {
                book.style.display = "block";
                titleElement.classList.add("highlight");
                authorElement.classList.add("highlight");
            } else {
                book.style.display = "none";
                titleElement.classList.remove("highlight");
                authorElement.classList.remove("highlight");
            }
        });
    });

    searchInput.addEventListener("input", function () {
        if (!searchInput.value.trim()) {
            Array.from(booksContainer.children).forEach(function (book) {
                book.style.display = "block";
                var titleElement = book.querySelector(".book-title #book-title");
                var authorElement = book.querySelector(".book-title #book-author");
                if (titleElement && authorElement) {
                    titleElement.classList.remove("highlight");
                    authorElement.classList.remove("highlight");
                }
            });
        }
    });
});

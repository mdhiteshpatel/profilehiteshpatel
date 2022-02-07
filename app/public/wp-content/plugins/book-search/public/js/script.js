$ = jQuery;

var mafs = $("#my-ajax-filter-search");
var mafsForm = mafs.find("form");

mafsForm.submit(function (e) {
    e.preventDefault();

    if (mafsForm.find("#search").val().length !== 0) {
        var search = mafsForm.find("#search").val();
    }
    if (mafsForm.find("#book_author").val().length !== 0) {
        var author = mafsForm.find("#book_author").val();
    }
    if (mafsForm.find("#book_publisher").val().length !== 0) {
        var publisher = mafsForm.find("#book_publisher").val();
    }
    if (mafsForm.find("#rating").val().length !== 0) {
        var rating = mafsForm.find("#rating").val();
    }
    if (mafsForm.find("#price").val().length !== 0) {
        var price = mafsForm.find("#price").val();
    }

    var data = {
        action: "my_ajax_filter_search",
        search: search,
        author: book_author,
        publisher: book_publisher,
        rating: rating,
        price: price
    }
    $.ajax({
        url: ajax_url,
        data: data,
        success: function (response) {
            mafs.find("ul").empty();
            if (response) {
                for (var i = 0; i < response.length; i++) {
                    var html = "<li id='book-" + response[i].id + "'>";
                    html += "  <a href='" + response[i].permalink + "' title='" + response[i].title + "'>";
                    html += "      <img src='" + response[i].poster + "' alt='" + response[i].title + "' />";
                    html += "      <div class='book-info'>";
                    html += "          <h4>" + response[i].title + "</h4>";
                    html += "          <p>Author: " + response[i].book_author + "</p>";
                    html += "          <p>Publisher: " + response[i].book_publisher + "</p>";
                    html += "          <p>Rating: " + response[i].rating + "</p>";

                    html += "          <p>Price: " + response[i].price + "</p>";

                    html += "      </div>";
                    html += "  </a>";
                    html += "</li>";
                    mafs.find("ul").append(html);
                }
            } else {
                var html = "<li class='no-result'>No matching movies found. Try a different filter or search keyword</li>";
                mafs.find("ul").append(html);
            }
        }
    });



    // we will add codes above this line later
});

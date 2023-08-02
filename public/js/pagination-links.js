jQuery(document).ready(function($) {
    console.log("ready!");

    $(document).on('click', '.paginate-button', function() {
        page = $(this).attr('data-page');
        get_books_data(parseInt(page));
    });

    function get_books_data(page = 1) {
        $.ajax({
            url: 'http://localhost/testsite/wp-json/wp/v2/book/',
            data: {
                per_page: 2,
                page: page,
            },
            success: function(result, textStatus, jqXHR) {
                total_pages = jqXHR.getResponseHeader('X-Wp-Totalpages');
                display_pagination_links(total_pages, page);
                $('.content').empty();
                console.log(result);
                result.forEach(function(item, index) {
                    $('.content').append($('<div class = "book-post"><h3>' + item.title.rendered + '</h3>' + item.content.rendered + '</div>'));
                })
            }
        });
    }
    get_books_data();



    function display_pagination_links(total_pages, page) {
        console.log(typeof(page));

        $('.pagination-container').empty();
        prev = page - 1;
        next = page + 1;


        if (page == 1) {
            $('.pagination-container').append($('<a data-page="' + page + '" class = "paginate-button active">' + page + '</a>'));
            $('.pagination-container').append($('<a data-page="' + next + '" class = "paginate-button">' + next + '</a>'));
            span_link();
            next_link(page);
            $('.pagination-container').append($('<a data-page ="' + total_pages + '" class="paginate-button">Last</a>'));
        } 
        else if (page == total_pages) {
            $('.pagination-container').append($('<a data-page = 1 class = "paginate-button">First</a>'));
            prev_link(page);
            span_link();
            $('.pagination-container').append($('<a data-page="' + prev + '" class = "paginate-button">' + prev + '</a>'));
            $('.pagination-container').append($('<a data-page="' + page + '" class = "paginate-button active">' + page + '</a>'));

        } 
        else if(page == 2){
            $('.pagination-container').append($('<a data-page = 1 class = "paginate-button">First</a>'));
            prev_link(page);
            prev_page_next_links(page);

            span_link();
            next_link(page);
            $('.pagination-container').append($('<a data-page ="' + total_pages + '" class="paginate-button">Last</a>'));
        }
        else if(page == total_pages - 1){
            $('.pagination-container').append($('<a data-page = 1 class = "paginate-button">First</a>'));
            prev_link(page);
            span_link();

            prev_page_next_links(page);

            next_link(page);
            $('.pagination-container').append($('<a data-page ="' + total_pages + '" class="paginate-button">Last</a>'));
        }
        else {
            $('.pagination-container').append($('<a data-page = 1 class = "paginate-button">First</a>'));
            prev_link(page);
            span_link();

            prev_page_next_links(page);

            span_link();
            next_link(page);
            $('.pagination-container').append($('<a data-page ="' + total_pages + '" class="paginate-button">Last</a>'));
        }
    }

    function prev_page_next_links(page){
        prev = page - 1;
        next = page + 1;

        $('.pagination-container').append($('<a data-page="' + prev + '" class = "paginate-button">' + prev + '</a>'));
        $('.pagination-container').append($('<a data-page="' + page + '" class = "paginate-button active">' + page + '</a>'));
        $('.pagination-container').append($('<a data-page="' + next + '" class = "paginate-button">' + next + '</a>'));
    }
    function prev_link(page){
        prev = page - 1;
        $('.pagination-container').append($('<a data-page="' + prev + '" class = "paginate-button">Previous</a>'));
    }
    function next_link(page){
        next = page + 1;
        $('.pagination-container').append($('<a data-page="' + next + '" class = "paginate-button">Next</a>'));
    }
    function span_link(){
        $('.pagination-container').append($('<span>...</span>'));
    }

});
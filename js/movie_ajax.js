$(document).ready(function (){
    
    // ########################################################################
    // ########################################################################
    // movie PAGE BUTTON CLICKS
    // ########################################################################
    // ########################################################################

    // To view all movies
    $('#view_all_movies').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/movie/movie_sql_results.php?mode=select');
    });

    // To select a single movie via movie_id from header file
    $('#find_movie').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/movie/movie_sql_results.php?mode=single_select&header_movie_id=');
    });

    // To add a single movie 
    $('#add_movie').on('click', function (event) {
        url_end = '?mode=insert';
        let inputmovieID = $('#input_movie_id').val();
        let inputmovieName = $('#input_movie_name').val();
        let inputmovieAwardID = $('#input_movie_award_id').val();

        executemovieSQL('POST','insert',inputmovieID,inputmovieName,inputmovieAwardID,url_end);
        movieClearAll();
    });

    // Delete movie
    $('#delete_movie').on('click', function(event) {
        let header_movie_id = $('#header_movie_id').val();
        let header_movie_award_id = $('#header_movie_award_id').val();

        window.open('/movie_project/movie_database_tables/movie/movie_sql_processor.php?mode=delete&header_movie_id='+header_movie_id
                    + '&header_movie_award_id='+header_movie_award_id);
        movieClearAll();
    });

    // Update movie
    $('#update_movie').on('click', function(event) {
        url_end = '?mode=update';
        let inputmovieID = $('#input_movie_id').val();
        let inputmovieName = $('#input_movie_name').val();
        let inputmovieAwardID = $('#input_movie_award_id').val();

        executemovieSQL('POST','update',inputmovieID,inputmovieName,inputmovieAwardID,url_end);
        movieClearAll();
    });
    
});

    // ########################################################################
    // movie PAGE BUTTON CLICKS
    function executemovieSQL(type, mode, movieID,movieName,movieAwardID,url_end) {
        $('#movie_form').on('submit', function (event) {
            // #######################################################################
            // VARIABLES FOR INSERTING INTO DATABASE
            event.stopImmediatePropagation();
    
            $.ajax({
                crossOrigin: true,
                url: '/movie_project/movie_database_tables/movie/movie_sql_processor.php'+url_end,
                type: type,
                dataType: 'JSON',
                async: false,
                data: {
                    movieID:movieID,
                    movieName: movieName,
                    movieAwardID: movieAwardID
                },
                success: function (response) {
                location.reload();
                }
            });
        });
    }

    function movieClearAll()
    {
        $('#input_movie_id').val('');
        $('#input_movie_name').val('');
        $('#input_movie_award_id').val('');
        $('#header_movie_id').val('');
        $('#header_movie_award_id').val('');
    }
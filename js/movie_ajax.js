$(document).ready(function (){
    
    // ########################################################################
    // ########################################################################
    // MOVIE PAGE BUTTON CLICKS
    // ########################################################################
    // ########################################################################

    // To view all movies
    $('#view_all_movies').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/movie/movie_sql_results.php?mode=select');
    });

    // To select a single movie via movie_id from header file
    $('#find_movie').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/movie/movie_sql_results.php?mode=single_select&header_movie_id='+$('#header_movie_id').val());
    });

    // Delete movie
    $('#delete_movie').on('click', function(event) {
        url_end = '?mode=delete'
        let header_movie_id = $('#header_movie_id').val();

        window.open('/movie_project/movie_database_tables/movie/movie_sql_processor.php'+
            url_end+'&header_movie_id='+header_movie_id);
    });

    // Update movie
    // Select by header id, input movie id is no
    $('#update_movie').on('click', function(event) {
        url_end = '?mode=update';
        let headerMovieID = $('#header_movie_id').val();
        let inputMovieTitle = $('#input_movie_title').val();
        let inputMovieDesc = $('#input_movie_desc').val();
        let inputGenreID = $('#input_movie_genre_id').val();
        let inputMovieReleaseDate = $('#input_movie_release_date').val();
        let inputMovieRating = $('#input_movie_rating').val();
        mode = 'update';

        executeMovieSQL('POST',mode,headerMovieID,inputMovieTitle,inputMovieDesc,inputGenreID,inputMovieReleaseDate,
                        inputMovieRating,url_end);
        movieClearAll();
    });

     // Insert movie
     $('#add_movie').on('click', function(event) {
        url_end = '?mode=insert';
        let inputMovieID = $('#input_movie_id').val();
        let inputMovieTitle = $('#input_movie_title').val();
        let inputMovieDesc = $('#input_movie_desc').val();
        let inputGenreID = $('#input_movie_genre_id').val();
        let inputMovieReleaseDate = $('#input_movie_release_date').val();
        let inputMovieRating = $('#input_movie_rating').val();

        executeMovieSQL('POST','',inputMovieID,inputMovieTitle,inputMovieDesc,inputGenreID,inputMovieReleaseDate,
                        inputMovieRating,url_end);
        movieClearAll();
    });

    // ########################################################################
    // ########################################################################
    // NAVIGATION
    // ########################################################################
    // ########################################################################

     // Navigate to ACTOR PAGE
    $('#view_actor').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/actor/actor_page.php');
    });
    
});

    // ########################################################################
    // movie PAGE BUTTON CLICKS
    function executeMovieSQL(type,mode,movieID,movieTitle,movieDesc,movieGenreID,movieReleaseDate,movieRating,url_end) {
        $('#movie_form').on('submit', function (event) {

            // #######################################################################
            // VARIABLES FOR INSERTING INTO DATABASE
            if(mode == 'update')
            {
                url_end += '&header_movie_id='+movieID;
            }
            // event.stopImmediatePropagation();
            event.preventDefault();
            $.ajax({
                crossOrigin: true,
                url: '/movie_project/movie_database_tables/movie/movie_sql_processor.php'+url_end,
                type: type,
                dataType: 'JSON',
                async: false,
                data: {
                    movieID:movieID,
                    movieTitle: movieTitle,
                    movieDesc:movieDesc,
                    movieGenreID:movieGenreID,
                    movieReleaseDate:movieReleaseDate,
                    movieRating:movieRating
                    
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
        $('#input_movie_title').val('');
        $('#input_movie_desc').val('');
        $('#input_movie_genre_id').val('');
        $('#input_movie_release_date').val('');
        $('#input_movie_rating').val('');
    }
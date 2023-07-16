$(document).ready(function(){

    // ########################################################################
    // ########################################################################
    // NAVIGATION
    // ########################################################################
    // ########################################################################

     // Navigate to ACTOR PAGE
     $('#view_actor').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/actor/actor_page.php');
    }); 

    // Navigate to MOVIE PAGE
    $('#view_movie').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/movie/movie_page.php');
    });
});
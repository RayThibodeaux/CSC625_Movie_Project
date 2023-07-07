$(document).ready(function (){
    
    // ########################################################################
    // ########################################################################
    // ACTOR PAGE BUTTON CLICKS
    // ########################################################################
    // ########################################################################

    // To view all actors
    $('#view_all_actors').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/actor/actor_sql_results.php?mode=select');
    });

    // To select a single actor via actor_id from header file
    $('#find_actor').on('click', function (event) {
        window.open('/movie_project/movie_database_tables/actor/actor_sql_results.php?mode=single_select&header_actor_id=' + $('#header_actor_id').val());
    });

    // To add a single actor 
    $('#add_actor').on('click', function (event) {
        url_end = '?mode=insert';
        let inputActorID = $('#input_actor_id').val();
        let inputActorName = $('#input_actor_name').val();
        let inputActorAwardID = $('#input_actor_award_id').val();

        executeActorSQL('POST','insert',inputActorID,inputActorName,inputActorAwardID,url_end);
        actorClearAll();
    });

    // Delete actor
    $('#delete_actor').on('click', function(event) {
        let header_actor_id = $('#header_actor_id').val();
        let header_actor_award_id = $('#header_actor_award_id').val();

        window.open('/movie_project/movie_database_tables/actor/actor_sql_processor.php?mode=delete&header_actor_id='+header_actor_id
                    + '&header_actor_award_id='+header_actor_award_id);
        actorClearAll();
    });

    // Update actor
    $('#update_actor').on('click', function(event) {
        url_end = '?mode=update';
        let inputActorID = $('#input_actor_id').val();
        let inputActorName = $('#input_actor_name').val();
        let inputActorAwardID = $('#input_actor_award_id').val();

        executeActorSQL('POST','update',inputActorID,inputActorName,inputActorAwardID,url_end);
        actorClearAll();
    });
    
});

    // ########################################################################
    // ACTOR PAGE BUTTON CLICKS
    function executeActorSQL(type, mode, actorID,actorName,actorAwardID,url_end) {
        $('#actor_form').on('submit', function (event) {
            // #######################################################################
            // VARIABLES FOR INSERTING INTO DATABASE
            event.stopImmediatePropagation();
    
            $.ajax({
                crossOrigin: true,
                url: '/movie_project/movie_database_tables/actor/actor_sql_processor.php'+url_end,
                type: type,
                dataType: 'JSON',
                async: false,
                data: {
                    actorID:actorID,
                    actorName: actorName,
                    actorAwardID: actorAwardID
                },
                success: function (response) {
                location.reload();
                }
            });
        });
    }

    function actorClearAll()
    {
        $('#input_actor_id').val('');
        $('#input_actor_name').val('');
        $('#input_actor_award_id').val('');
        $('#header_actor_id').val('');
        $('#header_actor_award_id').val('');
    }
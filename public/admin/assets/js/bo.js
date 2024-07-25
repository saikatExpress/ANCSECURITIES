$(document).ready(function(){
    $('#nominee_1_is_guardian').on('click', function(){
        $('.nominee_1_guardian').toggle();
    });
    $('#add-nominee_2').on('click', function(){
        $('#nominee_2-details').toggle();
    });
    $('#nominee_2_is_guardian').on('click', function(){
        $('.nominee_2_guardian').toggle();
    });
    $('#is_director').on('change', function(){
        $('.director_company').toggle();
    });
});

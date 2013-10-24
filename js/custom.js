$(document).ready(function() {


    var check_filter_type = function (filtertype, checkState) {

        var filtertypes = ['filter-dd', 'filter-srch', 'filter-lsrch']; // array osht deklaru per me u perdore ne rastet e if'ave ma poshte

        if(checkState) { // nese checkboxi X (me id'n X) osht checked
            
            $('.if-check-' + filtertype).stop(true,true).fadeIn("normal");
            // console.log("checked");


            // if (filtertype == filtertypes[0]){

            //     $('input:checkbox#' + filtertypes[1]+ ', input:checkbox#' + filtertypes[2]).stop(true,true).fadeOut("normal"),
            //     $('#label_' + filtertypes[1] +', #label_'+ filtertypes[2]).stop(true,true).fadeOut("normal");

            // }else if (filtertype == filtertypes[1]) {

            //     $('input:checkbox#' + filtertypes[2] + ', input:checkbox#' + filtertypes[0]).stop(true,true).fadeOut("normal"),
            //     $('#label_' + filtertypes[2] +', #label_'+ filtertypes[0]).stop(true,true).fadeOut("normal");

            // }else if (filtertype == filtertypes[2]) {

            //     $('input:checkbox#' + filtertypes[0] + ', input:checkbox#' + filtertypes[1]).stop(true,true).fadeOut("normal"),
            //     $('#label_' + filtertypes[0] +', #label_' + filtertypes[1]).stop(true,true).fadeOut("normal");

            // };


        }else if (!checkState) {

            $('.if-check-' + filtertype).stop(true,true).fadeOut("normal");


            // if (filtertype == filtertypes[0]){

            //     $('input:checkbox#' + filtertypes[1]+ ', input:checkbox#' + filtertypes[2]).stop(true,true).fadeIn("normal"),
            //     $('#label_' + filtertypes[1] +', #label_'+ filtertypes[2]).stop(true,true).fadeIn("normal");

            // }else if (filtertype == filtertypes[1]) {

            //     $('input:checkbox#' + filtertypes[2] + ', input:checkbox#' + filtertypes[0]).stop(true,true).fadeIn("normal"),
            //     $('#label_' + filtertypes[2] +', #label_'+ filtertypes[0]).stop(true,true).fadeIn("normal");

            // }else if (filtertype == filtertypes[2]) {

            //     $('input:checkbox#' + filtertypes[0] + ', input:checkbox#' + filtertypes[1]).stop(true,true).fadeIn("normal"),
            //     $('#label_' + filtertypes[0] +', #label_' + filtertypes[1]).stop(true,true).fadeIn("normal");

            // };



        };

    }

    $('.filtertype').live('change',function(){  // me klikimin e X checkboksit me klasen filtertype
        var checkState = this.checked;
        check_filter_type($(this).attr('id'), checkState); // thiret funksioni check_filtertype_type tu e mare id'n e checkboxit te selektume edhe statement nese osht ose jo i selektume.
    });






$("#searchInput").keyup(function () {
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#fbody").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});





// Icon Click Focus
$('div.icon').click(function(){
    $('input#search').focus();
});

// Live Search
// On Search Submit and Get Results
function search() {
    var query_value = $('input#search').val();
    $('strong#search-string').html(query_value);
    if(query_value !== ''){
        $.ajax({
            type: "POST",
            url: "search.php",
            data: { query: query_value },
            cache: false,
            success: function(html){
                $("div#results").html(html);
            }
        });
    }return false;    
}

$("input#search").live("keyup", function(e) {
    // Set Timeout
    clearTimeout($.data(this, 'timer'));

    // Set Search String
    var search_string = $(this).val();

    // Do Search
    if (search_string == '') {
        $("div#results").fadeOut();
        $('h4#results-text').fadeOut();
    }else{
        $("div#results").fadeIn();
        $('h4#results-text').fadeIn();
        $(this).data('timer', setTimeout(search, 100));
    };
});


});
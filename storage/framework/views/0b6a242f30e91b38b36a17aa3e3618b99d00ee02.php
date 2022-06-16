<script><!-- Ajax Paginatino Support -->

/*
 $(window).on('hashchange', function() {
        if (window.location.hash) {
            alert('hashchange');
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });
 */
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
           // alert($(this).attr('href').split('page=')[1]);
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });


    function getPosts(page) {

        if(window.location.search == ''){
            var seperator = "?";
        }else{
            var seperator = "&";
        }

        $.ajax({
            url : window.location.search+seperator+'page=' + page,
            //dataType: 'json',
        }).done(function (data) {
        	//alert(data);
            $('.ajax_content').html(data);
            location.hash = page;
        }).fail(function (jqXHR, textStatus, errorThrown) {   
            alert('Posts could not be loaded.');
            console.log(jqXHR)
        });
    }
</script>
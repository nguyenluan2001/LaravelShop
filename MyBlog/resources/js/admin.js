$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
    $('#content .card .card-body #cat select').change(function(){
        var cat_id=$(this).val();
        var data={cat_id:cat_id};
        $.ajax({
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'url':"http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyBlog/admin/post/subcat_process",
            'method':'Post',
            'data':data,
            success:function(data){
                $('#content .card .card-body #subcat select').html(data)

            },
            error:function(xhr,ajaxOptions,thrownError){
                alert(xhr.status);
                alert(thrownError);
            }


        })
    })
    $('#content .card .card-body #product_cat select').change(function(){
        var cat_id=$(this).val()
        var data={cat_id:cat_id}
        $.ajax({
            'url':'http://localhost:8080/UNITOP.VN/BACK-END/LARAVELPRO/MyBlog/admin/product/add/product_subcat_ajax',
            'method':'Post',
            'data':data,
            success:function(data){
                $('#content .card .card-body #product_subcat select').html(data)

            },
            error:function(xhr,ajaxOptions,thrownError){
                alert(xhr.status)
                alert(thrownError)
            }
        })
    })
});
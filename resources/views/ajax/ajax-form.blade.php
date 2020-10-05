
<h1 >Ajax Crud Operations</h1>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">


            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="form-group">
                <input type="file" id='file' name="file" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit"  class="form-control" id="ajax-submit">
            </div>

            <div class="alert alert-success" style="display:none;"></div>

        </form>
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        $('#ajax-submit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

            $.ajax({
                url: "{{route('ajax_implement')}}",
                method : 'POST',
                data: {file: $("#file").val()},
                success: function(result){
                    $(".alert").show();
                    $(".alert").html(result.success+' : ' + result.data);
                }
            });


        });
    });

</script>

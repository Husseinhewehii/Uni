@extends('layouts.app')
@section('content')
    <h2>Country City List</h2>
    <div class="container box">
        <div class="form-group">
            <select name="country" id="country" data-dependent="city" class="form-control input-lg dynamic">
                <option value="">Select Country</option>
                @foreach($country_list as $country)
                    <option value="{{$country->name}}"> {{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <select name="city" id="city" class="form-control input-lg dynamic">
                <option value="">Select City</option>
            </select>
        </div>
        {{csrf_field()}}
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value =  $(this).val();
                var dependent =  $(this).data('dependent');
                var _token =  $('input[name="_token"]').val();
                $.ajax({
                    url:"{{route('country_city_fetch')}}",
                    method:'POST',
                    data: {
                        select:select,
                        value:value,
                        _token:_token,
                        dependent:dependent
                    },
                    success:function(result)
                    {
                        $("#"+dependent).html(result);
                    }
                })

            }
        })
    })
</script>

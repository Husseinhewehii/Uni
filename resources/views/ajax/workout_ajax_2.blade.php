
<div class="container">
    <button id="button_1">Get User</button>
    <button id="button_2">Get Users</button>
    <br>
    <h1>User</h1>
    <div id="user"></div>
    <h1>Users</h1>
    <div id="users"></div>
</div>

<script>
    document.getElementById('button_1').addEventListener(
        'click', loadUser)  ;

    function loadUser()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET','workout_ajax_text_2_user ',true);

        xhr.onload = function(){
            if(this.status == 200){
                var user = this.responseText;
                console.log(user);
            }
        }
        xhr.send();
    }
</script>

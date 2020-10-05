
<div class="container">
    <button id="button">Get Text File</button>
    <p id="text"></p>
</div>
<script>
    document.getElementById('button').addEventListener(
        'click', loadText);

    function loadText()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET','workout_ajax_text ',true);

        console.log('READYSTATE',xhr.readyState);


        xhr.onprogress = function(){
            console.log('READYSTATE',xhr.readyState);
        }


        xhr.onload = function(){
            console.log('READYSTATE',xhr.readyState);
            if(this.status == 200){
                document.getElementById('text').innerHTML = this.responseText;
            }else if(this.status == 404){
                document.getElementById('text').innerHTML = 'seite nicht gefunden';
            }
        }


        xhr.onerror = function(){
            console.log('Request Error.....');
        }

        // xhr.onreadystatechange = function(){
        //     console.log('READYSTATE: ',xhr.readyState);
        //     if(this.readyState == 4 && this.status == 200){
        //         console.log(this.responseText);
        //     }
        // }

        xhr.send();
    }
</script>

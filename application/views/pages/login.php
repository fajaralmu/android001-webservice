
<div>
    <h2>Hello this login view</h2>
    <?=$session['username'].' '.$session['password']?>
    <div style="margin:auto">
        <table style="margin:auto">
            <tr>
                <td>
                    <label>Username</label>
                </td>
                <td>
                    <input type="text" name="username" id="username" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password</label>
                </td>
                <td>
                    <input type="password" name="password" id="password" />
                </td>
            </tr>
            <tr>
                <td>
                    <button id="btn_login">Login</button>
                </td>
            </tr>
        </table>
        
    </div>
    <script type="text/javascript">
        var username_field = document.getElementById('username');
        var password_field = document.getElementById('password');
        document.getElementById('btn_login').addEventListener("click", doLogin, false);

        function doLogin(){
        
            var username = username_field.value;
            var password = password_field.value;
            var user = {
                    'namapengguna':username,
                    'katasandi':password

            }
            alert("LOGIN "+username+" and "+password);
            ajax("<?=base_url()."index.php/akun/masuk"?>",user,
            function(data){
                if(data==1){
                    alert("login SUCCESS "+data);
                    window.open("<?=base_url()."/index.php/post"?>","_self")
                }
                else 
                    alert("login gagal");
            },
            function(data){
                alert("ERROR "+data);
            });
        
        };

        function ajax(url,obj, success, error){
            var param = JSON.stringify(obj);
            var request = new XMLHttpRequest();
            
            request.open("POST", url, true);
            request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

            request.onreadystatechange = function() {
                if (this.readyState == this.DONE && this.status == 200) {
                    console.log(this.responseText);
                    success(this.responseText);
                }else if(this.status != 200){
                    error(this.responseText + this.readyState);
                }
           
            };
            request.send(param);
        };
    </script>


</div>

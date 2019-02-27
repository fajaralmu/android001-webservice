<div>
<h2>Dasbor Post</h2>
<input type="hidden" id="id" />
<input type="hidden" id="id_guru" />
<p>Judul</p>
<input type="text" id="judul" />
<p>Konten</p>
<textarea id="konten">

</textarea>
<p></p>
<button id="add_btn" onclick="submit()">Tambah</button>
<button id="edit_btn" onclick="update()">Perbarui</button>
    <div>
        <b>Your Posts</b>
        <ul>
        <?php foreach($list_post as $post){  ?>
            <li><?=$post->judul?><button onclick='show_edit_post(<?=$post->id?>)'>Edit</button> <button onclick='delete_post(<?=$post->id?>)'>Hapus</button></li>
        <?php   } ?>
        </ul>
    
    </div>
<script type="text/javascript">
var judul_field = document.getElementById("judul");
var konten_field = document.getElementById("konten");
var id_field = document.getElementById("id");
var id_guru_field = document.getElementById("id_guru");

function show_edit_post(id){
    var post = {
        id:id
    }
    ajax("<?=base_url()."/index.php/post/get/"?>",post,
    function(data){
        data=JSON.parse(data);
        if(data!=null){
            id_field.value = data['id'];
            id_guru_field.value = data['idguru'];
            judul_field.value = data['judul'];
            konten_field.value = data['konten'];
        }else{
            alert("fetching gagal"+data);
        }
    },
    function(data){
        alert("internal error");
        }
    )
}

function update(){
    var post = {
        idguru : id_guru_field.value,
        id : id_field.value,
        judul : judul_field.value,
        konten : konten_field.value 
    }
    ajax("<?=base_url()."/index.php/post/update"?>",post,
    function(data){
        if(data==1){
            alert("update sukses"+data);
            location.reload();

        }else{
            alert("update gagal"+data);
        }
    },
    function(data){
        alert("internal error");
        }
    )
}

function delete_post(id){
    if(!confirm("Hapus post "+id+"?")){
        return;
    }
    var post = {
        id:id
    }
    ajax("<?=base_url()."/index.php/post/hapus"?>",post,
    function(data){
        if(data==1){
            alert("hapus sukses"+data);
            location.reload();

        }else{
            alert("hapus gagal"+data);
        }
    },
    function(data){
        alert("internal error");
        }
    )
}

function submit(){
    var post = {
        judul : judul_field.value,
        konten : konten_field.value 
    }
    ajax("<?=base_url()."/index.php/post/tambah"?>",post,
    function(data){
        if(data==1){
            alert("posting sukses"+data);
            location.reload();

        }else{
            alert("posting gagal"+data);
        }
    },
    function(data){
        alert("internal error");
        }
    )
}

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
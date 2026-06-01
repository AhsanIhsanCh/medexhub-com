function loadedit(u_id){
    var ajaxPath = "{{ $ajaxPath }}";
    document.getElementById("datadiv").style.display = "block";
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
    document.getElementById("datadiv").innerHTML = this.responseText;}
    xhttp.open("GET", "../packages/ajax_admin/user_ajax.blade.php?useredit=1&u_id="+u_id);
    xhttp.send();
}
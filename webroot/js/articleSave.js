//Добавление статьи
var form = document.getElementById('aform_submit');
form.addEventListener('click', function(event){
    alert('sd');
    event.preventDefault();
    var send_str = new FormData(form);
    ajax_request.run(ajax_request.method.POST, send_str, '', function(data){
        insertHtml(data);
    });
    event.preventDefault();
});
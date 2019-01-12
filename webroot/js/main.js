// Ajax запрос
var ajax_request = {
    method: {
        GET: 0,
        POST: 1
    },
    run: function (method, path, send_str, callback) {
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                callback(xhr.responseText);
            }
        }

        if (method == this.method.GET) {
            xhr.open("GET", path + '?' + send_str, true);
            xhr.send();
        }
        if (method == this.method.POST) {
            xhr.open('POST', path, true);
            xhr.send(send_str);
        }
    }
}

function insertHtml(html) {
    var wrapper = document.getElementById('wrapper');
    wrapper.innerHTML = html;
}

//Добавление и редактирование статьи ajax запросом
function articleSave() {
    var form = document.getElementById('aform');
    form.addEventListener('submit', function (event) {
        var send_str = new FormData(form);
        ajax_request.run(ajax_request.method.POST, form.action, send_str, function (data) {
            insertHtml(data);
        });
        event.preventDefault();
    })
}

document.addEventListener('DOMContentLoaded', function () {
    // Отмена стандартного действия по всем ссылкам для реализации Ajax запроса (клик по всем тегам a)
    document.addEventListener('click', function (event) {
        if(event.target.tagName != 'A')
            return;

        ajax_request.run(ajax_request.method.GET, event.target.href, '', function (data) {
            insertHtml(data);
        });
        event.preventDefault();
    })
});
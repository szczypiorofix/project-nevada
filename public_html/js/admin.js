/*
 * MIT License
 *
 * Copyright (c) 2018 Piotr Wróblewski
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 *
 */

var tableOfPosts = {
    maxrecords: 0,
    data: {},
    tb: null,
    addData: function(element, data) {
        let newTd = document.createElement(element);
        let t = document.createTextNode(data);
        newTd.appendChild(t);
        return newTd;        
    },
    refresh: function() {
        this.tb.innerHTML = '';
        let self = this;
        this.data.posts.forEach(function(item, index, t) {
            let newTr = document.createElement('tr');
            
            newTr.appendChild(self.addData('td', item.id));
            newTr.appendChild(self.addData('td', item.title));
            newTr.appendChild(self.addData('td', item.insert_date));
            newTr.appendChild(self.addData('td', item.update_date));
            
            let newTd = document.createElement('td');
            let nb = document.createElement('button');
            nb.className = "admin-button";
            nb.onclick = function() {
                window.location.href = "admin/edit?&postid="+item.id;
            };
            let bi = document.createElement('i');
            bi.className = 'fas fa-edit';
            nb.appendChild(bi);
            newTd.appendChild(nb);
            newTr.appendChild(newTd);
            
            nb = document.createElement('button');
            nb.className = "admin-button";
            nb.onclick = function() {
                if (confirm("Usunąć ?")) {
                    console.log('Zgłoszenie postu "'+item.title+'" do usunięcia ...');
                    t.splice(index, 1);
                    self.refresh();
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "admin/delete", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            console.log(this.response);
                            console.log('OK!');
                        }
                    };
                    xhttp.send("postid="+item.id);
                }
            };
            bi = document.createElement('i');
            bi.className = 'fas fa-trash-alt';
            nb.appendChild(bi);
            newTd.appendChild(nb);
            newTr.appendChild(newTd);
            
            self.tb.appendChild(newTr);
        });
    },
    init: function(data) {
        this.tb = document.getElementById("tablePostsBody");
        this.data = data;
        this.refresh();
    },
    show: function() {
        //console.log(this.data);
    }
};

//(function setSubmitMessageForm() {
//    var request;
//    $("#editpostform").submit(function(event) {
//        event.preventDefault();
//        if (request) {
//            request.abort();
//        }
//        var $form = $(this);
//        var $inputs = $form.find("input, button, textarea");
//        var serializedData = $form.serialize();
//        $inputs.prop("disabled", true);
//        request = $.ajax({
//            url: "Admin/save",
//            type: "post",
//            data: serializedData
//        });
//        request.done(function (response, textStatus, jqXHR){
//            console.log(response);
//            showNotification(response);
//            //$('input[type="text"],input[type="email"],textarea').val('');
//        });
//        request.fail(function (jqXHR, textStatus, errorThrown){
//            console.error(
//                "The following error occurred: "+textStatus, errorThrown
//            );
//        });
//        request.always(function () {
//            $inputs.prop("disabled", false);
//        });
//    });
//})();

(function setupFileUploader() {
    var fileFields = document.getElementById('post-file');
    if (fileFields) {
        fileFields.addEventListener('change', function(e) {
            document.getElementById('post-file-label').innerHTML = '<i class="fas fa-upload"></i> '+e.target.files[0].name;
        });
    }
})();

function addPost() {
    var form = $('#addpostform')[0];
    var data = new FormData(form);
    $("#addbutton").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "Admin/add",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 600000,
        success: function (data) {
            showNotification(data);
            console.log(data);
            $("#addbutton").prop("disabled", false);
        },
        error: function (e) {
            console.log("Błąd : ", e);
            showNotification("Błąd: "+e.responseText);
            $("#addbutton").prop("disabled", false);
        }
    });
}

(function addPostSetup() {
    $("#addbutton").click(function (event) {
        event.preventDefault();
        addPost();
    });
})();

function savePost() {
    var form = $('#editpostform')[0];
    var data = new FormData(form);
    $("#submitbutton").prop("disabled", true);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "Admin/save",
        data: data,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        timeout: 600000,
        success: function (data) {
            showNotification(data);
            console.log(data);
            $("#submitbutton").prop("disabled", false);
        },
        error: function (e) {
            console.log("Błąd : ", e);
            showNotification("Błąd: "+e.responseText);
            $("#submitbutton").prop("disabled", false);
        }
    });
}

(function savePostSetup() {
    $("#submitbutton").click(function (event) {
        event.preventDefault();
        savePost();
    });
})();

(function saveOnCtrlSPressed() {
    $(document).keydown(function(e) {
        var key = undefined;
        var possible = [e.key, e.keyIdentifier, e.keyCode, e.which];
        while (key === undefined && possible.length > 0)
        {
            key = possible.pop();
        }
        if (key && (key == '115' || key == '83' ) && (e.ctrlKey || e.metaKey) && !(e.altKey))
        {
            e.preventDefault();
            savePost();
            return false;
        }
        return true;
    }); 
})();

function makeBackup(b) {
    b.disabled = true;
    document.getElementById('backupSpinner').style.display = "inline-block";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            showNotification(this.response);
            console.log(this.response);
            document.getElementById('backupSpinner').style.display = "none";
            b.disabled = false;
        }
    };
    xhttp.open("GET", "Admin/backup", true);
    xhttp.send();
}

function showNotification(n) {
    let notificationsPanel = document.getElementById("notificationsPanel");
    let notificationsContent = document.getElementById("notificationsContent");
    notificationsContent.innerHTML = n;
    notificationsPanel.className = "show";
    setTimeout(function() {
        notificationsPanel.className = notificationsPanel.className.replace("show", "");
    }, 3000);
}

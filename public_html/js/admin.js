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
    th: null,
    sorting: 0, // 0-id w górę, 1-id w dół, 2-tytuł w górę, 3-tytuł w dół,
    // 4-data pub w górę, 5-data pub w dół, 6-data akt w górę, 7-data akt w dół
    sortUpBtn: 'fas fa-sort-amount-up',
    sortDownBtn: 'fas fa-sort-amount-down',
    addData: function(element, data) {
        let newTd = document.createElement(element);
        let t = document.createTextNode(data);
        newTd.appendChild(t);
        return newTd;        
    },
    refreshHead: function() {
        this.th.innerHTML = '';
        let self = this;
        let hTr = document.createElement('tr');
        let hth = ['Id', 'Tytuł', 'Data publikacji', 'Data aktualizacji', 'Opcje'];
        hth.forEach(function(item, index, t) {
            let tTh = document.createElement('th');
            if (index < t.length-1) {

                tButton = document.createElement('button');
                tButton.className = 'sort-button';

                if (self.sorting === index + 1) {
                    let tI = document.createElement('i');
                    tI.className = self.sortDownBtn;
                    tButton.appendChild(tI);
                }
                
                if (self.sorting * -1 === (index + 1)) {
                    let tI = document.createElement('i');
                    tI.className = self.sortUpBtn;
                    tButton.appendChild(tI);
                }
                
                let tButtonText = document.createTextNode(item);
                tButton.appendChild(tButtonText);
                
                tButton.onclick = function() {

                    if (self.sorting === (index+1)) {
                        self.sorting = (index + 1) *-1;
                    } else {
                        self.sorting = index + 1;
                    }
                    self.refreshHead();
                    self.refreshBody();
                    //console.log(self.sorting);
                }

                tTh.appendChild(tButton);
            } else {
                tTh.appendChild(document.createTextNode('Opcje'));
            }
            
            hTr.appendChild(tTh);
        });
        this.th.appendChild(hTr);
    },
    compare: function(key, order='asc') {
        return function(a, b) {
            if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) {
                return 0;
            }
            const varA = (typeof a[key] === 'string') ? a[key].toUpperCase() : a[key];
            const varB = (typeof b[key] === 'string') ? b[key].toUpperCase() : b[key];
            let comparison = 0;
            if (varA > varB) comparison = 1;
            else if (varA < varB) comparison = -1;
            return (order == 'desc') ? (comparison * -1) : comparison;
        }
    },
    refreshBody: function() {
        this.tb.innerHTML = '';
        switch (this.sorting) {
            case 1: {
                this.data.posts.sort(this.compare('id', 'asc'));
                break;
            }
            case -1: {
                this.data.posts.sort(this.compare('id', 'desc'));
                break;
            }
            case 2: {
                this.data.posts.sort(this.compare('title', 'asc'));
                break;
            }
            case -2: {
                this.data.posts.sort(this.compare('title', 'desc'));
                break;
            }
            case 3: {
                this.data.posts.sort(this.compare('insert_date', 'asc'));
                break;
            }
            case -3: {
                this.data.posts.sort(this.compare('insert_date', 'desc'));
                break;
            }
            case 4: {
                this.data.posts.sort(this.compare('update_date', 'asc'));
                break;
            }
            case -4: {
                this.data.posts.sort(this.compare('update_date', 'desc'));
                break;
            }
        }

        let self = this;
        this.data.posts.forEach(function(item, index, t) {
            let bTr = document.createElement('tr');
            
            bTr.appendChild(self.addData('td', item.id));
            let titleTd = document.createElement('td');
            let titleA = self.addData('a', item.title);
            titleA.href = 'post/'+item.url;
            titleA.target = '_blank';
            titleTd.appendChild(titleA);
            bTr.appendChild(titleTd);
            bTr.appendChild(self.addData('td', item.insert_date));
            bTr.appendChild(self.addData('td', item.update_date));
            
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
            bTr.appendChild(newTd);
            
            nb = document.createElement('button');
            nb.className = "admin-button";
            nb.onclick = function() {
                if (confirm("Usunąć ?")) {
                    console.log('Zgłoszenie postu "'+item.title+'" do usunięcia ...');
                    t.splice(index, 1);
                    self.refreshBody();
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "admin/delete", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            console.log(this.response);
                            showNotification('Post usunięty');
                        }
                    };
                    xhttp.send("postid="+item.id);
                }
            };
            bi = document.createElement('i');
            bi.className = 'fas fa-trash-alt';
            nb.appendChild(bi);
            newTd.appendChild(nb);
            bTr.appendChild(newTd);
            self.tb.appendChild(bTr);
        });
    },
    init: function(data) {
        this.tb = document.getElementById("tablePostsBody");
        this.th = document.getElementById("tablePostsHead");
        if (this.tb !== null && this.th !== null && data !== null) {
            this.data = data;
            this.sorting = 1;
            this.refreshHead();
            this.refreshBody();
        }
        
    },
    show: function() {
        //console.log(this.data);
    }
};

(function setupFileUploader() {
    var fileFields = document.getElementById('post-file');
    if (fileFields) {
        fileFields.addEventListener('change', function(e) {
            if (e.target.files) document.getElementById('post-file-label').innerHTML = '<i class="fas fa-upload"></i> '+e.target.files[0].name;
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
            form.reset();
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

(function registerAdmin() {
    $("#registerAdminButton").click(function (event) {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.response);
            }
        };
        xhttp.open("POST", "Admin/register", true);
        xhttp.send();
    });
})();

(function saveOnCtrlSPressed() {
    $(document).keydown(function(e) {
        var key = undefined;
        var possible = [e.key, e.keyIdentifier, e.keyCode, e.which];
        while (key === undefined && possible.length > 0) {
            key = possible.pop();
        }
        if (key && (key == '115' || key == '83' ) && (e.ctrlKey || e.metaKey) && !(e.altKey)) {
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

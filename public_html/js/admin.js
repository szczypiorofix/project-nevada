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
                window.location.href = "admin/edit?&postid=1";
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
        console.log(this.data);
    }
};

function savePost() {
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "admin/save", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.response);
            console.log('OK!');
            showNotification(this.response);
        }
    };
    xhttp.send("postid="+1);
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

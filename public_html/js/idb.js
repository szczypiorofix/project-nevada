
var iDB = {

    open: null,

    createDBStructure: function() {
        let db = this.open.result;
        let store = db.createObjectStore("posts", {keyPath: "id"});
        let index = store.createIndex("postid", ["post.title", "post.content"]);
        return new Promise(
            function(resolve, reject) {
                resolve('DB structure');
            }
        );
    },
    insertDataIntoDatabase: function() {
        var db = this.open.result;
        var tx = db.transaction("posts", "readwrite");
        var store = tx.objectStore("posts");
        var index = store.index("postid");
        
        store.put({id: 1, post: {title: 'Dupa', content: '#Dupa content'}});
        
        tx.oncomplete = function() {
            db.close();
        };
        return new Promise(
            function(resolve, reject) {
                resolve('DB content');
            }
        );
    },
    add: function(n, d) {

        if (!('indexedDB' in window)) {
            console.warn('This browser doesn\'t support IndexedDB');
            return;
        }
        
        indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        
        var prom1 = new Promise(
            function (resolve, reject) {
                this.open = indexedDB.open(n, 1);
                this.open.onupgradeneeded = resolve;
            }
        )

        console.log('1st');
        prom1
            .then(function (returnFrom_idUpgrade) {
                console.log(returnFrom_idUpgrade);
            })
            .then(this.createDBStructure)
            .then(function (returnFrom_idUpgrade) {
                console.log(returnFrom_idUpgrade);
            })
            .then(this.insertDataIntoDatabase)
            .then(function (returnFrom_idUpgrade) {
                console.log(returnFrom_idUpgrade);
            })
            .catch(function(err) {
                console.error('ERROR !!!'+err.message);
            });
        console.log('2nd');

    }

}

iDB.add("newDB");
var iDB = {

    data: null,


    dbUpgrade: function(o) {
        console.log(this.data);
        let db = o.target.result;
        let store = db.createObjectStore("MyObjectStore", {keyPath: "id"});
        let index = store.createIndex("NameIndex", ["name.last", "name.first"]);
    },

    dbSuccess: function(o) {
        console.log(this.data);
        var db = o.target.result;
        var tx = db.transaction("MyObjectStore", "readwrite");
        var store = tx.objectStore("MyObjectStore");
        var index = store.index("NameIndex");
    
        store.put({id: 12345, name: {first: "John", last: "Doe"}, age: 42});
        store.put({id: 67890, name: {first: "Bob", last: "Smith"}, age: 35});
        
        // var getJohn = store.get(12345);
        // var getBob = index.get(["Smith", "Bob"]);
    
        // getJohn.onsuccess = function() {
        //     console.log(getJohn.result.name.first);  // => "John"
        // };
    
        // getBob.onsuccess = function() {
        //     console.log(getBob.result.name.first);   // => "Bob"
        // };
    
        tx.oncomplete = function() {
            db.close();
        };
    },

    init: function(n, d) {
        this.data = d;
        let indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        let open = indexedDB.open(n, 1);

        open.onupgradeneeded = this.dbUpgrade;
        open.onsuccess = this.dbSuccess;
    }
}

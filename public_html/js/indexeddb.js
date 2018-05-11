var iDB = {

    data: null,

    init: function(n, d) {
        this.data = d;
        let indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
        var open = indexedDB.open(n, 1);

        open.onupgradeneeded = () => {
            //console.log(this.data);
            let db = open.result;
            let store = db.createObjectStore("posts", {keyPath: "id"});
            let index = store.createIndex("postid", ["post.title", "post.content", "post.url"]);
            
            store = db.createObjectStore("categories", {keyPath: "id"});
            store = db.createObjectStore("tags", {keyPath: "id"});
            store = db.createObjectStore("post_tags", {keyPath: "id"});
            store = db.createObjectStore("post_categories", {keyPath: "id"});
        }

        open.onsuccess = () => {
            console.log(this.data);
            var db = open.result;

            // POSTS
            var tx = db.transaction("posts", "readwrite");
            var store = tx.objectStore("posts");
            var index = store.index("postid");
            for (var i = 0; i < this.data.posts.length; i++) {
                store.put({id: this.data.posts[i].id, post: {title: this.data.posts[i].title, content: this.data.posts[i].content, url: this.data.posts[i].url, image: this.data.posts[i].image}});
            }
            tx.oncomplete = function() {
                db.close();
            };

            
            // CATEGORIES
            tx = db.transaction("categories", "readwrite");
            store = tx.objectStore("categories");
            for (var i = 0; i < this.data.categories.length; i++) {
                store.put({id: this.data.categories[i].id, title: this.data.categories[i].name});
            }
            tx.oncomplete = function() {
                db.close();
            };


            // TAGS
            tx = db.transaction("tags", "readwrite");
            store = tx.objectStore("tags");
            for (var i = 0; i < this.data.tags.length; i++) {
                store.put({id: this.data.tags[i].id, title: this.data.tags[i].name});
            }
            tx.oncomplete = function() {
                db.close();
            };


            // POST TAGS
            tx = db.transaction("post_tags", "readwrite");
            store = tx.objectStore("post_tags");
            for (var i = 0; i < this.data.post_tags.length; i++) {
                store.put({id: this.data.post_tags[i].id, tagid: this.data.post_tags[i].tagid, postid: this.data.post_tags[i].postid});
            }
            tx.oncomplete = function() {
                db.close();
            };


            // POST TAGS
            tx = db.transaction("post_tags", "readwrite");
            store = tx.objectStore("post_tags");
            for (var i = 0; i < this.data.post_tags.length; i++) {
                store.put({id: this.data.post_tags[i].id, tagid: this.data.post_tags[i].tagid, postid: this.data.post_tags[i].postid});
            }
            tx.oncomplete = function() {
                db.close();
            };


            // var getJohn = store.get(12345);
            // var getBob = index.get(["Smith", "Bob"]);
        
            // getJohn.onsuccess = function() {
            //     console.log(getJohn.result.name.first);  // => "John"
            // };
        
            // getBob.onsuccess = function() {
            //     console.log(getBob.result.name.first);   // => "Bob"
            // };
        }

        open.onerror = () => {
            console.error("Error occured !");
        }
    }
}



// var iDB = {

//     data: null,
    
//     add: function(n, d) {
//         this.data = d;
//         let indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
//         var open = indexedDB.open(n, 1);

//         open.onupgradeneeded = () => {
//             let db = open.result;
//             let store = db.createObjectStore("posts", {keyPath: "id"});
//             //let index = store.createIndex("postid", ["post.title", "post.content", "post.url"]);
//         }

//         open.onsuccess = () => {
//             console.log(this.data);
//             var db = open.result;
            
//             var keyNames = Object.keys(this.data);

//             // POSTS
//             var tx = db.transaction(keyNames[0], "readwrite");
//             var store = tx.objectStore(keyNames[0]);
//             //var index = store.index("postid");
            
//             for (var i = 0; i < this.data.posts.length; i++) {
//                 store.put({id: this.data.posts[i].id, title: this.data.posts[i].title});
//             }
//             tx.oncomplete = function() {
//                 db.close();
//             };

//             // var getJohn = store.get(12345);
//             // var getBob = index.get(["Smith", "Bob"]);
        
//             // getJohn.onsuccess = function() {
//             //     console.log(getJohn.result.name.first);  // => "John"
//             // };
        
//             // getBob.onsuccess = function() {
//             //     console.log(getBob.result.name.first);   // => "Bob"
//             // };
//         }

//         open.onerror = () => {
//             console.error("Error occured !");
//         }
//     }
// }


// iDB.add("nowa", {
//    posts: [
//        {id: '1', 'title': 'Dupa 1'},
//        {id: '2', 'title': 'Dupa 2'},
//        {id: '3', 'title': 'Dupa 3'}
//    ] 
// });

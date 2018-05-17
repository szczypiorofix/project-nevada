declare var showdown:any;

class DefaultContent {

    public constructor() {
        this.start();
    }

    // PROMISE-FRIENDLY
    // private async connect() {
    //     return new Promise(resolve => {
    //         let xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function() {
    //             if (this.readyState === 4 && this.status === 200) {
    //                 resolve(this.response);
    //             }
    //         };
    //         xmlhttp.open("GET", "json", true);
    //         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //         xmlhttp.send();
    //     });
    // }

    private async start() {
        let r = await fetch('json');
        this.showContent(await r.json());
    }

    private async parseCategories(data, id) {
        for (let i = 0; i < data['post_categories'].length; i++) {
            if (data['post_categories'][i]['postid'] == id) {
                for (let j = 0; j < data['categories'].length; j++) {
                    if (data['categories'][j]['id'] == data['post_categories'][i]['categoryid']) {
                        return data['categories'][j]['name'];
                    }
                }
            }
        }
        return 'error';
    }

    private async parseData(d) {
        // Zmiana danych
        // d['categories'] = [1,2,3,4];
        return d;
    }

    private async showContent(data) {        
        let r = document.getElementById("postContent");
        for (let i = data['posts'].length-1; i > data['posts'].length - 7; i--) {
            let divNewsPart = document.createElement('div');
            divNewsPart.className = "news-part";

            let imageDiv = document.createElement('div');
            imageDiv.className = "image-div";

            let imageCaption = document.createElement('span');
            imageCaption.className = 'image-caption';
            
            let mainPostContent = document.createElement('div');
            mainPostContent.className = "main-post-content";
            
            let additionalInfo = document.createElement('div');
            additionalInfo.className = "additional-info";
            let postDate = document.createElement('span');
            postDate.className = "post-date";
            postDate.appendChild(document.createTextNode(data['posts'][i]['update_date']));
            let postComments = document.createElement('span');
            postComments.className = "post-comments";
            let postCommentsI = document.createElement('i');
            postCommentsI.className = 'far fa-comment-alt';
            postComments.appendChild(postCommentsI);

            additionalInfo.appendChild(postDate);
            additionalInfo.appendChild(postComments);

            let postLink = document.createElement('a');
            postLink.href = "post/"+data['posts'][i]['url'];

            let postThumbnail = document.createElement('img');
            postThumbnail.src = "uploads/images/"+data['posts'][i]['image'];

            let categorySpan = document.createElement('span');
            categorySpan.className = 'image-caption';
            categorySpan.innerHTML = await this.parseCategories(data, data['posts'][i]['id']);

            postLink.appendChild(postThumbnail);
            imageDiv.appendChild(postLink);
            imageDiv.appendChild(categorySpan);
            
            let postTitle = document.createElement('div');
            postTitle.className = "post-title";

            let postTitleLink = document.createElement('a');
            postTitleLink.href = "post/"+data['posts'][i]['url'];

            let readMore = document.createElement('a');
            readMore.className = 'readmore';
            readMore.href = "post/"+data['posts'][i]['url'];
            readMore.appendChild(document.createTextNode("Czytaj więcej"));

            let postTitleLinkHeader = document.createElement('h3');
            postTitleLinkHeader.appendChild(document.createTextNode(data['posts'][i]['title']));
            postTitleLink.appendChild(postTitleLinkHeader);

            postTitle.appendChild(postTitleLink);
            mainPostContent.appendChild(postTitle);
            
            let converter = new showdown.Converter({simpleLineBreaks: true});
            let postContent:string = converter.makeHtml(data['posts'][i]['content']);
            let postContetnDiv = document.createElement('p');
            postContetnDiv.innerHTML = postContent.substr(0, 225)+"...";
            mainPostContent.appendChild(postContetnDiv);
            mainPostContent.appendChild(additionalInfo);
            mainPostContent.appendChild(readMore);
            
            divNewsPart.appendChild(imageDiv);
            divNewsPart.appendChild(mainPostContent);
            
            r.appendChild(divNewsPart);
        }
    }
}

var defaultContent = new DefaultContent();

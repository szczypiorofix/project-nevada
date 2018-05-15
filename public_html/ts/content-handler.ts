
class DefaultContent {

    public constructor() {

    }

    public getData() {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let res:object = JSON.parse(this.response);
                console.log(res);
                let r = document.getElementById("postContent");
                for (let i = res['posts'].length-1; i > res['posts'].length - 6; i--) {
                    let divNewsPart = document.createElement('div');
                    divNewsPart.className = "news-part";

                    let imageDiv = document.createElement('div');
                    imageDiv.className = "image-div";

                    let mainPostContent = document.createElement('div');
                    mainPostContent.className = "main-post-content";
                    
                    let additionalInfo = document.createElement('div');
                    additionalInfo.className = "additional-info";

                    let postLink = document.createElement('a');
                    postLink.href = "post/"+res['posts'][i]['url'];
                    let postLinkText = document.createTextNode(res['posts'][i]['title']);
                    postLink.appendChild(postLinkText);

                    let postThumbnail = document.createElement('img');
                    postThumbnail.src = "uploads/images/"+res['posts'][i]['image'];

                    let categorySpan = document.createElement('span');
                    
                    let postTitle = document.createElement('div');
                    postTitle.className = "post-title";

                    let postTitleLink = document.createElement('a');
                    postTitleLink.href = "post/"+res['posts'][i]['url'];

                    let postTitleLinkHeader = document.createElement('h3');
                    let postTitleLinkHeaderText = document.createTextNode(res['posts'][i]['title']);
                    postTitleLink.appendChild(postTitleLinkHeaderText);

                    postTitle.appendChild(postTitleLink);
                    mainPostContent.appendChild(postTitle);

                    postLink.appendChild(postThumbnail);
                    imageDiv.appendChild(postLink);
                    divNewsPart.appendChild(imageDiv);
                    
                    r.appendChild(divNewsPart);
                    


                    //r.innerHTML += res['posts'][i]['title'] +'<br>';
                    
                }
            }
        };
        xmlhttp.open("GET", "json", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

    public showContent() {
        
    }
}

var defaultContent = new DefaultContent();
defaultContent.getData();
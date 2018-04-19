(function makeMarkdown() {
    
    var converter = new showdown.Converter({simpleLineBreaks: true});
    var parseSource = document.getElementById('parseSource');
    var parseResults = document.getElementById('parseResults');
    document.getElementById('parseResults').innerHTML = converter.makeHtml(parseSource.value);
    parseSource.addEventListener('input', function(event) {
        document.getElementById('parseResults').innerHTML = converter.makeHtml(this.value);
    }, true);
})();

<script>
$(function() {
    $("a.jQueryBookmark").click(function(e){
            e.preventDefault(); // this will prevent the anchor tag from going the user off to the link
            var bookmarkUrl = this.href;
            var bookmarkTitle = "WikiMegaSearch";

            if (window.sidebar) { // For Mozilla Firefox Bookmark
                     alert("Den Hacken: \nDieses Lesezeichen in der Sidebar laden herausnehmen! \nAnsonsten wird die Seite in der Sidebar von Ihrem Browser angezeigt");
                    window.sidebar.addPanel(bookmarkTitle, bookmarkUrl,"");                  
            } else if( window.external || document.all) { // For IE Favorite
                    window.external.AddFavorite( bookmarkUrl, bookmarkTitle);
            } else if(window.opera) { // For Opera Browsers
                    $("a.jQueryBookmark").attr("href",bookmarkUrl);
                    $("a.jQueryBookmark").attr("title",bookmarkTitle);
                    $("a.jQueryBookmark").attr("rel","sidebar");
            } else { // for other browsers which does not support
                     alert('Your browser does not support this bookmark action');
                     return false;
            }
    });
});
</script>
<?php
    if (isset($url)) {
?>
<iframe class="iframe" id="resultIframe" src="<?php echo  $url; ?>" frameborder="0">
</iframe>
<?php 
    } else {
?>   
<div class="hero-unit">
    <h1>Wiki - MegaSearch</h1>
    <img src="img/beta-badge.png" alt="beta" style="position: absolute; top: 30px; z-index: 5000; left: 570px;" /><br>
    <p>Die Applikation "Wiki-MegaSearch" bietet eine Komfortable M&ouml;glichkeit mehrere Wikis gleichzeitig zu durchsuchen. <br> Aktuell werden folgende Wikis durchsucht :</p>
    <ul>
        <ul><li>http://fbiuk.kvr.muenchen.de/index.php</li>
        <li>http://limux.kvr.muenchen.de/index.php</li></ul>
    </ul><br>
    <a class="jQueryBookmark btn btn-large btn-primary" href="#">Lesezeichen hinzuf&uuml;gen</a> <br><br>
    <small>Feedback, BugReports oder Feature-Requests mit kurzer Beschreibung an <br> <a href="mailto:stefan.eisenkolb@muenchen.de">stefan.eisenkolb@muenchen.de</a></small>
</div>
<?php } ?>
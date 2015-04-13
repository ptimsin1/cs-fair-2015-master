<?php
//#############################################################################
// 
// List all the judges for the fair by category
//  

include ("top.php");

?>  

<!-- MAIN CONTENT -->

<section id="main">
<h1 class="page-title">Gallery</h1>
<hr/>
<section id="photoGallery"></section>

<!-- END MAIN CONTENT -->

</section>
   
<?php       

include ("footer.php");
?>

<script type="text/javascript">
function makeGallery() {
    var i = 1;
    var text = "";
    // loop through photos and builds gallery; number of photos should be of mod 4 = 0
    while (i <= 60) {
        text = text + '<div class="row">\n<div class="col-md-3"><a rel="lightbox" href="images/gallery/JPEG/CS_Fair-' + i + '.jpg" data-lightbox="cs-fair">\n<img class="img-thumbnail" src="images/gallery/CS_Fair-' + i + '.jpg" alt="CS Fair 2013" />\n</a>\n</div> ';
        i++;
        text = text + '<div class="col-md-3"><a rel="lightbox" href="images/gallery/JPEG/CS_Fair-' + i + '.jpg" data-lightbox="cs-fair">\n<img class="img-thumbnail" src="images/gallery/CS_Fair-' + i + '.jpg" alt="CS Fair 2013" />\n</a>\n</div>';
        i++;
        text = text + '<div class="col-md-3"><a rel="lightbox" href="images/gallery/JPEG/CS_Fair-' + i + '.jpg" data-lightbox="cs-fair">\n<img class="img-thumbnail" src="images/gallery/CS_Fair-' + i + '.jpg" alt="CS Fair 2013" />\n</a>\n</div>';
        i++;
        text = text + '<div class="col-md-3"><a rel="lightbox" href="images/gallery/JPEG/CS_Fair-' + i + '.jpg" data-lightbox="cs-fair">\n<img class="img-thumbnail" src="images/gallery/CS_Fair-' + i + '.jpg" alt="CS Fair 2013" />\n</a>\n</div>\n</div>';
        i++;
    }
    return text;
}
document.getElementById("photoGallery").innerHTML = makeGallery();
</script>

</body>
</html>

 <footer class="col-md-12">
     <p>Website design and event coordination provided by the Society of UVM Women in Computer Science</p>
     <p>University of Vermont, Computer Science Department, 351 Votey, (802) 656 - 3330</p>
</footer>

<?php
// Flexslider
if ($path_parts['filename'] == "home") {
    ?>
        <!-- Flexslider jQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')
        </script>

        <!-- FlexSlider -->
        <script defer src="js/flexslider/jquery.flexslider.js"></script>

        <script type="text/javascript">
        $(function() {
            SyntaxHighlighter.all();
        });
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                slideshowSpeed: 3000,
                start: function(slider) {
                    $('body').removeClass('loading');
                }
            });
        });
        </script>

        <!-- Syntax Highlighter -->
        <script type="text/javascript" src="js/flexslider/shCore.js"></script>
        <script type="text/javascript" src="js/flexslider/shBrushXml.js"></script>
        <script type="text/javascript" src="js/flexslider/shBrushJScript.js"></script>

        <!-- Optional FlexSlider Additions -->
        <script src="js/flexslider/jquery.easing.js"></script>
        <script src="js/flexslider/jquery.mousewheel.js"></script>
        <script defer src="js/flexslider/demo.js"></script>
    <?php
} ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
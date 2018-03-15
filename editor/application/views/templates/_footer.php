<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
    }


    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


</script>

</main><!-- #site-content -->

<footer id="site-footer" role="contentinfo" class="footer navbar-fixed-bottom" style="background-color: #e5e5e5">
    <div class="container" >
        <div class="row">

            <strong>Notice:</strong> You will be logged out automatically after 15minutes of inactivity
        </div>
    </div>
</footer><!-- #site-footer -->

<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/script.js') ?>"></script>

</body>
</html>
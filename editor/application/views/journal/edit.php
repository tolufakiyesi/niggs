<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>


        <div class="col-md-12">
            <div class="page-header">
                <h1>Edit your Jounal</h1>
            </div>
            <?= form_open_multipart('') ?>

            <div class="form-group">
                <label for="journaltitle">Short Title</label>
                <input type="text" class="form-control" id="journaltitle" name="journaltitle" value="<?= $journal->title?>" placeholder="Your publication title" required>
                <p class="help-block">Limit 20 words </p>
            </div>
            <div class="form-group">
                <label for="fulltitle">Full Title</label>
                <textarea  class="form-control" id="fulltitle" name="fulltitle" rows="3" ><?= $journal->fulltitle?></textarea>
                <p class="help-block">Limit 1000 characters </p>
            </div>
            <div class="form-group ">
                <label for="journaltype">Journal Type</label>
                <select id="journaltype" name="journaltype" required>
                    <option disabled selected hidden>Select</option>
                    <option value="1" <?= ($journal->journaltype=="1" ? "selected":"") ?>>Original Study</option>
                    <option value="2" <?= ($journal->journaltype=="2" ? "selected":"") ?>>Review</option>
                    <option value="3" <?= ($journal->journaltype=="3" ? "selected":"") ?>>Case Report</option>
                    <option value="4" <?= ($journal->journaltype=="4" ? "selected":"") ?>>Brief Communication</option>
                    <option value="5" <?= ($journal->journaltype=="5" ? "selected":"") ?>>Editorial</option>
                    <option value="6" <?= ($journal->journaltype=="6" ? "selected":"") ?>>Letter to the Editor</option>
                    <option value="7" <?= ($journal->journaltype=="7" ? "selected":"") ?>>In Memoriam</option>
                </select>
            </div>
            <div class="form-group">

                <label>Area of Research Relevance</label>
                <select class="education-level" name="relevance" required>
                    <option disabled hidden selected>Select</option>
                    <option value="astronomy" <?= ($journal->relevance=="astronomy" ? "selected":"") ?>>Astronomy and Planetary Science</option>
                    <option value="atmosphere" <?= ($journal->relevance=="atmosphere" ? "selected":"") ?>>Atmospheric Science</option>
                    <option value="hydro" <?= ($journal->relevance=="hydro" ? "selected":"") ?>>Hydrological Science</option>
                    <option value="ocean" <?= ($journal->relevance=="ocean" ? "selected":"") ?>>Ocean Science</option>
                    <option value="solar" <?= ($journal->relevance=="solar" ? "selected":"") ?>>Solar and Terrestrial Science</option>
                    <option value="solid" <?= ($journal->relevance=="solid" ? "selected":"") ?>>Solid Earth Science</option>

                </select>
            </div>
            <div class="form-group">
                <label for="journalauthors">Authors</label>
                <input type="text" class="form-control" id="journalauthors" name="journalauthors" value="<?=$journal->authors?>" >
                <p class="help-block">Add coauthors to your publication  </p>
                <input type="button" value="&plus;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" >
            </div>
            <div class="form-group">
                <label for="journalabstract">Abstracts</label>
                <textarea class="form-control" id="journalabstract" name="journalabstract" rows="5" ><?= $journal->abstract?></textarea>
                <p class="help-block">Enter the abstract of your manuscript into the text box below. The abstract may be cut and pasted from a word processing program; however, the formatting will be lost.(Less than 1000 characters) </p>
            </div>
            <div class="form-group">
                <label for="journalfile">Upload</label>
                <input type="file" class="form-control" id="journalfile" name="journalfile" accept=".pdf, .doc, .docx" >
                <p class="help-block">Leave Blank if you do not wish to upload a different file. Not larger than 30mb</p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Submit">
            </div>
            </form>
        </div>
    </div><!-- .row -->
</div><!-- .container -->


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Add Authors</h4>
            </div>

            <div class="modal-body">

                <p><label for="coauthor">Coauthor</label><br>
                    <input type="text" class="form-control" id="coauthor" name="coauthor" placeholder="Full Name">


                    <button type="button" type="submit" class="btn btn-primary" id="save" data-dismiss="modal">
                        Add
                    </button>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- $( "input[name='journalauthors']" ).val($("input[name='coauthor']").val()); -->
    </div>
</div>
<script src="<?= base_url('vendor/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/jquery.easing.min.js') ?>"></script>

<script>



    $('#save').click(function() {
        $ath = $( "input[name='journalauthors']" ).val();
        $author = $("input[name='coauthor']").val();
        $toadd = $ath + ", " + $author;
        $( "input[name='journalauthors']" ).val($toadd);


    });


</script>
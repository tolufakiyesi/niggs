<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid" >
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
                <h1>Submit your paper</h1>
                <p> Please <strong><a href="<?=base_url().'download/templates/NGS_Manuscript-Template.doc'?>">download Manuscript Template</a></strong> for details and additional information on how to prepare your manuscript to meet the Journal's requirements.</p>
            </div>

            <?= form_open_multipart() ?>

            <div class="form-group">
                <label for="title">Short Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title')?>" placeholder="Your publication title" required>

            </div>
            <div class="form-group">
                <label for="fulltitle">Full Title</label>
                <textarea  class="form-control" id="fulltitle" name="fulltitle" rows="3" ><?= set_value('fulltitle')?></textarea>

            </div>
            <div class="form-group ">
                <label for="journaltype">Journal Type</label>
                <select id="journaltype" name="journaltype" value="<?= set_value('journaltype')?>"required>
                    <option disabled selected>Select</option>
                    <option value="1">Original Study</option>
                    <option value="2">Review</option>
                    <option value="3">Case Report</option>
                    <option value="4">Brief Communication</option>
                    <option value="5">Editorial</option>
                    <option value="6">Letter to the Editor</option>
                    <option value="4">In Memoriam</option>
                </select>
            </div>
            <div class="form-group">
                <div class="text-danger"><?php echo form_error('relevance'); ?></div>
                <span>Area of Research Relevance</span>
                <select class="education-level" name="relevance" required >
                    <option value=""  disabled selected>Select</option>
                    <option value="astronomy" <?= set_select('relevance', 'astronomy') ?>>Astronomy and Planetary Science</option>
                    <option value="atmosphere" <?= set_select('relevance', 'atmosphere') ?>>Atmospheric Science</option>
                    <option value="hydro" <?= set_select('relevance', 'hydro') ?>>Hydrological Science</option>
                    <option value="ocean" <?= set_select('relevance', 'ocean') ?>>Ocean Science</option>
                    <option value="solar" <?= set_select('relevance', 'solar') ?>>Solar and Terrestrial Science</option>
                    <option value="solid" <?= set_select('relevance', 'solid') ?>>Solid Earth Science</option>

                </select>
            </div>
            <div class="form-group">
                <label for="authors">Authors</label>
                <input type="text" class="form-control" id="authors" name="authors" value="<?= $user->lastname. " " .$user->firstname . " ". $user->othernames?>" >
                <p class="help-block">Add coauthors to your publication  </p>
                <input type="button" value="&plus;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" >
            </div>
            <div class="form-group">
                <label for="abstract">Abstracts</label>
                <textarea class="form-control" id="abstract" name="abstract" rows="5" ><?= set_value('abstract')?></textarea>
                <p class="help-block">Enter the abstract of your manuscript into the text box below. The abstract may be cut and pasted from a word processing program; however, the formatting will be lost.(Less than 1000 characters) </p>
            </div>
            <div class="form-group">
                <label for="journalfile">Upload Manuscript</label>
                <input type="file" class="form-control" id="journalfile" name="journalfile" accept=".doc, .docx" required>
                <p class="help-block">Not larger than 30mb(.doc format only)</p>
            </div>
            <hr>
            <div>
                <label for="suggest_reviewer">Suggest Reviewer</label>
                <input type="button" value="&plus;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#suggested_modal" >
                <div class="text-muted">Note: You can only suggest up to five reviewers</div>
                <table id="suggest_reviewer" class="table table-responsive">
                    <thead>
                        <th>Fullname</th>
                        <th>Affiliation</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </thead>
                </table>
            </div>
            <hr>
            <input type="hidden" name="suggested_name_1" id="suggested_name_1">
            <input type="hidden" name="suggested_affiliation_1" id="suggested_affiliation_1">
            <input type="hidden" name="suggested_email_1" id="suggested_email_1">
            <input type="hidden" name="suggested_phone_1" id="suggested_phone_1">

            <input type="hidden" name="suggested_name_2" id="suggested_name_2">
            <input type="hidden" name="suggested_affiliation_2" id="suggested_affiliation_2">
            <input type="hidden" name="suggested_email_2" id="suggested_email_2">
            <input type="hidden" name="suggested_phone_2" id="suggested_phone_2">

            <input type="hidden" name="suggested_name_3" id="suggested_name_3">
            <input type="hidden" name="suggested_affiliation_3" id="suggested_affiliation_3">
            <input type="hidden" name="suggested_email_3" id="suggested_email_3">
            <input type="hidden" name="suggested_phone_3" id="suggested_phone_3">

            <input type="hidden" name="suggested_name_4" id="suggested_name_4">
            <input type="hidden" name="suggested_affiliation_4" id="suggested_affiliation_4">
            <input type="hidden" name="suggested_email_4" id="suggested_email_4">
            <input type="hidden" name="suggested_phone_4" id="suggested_phone_4">

            <input type="hidden" name="suggested_name_5" id="suggested_name_5">
            <input type="hidden" name="suggested_affiliation_5" id="suggested_affiliation_5">
            <input type="hidden" name="suggested_email_5" id="suggested_email_5">
            <input type="hidden" name="suggested_phone_5" id="suggested_phone_5">
<hr>

            <input type="checkbox" name="confirmation" required>
            <label>By checking this box, I agree that all authors listed on this manuscript are fully aware and have consented to be included.</label>

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
                    <input type="text" class="form-control" id="coauthor" name="coauthor" placeholder="Surname Firstname Middlename">


                    <button type="button" type="submit" class="btn btn-primary" id="save" data-dismiss="modal" style="margin-top: 10px">
                        Add
                    </button>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="suggested_modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Suggest a Reviewer</h4>
            </div>

            <div class="modal-body " style="margin: 10px">


                    <input type="text" class="form-control" id="reviewer_name" name="reviewer_name" placeholder="Surname Firstname Middlename" style="margin: 10px">
                    <input type="text" class="form-control" id="reviewer_affiliation" name="reviewer_affiliation" placeholder="Affiliation" style="margin: 10px">
                    <input type="email" class="form-control" id="reviewer_email" name="reviewer_email" placeholder="Reviewer's Email" style="margin: 10px">
                    <input type="text" class="form-control" id="reviewer_phone" name="reviewer_phone" placeholder="Reviewer's Phone" style="margin: 10px">


                    <button type="button" type="submit" class="btn btn-primary" id="suggest" data-dismiss="modal" style="margin-top: 10px" >
                        Suggest
                    </button>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<script src="<?= base_url('vendor/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('vendor/js/jquery.easing.min.js') ?>"></script>
<script>
    $(document).ready(function () {

        $('#save').click(function () {
            $ath = $("input[name='authors']").val();
            $author = $("input[name='coauthor']").val();
            $toadd = $ath + ", " + $author;
            $("input[name='authors']").val($toadd);


        });
        $('#suggest').click(function () {
            $count = $('tr').length;

            if ($count < 6){
                $('#suggest_reviewer').append("<tr> <td> " +
                    $("input[name='reviewer_name']").val()+  "</td>" +
                    "<td>" +
                    $("input[name='reviewer_affiliation']").val()+  "</td>" +
                    "<td>" +
                    $("input[name='reviewer_email']").val()+  "</td>" +
                    "<td>" +
                    $("input[name='reviewer_phone']").val()+  "</td>" +
                    "</tr>"
                );
                $("#suggested_name_"+$count).val($("input[name='reviewer_name']").val());
                $("#suggested_affiliation_"+$count).val($("input[name='reviewer_affiliation']").val());
                $("#suggested_email_"+$count).val($("input[name='reviewer_email']").val());
                $("#suggested_phone_"+$count).val($("input[name='reviewer_phone']").val());
            }

        });
    });
</script>
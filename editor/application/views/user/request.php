<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>






    <div class="container-fluid">
        <!-- Page -->
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

        <div class="page-header">
            <h1 class="page-title">Priviledge Request</h1>
        </div>
        <div class="page-content">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body container-fluid">
                    <div class="row row-lg">
                        <div class="col-md-12">
                            <div class="example-wrap">

                                <h4 class="page-title">Apply to get account upgraded to Reviewer or Editor </h4>
                                <div class="example table-responsive">



                                    <form id="request-form" action="<?= base_url('user/request') ?>" method="post" role="form" >


                                    <div class="form-group">
                                        <label> Apply for the role of: </label>
                                        <select id="priviledge" name="priviledge" class="form-control">
                                            <option disabled selected>Select</option>
                                            <option value="1" <?= set_select('priviledge','1')?>>Editor</option>
                                            <option value="2" <?= set_select('priviledge','2')?>>Reviewer</option>
                                        </select>

                                    </div>

                                    <div class="form-group">

                                        <label>Area of Research Relevance</label>
                                        <select class="education-level form-control" name="relevance" required >
                                            <option disabled selected>Select</option>
                                            <option value="astronomy" <?= set_select('relevance', 'astronomy') ?>>Astronomy and Planetary Science</option>
                                            <option value="atmosphere" <?= set_select('relevance', 'atmosphere') ?>>Atmospheric Science</option>
                                            <option value="hydro" <?= set_select('relevance', 'hydro') ?>>Hydrological Science</option>
                                            <option value="ocean" <?= set_select('relevance', 'ocean') ?>>Ocean Science</option>
                                            <option value="solar" <?= set_select('relevance', 'solar') ?>>Solar and Terrestrial Science</option>
                                            <option value="solid" <?= set_select('relevance', 'solid') ?>>Solid Earth Science</option>

                                        </select>
                                    </div>
                                      <!--  <label for="priorwork">Show us something you've done recently</label>
                                        <input type="file" class="form-control" id="priorwork" name="priorwork" >
                                        <p class="help-block">Not larger than 30mb</p>
                                        -->
                                        <input type="submit" class="btn btn-default" value="Submit">



                                </form>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




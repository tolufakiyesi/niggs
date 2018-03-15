<!--=============================== Carousel Slider ===========================-->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?= base_url('graphics/img/home.jpg') ?>" alt="NGS">
            <div class="heading">
                <h1>NIGERIAN<br>GEOPHYSICAL<br>SOCIETY</h1>
                <a href="#about" class="page-scroll"><button class="btn btn-primary">Explore</button></a>
            </div>
        </div>

        <div class="item">
            <img src="<?= base_url('graphics/img/astronomy.jpg') ?>" alt="NGS">
            <div class="carousel-caption">
                <h3>Astronomy and Planetary Science</h3>
                <p>A brief explanation of what the field is all about.</p>
            </div>
        </div>

        <div class="item">
            <img src="<?= base_url('graphics/img/atmosphere.jpg') ?>" alt="NGS">
            <div class="carousel-caption">
                <h3>Atmospheric Science</h3>
                <p>A brief explanation of what the field is all about.</p>
            </div>
        </div>

        <div class="item">
            <img src="<?= base_url('graphics/img/hydro.jpg') ?>" alt="NGS">
            <div class="carousel-caption">
                <h3>Hydrological Science</h3>
                <p>A brief explanation of what the field is all about.</p>
            </div>
        </div>

        <div class="item">
            <img src="<?= base_url('graphics/img/ocean2.jpg') ?>" alt="NGS">
            <div class="carousel-caption">
                <h3>Ocean Science</h3>
                <p>A brief explanation of what the field is all about.</p>
            </div>
        </div>

        <div class="item">
            <img src="<?= base_url('graphics/img/solar.jpg') ?>" alt="NGS">
            <div class="carousel-caption">
                <h3>Solar Terrestrial Science</h3>
                <p>A brief explanation of what the field is all about.</p>
            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="fa fa-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="fa fa-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- ===================== End of Carousel Slider =================== -->

<!-- ============================== About  ========================== -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">ABOUT</h2><hr>
                <h3 class="section-subheading">What the Nigeria Geophysical Society is about.</h3>
            </div>
        </div>
        <div class="row text-center about">
            <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary sr-icons"></i>
              <i class="fa fa-question fa-stack-1x fa-inverse"></i>
            </span>
                <h4 class="what-heading">What is NGS?</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni.</p>
            </div>

            <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
            </span>
                <h4 class="vision-heading">Vision</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto.</p>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto.</p>
            </div>

            <div class="col-md-4">
            <span class="fa-stack fa-4x">
              <i class="fa fa-circle fa-stack-2x text-primary sr-icons"></i>
              <i class="fa fa-rocket fa-stack-1x fa-inverse"></i>
            </span>
                <h4 class="what-heading">Mission</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni.</p>
            </div>
        </div>
    </div>
</section>
<!-- =========================== End Of About ======================= -->


<!-- ============================= Executives ======================= -->
<section id="leaders" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">EXECUTIVES OF NGS</h2><hr>
                <h3 class="section-subheading text-muted">Meet our executives with vast knowledge in their field.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e1.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">President</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e2.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">Vice-President</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e3.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">Gen. Sec</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e4.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">Fin. Sec</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e5.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">PRO</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 members-item">
                <div class="excos">
                    <div class="icon-holder">
                        <img src="<?= base_url('graphics/img/excos/e6.jpg') ?>" class="icon img-circle">
                    </div>
                    <h4 class="heading">Firstname LASTNAME<br><span class="title">Ass. Gen. Sec</span></h4>
                    <p class="description">Lorem ipsum dolor sit amet consectetur ipsum dolor sit amet consectetur.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========================== End Of Executives =================== -->

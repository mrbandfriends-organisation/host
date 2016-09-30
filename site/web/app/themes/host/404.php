<?php
    use Roots\Sage\Utils;
?>

<section class="404-page">
    <div class="box box--mega-padding box--fg-sky">
        <div class="container content-404">
            <img class="content-404__image" src="<?php echo get_template_directory_uri() . '/assets/images/404_pause.png'; ?>" alt="" />

            <h1 class="content-404__title">
                Whoopsie!<br />
                That’s an error.
            </h1>

            <p>
                We're sorry something went wrong there. The page your looking for could not be found.
                <br>
                <br>
                Don’t cry. We’ll get you home.
            </p>

            <a href="<?php echo get_home_url(); ?>" class="btn">Homepage</a>
        </div>
    </div>
</section>

<section class="band testimonial-wall">
    <h2 class="vh">What our residents say</h2>

    <div class="grid">
        <div class="gc l1-3 grid grid--vertical-t">
            <article class="testimonial-wall__testimonial grid gc t1-2">
                <aside class="testimonial-wall__image gc t1-2 box box--red">
                    <?php $this->insert('component::bleed-image', [ 'image' => '/_dummy/testimonial-wall/bio-kelly-chan.png' ]); ?>
                </aside>
                <div class="testimonial-wall__content gc t1-2 box box--red-alt box--less-padding">
                    <h3>Kelly Chan<br>Cardiff</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>
            </article>
            <article class="testimonial-wall__testimonial gc t1-2 grid">
                <div class="testimonial-wall__content box box--ink box--less-padding">
                    <h3>Tom Carter<br>Manchester</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
            </article>

        </div>
        <article class="testimonial-wall__testimonial gc l3-6 grid">
            <aside class="testimonial-wall__image gc t3-5 box box--red">
                <?php $this->insert('component::bleed-image', [ 'image' => '/_dummy/testimonial-wall/bio-sara-crosby.png' ]); ?>
            </aside>
            <div class="testimonial-wall__content gc t2-5 box box--ink box--less-padding">
                <h3>Sara Crosby<br>London</h3>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore magna aliqua.
                </p>
            </div>
        </article>
        <article class="testimonial-wall__testimonial gc l1-6 grid grid--vertical-t">
            <aside class="testimonial-wall__image gc t1-2 box box--red">
                <?php $this->insert('component::bleed-image', [ 'image' => '/_dummy/testimonial-wall/bio-pete-williams.png' ]); ?>
            </aside>
            <div class="testimonial-wall__content gc t1-2 box box--red-alt box--less-padding">
                <h3>Pete Williams<br>Nottingham</h3>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </p>
            </div>
        </article>
    </div>

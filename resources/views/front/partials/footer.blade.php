<div id="footer-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Quick Links</h2>

                <?php
                    $links = [
                        ['Home', 'home'],
                        ['About Golf Login', 'about'],
                        ['Features', 'features'],
                        ['Demo', 'demo'],
                        ['Purchase Golf Login', 'purchase'],
                        ['Frequently Asked Questions', 'faqs'],
                        ['Support / Contact', 'support'],
                    ];
                ?>

                <ul id="quick-links">
                    @foreach ($links as $link)
                        <li>
                            <a href="{{ route($link[1]) }}">
                                {{ $link[0] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>

            <div class="col-md-4 col-md-offset-4">
                <h2>Contact Us</h2>
                <p>
                    We're here to help, whether you have questions or just need a little help. We offer many ways to get in touch with us. Feel free to call or text the number below, or send us an email via our <a href="{{ route('contact') }}">contact form</a>.
                </p>
                <p class="top-margin bigger-font">
                    <i class="fa fa-mobile-phone push-right secondaryColor"></i> (803) 392-4400
                </p>
            </div>

        </div>
    </div>
</div>
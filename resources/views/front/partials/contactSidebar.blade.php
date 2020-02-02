<div class="col-md-4">
    <p class="squared-btn">
        Support
    </p>
    <div class="row top-margin">
        <div class="col-md-2 col-sm-2 col-xs-2 center">
            <i class="fa fa-phone primaryColor"></i>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            (803) 392-4400
        </div>
    </div>
    <div class="row half-top-margin">
        <div class="col-md-2 col-sm-2 col-xs-2 center">
            <i class="fa fa-envelope primaryColor"></i>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            {!! Html::email('help@4hourlabs.com') !!} <br>
        </div>
    </div>
    <p class="squared-btn double-margin">
        Questions?
    </p>
    <p>
        <small>
            Be sure to check our FAQ's to see if we've already posted the answer to any questions you may have. <br>
            {!! link_to_route('faqs', 'Click here') !!} to view our FAQ's.
        </small>
    </p>
</div>
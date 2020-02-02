<div class="row double-margin">
    <div class="col-md-6">
        <p class="bigger-font">
            Your information:
        </p>
    </div>
    <div class="col-md-6">
        <p>
            <label class="control-label" for="first">First Name</label>
            <input type="text" name="first" id="first" class="form-control">
        </p>
        <p>
            <label class="control-label" for="last">Last Name</label>
            <input type="text" name="last" id="last" class="form-control">
        </p>
        <p>
            <label class="control-label" for="email">Email Address</label>
            <input type="text" name="email" id="email" class="form-control">
        </p>
        <p>
            <label class="control-label" for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </p>
        <p>
            <label class="control-label" for="club">School / Club Name</label>
            <input type="text" name="club" id="club" class="form-control">
        </p>
        <p>
            <label class="control-label" for="website">School / Club Website</label>
            <input type="text" name="website" id="website" class="form-control">
        </p>
    </div>
</div>
<div class="row double-margin">
    <div class="col-md-6">
        <p class="bigger-font">
            Custom system URL:
        </p>
        <p class="alert alert-info top-margin">
            <strong>Golf Login</strong> allows each team / club to select what's called a vanity URL. In laymen's terms, the vanity URL is what you and others will use to access your Golf Login. For example, the demo account use is our company's Golf Login system, which is www.golflogin.com/4hl. In this case, '4hl' is the vanity URL. If the vanity URL you'd like is not available, our system will let you choose another. There's plenty to go around!
        </p>
    </div>
    <div class="col-md-6">
        <p>
            <label class="control-label" for="vanity_name">Custom Vanity URL</label>
            <input type="text" name="vanity_name" id="vanity_name" class="form-control">
        </p>

        @include('front.partials.customVanityTips')
    </div>
</div>
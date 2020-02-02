@if ($errors->has())
    <div class="alert alert-danger top-margin">
        <p>
            <strong>Please correct the following errors:</strong>
        </p>
        <ul class="half-top-padding">
            <?php
            foreach ($errors->all() as $error) {
                echo '<li>' . $error . '</li>';
            }
            ?>
        </ul>
    </div>
@endif

@if (\Session::has('errorMessage'))
    <div class="alert alert-danger top-margin">
        <p>
            {{ \Session::get('errorMessage') }}
        </p>
    </div>
@endif
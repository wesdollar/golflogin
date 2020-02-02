<p>
    <small>
        Example: Entering <strong>glhs</strong> as the vanity name would make your system accessible from www.golflogin.com/glhs
    </small>
</p>
<ul class="fa-ul small">
    @foreach (['Choose something easy to remember', 'We usually recommend using your school\'s initials', 'The shorter, the better'] as $tip)
        <li><i class="fa-li fa fa-check-square-o"></i>{{ $tip }}</li>
    @endforeach
</ul>
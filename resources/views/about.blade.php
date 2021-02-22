<html>
    <head>

    </head>
    <body>
        <a href="{{ url("contact") }}">Contact Page</a>
        <a href="{{ url("portfolio") }}">Portfolio Page</a>
        @for($i=1; $i <= 10; $i++)
            <p>{{ $i }} I love Bangladesh</p>
        @endfor
    </body>
</html>

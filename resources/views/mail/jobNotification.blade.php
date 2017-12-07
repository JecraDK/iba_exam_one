<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style>

        h1  {
            color: #a7183f;
            font-family: 'Open Sans';
        }

        p   {
            font-family: 'Open Sans';
        }

    </style>


</head>
<body>
    <img src="http://web1.emma613j.iba-abakomp.dk/img/epico_logo.png" height="100px" >
    <h1>{{ $job->headline }}</h1>
    <div>
        <p>Hey there the above job just got posted on the site, <a href="{{ route('jobAd',$job) }}">click this link to see it!</a></p>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Page</title>
</head>
<body>
    <header>
        <h1>{{$apartment->title}}</h1>
    </header>
    <div class="container">
        <ul>
            <li>Title: {{$apartment->title}}</li>
            <li>Category: {{$apartment->category_id}}</li>
            <li>Description: {{$apartment->description}}</li>
            <li>Rooms number: {{$apartment->rooms_number}}</li>
            <li>Beds number: {{$apartment->beds_number}}</li>
            <li>Bathrooms number: {{$apartment->bathrooms_number}}</li>
            <li>Square meters: {{$apartment->square_meters}}</li>
            <li>Address: {{$apartment->address}}</li>
            <h3>Apartments image</h3>
            <li>
                <img src="{{$apartment->featured_img}}" alt="{{$apartment->title}}">
            </li>
        </ul>
    </div>
</body>
</html>
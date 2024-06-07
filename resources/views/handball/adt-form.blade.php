<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADT</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<section class="container">
        <form class="mt-5" method="post" action="{{ route('adt-score.store') }}">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="">Enter Team A Name:</label>
                    <input type="text" class="form-control" name="team_a" placeholder="Enter Team A">
                </div>
                <div class="col">
                    <label for="">Enter Team B Name:</label>
                    <input type="text" class="form-control" name="team_b" placeholder="Enter Team B">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
<div class="mt-5">
    <h1>Matches</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Team A</th>
            <th scope="col">Team B</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($scores as $score)
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $score->team_a }}</td>
            <td>{{ $score->team_b }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('adt.score-board',[$score->id,$score->team_a,$score->team_b]) }}">Controller</a>
                <a class="btn btn-warning" href="{{ route('adt-score.live',$score->id) }}">Live</a>
                <a class="btn btn-danger" href="{{ route('adt-score.destroy',$score->id) }}">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

</section>


</body>
</html>

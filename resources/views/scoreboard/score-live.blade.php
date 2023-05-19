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
    <style>
        .btn-group button:hover {
            background-color: #3e8e41;
        }

        .left-points {
            font-size: 60px;
            color: white;
        }

        .text-outline {
            color: #fff;
            text-shadow: 2px 0 0 #000, 0 -2px 0 #000, 0 2px 0 #000, -2px 0 0 #000;
        }
    </style>
</head>
<body>
<section id="matchs">
    <input id="scoreLiveUrl" type="hidden" value="{{ route('adt-score.liveScore',$adtScore->id) }}">
    <div class="container mt-5">
        <div class="col-lg-12 d-flex">
            <div class="col-lg-6" style="text-align: center;">
                <h1 class="team-a-name text-outline" id="teamAName"></h1>
                <h1 class="left-points text-outline teamAPoint">23</h1>
            </div>

            <div class="col-lg-6" style="text-align: center;">
                <h1 class="team-b-name text-outline">DUM</h1>
                <h1 class="right-score-board left-points text-outline teamBPoint">21</h1>

            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function (){
        var liveScoreUrl = $('#scoreLiveUrl').val();
        setInterval(function(){
            $.ajax({
                type: 'GET',
                url: liveScoreUrl,
                success: function(response) {
                    let teamAName = (response.round == 1) ? response.team_a : response.team_b;
                    let teamBName = (response.round == 2) ? response.team_a : response.team_b;
                    let teamAScore = (response.round == 1) ? response.team_a_score : response.team_b_score;
                    let teamBScore = (response.round == 2) ? response.team_a_score : response.team_b_score;
                    $('.team-a-name').html(teamAName);
                    $('.team-b-name').html(teamBName);
                    $('.teamAPoint').html(teamAScore);
                    $('.teamBPoint').html(teamBScore);
                }
            });
        }, 200);
    });
</script>

</body>
</html>

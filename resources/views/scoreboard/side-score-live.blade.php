<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADT</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #d1d1d1;
            margin: 0;
        }
        .scoreboard {
            width: 600px;
            background: black;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            height: 354px;
        }
        .title {
            background: white;
            color: black;
            display: inline-block;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 18px;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .teams {
            display: flex;
            justify-content: space-between;
            font-size: 50px;
            font-weight: bold;
            margin-top: 50px;
        }
        .scores {
            display: flex;
            justify-content: space-between;
            font-size: 165px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="scoreboard">
        <input id="scoreLiveUrl" type="hidden" value="{{ route('adt-score.liveScore',$matchScores->id) }}">
        <div class="title">71ST SENIOR NATIONAL</div>
        <div class="teams">
            <div class="team-a-name">TEAM 1</div>
            <div class="team-b-name">TEAM 2</div>
        </div>
        <div class="scores">
            <div class="team-a-score">01</div>
            <div class="team-b-score">07</div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function (){
        let liveScoreUrl = $('#scoreLiveUrl').val();
        let numItems = 7;
        let i = 1;
        let j = 1;
        setInterval(function(){
            $.ajax({
                type: 'GET',
                url: liveScoreUrl,
                success: function(response) {
                    $('.team-a-score').text(response.score_a);
                    $('.team-b-score').text(response.score_b);
                    $('.team-a-name').text(response.match_between_teams.team_a);
                    $('.team-b-name').text(response.match_between_teams.team_b);      
                }
            });
        }, 1000);
    });
</script>

</body>
</html>

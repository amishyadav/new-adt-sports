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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Noto Sans", sans-serif;
        }

        img {
            width: 100%;
            height: 100%;
        }

        .main-container {
            min-width: 100vw;
            min-height: 100vh;
            max-width: 100vw;
            max-height: 100vh;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .main-container .container {
            width: 100%;
            height: 100%;
            align-items: end;
            justify-content: center;
            padding-bottom: 60px;
        }

        .main-container .container .right {
            display: flex;
            position: relative;
            right: 57px;
            margin-top: 10px;
        }

        .main-container .container .first,
        .main-container .container .fifth {
            position: relative;
            width: 75px;
            height: 54px;
            z-index: 2;
        }

        .main-container .container .scores .score {
            position: absolute;
            top: 50%;
            left: 40%;
            transform: translate(-50%, -50%);
            font-size: 29px;
            font-weight: 600;
            color: white;
        }

        .main-container .container .fifth .score {
            left: 60%;
        }

        .main-container .container .teams {
            height: 44px;
            width: 350px;
            background: #00032c;
        }

        .main-container .container .fourth {
            position: relative;
            height: 54px;
            width: 350px;
            left: 31px;
        }

        .main-container .container .second .teams {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .main-container .container .second .teams .team-name {
            width: 100%;
            height: 100%;
            display: flex;
            font-size: 22px;
            font-weight: 600;
            align-items: center;
            justify-content: center;
        }


        .main-container .container .fourth .teams {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 10px !important;
        }

        .main-container .container .fourth .teams .team-name {
            width: 100%;
            height: 100%;
            display: flex;
            font-size: 22px;
            font-weight: 600;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .main-container .container .teams {
            height: 44px;
            width: 352px;
            background: #00032c;
        }


    </style>
</head>
<body>
    <input id="scoreLiveUrl" type="hidden" value="{{ route('handball-adt-score.liveScore',$matchScores->id) }}">
<div class="main-container">
    <div class="container">
        <br>
        <div class="right">
            <div class="fourth">
                <div class="teams">
                    <div class="team-name team-a-name">Team 2</div>
                </div>
            </div>
            <div class="fifth scores">
                <img src="{{asset('assets/Images/right_score.svg')}}" alt="" />
                <div class="score team-a-score">00</div>
            </div>
        </div>
        <div class="right">
            <div class="fourth">
                <div class="teams">
                    <div class="team-name team-b-name">Team 2</div>
                </div>
            </div>
            <div class="fifth scores">
                <img src="{{asset('assets/Images/right_score.svg')}}" alt="" />
                <div class="score team-b-score">00</div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        let liveScoreUrl = $('#scoreLiveUrl').val();
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

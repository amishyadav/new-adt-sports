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
        .team_view {
            background: #444;
            padding: 20px;
            border-radius: 30px 30px 0 0;
        }

        .match_time {
            background: purple;
            border-radius: 0 0 20px 20px;
        }

        .main-class-padding {
            padding: 0 226px 0 226px;
        }
        .point-btn {
            padding: 15px 25px 15px 25px;
        }

        .btn-group button {
            background-color: #04AA6D; /* Green background */
            border: 1px solid green; /* Green border */
            color: white; /* White text */
            /*padding: 10px 24px; !* Some padding *!*/
            cursor: pointer; /* Pointer/hand icon */
            /*float: left; !* Float the buttons side by side *!*/
        }

        .leftScoreMinus,.rightScoreMinus {
            color: #fff !important;
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
        .btn-group button:hover {
            background-color: #3e8e41;
        }

        .timer {
            font-size: 80px;
        }

        .right-points {
            margin: -270px 0px 0px 897px;
            position: absolute;
            color: white;
        }

        .left-points {
            font-size: 60px;
            color: white;
        }

        .countdown-time {
            margin: -515px 0px 0px 539px;
            position: absolute;
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
    <form action="{{ route('adt-score.update',$adtScore->id) }}" method="post">
        @csrf
        @method('put')
    <div class="container mt-5">
        <div class="col-lg-12 d-flex">
            <div class="col-lg-6" style="border-right: 1px solid;">
                @if($adtScore->round == 1)
                    @include('scoreboard.team-a-score')
                @else
                    @include('scoreboard.team-b-score')
                @endif
            </div>

            <div class="col-lg-6">
                @if($adtScore->round == 2)
                    @include('scoreboard.team-a-score')
                @else
                    @include('scoreboard.team-b-score')
                @endif
            </div>
        </div>

        @if($adtScore->round == 1)
            <h4 class="half-first mt-5" style="text-align: center;font-weight: 800;">{{$adtScore->round}}st Half</h4>
        @else
            <h4 class="half-second mt-5" style="text-align: center;font-weight: 800;">{{$adtScore->round}}nd Half</h4>
        @endif

        <div class="time-buttons mt-5" style="text-align: center">
            <button class="btn btn-lg btn-success first-half" name="round" value="1" data-action="start">
                1st Half
            </button>
            <button class="btn btn-lg btn-danger second-half" name="round" value="2" data-action="stop">
                2nd Half
            </button>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('adt-score.index') }}" class="btn btn-warning"> Reset</a>
            <a class="btn btn-danger" href="{{ route('adt-score.live',$adtScore->id) }}">Live</a>
        </div>

    </div>

    </form>

</section>

<script>
    $(document).ready(function (){
        let leftTotal = 0;
        let rightTotal = 0;
        $('.leftScoreBtn').on('click', function(){
            let symbol = $(this).attr('data-symbol');
            let point = $(this).attr('data-point');
            let leftTotal = $('.left-score-board').attr('data-team1');
            if(symbol == '+'){
                leftTotal = parseInt(leftTotal) + parseInt(point);
            }
            else{
                leftTotal -= parseInt(point);
            }
            if(leftTotal < 0)
            {
                $('.leftScoreMinus').prop('disabled', true);
                leftTotal = parseInt(score);
                return false;
            }
            else{
                $('.leftScoreMinus').prop('disabled', false);
            }

            if(leftTotal < 10) {
                totalScore = ('0'+leftTotal).slice(-2)
            }
            else
            {
                totalScore = leftTotal
            }

            $('.left-score-board').text(totalScore).attr('data-team1',totalScore);
            $('#teamAScore').attr('value',totalScore);
        });


        $('.rightScoreBtn').on('click', function(){
            let symbol = $(this).attr('data-symbol');
            let point = $(this).attr('data-point');
            let rightTotal = $('.right-score-board').attr('data-team2');
            if(symbol == '+'){
                rightTotal = parseInt(rightTotal) + parseInt(point);
            }
            else{
                rightTotal -= parseInt(point);
            }

            if(rightTotal < 0)
            {
                $('.rightScoreMinus').prop('disabled', true);
                rightTotal = parseInt(score);
                return false;

            }
            else{
                $('.rightScoreMinus').prop('disabled', false);
            }

            if(rightTotal < 10) {
                totalScore = ('0'+rightTotal).slice(-2)
            }
            else
            {
                totalScore = rightTotal
            }

            $('.right-score-board').text(totalScore).attr('data-team2',totalScore);
            $('#teamBScore').attr('value',totalScore);
        });

// Stopwatch time code
//         const btnStartElement = document.querySelector('[data-action="start"]');
//         const btnStopElement = document.querySelector('[data-action="stop"]');
//         const btnResetElement = document.querySelector('[data-action="reset"]');
//         const minutes = document.querySelector('.minutes');
//         const seconds = document.querySelector('.seconds');
//         let timerTime = 0;
//         let interval;
//
//
//         const start = () => {
//             isRunning = true;
//             interval = setInterval(incrementTimer, 1000)
//         }
//
//         const stop = () => {
//             isRunning = false;
//             clearInterval(interval);
//         }
//
//         const reset = () => {
//             minutes.innerText = '00';
//             seconds.innerText = '00';
//             timerTime = 00;
//         }
//
//         const pad = (number) => {
//             return (number < 10) ? '0' + number : number;
//         }
//
//         const incrementTimer = () => {
//             timerTime++;
//
//             const numberMinutes = Math.floor(timerTime / 60);
//             const numberSeconds = timerTime % 60;
//
//             minutes.innerText = pad(numberMinutes);
//             seconds.innerText = pad(numberSeconds);
//         }
//
//         btnStartElement.addEventListener('click', startTimer = () => {
//             $('.start-timer').prop('disabled',true)
//             $('.stop-timer').prop('disabled',false)
//             start();
//         });
//
//         btnStopElement.addEventListener('click', stopTimer = () => {
//             $('.stop-timer').prop('disabled',true)
//             $('.start-timer').prop('disabled',false)
//             stop();
//         });
//
//         btnResetElement.addEventListener('click', stopTimer = () => {
//             $('.start-timer').prop('disabled',false)
//             $('.stop-timer').prop('disabled',false)
//             reset();
//         });
    });
</script>

</body>
</html>

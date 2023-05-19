<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="container px-lg-0">
        <div class="row m-auto d-flex justify-content-center mt-5">
            {{--            <img src="{{ asset('score.jpg') }}" alt="">--}}
            {{--            <div data-wow-duration="1s" class="wow flipInX col-lg-12 mt-5" style="visibility: visible; animation-duration: 1s; animation-name: flipInX;">--}}
            {{--                <div class="team_view d-flex flex-wrap justify-content-center">--}}
            {{--                    <div class="team_one d-flex  flex-wrap justify-content-center">--}}
            {{--                        <h4 class="m-auto text-white">Istanbul Sports</h6>--}}
            {{--                    </div>--}}
            {{--                    <div class=" m-auto d-flex">--}}
            {{--                        <div class="vs">--}}
            {{--                            <div class="card text-center" style="width: 3rem; border-right: 0px;">--}}
            {{--                                <h1 class="left-score-board" data-team1="00">00</h1>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="vs">--}}
            {{--                            <div class="card text-center" style="width: 1rem; border-right: 0px; border-left: 0px;">--}}
            {{--                                <h1 class="">:</h1>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="vs">--}}
            {{--                            <div class="card text-center" style="width: 3rem; border-left: 0px;">--}}
            {{--                                <h1 class="right-score-board">00</h1>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <div class="team_one d-flex flex-wrap justify-content-center">--}}
            {{--                        <h4 class="m-auto text-white">United Fs Club</h6>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="match_time d-flex flex-wrap text-center justify-content-center ">--}}
            {{--                    <h6 id="current-time"><i class="fa-solid fa-calendar-days"></i> May 21, 2022 - 16:00</h6>--}}

            {{--                </div>--}}

            {{--            </div>--}}
        </div>
    </div>




    <div class="container mt-5">
        <div class="col-lg-12 d-flex">
            <div class="col-lg-6" style="border-right: 1px solid;">
                <h1 class="team-a-name text-outline" style="text-align: center;">Team A</h1>
                <h1 class="left-score-board left-points text-outline" data-team1="00" style="text-align: center">00</h1>
                <div class="d-flex btn-group">
                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="1" disabled>-1</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="1"
                            data-symbol="+">+1
                    </button>

                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="2" disabled>-2</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="2"
                            data-symbol="+">+2
                    </button>

                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="3" disabled>-3</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="3"
                            data-symbol="+">+3
                    </button>

                </div>
                <div class="d-flex btn-group">
                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="4" disabled>-4</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="4"
                            data-symbol="+">+4
                    </button>

                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="5" disabled>-5</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="5"
                            data-symbol="+">+5
                    </button>

                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="6" disabled>-6</button>
                    <button class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="6"
                            data-symbol="+">+6
                    </button>

                </div>
            </div>

            <div class="col-lg-6">
                <h1 class="team-b-name text-outline" style="text-align: center;">Team B</h1>
                <h1 class="right-score-board left-points text-outline" style="text-align: center">00</h1>
                <div class="d-flex btn-group">
                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="1" disabled>-1</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="1"
                            data-symbol="+">+1</button>

                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="2" disabled>-2</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="2"
                            data-symbol="+">+2</button>

                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="3" disabled>-3</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="3"
                            data-symbol="+">+3</button>

                </div>
                <div class="d-flex btn-group">
                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="4" disabled>-4</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="4"
                            data-symbol="+">+4</button>

                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="5" disabled>-5</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="5"
                            data-symbol="+">+5</button>

                    <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn ml-5" id="" data-symbol="-" data-point="6" disabled>-6</button>
                    <button class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="6"
                            data-symbol="+">+6</button>

                </div>
            </div>
        </div>


        {{--        <div>--}}
        {{--            <div class="text-center">--}}
        {{--                <div class="timer">--}}
        {{--    <span class="minutes d-none">--}}
        {{--      00--}}
        {{--    </span>--}}
        {{--                    <h3 class="seconds countdown-time">--}}
        {{--                        00--}}
        {{--                    </h3>--}}
        {{--                </div>--}}
        {{--                <div class="time-buttons mt-5">--}}
        {{--                    <button class="btn btn-lg btn-success start-timer" data-action="start">--}}
        {{--                        Start--}}
        {{--                    </button>--}}
        {{--                    <button class="btn btn-lg btn-danger stop-timer" data-action="stop">--}}
        {{--                        Stop--}}
        {{--                    </button>--}}
        {{--                    <button class="btn btn-lg btn-link btn-block reset-timer" data-action="reset">--}}
        {{--                        Reset--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <h4 class="half-first mt-5" style="text-align: center;font-weight: 800;">1st Half</h4>
        <h4 class="half-second d-none mt-5" style="text-align: center;font-weight: 800;">2nd Half</h4>

        <div class="time-buttons mt-5" style="text-align: center">
            <button class="btn btn-lg btn-success first-half" data-action="start">
                1st Half
            </button>
            <button class="btn btn-lg btn-danger second-half" data-action="stop">
                2nd Half
            </button>
        </div>

        <form class="mt-5">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" id="teamA" placeholder="Enter Team A">
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="teamB" placeholder="Enter Team B">
                </div>
            </div>
        </form>

    </div>

</section>

<script>
    $(document).ready(function (){
        $("#teamA").keypress(function(){
            $(".team-a-name").text(this.value);
        });
        $("#teamB").keypress(function(){
            $(".team-b-name").text(this.value);
        });

        let leftTotal = 0;
        let rightTotal = 0;
        $('.leftScoreBtn').on('click', function(){
            let symbol = $(this).attr('data-symbol');
            let point = $(this).attr('data-point');
            let score = $('.left-score-board').text();
            console.log(point)
            console.log(symbol)
            if(symbol == '+'){
                leftTotal += parseInt(point);
            }
            else{
                leftTotal -= parseInt(point);
            }
            console.log(leftTotal)
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

            $('.left-score-board').text(totalScore)

        });


        $('.rightScoreBtn').on('click', function(){
            let symbol = $(this).attr('data-symbol');
            let point = $(this).attr('data-point');
            let score = $('.right-score-board').text();
            if(symbol == '+'){
                rightTotal += parseInt(point);
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

            $('.right-score-board').text(totalScore)

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

        $('.first-half').on('click', function (){
            $('.half-first').removeClass('d-none')
            $('.half-second').addClass('d-none')
        })
        $('.second-half').on('click', function (){
            $('.half-second').removeClass('d-none')
            $('.half-first').addClass('d-none')
        })
    });
</script>

</body>
</html>

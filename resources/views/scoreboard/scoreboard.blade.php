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
    </style>
</head>
<body>
<section id="matchs" class="main-class-padding">
    <div class="container px-lg-0">
        <div class="row m-auto d-flex justify-content-center mt-5">

            <div data-wow-duration="1s" class="wow flipInX col-lg-12 mt-5" style="visibility: visible; animation-duration: 1s; animation-name: flipInX;">
                <div class="team_view d-flex flex-wrap justify-content-center">
                    <div class="team_one d-flex  flex-wrap justify-content-center">
                        <h4 class="m-auto text-white">Istanbul Sports</h6>
                    </div>
                    <div class=" m-auto d-flex">
                        <div class="vs">
                            <div class="card text-center" style="width: 3rem; border-right: 0px;">
                                <h1 class="left-score-board" data-team1="00">00</h1>
                            </div>
                        </div>
                        <div class="vs">
                            <div class="card text-center" style="width: 1rem; border-right: 0px; border-left: 0px;">
                                <h1 class="">:</h1>
                            </div>
                        </div>
                        <div class="vs">
                            <div class="card text-center" style="width: 3rem; border-left: 0px;">
                                <h1 class="right-score-board">00</h1>
                            </div>
                        </div>
                    </div>
                    <div class="team_one d-flex flex-wrap justify-content-center">
                        <h4 class="m-auto text-white">United Fs Club</h6>
                    </div>
                </div>
                <div class="match_time d-flex flex-wrap text-center justify-content-center ">
                    <h6 id="current-time"><i class="fa-solid fa-calendar-days"></i> May 21, 2022 - 16:00</h6>

                </div>

            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="col-lg-12 d-flex">
            <div class="col-lg-6">
                @for($i = 0;$i<5;$i++)
                    <button class="btn btn-primary leftScoreBtn mt-3" id="leftScorePlus" data-point="{{ $i }}"
                            data-symbol="+">
                        {{ $i }}</button>
                    <button class="btn btn-primary leftScoreBtn leftScoreMinus mt-3" id="" data-symbol="-" data-point="{{ $i }}" disabled>-</button>
                    <br>
                @endfor
            </div>

            <div class="col-lg-6">
                <div class="float-right">
                    {{--            <button class="btn btn-primary rightScoreBtn" id="rightScorePlus">+</button>--}}
                    {{--            <button class="btn btn-primary rightScoreBtn" id="rightScoreMinus" disabled>-</button>--}}
                    @for($i = 0;$i<5;$i++)
                        <button class="btn btn-primary rightScoreBtn mt-3" data-point="{{ $i }}"
                                data-symbol="+">
                            {{ $i }}</button>
                        <button class="btn btn-primary rightScoreBtn rightScoreMinus mt-3" id="" data-symbol="-" data-point="{{ $i }}" disabled>-</button>
                        <br>
                    @endfor
                </div>
            </div>
        </div>





    </div>

</section>

<script>
    $(document).ready(function (){
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

        function setCurrentTime() {
            var myDate = new Date();

            let daysList = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            let monthsList = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Aug', 'Oct', 'Nov', 'Dec'];


            let date = myDate.getDate();
            let month = monthsList[myDate.getMonth()];
            let year = myDate.getFullYear();
            let day = daysList[myDate.getDay()];

            let today = `${date} ${month} ${year}, ${day}`;

            let amOrPm;
            let twelveHours = function() {
                if (myDate.getHours() > 12) {
                    amOrPm = 'PM';
                    let twentyFourHourTime = myDate.getHours();
                    let conversion = twentyFourHourTime - 12;
                    return `${conversion}`

                } else {
                    amOrPm = 'AM';
                    return `${myDate.getHours()}`
                }
            };
            let hours = twelveHours();
            let minutes = myDate.getMinutes();
            let seconds = myDate.getSeconds();

            let currentTime = `${hours}:${minutes}:${seconds} ${amOrPm}`;

            document.getElementById('current-time').innerText = today + ' ' + currentTime
        }

// setInterval(function() {
//     $('.date-time').text( setCurrentTime());
//   setCurrentTime();
// }, 1000);
    });
</script>

</body>
</html>

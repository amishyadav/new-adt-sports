
<html lang="en">
<head>
    <title>ADT Score Board</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        /* MAIN */
        body {
            margin: 0;
            padding: 0;

        }

        /* Typography */

        @font-face {
            font-family: CursedTimer;
            src: url(https://www.fontspace.com/cursed-timer-ulil-font-f29411);
        }

        .team {
            font-size: 80px;
            color: black;
            margin: auto;
            background-color: #72e1ae;
        }

        .score-box {
            font-size: 80px;
            font-family: CursedTimer;
            color: white;
            background: #004aad;
            width: 300px;
            margin-top: 16px;
        }

        .plus-score {
            font-size: 20px;
            padding: 20px;
            background-color: #72e1ae;
            color: black;
            width: 160px;
        }

        .counts {
            font-size: 60px;
            background-color: #0a53be;
            /*color: black;*/
        }

        p{
            margin: 20px;
            padding: 0px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            color: aliceblue;
        }
        /* Layouts */

        .rows-score {
            display: flex;
            margin: auto;
            text-align: center;
        }

        .left-score {
            padding: 5px 20px;
            align-items: center;
        }

        .right-score {
            padding: 5px 20px;
            align-items: center;
        }

        .score-buttons {
            width: 500px;
            display: flex;
            text-align: center;
            margin-top: 10px;
        }
        .counters {
            margin: 100px 20px;

            .form-control:focus {
                background-color: #72e1ae !important;
            }
        }

        .btn {
            padding: 10px;
            margin: 5px 0px;
            width: 100px;
        }

        .new-game button{
            width: 200px;
            margin: 50px 0px;
            font-size: 30px;
        }

        button {
            color: white;
            border: white 2px solid;
            background: #1B244A;
            cursor: pointer;
        }
        .other-points {
            display: flex;
            justify-content: center;
        }
        .winner-btn {
            width: 200px;
            height: 50px;
        }
        .light-green {
            background-color: #72e1ae;
        }
        .timer-thirty {
            margin-top: 10px;
        }
        .timer-thirty > svg {
            width: 200px;
            height: 200px;
        }
        .timer-thirty > svg > circle {
            fill: none;
            stroke-opacity: 0.3;
            stroke: #0d6efd;
            stroke-width: 10;
            transform-origin: center center;
            transform: rotate(-90deg);
        }
        .timer-thirty > svg > circle + circle {
            stroke-dasharray: 1;
            stroke-dashoffset: 1;
            stroke-linecap: round;
            stroke-opacity: 1;
        }
        .timer-thirty.animatable > svg > circle + circle {
            transition: stroke-dashoffset 0.3s ease;
        }
        .timer-thirty > svg > text {
            font-size: 2rem;
        }
        .timer-thirty > svg > text + text {
            font-size: 1rem;
        }
        .pointer-cursor {
            cursor: pointer;
        }
        .remain-player {
            border-radius: 50%;
            height: 50px;
            width: 50px;
        }
    </style>
</head>
<body>
<main>
    <div class="rows-score">
        <!-- left board -->
        <div class="right-score">
            <h1 class="team">{{ $matchScores->matchBetweenTeams->team_a }}</h1>
            <div class="d-flex align-items-center">
                <div class="score-box">
                    <div id="score-left">{{ $matchScores->score_a }}</div>
                </div>
                <button class="winner-btn">Winner</button>
            </div>
            <div class="score-buttons">
                <button class="plus-score" onclick="add1ScoreLeft()">+ 1</button>
                <button class="plus-score" onclick="add2ScoreLeft()">+ 2</button>
                <button class="plus-score" onclick="add3ScoreLeft()">+ 3</button>
                <button class="plus-score" onclick="add4ScoreLeft()">+ 4</button>
            </div>
            <div class="score-buttons align-items-center">
                <button class="plus-score" onclick="sub1ScoreLeft()">-</button>
                @for($i = 1; $i<=7;$i++)
                    <button class="remain-player" onclick="player{{$i}}RemainLeft()">{{$i}}</button>
                @endfor
            </div>
        </div>
        <!-- left board -->

        <!-- mid row -->
        <div class="counters">
            <div class="d-flex">
                <div class="left-timer-thirty timer-thirty animatable cursor-pointer">
                    <svg class="pointer-cursor" id="startStopTimer" onclick="startStopLeftTimer()">
                        <circle cx="50%" cy="50%" r="90"/>
                        <circle cx="50%" cy="50%" r="90" pathLength="1" />
                        <text x="100" y="100" text-anchor="middle"><tspan id="timeLeft">30</tspan></text>
                        <text x="100" y="120" text-anchor="middle">seconds</text>
                    </svg>
                    <button class="btn btn-dark" onclick="resetThirtyTimerLeft()">Clear</button>
                </div>

                <div class="right-timer-thirty timer-thirty animatable cursor-pointer">
                    <svg class="pointer-cursor" id="startStopTimer" onclick="startStopRightTimer()">
                        <circle cx="50%" cy="50%" r="90"/>
                        <circle cx="50%" cy="50%" r="90" pathLength="1" />
                        <text x="100" y="100" text-anchor="middle"><tspan id="timeRight">30</tspan></text>
                        <text x="100" y="120" text-anchor="middle">seconds</text>
                    </svg>
                    <button class="btn btn-dark" onclick="resetThirtyTimerRight()">Clear</button>
                </div>
            </div>

            <div class="d-flex">
                <select class="light-green form-control" id="matchPart">
                    <option value="first_half" {{ $matchScores->match_part == 'first_half' ? 'selected' : '' }} >First Half</option>
                    <option value="second_half" {{ $matchScores->match_part == 'second_half' ? 'selected' : '' }}>Second Half</option>
                </select>
                <select class="light-green form-control" name="" id="">
                    <option value="">20:00</option>
                    <option value="">40:00</option>
                </select>
            </div>
            <div class="timer">
                <p class="counts" id="timer_count">10:00</p>
                <div class="timer-buttons">
                    <button class="btn btn-primary" id="start_timer" onclick="startTimer()">Start</button>
                    <button class="btn btn-primary" id="pause_timer" onclick="pauseTimer()">Pause</button>
                    <button class="btn btn-primary" id="reset_timer" onclick="resetTimer()">Reset</button>
                    <!-- <button class="btn">Resume</button> -->
                </div>
            </div>

        </div>
        <!-- mid row -->

        <!-- right board -->
        <div class="left-score">
            <h1 class="team">{{ $matchScores->matchBetweenTeams->team_b }}</h1>
            <div class="d-flex align-items-center">
                <button class="winner-btn">Winner</button>
                <div class="score-box">
                    <div id="score-right">{{ $matchScores->score_b }}</div>
                </div>

            </div>
            <div class="score-buttons">
                <button class="plus-score" onclick="add1ScoreRight()">+ 1</button>
                <button class="plus-score" onclick="add2ScoreRight()">+ 2</button>
                <button class="plus-score" onclick="add3ScoreRight()">+ 3</button>
                <button class="plus-score" onclick="add4ScoreRight()">+ 4</button>
            </div>
            <div class="score-buttons align-items-center">
                <button class="plus-score" onclick="sub1ScoreRight()">-</button>
                @for($i = 1; $i<=7;$i++)
                    <button class="remain-player" onclick="player{{$i}}RemainRight()">{{$i}}</button>
                @endfor
            </div>
        </div>
        <!-- right board -->

    </div>
    <div class="other-points">
        <div>
            <button class="plus-score" onclick="add2ScoreLeft()">Super Tackle</button>
            <button class="plus-score" onclick="add2ScoreLeft()">Super Raid</button>
            <button class="plus-score" onclick="add3ScoreLeft()">Do or Die</button>
            <button class="plus-score" onclick="add4ScoreLeft()">All Out</button>
        </div>
    </div>

{{--    <div class="new-game other-points">--}}
{{--        <button class="btn btn-warning" onclick="newGame()">New Game</button>--}}
{{--    </div>--}}
</main>
<script>
    // $(document).ready(function(){
    let scoreLeftElementDisplay = document.getElementById('score-left');
    let scoreRightElementDisplay = document.getElementById('score-right');

    let scoreLeft = {{ $matchScores->score_a }};
    let scoreRight = {{ $matchScores->score_b }};

    // adding score to left
    function add1ScoreLeft() {
        let score = scoreLeft += 1;
        scoreLeftElementDisplay.textContent = score;
        submitData(score,'left');
    }

    function add2ScoreLeft() {
        let score = scoreLeft += 2;
        scoreLeftElementDisplay.textContent = score;
        submitData(score,'left');
    }

    function add3ScoreLeft() {
        let score = scoreLeft += 3;
        scoreLeftElementDisplay.textContent = score;
        submitData(score,'left');
    }

    function add4ScoreLeft() {
        let score = scoreLeft += 4;
        scoreLeftElementDisplay.textContent = score;
        submitData(score,'left');
    }

    // adding score right
    function add1ScoreRight() {
        let score = scoreRight += 1;
        scoreRightElementDisplay.textContent = score;
        submitData(score,'right');
    }

    function add2ScoreRight() {
        let score = scoreRight += 2;
        scoreRightElementDisplay.textContent = score;
        submitData(score,'right');
    }

    function add3ScoreRight() {
        let score = scoreRight += 3;
        scoreRightElementDisplay.textContent = score;
        submitData(score,'right');
    }

    function add4ScoreRight() {
        let score = scoreRight += 4;
        scoreRightElementDisplay.textContent = score;
        submitData(score,'right');
    }

    function player1RemainLeft() {
        submitData(1,'playerRemainLeft');
    }

    function player2RemainLeft() {
        submitData(2,'playerRemainLeft');
    }

    function player3RemainLeft() {
        submitData(3,'playerRemainLeft');
    }

    function player4RemainLeft() {
        submitData(4,'playerRemainLeft');
    }

    function player5RemainLeft() {
        submitData(5,'playerRemainLeft');
    }

    function player6RemainLeft() {
        submitData(6,'playerRemainLeft');
    }

    function player7RemainLeft() {
        submitData(7,'playerRemainLeft');
    }

    function player1RemainRight() {
        submitData(1,'playerRemainRight');
    }

    function player2RemainRight() {
        submitData(2,'playerRemainRight');
    }

    function player3RemainRight() {
        submitData(3,'playerRemainRight');
    }

    function player4RemainRight() {
        submitData(4,'playerRemainRight');
    }

    function player5RemainRight() {
        submitData(5,'playerRemainRight');
    }

    function player6RemainRight() {
        submitData(6,'playerRemainRight');
    }

    function player7RemainRight() {
        submitData(7,'playerRemainRight');
    }

    function sub1ScoreLeft() {
        let score = scoreLeft -= 1;
        scoreLeftElementDisplay.textContent = score;
        submitData(score,'left');
    }

    function sub1ScoreRight() {
        let score = scoreRight -= 1;
        scoreRightElementDisplay.textContent = score;
        submitData(score,'right');
    }

    $('#matchPart').on('change', function() {
        submitData(this.value,'match_part');
    });

    // Function for countdown timer
    let countdownTimerElementDisplay = document.getElementById('timer_count');

    const startingMinutes = 10;
    let time = startingMinutes * 60;

    let isPaused = true;

    var timer = setInterval(() => {
        if(!isPaused) {
            const minute = Math.floor(time / 60);
            let seconds = time % 60;

            seconds = seconds < 10 ? '0' + seconds : seconds;

            countdownTimerElementDisplay.textContent = `${minute}:${seconds}`;
            time--;
        }
    }, 1000);

    function startTimer(){
        isPaused = false;
    }

    function pauseTimer(){
        isPaused = true;
    }

    function resetTimer() {
        countdownTimerElementDisplay.textContent = '10:00';
        time = startingMinutes * 60;
        isPaused = true;
    }

    // new game refresh
    function newGame() {
        scoreLeft = 0;
        scoreRight = 0;

        // for timer
        time = startingMinutes * 60;
        isPaused = true;


        scoreLeftElementDisplay.textContent = scoreLeft;
        scoreRightElementDisplay.textContent = scoreRight;
        countdownTimerElementDisplay.textContent = '10:00';
    }

    // 30 Seconds timer code

    let leftTime = 30;
    let rightTime = 30;
    let leftTimerThirty = document.getElementById('timeLeft');
    let rightTimerThirty = document.getElementById('timeRight');
    let leftTimerRunning = false;
    let rightTimerRunning = false;
    let leftCountdownTimer,rightCountdownTimer;

    function runTimerLeft(timerElement) {
        const timerCircle = timerElement.querySelector('svg > circle + circle');
        timerElement.classList.add('animatable');
        // timerCircle.style.strokeDashoffset = 1;

        leftCountdownTimer = setInterval(function(){
            leftTimerRunning = true;
                const timeRemaining = leftTime--;
                const normalizedTime = (30 - timeRemaining) / 30;
                timerCircle.style.strokeDashoffset = normalizedTime;
                leftTimerThirty.innerHTML = timeRemaining;

                if(timeRemaining == 0) {
                    clearInterval(leftCountdownTimer);
                    timerElement.classList.remove('animatable');
                    leftTime = 30;
                    leftTimerRunning = false;
                    leftTimerThirty.textContent = '30';
                    return false
                }
        }, 1000);
    }

    function runTimerRight(timerElement) {
        const timerCircle = timerElement.querySelector('svg > circle + circle');
        timerElement.classList.add('animatable');
        // timerCircle.style.strokeDashoffset = 1;

        rightCountdownTimer = setInterval(function(){
            rightTimerRunning = true;
            const timeRemaining = rightTime--;
            const normalizedTime = (timeRemaining - 30) / 30;
            timerCircle.style.strokeDashoffset = normalizedTime;
            rightTimerThirty.innerHTML = timeRemaining;

            if(timeRemaining == 0) {
                clearInterval(rightCountdownTimer);
                timerElement.classList.remove('animatable');
                rightTime = 30;
                rightTimerRunning = false;
                rightTimerThirty.textContent = '30';
                return false
            }
        }, 1000);
    }



    function startStopLeftTimer() {
        if(leftTimerRunning) {
            clearInterval(leftCountdownTimer);
            leftTimerRunning = false;
            return false;
        }

        runTimerLeft(document.querySelector('.left-timer-thirty'));
    }
    function startStopRightTimer() {
        if(rightTimerRunning) {
            clearInterval(rightCountdownTimer);
            rightTimerRunning = false;
            return false;
        }

        runTimerRight(document.querySelector('.right-timer-thirty'));
    }

    function resetThirtyTimerLeft() {
        let timerReset = document.getElementById('timeLeft');
        timerReset.textContent = '30';
        leftTime = 30;
        document.querySelector('.left-timer-thirty').classList.remove('animatable');
        const timerCircle = document.querySelector('.left-timer-thirty').querySelector('svg > circle + circle');
        timerCircle.style.strokeDashoffset = 0;
        leftTimerRunning = false;
        clearInterval(leftCountdownTimer);
    }
    function resetThirtyTimerRight() {
        let timerReset = document.getElementById('timeRight');
        timerReset.textContent = '30';
        rightTime = 30;
        document.querySelector('.right-timer-thirty').classList.remove('animatable');
        const timerCircle = document.querySelector('.right-timer-thirty').querySelector('svg > circle + circle');
        timerCircle.style.strokeDashoffset = 0;
        rightTimerRunning = false;
        clearInterval(rightCountdownTimer);
    }


    function submitData(data,type) {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        let formData;
        if(type == 'left') {
            formData = {
                score_a: data,
            };
        }
        if(type == 'right') {
            formData = {
                score_b: data,
            };
        }

        if(type == 'playerRemainLeft') {
            formData = {
                player_left_a: data,
            };
        }

        if(type == 'playerRemainRight') {
            formData = {
                player_left_b: data,
            };
        }

        if(type == 'match_part') {
            formData = {
                match_part: data,
            };
        }
        console.log(formData,'formData')
        $.ajax({
            url: "{{ route('adt.score-board.store',$matchScores->match_between_team_id) }}",
            method: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response){
                console.log(response);
            },
            error: function(xhr, status, error){

                console.error(xhr.responseText);
            }
        });
    }

        {{--$('#your-form-id').on('submit', function(e){--}}
        {{--    e.preventDefault();--}}
        {{--    var formData = $(this).serialize();--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('submit.form') }}",--}}
        {{--        method: "POST",--}}
        {{--        data: formData,--}}
        {{--        success: function(response){--}}
        {{--            // Handle success response--}}
        {{--            console.log(response);--}}
        {{--        },--}}
        {{--        error: function(xhr, status, error){--}}
        {{--            // Handle error response--}}
        {{--            console.error(xhr.responseText);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    // });
</script>
</body>
</html>

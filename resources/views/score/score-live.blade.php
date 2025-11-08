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
        /*.btn-group button:hover {*/
        /*    background-color: #3e8e41;*/
        /*}*/

        /*.left-points {*/
        /*    font-size: 60px;*/
        /*    color: white;*/
        /*}*/

        /*.text-outline {*/
        /*    color: #fff;*/
        /*    text-shadow: 2px 0 0 #000, 0 -2px 0 #000, 0 2px 0 #000, -2px 0 0 #000;*/
        /*}*/

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
            display: flex;
            align-items: end;
            justify-content: center;
            padding-bottom: 60px;
        }

        .main-container .container .left {
            display: flex;
            position: relative;
            right: -55px;
        }
        .main-container .container .right {
            display: flex;
            position: relative;
            right: 57px;
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
            background: #FFD3BB;
        }

        .main-container .container .second {
            position: relative;
            height: 54px;
            width: 350px;
            left: -31px;
        }

        .main-container .container .second .team-players {
            height: 20px;
            display: flex;
            position: absolute;
            right: 60px;
            bottom: -21px;
            gap: 10px;
        }

        .main-container .container .fourth .team-players {
            height: 20px;
            display: flex;
            position: absolute;
            right: 75px;
            bottom: -21px;
            gap: 10px;
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

        .main-container .container .second .teams .progress {
            height: 4.5px;
            width: 100%;
            position: absolute;
            background: red;
            bottom: 0px;
        }

        .main-container .container .third {
            height: 83px;
            width: 152px;
            z-index: 3;
            position: relative;
            top: 13px;
        }

        .main-container .container .third .bottom {
            height: 38px;
            width: 220px;
            position: absolute;
            bottom: -19px;
            z-index: -1;
            left: -31px;
        }

        .main-container .container .third .halfs {
            color: white;
            font-size: 12px;
            font-weight: 500;
            position: absolute;
            bottom: -20px;
            left: 9%;
            border-radius: 10px;
            padding: 3px;
            background-image: radial-gradient(circle at center, rgba(26, 177, 63, 0) 5%, #1AB13F 50%);
            z-index: 9999;
        }

        .main-container .container .fourth .teams {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        .main-container .container .fourth .teams .team-name {
            width: 100%;
            height: 100%;
            display: flex;
            font-size: 22px;
            font-weight: 600;
            align-items: center;
            justify-content: center;
        }

        .main-container .container .fourth .teams .progress {
            height: 4.5px;
            width: 100%;
            position: absolute;
            background: red;
            bottom: 0px;
        }

        /*.margin-btn {*/
        /*    margin-left: 5px !important;*/
        /*    margin-right: 5px !important;*/
        /*}*/

    </style>
</head>
<body>
{{--<section id="matchs">--}}
{{--    <input id="scoreLiveUrl" type="hidden" value="{{ route('adt-score.liveScore',$matchScores->id) }}">--}}
{{--    <div class="container mt-5">--}}
{{--        <div class="col-lg-12 d-flex">--}}
{{--            <div class="col-lg-6" style="text-align: center;">--}}
{{--                <h1 class="team-a-name text-outline" id="teamAName"></h1>--}}
{{--                <h1 class="left-points text-outline teamAPoint">23</h1>--}}
{{--            </div>--}}

{{--            <div class="col-lg-6" style="text-align: center;">--}}
{{--                <h1 class="team-b-name text-outline">DUM</h1>--}}
{{--                <h1 class="right-score-board left-points text-outline teamBPoint">21</h1>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<div class="main-container">
    <div class="container">
        <div class="left">
            <div class="first scores">
                <img src="{{asset('assets/Images/left_score.svg')}}" alt="" />
                <div class="score team-a-score" id="teamScoreLeft">00</div>
            </div>
            <div class="second team-panel">
                <div class="teams">
                    <div class="team-name team-a-name" id="teamNameLeft">Team 1</div>
                    <div class="progress">{/* <Progress percent={100} status="active" showInfo={false} /> */}</div>
                </div>
                <div class="team-players player-team-a players">
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <!-- <img class="non-active-player" src="{{asset('assets/Images/non_active_player.svg')}}" /> -->
                </div>
            </div>
        </div>
        <div class="third">
            <div class="center">
                <img src="{{asset('assets/Images/center.svg')}}" alt="" />
            </div>
            <div class="bottom">
                <img src="{{asset('assets/Images/center_bottom.svg')}}" alt="" />
            </div>
            <div class="d-flex halfs">
                <div id="courtSwap">FIRST HALF</div>
                <div class="mx-1"> | </div>
                <div id="mainTimer">20:00</div>
                <div class="mx-1"> | </div>
                <div id="raidTimer">30</div>
            </div>

        </div>
        <div class="right">
            <div class="fourth team-panel right">
                <div class="teams">
                    <div class="team-name team-b-name" id="teamNameRight">Team 2</div>
                    <div class="progress">{/* <Progress percent={100} status="active" showInfo={false} /> */}</div>
                </div>
                <div class="team-players player-team-b players">
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                    <img class="player" src="{{asset('assets/Images/active_player.svg')}}" />
                </div>
            </div>
            <div class="fifth scores">
                <img src="{{asset('assets/Images/right_score.svg')}}" alt="" />
                <div class="score team-b-score" id="teamScoreRight">00</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Match ID passed from Laravel route
    const matchId = {{ $score->id }};

    const mainTimerDisplay = document.getElementById('mainTimer');
    const raidDisplay = document.getElementById('raidTimer');
    const teamNameLeft = document.getElementById('teamNameLeft');
    const teamScoreLeft = document.getElementById('teamScoreLeft');
    const teamNameRight = document.getElementById('teamNameRight');
    const teamScoreRight = document.getElementById('teamScoreRight');
    const courtSwap = document.getElementById('courtSwap');

    const leftPlayersContainer = document.querySelector('.team-panel .players');
    const rightPlayersContainer = document.querySelector('.team-panel.right .players');

    // Helper to format time
    function formatTime(seconds) {
        let m = String(Math.floor(seconds / 60)).padStart(2, '0');
        let s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    // Helper to render players dynamically
    function renderPlayers(container, playersLeft) {
        const totalPlayers = 7;
        container.innerHTML = '';

        for (let i = 0; i < totalPlayers; i++) {
            const img = document.createElement('img');
            img.classList.add('player');

            if (i < playersLeft) {
                img.src = `{{ asset('assets/Images/active_player.svg') }}`;
                img.classList.add('active');
            } else {
                img.src = `{{ asset('assets/Images/non_active_player.svg') }}`;
            }

            container.appendChild(img);
        }
    }

    // Fetch timer and player data from backend
    function fetchTimers() {
        fetch('{{ route("team-match-score.live-score", $score->id) }}')
            .then(res => res.json())
            .then(data => {
                if (data) {
                    console.log(data,'data')
                    // Timers
                    mainTimerDisplay.textContent = formatTime(data.main_timer_seconds);
                    raidDisplay.textContent = data.raid_timer_seconds;

                    // Team Names & Scores
                    teamNameLeft.textContent = data.game_part == 1 ? data.team_match.team1.name : data.team_match.team2.name;
                    teamScoreLeft.textContent = data.game_part == 1 ? data.team1_score : data.team2_score;

                    teamNameRight.textContent = data.game_part == 1 ? data.team_match.team2.name : data.team_match.team1.name;
                    teamScoreRight.textContent = data.game_part == 1 ? data.team2_score : data.team1_score;

                    // Court Swap Label
                    courtSwap.textContent = data.game_part == 1 ? '1ST HALF' : '2ND HALF';

                    // Player Icons (based on number of players left)
                    if (data.game_part == 1) {
                        renderPlayers(leftPlayersContainer, data.team1_player_left);
                        renderPlayers(rightPlayersContainer, data.team2_player_left);
                    } else {
                        // Swap teams visually after half-time
                        renderPlayers(leftPlayersContainer, data.team2_player_left);
                        renderPlayers(rightPlayersContainer, data.team1_player_left);
                    }
                }
            })
            .catch(err => console.error('Error fetching timers:', err));
    }

    // Fetch initially and refresh every second
    fetchTimers();
    setInterval(fetchTimers, 1000);
</script>
</body>
</html>

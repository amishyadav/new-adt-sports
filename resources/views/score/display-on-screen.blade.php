<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kabaddi Display Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .scoreboard {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
        }

        .team-panel {
            flex: 1;
            background-color: #e65100;
            padding: 200px 2px;
            text-align: center;
            position: relative;
            clip-path: polygon(0 0, 85% 0, 100% 50%, 85% 100%, 0 100%);
        }

        .team-panel.right {
            clip-path: polygon(15% 0, 100% 0, 100% 100%, 15% 100%, 0 50%);
        }

        .team-name {
            font-size: 4rem;
            font-weight: bold;
        }

        .team-score {
            font-size: 8rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .players {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        .player {
            width: 25px;
            height: 25px;
            background-color: #ffcc80;
            border-radius: 50%;
        }

        .player.active {
            border: 2px solid green;
        }

        .center-panel {
            text-align: center;
            flex: 0.6;
        }

        .half-label {
            background-color: #e65100;
            padding: 5px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            display: inline-block;
            font-size: 2rem;
        }

        .timer {
            font-size: 5rem;
            font-weight: bold;
            margin-bottom: 143px;
        }

        .raid-timer {
            background-color: green;
            color: white;
            font-size: 6rem;
            font-weight: bold;
            border-radius: 15px;
            padding: 19px 46px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="scoreboard">

    <!-- Team A -->
    <div class="team-panel">
        <div class="team-name" id="teamNameLeft">TEAM A</div>
        <div class="team-score" id="teamScoreLeft">00</div>
        <div class="players">
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/non_active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/non_active_player.svg') }}" />
        </div>
    </div>

    <!-- Center -->
    <div class="center-panel">
        <div class="half-label" id="courtSwap">1ST HALF</div>
        <div class="timer" id="mainTimer">20:00</div>
        <div class="raid-timer" id="raidTimer">30</div>
    </div>

    <!-- Team B -->
    <div class="team-panel right">
        <div class="team-name" id="teamNameRight">TEAM B</div>
        <div class="team-score" id="teamScoreRight">00</div>
        <div class="players">
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
            <img class="player" src="{{ asset('assets/Images/active_player.svg') }}" />
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
        fetch('{{ route("timer-score.get", $score->id) }}')
            .then(res => res.json())
            .then(data => {
                if (data) {
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
    // setInterval(fetchTimers, 1000);
</script>


</body>
</html>

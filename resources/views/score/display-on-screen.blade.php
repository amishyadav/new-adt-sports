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
        <div class="team-name">TEAM A</div>
        <div class="team-score">00</div>
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
        <div class="half-label">1ST HALF</div>
        <div class="timer">20:00</div>
        <div class="raid-timer">30</div>
    </div>

    <!-- Team B -->
    <div class="team-panel right">
        <div class="team-name">TEAM B</div>
        <div class="team-score">00</div>
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
    const leftRaidDisplay = document.getElementById('leftRaidTimer');
    const rightRaidDisplay = document.getElementById('rightRaidTimer');

    // Helper to format time
    function formatTime(seconds) {
        let m = String(Math.floor(seconds / 60)).padStart(2, '0');
        let s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    // Fetch timer data from backend
    function fetchTimers() {
        fetch(`/api/match/${matchId}/timers`)
            .then(res => res.json())
            .then(data => {
                if (data) {
                    mainTimerDisplay.textContent = formatTime(data.main_seconds);
                    leftRaidDisplay.textContent = data.raid_left;
                    rightRaidDisplay.textContent = data.raid_right;
                }
            })
            .catch(err => console.error('Error fetching timers:', err));
    }

    // Poll every second for updates
    // setInterval(fetchTimers, 1000);

    // Initial fetch on load
    fetchTimers();
</script>

</body>
</html>

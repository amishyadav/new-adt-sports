<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kabaddi Display Screen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
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
        <div class="team-name" id="teamNameLeft">{{ $matchState['court_swap'] == 0 ? $matchState['team_match']['team1']['name'] : $matchState['team_match']['team2']['name'] }}</div>
        <div class="team-score" id="teamScoreLeft">{{ str_pad((string) ($matchState['court_swap'] == 0 ? $matchState['team1_score'] : $matchState['team2_score']), 2, '0', STR_PAD_LEFT) }}</div>
        <div class="players">
        </div>
    </div>

    <!-- Center -->
    <div class="center-panel">
        <div class="half-label" id="courtSwap">{{ $matchState['court_swap'] == 0 ? '1ST HALF' : '2ND HALF' }}</div>
        <div class="timer" id="mainTimer">{{ sprintf('%02d:%02d', intdiv($matchState['main_timer_seconds'], 60), $matchState['main_timer_seconds'] % 60) }}</div>
        <div class="raid-timer" id="raidTimer">{{ $matchState['raid_timer_seconds'] }}</div>
    </div>

    <!-- Team B -->
    <div class="team-panel right">
        <div class="team-name" id="teamNameRight">{{ $matchState['court_swap'] == 0 ? $matchState['team_match']['team2']['name'] : $matchState['team_match']['team1']['name'] }}</div>
        <div class="team-score" id="teamScoreRight">{{ str_pad((string) ($matchState['court_swap'] == 0 ? $matchState['team2_score'] : $matchState['team1_score']), 2, '0', STR_PAD_LEFT) }}</div>
        <div class="players">
        </div>
    </div>
</div>

<script>
    const matchId = {{ $score->id }};
    const initialMatchState = @json($matchState);
    const websocketConfig = {
        key: @json(config('broadcasting.connections.pusher.key')),
        cluster: @json(env('PUSHER_APP_CLUSTER')) || 'mt1',
        wsHost: @json(config('broadcasting.connections.pusher.options.host')) || window.location.hostname,
        wsPort: {{ (int) env('PUSHER_PORT', 6001) }},
        forceTLS: @json(env('PUSHER_SCHEME', 'https') === 'https')
    };

    const mainTimerDisplay = document.getElementById('mainTimer');
    const raidDisplay = document.getElementById('raidTimer');
    const teamNameLeft = document.getElementById('teamNameLeft');
    const teamScoreLeft = document.getElementById('teamScoreLeft');
    const teamNameRight = document.getElementById('teamNameRight');
    const teamScoreRight = document.getElementById('teamScoreRight');
    const courtSwap = document.getElementById('courtSwap');

    const leftPlayersContainer = document.querySelector('.team-panel .players');
    const rightPlayersContainer = document.querySelector('.team-panel.right .players');
    let mainTimerInterval = null;
    let raidTimerInterval = null;
    let currentMainTime = initialMatchState.main_timer_seconds ?? 1200;
    let currentRaidTime = initialMatchState.raid_timer_seconds ?? 30;

    // Helper to format time
    function formatTime(seconds) {
        let m = String(Math.floor(seconds / 60)).padStart(2, '0');
        let s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    function formatScore(score) {
        return String(score ?? 0).padStart(2, '0');
    }

    function stopDisplayTimers() {
        if (mainTimerInterval) {
            clearInterval(mainTimerInterval);
            mainTimerInterval = null;
        }

        if (raidTimerInterval) {
            clearInterval(raidTimerInterval);
            raidTimerInterval = null;
        }
    }

    function startDisplayMainTimer() {
        if (mainTimerInterval) {
            clearInterval(mainTimerInterval);
        }

        mainTimerInterval = setInterval(() => {
            if (currentMainTime > 0) {
                currentMainTime--;
                mainTimerDisplay.textContent = formatTime(currentMainTime);
            }
        }, 1000);
    }

    function startDisplayRaidTimer() {
        if (raidTimerInterval) {
            clearInterval(raidTimerInterval);
        }

        raidTimerInterval = setInterval(() => {
            if (currentRaidTime > 0) {
                currentRaidTime--;
                raidDisplay.textContent = currentRaidTime;
            }
        }, 1000);
    }

    function renderPlayers(container, playersLeft) {
        const totalPlayers = 7;
        container.innerHTML = '';

        for (let i = 0; i < totalPlayers; i++) {
            const img = document.createElement('img');
            img.classList.add('player');

            if (i < playersLeft) {
                img.src = `{{ asset('assets/Images/active_player.svg') }}`;
            } else {
                img.src = `{{ asset('assets/Images/non_active_player.svg') }}`;
            }

            container.appendChild(img);
        }
    }

    function applyMatchState(data) {
        if (!data) {
            return;
        }

        stopDisplayTimers();

        const syncedAtMs = Number(data.synced_at_ms || Date.now());
        const elapsedSeconds = Math.max(0, Math.floor((Date.now() - syncedAtMs) / 1000));
        currentMainTime = Math.max(0, Number(data.main_timer_seconds ?? 1200) - (data.main_running ? elapsedSeconds : 0));
        currentRaidTime = Math.max(0, Number(data.raid_timer_seconds ?? 30) - (data.raid_running ? elapsedSeconds : 0));

        mainTimerDisplay.textContent = formatTime(currentMainTime);
        raidDisplay.textContent = currentRaidTime;

        teamNameLeft.textContent = data.court_swap == 0 ? data.team_match.team1.name : data.team_match.team2.name;
        teamScoreLeft.textContent = formatScore(data.court_swap == 0 ? data.team1_score : data.team2_score);

        teamNameRight.textContent = data.court_swap == 0 ? data.team_match.team2.name : data.team_match.team1.name;
        teamScoreRight.textContent = formatScore(data.court_swap == 0 ? data.team2_score : data.team1_score);

        courtSwap.textContent = data.court_swap == 0 ? '1ST HALF' : '2ND HALF';

        if (data.court_swap == 0) {
            renderPlayers(leftPlayersContainer, data.team1_player_left);
            renderPlayers(rightPlayersContainer, data.team2_player_left);
        } else {
            renderPlayers(leftPlayersContainer, data.team2_player_left);
            renderPlayers(rightPlayersContainer, data.team1_player_left);
        }

        if (data.main_running && currentMainTime > 0) {
            startDisplayMainTimer();
        }

        if (data.raid_running && currentRaidTime > 0 && data.active_side && data.active_side !== 'none') {
            startDisplayRaidTimer();
        }
    }

    function subscribeToMatchUpdates() {
        if (!websocketConfig.key) {
            console.error('Missing websocket key. Check PUSHER_APP_KEY.');
            return;
        }

        const pusherOptions = {
            cluster: websocketConfig.cluster,
            wsHost: websocketConfig.wsHost,
            wsPort: websocketConfig.wsPort,
            wssPort: websocketConfig.wsPort,
            forceTLS: websocketConfig.forceTLS,
            enabledTransports: ['ws', 'wss'],
            disableStats: true
        };

        const pusher = new Pusher(websocketConfig.key, pusherOptions);

        const channel = pusher.subscribe(`match-state.${matchId}`);

        channel.bind('match.state.updated', applyMatchState);
        pusher.connection.bind('connected', () => console.log('Websocket connected'));
        pusher.connection.bind('error', err => console.error('Websocket error:', err));
    }

    applyMatchState(initialMatchState);
    subscribeToMatchUpdates();
</script>


</body>
</html>

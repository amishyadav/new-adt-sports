<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kabaddi Scoreboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0d1116;
            color: #fff;
            font-family: 'Rajdhani', sans-serif;
        }
        .scoreboard-container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .topbar {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .timer-box {
            text-align: center;
            margin-bottom: 20px;
            background: #111720;
            border: 1px solid #222a36;
            border-radius: 12px;
            padding: 15px;
        }
        .timer-box small {
            font-size: 14px;
            color: #9fb0c3;
            display: block;
        }
        .timer-box .time {
            font-size: 40px;
            font-weight: 700;
            margin-top: 5px;
        }
        .team-card {
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: #111720;
            border: 2px solid #222a36;
        }
        .team-left { border-color: #ffb000; }
        .team-right { border-color: #1e90ff; }
        .team-name {
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .team-left .team-name { color: #ffb000; }
        .team-right .team-name { color: #1e90ff; }
        .score {
            font-size: 80px;
            font-weight: 700;
            margin: 10px 0;
        }
        .btn-custom {
            min-width: 90px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 10px;
        }
        /* Button Theme */
        .btn-warning { background-color: #ffb000; border: none; color: #121212; }
        .btn-success { background-color: #00d084; border: none; }
        .btn-danger { background-color: #ff4d4d; border: none; }
        .btn-secondary { background-color: #2a3648; border: none; color: #dfe7f1; }
        .btn-secondary:hover { background-color: #3a465a; }
        .btn-outline-light { border: 1px solid #9fb0c3; color: #9fb0c3; }
        /* Footer spacing */
        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .player-btn {
            width: 45px;
            height: 45px;
            font-weight: 700;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        .player-btn:hover {
            transform: scale(1.1);
        }
        .player-btn.active {
            opacity: 1;
        }
        .player-btn:not(.active) {
            opacity: 0.3;
        }

    </style>
</head>
<body>
<div class="scoreboard-container">
    <!-- Match Title -->
    <div class="topbar">Match: {{$score->teamMatch->team1->name}} vs {{$score->teamMatch->team2->name}}</div>

    <!-- Teams -->
    <div class="row g-3" id="teamsRow">
        <!-- Left Team -->
        <div class="col-md-6" id="teamLeftCol">
            <div class="team-card team-left">
                <div class="team-name">{{$score->teamMatch->team1->name}}</div>
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <button class="btn btn-warning btn-custom score-minus">-</button>
                    <div class="score">{{$score->team1_score}}</div>
                    <button class="btn btn-success btn-custom score-plus">+</button>
                </div>
                <div class="d-flex justify-content-center gap-2 flex-wrap mt-3">
                    <input type="number" class="form-control text-center score-input" value="1" style="width:70px;">
                    <button class="btn btn-warning btn-custom score-input-minus">Minus</button>
                    <div>
                        <button class="btn btn-secondary btn-custom mt-2">Adjust</button>
                    </div>
                    <input type="number" class="form-control text-center score-input" value="1" style="width:70px;">
                    <button class="btn btn-success btn-custom score-input-plus">Plus</button>
                </div>
            </div>
        </div>

        <!-- Right Team -->
        <div class="col-md-6" id="teamRightCol">
            <div class="team-card team-right">
                <div class="team-name">{{$score->teamMatch->team2->name}}</div>
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <button class="btn btn-warning btn-custom score-minus">-</button>
                    <div class="score">{{$score->team2_score}}</div>
                    <button class="btn btn-success btn-custom score-plus">+</button>
                </div>
                <div class="d-flex justify-content-center gap-2 flex-wrap mt-3">
                    <input type="number" class="form-control text-center score-input" value="1" style="width:70px;">
                    <button class="btn btn-warning btn-custom score-input-minus">Minus</button>
                    <div>
                        <button class="btn btn-secondary btn-custom mt-2">Adjust</button>
                    </div>
                    <input type="number" class="form-control text-center score-input" value="1" style="width:70px;">
                    <button class="btn btn-success btn-custom score-input-plus">Plus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Players Left Manager -->
    <div class="timer-box players-manager text-center mb-4 mt-5">
        <h4 class="mb-3 text-uppercase fw-bold">Players Left</h4>
        <div class="row g-4 justify-content-center">

            <!-- Left Team -->
            <div class="col-md-6">
                <div class="p-3 border rounded-3 team-left-player-box">
                    <div class="fw-bold mb-3 text-warning fs-5">{{$score->teamMatch->team1->name}}</div>
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <!-- Player buttons 1–7 -->
                        <button class="btn btn-outline-warning player-btn active">1</button>
                        <button class="btn btn-outline-warning player-btn active">2</button>
                        <button class="btn btn-outline-warning player-btn active">3</button>
                        <button class="btn btn-outline-warning player-btn active">4</button>
                        <button class="btn btn-outline-warning player-btn active">5</button>
                        <button class="btn btn-outline-warning player-btn active">6</button>
                        <button class="btn btn-outline-warning player-btn active">7</button>
                    </div>
                </div>
            </div>

            <!-- Right Team -->
            <div class="col-md-6">
                <div class="p-3 border rounded-3 team-right-player-box">
                    <div class="fw-bold mb-3 text-primary fs-5">{{$score->teamMatch->team2->name}}</div>
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <!-- Player buttons 1–7 -->
                        <button class="btn btn-outline-primary player-btn active">1</button>
                        <button class="btn btn-outline-primary player-btn active">2</button>
                        <button class="btn btn-outline-primary player-btn active">3</button>
                        <button class="btn btn-outline-primary player-btn active">4</button>
                        <button class="btn btn-outline-primary player-btn active">5</button>
                        <button class="btn btn-outline-primary player-btn active">6</button>
                        <button class="btn btn-outline-primary player-btn active">7</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Buttons -->
    <div class="footer d-flex justify-content-center gap-3 flex-wrap mt-4">
        <button class="btn btn-secondary btn-lg btn-undo">Undo</button>
        <button class="btn btn-danger btn-lg btn-reset">Reset Match</button>
        <button class="btn btn-danger btn-lg btn-refresh">Refresh Page</button>
        <button class="btn btn-danger btn-lg px-5" id="swapBtn">Swap Courts</button>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let historyStack = [];

    // ------- AJAX SAVE FUNCTION -------
    function saveScoreToDB(extraData = {}, reload = false) {
        const team1Score = parseInt(document.querySelector('#teamLeftCol .score').textContent);
        const team2Score = parseInt(document.querySelector('#teamRightCol .score').textContent);

        let payload = {
            team1_score: team1Score,
            team2_score: team2Score,
            ...extraData
        };

        $.ajax({
            url: "{{ route('match.update-score', $score->id) }}",
            method: "POST",
            data: JSON.stringify(payload),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: function () {
                console.log("Saved ✅", payload);
                if (reload) location.reload();
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    // ------- SCORE CONTROLS -------
    document.querySelectorAll('.team-card').forEach(team => {
        const scoreEl = team.querySelector('.score');

        function updateScore(newScore) {
            historyStack.push({ el: scoreEl, prev: parseInt(scoreEl.textContent) });
            scoreEl.textContent = newScore;
            saveScoreToDB();
        }

        team.querySelector('.score-minus').addEventListener('click', () => {
            let score = parseInt(scoreEl.textContent);
            if (score > 0) updateScore(score - 1);
        });

        team.querySelector('.score-plus').addEventListener('click', () => {
            let score = parseInt(scoreEl.textContent);
            updateScore(score + 1);
        });

        team.querySelector('.score-input-minus').addEventListener('click', () => {
            const input = team.querySelectorAll('.score-input')[0];
            let score = parseInt(scoreEl.textContent);
            let val = parseInt(input.value) || 0;
            if (score - val >= 0) updateScore(score - val);
        });

        team.querySelector('.score-input-plus').addEventListener('click', () => {
            const input = team.querySelectorAll('.score-input')[1];
            let score = parseInt(scoreEl.textContent);
            let val = parseInt(input.value) || 0;
            updateScore(score + val);
        });
    });

    // ------- UNDO / RESET / REFRESH -------
    document.querySelector('.btn-undo').addEventListener('click', () => {
        if (historyStack.length > 0) {
            const last = historyStack.pop();
            last.el.textContent = last.prev;
            saveScoreToDB();
        }
    });

    document.querySelector('.btn-reset').addEventListener('click', () => location.reload());
    document.querySelector('.btn-refresh').addEventListener('click', () => location.reload());

    // ------- SWAP COURTS (with persistence) -------
    document.getElementById('swapBtn').addEventListener('click', () => {
        toggleCourtSwap();
    });

    function toggleCourtSwap() {
        const teamsRow = document.getElementById('teamsRow');
        const leftCol = document.getElementById('teamLeftCol');
        const rightCol = document.getElementById('teamRightCol');
        const leftPlayerBox = document.querySelector('.team-left-player-box');
        const rightPlayerBox = document.querySelector('.team-right-player-box');
        const playersManager = document.querySelector('.players-manager .row');

        const courtSwapped = {{ $score->court_swap ? 'true' : 'false' }};

        // Determine next state (toggle)
        const newCourtSwapped = !courtSwapped;

        // Swap DOM elements visually
        if (newCourtSwapped) {
            teamsRow.insertBefore(rightCol, leftCol);
            playersManager.insertBefore(rightPlayerBox.parentElement, leftPlayerBox.parentElement);
        } else {
            teamsRow.insertBefore(leftCol, rightCol);
            playersManager.insertBefore(leftPlayerBox.parentElement, rightPlayerBox.parentElement);
        }

        // Save the new state to DB and reload
        saveScoreToDB({ court_swap: newCourtSwapped ? 1 : 0 }, true);
    }

    // ------- PLAYER PANEL SELECTION -------
    function initializePlayerSelection() {
        const team1Selected = {{ $score->team1_player_left }};
        const team2Selected = {{ $score->team2_player_left }};
        const courtSwapped = {{ $score->court_swap ? 'true' : 'false' }};

        // Apply saved court swap first
        if (courtSwapped) {
            const teamsRow = document.getElementById('teamsRow');
            const leftCol = document.getElementById('teamLeftCol');
            const rightCol = document.getElementById('teamRightCol');
            const leftPlayerBox = document.querySelector('.team-left-player-box');
            const rightPlayerBox = document.querySelector('.team-right-player-box');
            const playersManager = document.querySelector('.players-manager .row');

            teamsRow.insertBefore(rightCol, leftCol);
            playersManager.insertBefore(rightPlayerBox.parentElement, leftPlayerBox.parentElement);
        }

        // Apply player active states
        document.querySelectorAll('.team-left-player-box .player-btn').forEach(btn => {
            const num = parseInt(btn.textContent);
            btn.classList.toggle('active', num === team1Selected);
            btn.style.opacity = num === team1Selected ? '1' : '0.3';
        });

        document.querySelectorAll('.team-right-player-box .player-btn').forEach(btn => {
            const num = parseInt(btn.textContent);
            btn.classList.toggle('active', num === team2Selected);
            btn.style.opacity = num === team2Selected ? '1' : '0.3';
        });
    }

    function handlePlayerClick(btn) {
        const teamBoxLeft = btn.closest('.team-left-player-box');
        const teamBoxRight = btn.closest('.team-right-player-box');
        const selectedNumber = parseInt(btn.textContent);
        let payload = {};

        if (teamBoxLeft) {
            teamBoxLeft.querySelectorAll('.player-btn').forEach(b => {
                b.classList.remove('active');
                b.style.opacity = '0.3';
            });
            btn.classList.add('active');
            btn.style.opacity = '1';
            payload = { team1_player_left: selectedNumber };
        } else if (teamBoxRight) {
            teamBoxRight.querySelectorAll('.player-btn').forEach(b => {
                b.classList.remove('active');
                b.style.opacity = '0.3';
            });
            btn.classList.add('active');
            btn.style.opacity = '1';
            payload = { team2_player_left: selectedNumber };
        }

        saveScoreToDB(payload);
    }

    // Attach click handlers for players
    document.querySelectorAll('.player-btn').forEach(btn => {
        btn.addEventListener('click', () => handlePlayerClick(btn));
    });

    // Run on page load
    document.addEventListener('DOMContentLoaded', initializePlayerSelection);
</script>

</body>
</html>

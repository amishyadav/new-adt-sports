<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kabaddi Scoreboard</title>
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
    </style>
</head>
<body>
<div class="scoreboard-container">

    <!-- Match Title -->
    <div class="topbar">Match: {{$teamMatch->team1->name}} vs {{$teamMatch->team2->name}}</div>

    <!-- Timer -->
    <div class="timer-box">
        <small>Second Half</small>
        <div class="time">20:00</div>
    </div>

    <!-- Swap Courts -->
    <div class="text-center mb-4">
        <button class="btn btn-danger btn-lg px-5" id="swapBtn">Swap Courts</button>
    </div>

    <!-- Teams -->
    <div class="row g-3" id="teamsRow">
        <!-- Left Team -->
        <div class="col-md-6" id="teamLeftCol">
            <div class="team-card team-left">
                <div class="team-name">Telugu Titans</div>
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <button class="btn btn-warning btn-custom score-minus">-</button>
                    <div class="score">0</div>
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
                <div class="team-name">Tamil Thalaivas</div>
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                    <button class="btn btn-warning btn-custom score-minus">-</button>
                    <div class="score">0</div>
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


    <!-- Footer Buttons -->
    <div class="footer d-flex justify-content-center gap-3 flex-wrap mt-4">
        <button class="btn btn-secondary btn-lg btn-undo">Undo</button>
        <button class="btn btn-danger btn-lg btn-reset">Reset Match</button>
        <button class="btn btn-danger btn-lg btn-refresh">Refresh Page</button>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let historyStack = []; // track score changes

    document.querySelectorAll('.team-card').forEach(team => {
        const scoreEl = team.querySelector('.score');

        function updateScore(newScore) {
            historyStack.push({ el: scoreEl, prev: parseInt(scoreEl.textContent) });
            scoreEl.textContent = newScore;
        }

        // Direct - and + buttons
        team.querySelector('.score-minus').addEventListener('click', () => {
            let score = parseInt(scoreEl.textContent);
            if (score > 0) updateScore(score - 1);
        });

        team.querySelector('.score-plus').addEventListener('click', () => {
            let score = parseInt(scoreEl.textContent);
            updateScore(score + 1);
        });

        // Input minus button
        team.querySelector('.score-input-minus').addEventListener('click', () => {
            const input = team.querySelectorAll('.score-input')[0];
            let score = parseInt(scoreEl.textContent);
            let val = parseInt(input.value) || 0;
            if (score - val >= 0) updateScore(score - val);
        });

        // Input plus button
        team.querySelector('.score-input-plus').addEventListener('click', () => {
            const input = team.querySelectorAll('.score-input')[1];
            let score = parseInt(scoreEl.textContent);
            let val = parseInt(input.value) || 0;
            updateScore(score + val);
        });
    });

    // Undo button
    document.querySelector('.btn-undo').addEventListener('click', () => {
        if (historyStack.length > 0) {
            const last = historyStack.pop();
            last.el.textContent = last.prev;
        }
    });

    // Reset & Refresh buttons (reload page)
    document.querySelector('.btn-reset').addEventListener('click', () => location.reload());
    document.querySelector('.btn-refresh').addEventListener('click', () => location.reload());

    // Swap Courts
    document.getElementById('swapBtn').addEventListener('click', () => {
        const teamsRow = document.getElementById('teamsRow');
        const leftCol = document.getElementById('teamLeftCol');
        const rightCol = document.getElementById('teamRightCol');

        // Swap positions in the DOM
        if (leftCol.nextElementSibling === rightCol) {
            teamsRow.insertBefore(rightCol, leftCol);
        } else {
            teamsRow.insertBefore(leftCol, rightCol);
        }
    });

</script>
</body>
</html>

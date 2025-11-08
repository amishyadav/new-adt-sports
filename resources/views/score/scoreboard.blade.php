<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            font-size: 30px;
            margin-bottom: -16px;
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

        /* Raid Buttons */
        .raid-btn {
            min-width: 110px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 8px;
        }
        .raid-btn.safe-raid {
            border: 1px solid rgba(255,186,0,0.25);
            color: #ffb000;
            background: transparent;
        }
        .raid-btn.do-or-die {
            border: 1px solid rgba(255,77,77,0.25);
            color: #ff4d4d;
            background: transparent;
        }
        .raid-btn.active {
            background-color: #00d084 !important;
            color: #121212 !important;
            border: none !important;
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

                <!-- Safe Raid / Do or Die Buttons (team1) -->
                <div class="d-flex justify-content-center gap-2 mt-3 raid-buttons">
                    <button class="btn raid-btn safe-raid" data-team="team1" data-pos="1">Safe Raid</button>
                    <button class="btn raid-btn safe-raid" data-team="team1" data-pos="2">Safe Raid</button>
                    <button class="btn raid-btn do-or-die" data-team="team1" data-pos="3">Do or Die</button>
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

                <!-- Safe Raid / Do or Die Buttons (team2) -->
                <div class="d-flex justify-content-center gap-2 mt-3 raid-buttons">
                    <button class="btn raid-btn safe-raid" data-team="team2" data-pos="1">Safe Raid</button>
                    <button class="btn raid-btn safe-raid" data-team="team2" data-pos="2">Safe Raid</button>
                    <button class="btn raid-btn do-or-die" data-team="team2" data-pos="3">Do or Die</button>
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

<!-- Audio -->
<audio id="doOrDieAudio" src="/sounds/do-or-die.mp3" preload="auto"></audio>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let historyStack = [];

    // ------- AJAX SAVE FUNCTION -------
    function saveScoreToDB(extraData = {}, reload = false) {
        const team1Score = parseInt(document.querySelector('#teamLeftCol .score').textContent) || 0;
        const team2Score = parseInt(document.querySelector('#teamRightCol .score').textContent) || 0;

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
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.team-card').forEach(team => {
            const scoreEl = team.querySelector('.score');

            function updateScore(newScore) {
                historyStack.push({ el: scoreEl, prev: parseInt(scoreEl.textContent) || 0 });
                scoreEl.textContent = newScore;
                saveScoreToDB();
            }

            const minus = team.querySelector('.score-minus');
            const plus = team.querySelector('.score-plus');
            const inputMinus = team.querySelector('.score-input-minus');
            const inputPlus = team.querySelector('.score-input-plus');

            if (minus) minus.addEventListener('click', () => {
                let score = parseInt(scoreEl.textContent) || 0;
                if (score > 0) updateScore(score - 1);
            });

            if (plus) plus.addEventListener('click', () => {
                let score = parseInt(scoreEl.textContent) || 0;
                updateScore(score + 1);
            });

            if (inputMinus) inputMinus.addEventListener('click', () => {
                const input = team.querySelectorAll('.score-input')[0];
                let score = parseInt(scoreEl.textContent) || 0;
                let val = parseInt(input.value) || 0;
                if (score - val >= 0) updateScore(score - val);
            });

            if (inputPlus) inputPlus.addEventListener('click', () => {
                const input = team.querySelectorAll('.score-input')[1];
                let score = parseInt(scoreEl.textContent) || 0;
                let val = parseInt(input.value) || 0;
                updateScore(score + val);
            });
        });

        // ------- UNDO / RESET / REFRESH -------
        const undoBtn = document.querySelector('.btn-undo');
        if (undoBtn) {
            undoBtn.addEventListener('click', () => {
                if (historyStack.length > 0) {
                    const last = historyStack.pop();
                    last.el.textContent = last.prev;
                    saveScoreToDB();
                }
            });
        }

        const resetBtn = document.querySelector('.btn-reset');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                // Remove saved Safe Raid state
                localStorage.removeItem('raidState');
                // optionally remove other saved states if any
                location.reload();
            });
        }

        const refreshBtn = document.querySelector('.btn-refresh');
        if (refreshBtn) refreshBtn.addEventListener('click', () => location.reload());

        // ------- SWAP COURTS -------
        const swapBtn = document.getElementById('swapBtn');
        if (swapBtn) {
            swapBtn.addEventListener('click', () => {
                toggleCourtSwap();
            });
        }

        function toggleCourtSwap() {
            const teamsRow = document.getElementById('teamsRow');
            const leftCol = document.getElementById('teamLeftCol');
            const rightCol = document.getElementById('teamRightCol');
            const leftPlayerBox = document.querySelector('.team-left-player-box');
            const rightPlayerBox = document.querySelector('.team-right-player-box');
            const playersManager = document.querySelector('.players-manager .row');

            const courtSwapped = {{ $score->court_swap ? 'true' : 'false' }};
            const newCourtSwapped = !courtSwapped;

            if (newCourtSwapped) {
                teamsRow.insertBefore(rightCol, leftCol);
                if (rightPlayerBox && leftPlayerBox) {
                    playersManager.insertBefore(rightPlayerBox.parentElement, leftPlayerBox.parentElement);
                }
            } else {
                teamsRow.insertBefore(leftCol, rightCol);
                if (rightPlayerBox && leftPlayerBox) {
                    playersManager.insertBefore(leftPlayerBox.parentElement, rightPlayerBox.parentElement);
                }
            }

            saveScoreToDB({ court_swap: newCourtSwapped ? 1 : 0 }, true);
        }

        // ------- PLAYER PANEL SELECTION -------
        function initializePlayerSelection() {
            const team1Selected = {{ $score->team1_player_left }};
            const team2Selected = {{ $score->team2_player_left }};
            const courtSwapped = {{ $score->court_swap ? 'true' : 'false' }};

            if (courtSwapped) {
                const teamsRow = document.getElementById('teamsRow');
                const leftCol = document.getElementById('teamLeftCol');
                const rightCol = document.getElementById('teamRightCol');
                const leftPlayerBox = document.querySelector('.team-left-player-box');
                const rightPlayerBox = document.querySelector('.team-right-player-box');
                const playersManager = document.querySelector('.players-manager .row');

                teamsRow.insertBefore(rightCol, leftCol);
                if (rightPlayerBox && leftPlayerBox) {
                    playersManager.insertBefore(rightPlayerBox.parentElement, leftPlayerBox.parentElement);
                }
            }

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

        document.querySelectorAll('.player-btn').forEach(btn => {
            btn.addEventListener('click', () => handlePlayerClick(btn));
        });

        initializePlayerSelection();

        // ------- RAID BUTTONS (Safe Raid & Do or Die) -------
        // Use stable keys: `${data-team}_${data-pos}`
        const raidStateRaw = localStorage.getItem('raidState');
        let raidState = {};
        try {
            raidState = raidStateRaw ? JSON.parse(raidStateRaw) : {};
        } catch (e) {
            console.warn('raidState parse error, resetting', e);
            raidState = {};
            localStorage.removeItem('raidState');
        }

        // When a raid button is clicked
        document.querySelectorAll('.raid-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const team = btn.getAttribute('data-team');
                const pos = btn.getAttribute('data-pos');
                const key = `${team}_${pos}`;

                // Toggle the state in raidState
                raidState[key] = !raidState[key];

                // Apply styles and classes based on state
                if (raidState[key]) {
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                } else {
                    btn.classList.remove('active');
                    btn.style.opacity = btn.classList.contains('safe-raid') ? '0.9' : '0.9';
                }
            });
        });

        // Attach click listeners
        document.querySelectorAll('.raid-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const team = btn.getAttribute('data-team');
                const pos = btn.getAttribute('data-pos');
                const isDoOrDie = btn.classList.contains('do-or-die');
                const key = `${team}_${pos}`;

                if (isDoOrDie) {
                    // Play audio (Do or Die)
                    const audio = document.getElementById('doOrDieAudio');
                    if (audio) {
                        audio.currentTime = 0;
                        audio.play().catch(err => {
                            // Auto-play may be blocked on some browsers; that's ok.
                            console.warn('Audio play failed:', err);
                        });
                    }
                    // Optionally give visual feedback: briefly flash the button
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                    setTimeout(() => {
                        // return to previous state after 1.5s (do not persist)
                        const saved = raidState[key];
                        if (!saved) {
                            btn.classList.remove('active');
                            btn.style.opacity = btn.classList.contains('safe-raid') ? '0.9' : '0.9';
                        }
                    }, 1500);
                    return;
                }

                // Toggle Safe Raid
                const currentlyActive = btn.classList.contains('active');
                if (currentlyActive) {
                    btn.classList.remove('active');
                    btn.style.opacity = '0.9';
                    raidState[key] = false;
                } else {
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                    raidState[key] = true;
                }

                // Persist
                try {
                    localStorage.setItem('raidState', JSON.stringify(raidState));
                } catch (e) {
                    console.warn('Could not save raidState to localStorage', e);
                }
            });
        });

    }); // end DOMContentLoaded
</script>
</body>
</html>

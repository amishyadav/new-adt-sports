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

        /* Game Part select */
        #gamePartBar .form-select-lg {
            padding: .5rem 1rem;
            border-radius: 10px;
            background:#0f1520;
            color:#e7eefb;
            border:1px solid #222a36;
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

    <!-- Game Part selector -->
    <div id="gamePartBar" class="players-manager timer-box mb-3 mt-5">
        <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
            <span class="fw-bold text-uppercase" style="letter-spacing:.5px;">Game Part:</span>
            <select id="gamePartSelect" class="form-select form-select-lg" style="max-width: 240px;">
                <option value="1">1st Inning</option>
                <option value="2">2nd Inning</option>
            </select>
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
<audio id="doOrDieAudio" src="{{ asset('sounds/do-or-die.mp3') }}" preload="auto"></audio>

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
                if (reload) location.reload();
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {

        // ------- GAME PART (Innings) -------
        (function initGamePart() {
            const select = document.getElementById('gamePartSelect');
            if (!select) return;

            // Initial value from server (Blade). Defaults to 1 if null.
            const initialGamePart = parseInt({{ $score->game_part ?? 1 }}) || 1;
            select.value = String(initialGamePart);

            // Mirror to localStorage for instant UI on super-fast reloads
            try { localStorage.setItem('game_part', String(initialGamePart)); } catch (_) {}

            // If server value absent, fall back to any saved local value
            if (!{{ isset($score->game_part) ? 'true' : 'false' }}) {
                const saved = localStorage.getItem('game_part');
                if (saved === '1' || saved === '2') {
                    select.value = saved;
                }
            }

            // Persist to DB on change (also keep localStorage in sync)
            select.addEventListener('change', () => {
                const val = parseInt(select.value) || 1;
                try { localStorage.setItem('game_part', String(val)); } catch (_) {}
                saveScoreToDB({ game_part: val });
            });
        })();

        // ------- SCORE CONTROLS -------
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
                // Optionally remove other saved states if any
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
        const raidStateRaw = localStorage.getItem('raidState');
        let raidState = {};
        try {
            raidState = raidStateRaw ? JSON.parse(raidStateRaw) : {};
        } catch (e) {
            console.warn('raidState parse error, resetting', e);
            raidState = {};
            localStorage.removeItem('raidState');
        }

        function persistRaidState() {
            try { localStorage.setItem('raidState', JSON.stringify(raidState)); }
            catch (e) { console.warn('Could not save raidState to localStorage', e); }
        }

        function applyRaidStateToUI() {
            // Apply only to Safe Raid buttons (persisted)
            document.querySelectorAll('.raid-btn.safe-raid').forEach(btn => {
                const team = btn.getAttribute('data-team');
                const pos = btn.getAttribute('data-pos');
                const key = `${team}_${pos}`;
                const active = !!raidState[key];
                btn.classList.toggle('active', active);
                btn.style.opacity = active ? '1' : '0.9';
            });
            // Do-or-Die should never persist
            document.querySelectorAll('.raid-btn.do-or-die').forEach(btn => {
                btn.classList.remove('active');
                btn.style.opacity = '0.9';
            });
        }

        // Apply saved state once on load
        applyRaidStateToUI();

        // Original listeners (kept)
        document.querySelectorAll('.raid-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const team = btn.getAttribute('data-team');
                const pos = btn.getAttribute('data-pos');
                const key = `${team}_${pos}`;
                raidState[key] = !raidState[key];

                if (raidState[key]) {
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                } else {
                    btn.classList.remove('active');
                    btn.style.opacity = btn.classList.contains('safe-raid') ? '0.9' : '0.9';
                }
            });
        });

        document.querySelectorAll('.raid-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const team = btn.getAttribute('data-team');
                const pos = btn.getAttribute('data-pos');
                const isDoOrDie = btn.classList.contains('do-or-die');
                const key = `${team}_${pos}`;

                if (isDoOrDie) {
                    const audio = document.getElementById('doOrDieAudio');
                    if (audio) {
                        audio.currentTime = 0;
                        audio.play().catch(err => {
                            console.warn('Audio play failed:', err);
                        });
                    }
                    btn.classList.add('active');
                    btn.style.opacity = '1';
                    setTimeout(() => {
                        btn.classList.remove('active');
                        btn.style.opacity = btn.classList.contains('safe-raid') ? '0.9' : '0.9';
                    }, 1500);
                    return;
                }

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

                try {
                    localStorage.setItem('raidState', JSON.stringify(raidState));
                } catch (e) {
                    console.warn('Could not save raidState to localStorage', e);
                }
            });
        });

        // Controller to avoid double-firing; also clears safe raids on Do-or-Die
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.raid-btn');
            if (!btn) return;

            const team = btn.getAttribute('data-team');
            const pos = btn.getAttribute('data-pos');
            const key = `${team}_${pos}`;
            const isDoOrDie = btn.classList.contains('do-or-die');
            const isSafeRaid = btn.classList.contains('safe-raid');

            if (isDoOrDie) {
                ['1', '2'].forEach(p => {
                    const k = `${team}_${p}`;
                    if (raidState[k]) {
                        raidState[k] = false;
                    }
                });
                persistRaidState();

                document.querySelectorAll(`.raid-btn.safe-raid[data-team="${team}"]`).forEach(srBtn => {
                    srBtn.classList.remove('active');
                    srBtn.style.opacity = '0.9';
                });

                const audio = document.getElementById('doOrDieAudio');
                if (audio) {
                    try {
                        audio.currentTime = 0;
                        audio.play();
                    } catch (_) {}
                }
                btn.classList.add('active');
                btn.style.opacity = '1';
                setTimeout(() => {
                    btn.classList.remove('active');
                    btn.style.opacity = '0.9';
                }, 1500);

                e.stopImmediatePropagation();
                e.preventDefault();
                return;
            }

            if (isSafeRaid) {
                const newVal = !raidState[key];
                raidState[key] = newVal;
                persistRaidState();

                btn.classList.toggle('active', newVal);
                btn.style.opacity = newVal ? '1' : '0.9';

                e.stopImmediatePropagation();
                e.preventDefault();
                return;
            }
        }, true);

        // Re-apply after any initial mutations
        applyRaidStateToUI();

    }); // end DOMContentLoaded
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kabaddi Scoreboard</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: radial-gradient(1000px 600px at 50% -40%, #1b2431 0%, #0d1116 45%) no-repeat, #0d1116;
            color: #dfe7f1;
            font-family: Inter, system-ui, sans-serif;
        }
        .topbar {
            text-align: center;
            font-family: Rajdhani;
            font-weight: 700;
            letter-spacing: .06em;
            font-size: 24px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .timer {
            border: 1px solid #222a36;
            border-radius: 14px;
            padding: 20px 110px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #0b1118;
        }
        .timer small { color: #9fb0c3; font-size: 13px; text-transform: uppercase; margin-bottom: 6px }
        .timer .time { font-family: Rajdhani; font-size: 34px; font-weight: 700 }
        .team {
            background: #111823;
            border: 2px solid #222a36;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,.35);
            padding: 18px;
        }
        .team__header {
            text-align: center;
            margin-bottom: 14px;
            font-family: Rajdhani;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            font-size: 35px;
        }
        .team--left .team__header { color: #ffb000; }
        .team--right .team__header { color: #1e90ff; }
        .raid-tabs .btn { flex: 1; font-weight: 700; }
        .team__body { display: grid; place-items: center; gap: 10px; }
        .score { font-family: Rajdhani; font-size: 60px; font-weight: 700 }
        .status { font-family: Rajdhani; font-size: 20px; letter-spacing: .4em; text-transform: uppercase; color: #ffcf66 }

        .border {
            border: var(--bs-border-width) var(--bs-border-style) #3f454a !important;
        }

        .bg-color {
            background: #111823 !important;
            border: 2px solid #222a36 !important;
            border-radius: 8px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .35) !important;
        }
    </style>
</head>
<body>
<main class="container py-4">
    <header class="topbar">Match: 1 – Telugu vs Tamil</header>

    <!-- Timer + Controls -->
    <section class="p-3 mb-3 shadow bg-color">
        <div class="row align-items-center">
            <!-- Left: Timer + Start/Stop -->
            <div class="col-md d-flex align-items-center gap-2 mb-3 mb-md-0">
                <div class="timer me-3">
                    <small>Second Half</small>
                    <div id="main-timer" class="time">20:00</div>
                </div>
                <button class="btn btn-success btn-lg" id="startBtn">Start</button>
                <button class="btn btn-danger btn-lg" id="stopBtn">Stop</button>
            </div>

            <!-- Right: Input / Set / Reset -->
            <div class="col-md d-flex justify-content-md-end gap-2">
                <input type="number" class="form-control w-auto text-center" id="timeInput" placeholder="Minutes">
                <button class="btn btn-secondary" id="setBtn">Set</button>
                <button class="btn btn-primary" id="setStartBtn">Set & Start</button>
                <button class="btn btn-outline-light" id="resetBtn">Reset 20:00</button>
            </div>
        </div>
    </section>

    <!-- Swap courts + Half Selector -->
    <section class="p-3 mb-3 text-center bg-color">
        <div class="d-flex justify-content-center gap-2">
            <button class="btn btn-outline-light" id="swapBtn">Swap Courts</button>
            <select class="form-select w-auto">
                <option>First Half</option>
                <option selected>Second Half</option>
                <option>Extra Time</option>
            </select>
        </div>
    </section>

    <!-- Teams -->
    <section class="row g-3" id="teamsRow">
        <div class="col-md-6" id="teamLeftCol">
            <article class="team team--left">
                <div class="team__header">Telugu Titans</div>
                <div class="raid-tabs d-flex gap-2 mb-3">
                    <button class="btn btn-warning" id="raidInBtnLeft">Raid In</button>
                    <button class="btn btn-outline-light" id="raidOutBtnLeft">Raid Out</button>
                </div>
                <div class="team__body">
                    <div class="score" id="raidTimerLeft">30</div>
                    <div class="status">Out</div>
                </div>
            </article>
        </div>

        <div class="col-md-6" id="teamRightCol">
            <article class="team team--right">
                <div class="team__header">Tamil Thalaivas</div>
                <div class="raid-tabs d-flex gap-2 mb-3">
                    <button class="btn btn-primary" id="raidInBtnRight">Raid In</button>
                    <button class="btn btn-outline-light" id="raidOutBtnRight">Raid Out</button>
                </div>
                <div class="team__body">
                    <div class="score" id="raidTimerRight">30</div>
                    <div class="status">Out</div>
                </div>
            </article>
        </div>
    </section>

    <!-- Footer -->
    <div class="text-center mt-4">
        <button class="btn btn-outline-light" onclick="location.reload()">Refresh Page</button>
    </div>
</main>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Main Timer
    let mainTimerDisplay = document.getElementById('main-timer');
    let defaultMainTime = 20 * 60; // 20 minutes
    let mainTime = defaultMainTime;
    let mainInterval = null;

    function formatTime(seconds) {
        let m = String(Math.floor(seconds / 60)).padStart(2, '0');
        let s = String(seconds % 60).padStart(2, '0');
        return `${m}:${s}`;
    }

    // Update timer display
    function updateMainTimer() {
        mainTimerDisplay.textContent = formatTime(mainTime);
    }

    // Start main timer countdown
    function startMainTimer() {
        if (mainInterval) return; // prevent multiple intervals
        mainInterval = setInterval(() => {
            if (mainTime > 0) {
                mainTime--;
                updateMainTimer();
            } else {
                clearInterval(mainInterval);
                mainInterval = null;
            }
        }, 1000);
    }

    // Stop main timer countdown
    function stopMainTimer() {
        clearInterval(mainInterval);
        mainInterval = null;
    }

    // Set button functionality
    document.getElementById('setBtn').addEventListener('click', () => {
        let minutes = parseInt(document.getElementById('timeInput').value);
        if (!isNaN(minutes) && minutes > 0) {
            mainTime = minutes * 60;
            updateMainTimer();
        }
    });

    // Set & Start button functionality
    document.getElementById('setStartBtn').addEventListener('click', () => {
        let minutes = parseInt(document.getElementById('timeInput').value);
        if (!isNaN(minutes) && minutes > 0) {
            mainTime = minutes * 60;
            updateMainTimer();
            stopMainTimer(); // ensure no duplicates
            startMainTimer();
        }
    });

    // Start / Stop / Reset buttons
    document.getElementById('startBtn').addEventListener('click', startMainTimer);
    document.getElementById('stopBtn').addEventListener('click', stopMainTimer);
    document.getElementById('resetBtn').addEventListener('click', () => {
        stopMainTimer();
        mainTime = defaultMainTime;
        updateMainTimer();
    });

    // Half Selector
    document.querySelector('select').addEventListener('change', (e) => {
        document.querySelector('.timer small').textContent = e.target.value;
    });

    // -------- RAID TIMERS --------
    // Left
    let raidTimerDisplayLeft = document.getElementById('raidTimerLeft');
    let raidIntervalLeft = null;
    let raidTimeLeft = 30;

    function startRaidCountdownLeft() {
        clearInterval(raidIntervalLeft);
        raidTimeLeft = 30;
        raidTimerDisplayLeft.textContent = raidTimeLeft;
        raidIntervalLeft = setInterval(() => {
            if (raidTimeLeft > 0) {
                raidTimeLeft--;
                raidTimerDisplayLeft.textContent = raidTimeLeft;
            } else {
                clearInterval(raidIntervalLeft);
            }
        }, 1000);
    }

    function stopRaidCountdownLeft() {
        clearInterval(raidIntervalLeft);
    }

    document.getElementById('raidInBtnLeft').addEventListener('click', startRaidCountdownLeft);
    document.getElementById('raidOutBtnLeft').addEventListener('click', stopRaidCountdownLeft);

    // Right
    let raidTimerDisplayRight = document.getElementById('raidTimerRight');
    let raidIntervalRight = null;
    let raidTimeRight = 30;

    function startRaidCountdownRight() {
        clearInterval(raidIntervalRight);
        raidTimeRight = 30;
        raidTimerDisplayRight.textContent = raidTimeRight;
        raidIntervalRight = setInterval(() => {
            if (raidTimeRight > 0) {
                raidTimeRight--;
                raidTimerDisplayRight.textContent = raidTimeRight;
            } else {
                clearInterval(raidIntervalRight);
            }
        }, 1000);
    }

    function stopRaidCountdownRight() {
        clearInterval(raidIntervalRight);
    }

    document.getElementById('raidInBtnRight').addEventListener('click', startRaidCountdownRight);
    document.getElementById('raidOutBtnRight').addEventListener('click', stopRaidCountdownRight);

    // Swap Courts
    document.getElementById('swapBtn').addEventListener('click', () => {
        const teamsRow = document.getElementById('teamsRow');
        const leftCol = document.getElementById('teamLeftCol');
        const rightCol = document.getElementById('teamRightCol');

        // Swap their positions
        if (leftCol.nextElementSibling === rightCol) {
            teamsRow.insertBefore(rightCol, leftCol);
        } else {
            teamsRow.insertBefore(leftCol, rightCol);
        }
    });
</script>

</body>
</html>

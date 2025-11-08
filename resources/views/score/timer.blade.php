<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kabaddi Timer Controller</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <header class="topbar">Timer Controller</header>

    <!-- Main Timer -->
    <section class="p-3 mb-3 shadow bg-color">
        <div class="row align-items-center">
            <div class="col-md d-flex align-items-center gap-2 mb-3 mb-md-0">
                <div class="timer me-3">
                    <small id="halfLabel">First Half</small>
                    <div id="main-timer" class="time">20:00</div>
                </div>
                <button class="btn btn-success btn-lg" id="startBtn">Start</button>
                <button class="btn btn-danger btn-lg" id="stopBtn">Stop</button>
            </div>
            <div class="col-md d-flex justify-content-md-end gap-2">
                <input type="number" class="form-control w-auto text-center" id="timeInput" placeholder="Minutes">
                <button class="btn btn-secondary" id="setBtn">Set</button>
                <button class="btn btn-primary" id="setStartBtn">Set & Start</button>
                <button class="btn btn-outline-light" id="resetBtn">Reset 20:00</button>
            </div>
        </div>
    </section>

    <!-- Teams -->
    <section class="row g-3" id="teamsRow">
        <!-- LEFT TEAM -->
        <div class="col-md-6" id="teamLeftCol">
            <article class="team team--left">
                <div class="team__header">{{ $score->teamMatch->team1->name }}</div>
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

        <!-- RIGHT TEAM -->
        <div class="col-md-6" id="teamRightCol">
            <article class="team team--right">
                <div class="team__header">{{ $score->teamMatch->team2->name }}</div>
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
</main>

<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const matchId = {{ $score->id ?? 1 }};

    // MAIN TIMER -----------------------
    let mainTime = 1200; // 20min default
    let mainInterval = null;

    // RAID TIMER -----------------------
    let raidTime = 30;
    let raidInterval = null;
    let activeSide = null; // 'left' or 'right'

    // STORAGE KEYS
    const MAIN_KEY = 'kabaddi_main_timer_state_{{ $score->id ?? 1 }}';
    const RAID_KEY = 'kabaddi_raid_timer_state_{{ $score->id ?? 1 }}';

    // ----------- FORMATTERS -----------
    function formatMain(sec) {
        let m = String(Math.floor(sec / 60)).padStart(2, '0');
        let s = String(sec % 60).padStart(2, '0');
        return `${m}:${s}`;
    }
    function updateMainDisplay() {
        document.getElementById('main-timer').textContent = formatMain(mainTime);
    }
    function updateRaidDisplay() {
        // If a side is active, show remaining raidTime on that side, otherwise default 30
        document.getElementById('raidTimerLeft').textContent = (activeSide === 'left') ? raidTime : 30;
        document.getElementById('raidTimerRight').textContent = (activeSide === 'right') ? raidTime : 30;
    }

    // ----------- SOUND LOGIC -----------
    function playNumberSound(num) {
        if (num >= 1 && num <= 10) {
            const audio = new Audio(`/sounds/${num}.mp3`);
            audio.play().catch(e => console.warn('Audio play failed:', e));
        }
    }

    // ----------- PERSISTENCE HELPERS -----------
    function safeParse(raw) {
        try { return JSON.parse(raw); } catch (e) { return null; }
    }

    function persistMainTimer() {
        const obj = {
            mainTime: mainTime,
            running: !!mainInterval,
            lastSaved: Date.now()
        };
        localStorage.setItem(MAIN_KEY, JSON.stringify(obj));
    }

    function persistRaidTimer() {
        const obj = {
            raidTime: raidTime,
            activeSide: activeSide,
            running: !!raidInterval,
            lastSaved: Date.now()
        };
        localStorage.setItem(RAID_KEY, JSON.stringify(obj));
    }

    // ----------- MAIN TIMER LOGIC -----------
    function startMain() {
        if (mainInterval) return;
        // start ticking
        mainInterval = setInterval(() => {
            if (mainTime > 0) mainTime--;
            else {
                stopMain();
            }
            updateMainDisplay();
            persistMainTimer();
            sendTimerUpdate();
        }, 1000);
        // persist immediately with running = true
        persistMainTimer();
    }
    function stopMain() {
        if (mainInterval) {
            clearInterval(mainInterval);
            mainInterval = null;
        }
        persistMainTimer();
        sendTimerUpdate();
    }
    function resetMain() {
        stopMain();
        mainTime = 1200;
        updateMainDisplay();
        persistMainTimer();
        sendTimerUpdate();
    }

    // ----------- RAID TIMER LOGIC -----------
    function startRaid(side) {
        // Don't allow both sides to run
        if (raidInterval) clearInterval(raidInterval);

        activeSide = side;
        // If a saved raidTime exists and we are simply resuming, keep it; here we reset to 30 on new start
        // This follows your original behavior: starting a raid sets it to 30.
        raidTime = 30;
        updateRaidDisplay();
        persistRaidTimer();

        raidInterval = setInterval(() => {
            if (raidTime > 0) {
                raidTime--;

                // Play sound when 10 to 1
                if (raidTime <= 10 && raidTime >= 1) {
                    playNumberSound(raidTime);
                }
            } else {
                stopRaid();
            }

            updateRaidDisplay();
            persistRaidTimer();
            sendTimerUpdate();
        }, 1000);

        // persist start
        persistRaidTimer();
    }
    function stopRaid() {
        if (raidInterval) {
            clearInterval(raidInterval);
            raidInterval = null;
        }
        activeSide = null;
        persistRaidTimer();
        sendTimerUpdate();
    }

    // ----------- AJAX SYNC -----------
    function sendTimerUpdate() {
        fetch('{{ route("timer.update", $score->id) }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify({
                match_id: matchId,
                main_timer_seconds: mainTime,
                raid_timer_seconds: raidTime,
                active_side: activeSide
            })
        }).catch(e => console.error(e));
    }

    // ----------- RESTORE LOGIC (accounts for elapsed time) -----------
    function restoreTimers() {
        // Restore main timer
        const mainRaw = localStorage.getItem(MAIN_KEY);
        const mainSaved = safeParse(mainRaw);
        if (mainSaved && typeof mainSaved.mainTime === 'number') {
            // compute elapsed seconds since last save
            const elapsedMs = Date.now() - (mainSaved.lastSaved || Date.now());
            const elapsedSec = Math.floor(elapsedMs / 1000);
            // If it was running, subtract elapsed seconds
            let restoredMain = mainSaved.mainTime;
            if (mainSaved.running) {
                restoredMain = Math.max(0, restoredMain - elapsedSec);
            }
            mainTime = restoredMain;
            updateMainDisplay();
            // If it was running and still > 0, resume
            if (mainSaved.running && mainTime > 0) {
                // startMain will persist again and start ticking
                startMain();
            } else {
                // ensure not running
                if (mainInterval) { clearInterval(mainInterval); mainInterval = null; }
                persistMainTimer(); // update stored running=false if needed
            }
        } else {
            // no saved state, ensure UI shows default
            updateMainDisplay();
        }

        // Restore raid timer
        const raidRaw = localStorage.getItem(RAID_KEY);
        const raidSaved = safeParse(raidRaw);
        if (raidSaved && typeof raidSaved.raidTime === 'number') {
            const elapsedMs = Date.now() - (raidSaved.lastSaved || Date.now());
            const elapsedSec = Math.floor(elapsedMs / 1000);
            let restoredRaid = raidSaved.raidTime;
            // If raid was running, subtract elapsed seconds and possibly stop it if <=0
            if (raidSaved.running && raidSaved.activeSide) {
                restoredRaid = Math.max(0, restoredRaid - elapsedSec);
            }
            raidTime = restoredRaid;
            activeSide = raidSaved.activeSide || null;
            updateRaidDisplay();

            if (raidSaved.running && activeSide && raidTime > 0) {
                // resume raid timer with corrected remaining time
                // we should start the interval but not reset raidTime to 30 (startRaid resets to 30),
                // so we'll create a resume path for raid
                if (raidInterval) clearInterval(raidInterval);
                raidInterval = setInterval(() => {
                    if (raidTime > 0) {
                        raidTime--;

                        // Play sound when 10 to 1
                        if (raidTime <= 10 && raidTime >= 1) {
                            playNumberSound(raidTime);
                        }
                    } else {
                        stopRaid();
                    }

                    updateRaidDisplay();
                    persistRaidTimer();
                    sendTimerUpdate();
                }, 1000);
                persistRaidTimer();
            } else {
                // not running (or expired)
                if (raidInterval) { clearInterval(raidInterval); raidInterval = null; }
                if (raidTime <= 0) {
                    // expired while offline: clear active side
                    activeSide = null;
                    raidTime = 30; // optional: keep default display for next raid
                    updateRaidDisplay();
                }
                persistRaidTimer();
            }
        } else {
            // no saved raid, show defaults
            raidTime = 30;
            activeSide = null;
            updateRaidDisplay();
        }
    }

    // ----------- BUTTON EVENTS -----------
    document.getElementById('startBtn').onclick = startMain;
    document.getElementById('stopBtn').onclick = stopMain;
    document.getElementById('resetBtn').onclick = resetMain;

    document.getElementById('raidInBtnLeft').onclick = () => startRaid('left');
    document.getElementById('raidOutBtnLeft').onclick = stopRaid;
    document.getElementById('raidInBtnRight').onclick = () => startRaid('right');
    document.getElementById('raidOutBtnRight').onclick = stopRaid;

    document.getElementById('setBtn').onclick = () => {
        let m = parseInt(document.getElementById('timeInput').value);
        if (!isNaN(m) && m > 0) { mainTime = m * 60; updateMainDisplay(); persistMainTimer(); sendTimerUpdate(); }
    };
    document.getElementById('setStartBtn').onclick = () => {
        let m = parseInt(document.getElementById('timeInput').value);
        if (!isNaN(m) && m > 0) { mainTime = m * 60; updateMainDisplay(); stopMain(); startMain(); }
    };

    // Initialize displays and restore any running timers
    updateMainDisplay();
    updateRaidDisplay();
    restoreTimers();

    // Optional: Before unload persist final state (helps if browser is closed quickly)
    window.addEventListener('beforeunload', () => {
        persistMainTimer();
        persistRaidTimer();
    });

    // Preload sounds to reduce delay
    for (let i = 1; i <= 10; i++) {
        const a = new Audio(`/sounds/${i}.mp3`);
        a.load();
    }
</script>

</body>
</html>

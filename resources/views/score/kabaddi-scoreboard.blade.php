<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabaddi Scoreboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .scoreboard-container {
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            overflow: hidden;
        }

        .teams-header {
            display: flex;
            position: relative;
        }

        .team-header {
            flex: 1;
            padding: 15px 20px;
            text-align: center;
            font-size: 28px;
            font-weight: 700;
        }

        .team1 {
            background-color: #3498db;
            color: white;
        }

        .team2 {
            background-color: #e74c3c;
            color: white;
        }

        .vs-badge {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            color: #333;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            box-shadow: 0 0 0 4px #f0f2f5;
            z-index: 1;
        }

        .scoreboard-main {
            display: flex;
            padding: 20px;
            gap: 30px;
        }

        .team-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .score-display {
            background-color: #2c3e50;
            color: white;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 56px;
            font-weight: bold;
            height: 120px;
        }

        .point-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .point-btn {
            flex: 1;
            min-width: 60px;
            background-color: #ecf0f1;
            color: #2c3e50;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }

        .point-btn:hover {
            background-color: #d5dbdb;
        }

        .number-selector {
            display: flex;
            gap: 6px;
            margin-top: 10px;
        }

        .num-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f8a5a5;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }

        .num-btn:hover {
            background-color: #e74c3c;
        }

        .action-btn {
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .technical-btn {
            background-color: #2ecc71;
            color: white;
        }

        .technical-btn:hover {
            background-color: #27ae60;
        }

        .bonus-btn {
            background-color: #f39c12;
            color: white;
        }

        .bonus-btn:hover {
            background-color: #d35400;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons .action-btn {
            flex: 1;
        }

        .special-actions {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .special-action-btn {
            background-color: #95e1d3;
            color: #2c3e50;
            padding: 12px 5px;
            border-radius: 8px;
            border: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .special-action-btn:hover {
            background-color: #81cfc0;
        }

        .center-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
        }

        .timer-display {
            display: flex;
            gap: 15px;
        }

        .raid-timer {
            width: 80px;
            height: 80px;
            background-color: #ff6b6b;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            font-weight: bold;
        }

        .center-buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }

        .submit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            background-color: #2980b9;
        }

        .reset-btn {
            background-color: #95a5a6;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }

        .reset-btn:hover {
            background-color: #7f8c8d;
        }

        .winner-badge {
            background-color: #a29bfe;
            color: white;
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 10px;
        }

        .timer-controls {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .time-selector {
            display: flex;
            align-items: center;
            background-color: #c7ecee;
            border-radius: 8px;
            padding: 8px 15px;
            justify-content: space-between;
        }

        .control-panel {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            background-color: #dff9fb;
            border-radius: 8px;
            padding: 10px;
        }

        .timer-btn {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .start-btn {
            background-color: #27ae60;
            color: white;
        }

        .pause-btn {
            background-color: #f39c12;
            color: white;
        }

        .stop-btn {
            background-color: #e74c3c;
            color: white;
        }

        .reset-timer-btn {
            background-color: #7f8c8d;
            color: white;
        }

        .time-display {
            background-color: #f1c40f;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="scoreboard-container">
    <div class="teams-header">
        <div class="team-header team1">TEAM 1</div>
        <div class="vs-badge">VS</div>
        <div class="team-header team2">TEAM 2</div>
    </div>

    <div class="scoreboard-main">
        <div class="team-column">
            <div class="score-display">00</div>
            <div class="winner-badge">WINNER</div>

            <div class="point-controls">
                <button class="point-btn">+1</button>
                <button class="point-btn">+2</button>
                <button class="point-btn">+3</button>
                <button class="point-btn">+4</button>
            </div>

            <div class="number-selector">
                <button class="num-btn">1</button>
                <button class="num-btn">2</button>
                <button class="num-btn">3</button>
                <button class="num-btn">4</button>
                <button class="num-btn">5</button>
                <button class="num-btn">6</button>
                <button class="num-btn">7</button>
            </div>

            <div class="action-buttons">
                <button class="action-btn technical-btn">TECHNICAL POINT</button>
                <button class="action-btn bonus-btn">BONUS</button>
            </div>

            <div class="special-actions">
                <button class="special-action-btn">SUPPER TACKLE</button>
                <button class="special-action-btn">SUPPER RAID</button>
                <button class="special-action-btn">DO OR DIE</button>
                <button class="special-action-btn">ALL OUT</button>
            </div>
        </div>

        <div class="center-column">
            <div class="timer-display">
                <div class="raid-timer">30</div>
                <div class="raid-timer">30</div>
            </div>

            <div class="center-buttons">
                <button class="submit-btn">SUBMIT</button>
                <button class="reset-btn">RESET</button>
            </div>

            <div class="timer-controls">
                <div class="time-selector">
                    <span>FIRST HALF</span>
                    <span>20:00</span>
                </div>

                <div class="control-panel">
                    <div class="time-display">20:00</div>
                    <button class="timer-btn start-btn">▶</button>
                    <button class="timer-btn pause-btn">⏸</button>
                    <button class="timer-btn stop-btn">⏹</button>
                    <button class="timer-btn reset-timer-btn">↻</button>
                </div>
            </div>
        </div>

        <div class="team-column">
            <div class="score-display">00</div>
            <div class="winner-badge">WINNER</div>

            <div class="point-controls">
                <button class="point-btn">+1</button>
                <button class="point-btn">+2</button>
                <button class="point-btn">+3</button>
                <button class="point-btn">+4</button>
            </div>

            <div class="number-selector">
                <button class="num-btn">1</button>
                <button class="num-btn">2</button>
                <button class="num-btn">3</button>
                <button class="num-btn">4</button>
                <button class="num-btn">5</button>
                <button class="num-btn">6</button>
                <button class="num-btn">7</button>
            </div>

            <div class="action-buttons">
                <button class="action-btn technical-btn">TECHNICAL POINT</button>
                <button class="action-btn bonus-btn">BONUS</button>
            </div>

            <div class="special-actions">
                <button class="special-action-btn">SUPPER TACKLE</button>
                <button class="special-action-btn">SUPPER RAID</button>
                <button class="special-action-btn">DO OR DIE</button>
                <button class="special-action-btn">ALL OUT</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<h1 class="team-a-name text-outline" style="text-align: center;">{{ $adtScore->team_a }}</h1>
<h1 class="left-score-board left-points text-outline" data-team1="{{ isset($adtScore) ? $adtScore->team_a_score : 00 }}" style="text-align: center">{{ ($adtScore->team_a_score == 0 ? '00' : $adtScore->team_a_score) }}</h1>
<input type="hidden" name="team_a_score" id="teamAScore" value="{{ isset($adtScore) ? $adtScore->team_a_score : 00 }}">
@if(\Request::route()->getName() != 'adt-score.live')
<div class="d-flex btn-group">
    <button type="button" class="btn btn-primary leftScoreBtn leftScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="1" {{ $adtScore->team_a_score <=0 ? 'disabled' : '' }}>-1</button>
    <button type="button" class="btn btn-primary leftScoreBtn mt-3 point-btn" id="leftScorePlus" data-point="1"
            data-symbol="+">+1
    </button>
</div>
@endif

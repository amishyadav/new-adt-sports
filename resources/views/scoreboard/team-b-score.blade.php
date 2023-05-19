<h1 class="team-b-name text-outline"  style="text-align: center;">{{ $adtScore->team_b }}</h1>
<h1 class="right-score-board left-points text-outline" data-team2="{{ isset($adtScore) ? $adtScore->team_b_score : 00 }}" style="text-align: center">{{ ($adtScore->team_b_score == 0 ? '00' : $adtScore->team_b_score) }}</h1>
<input type="hidden" name="team_b_score" id="teamBScore" value="{{ isset($adtScore) ? $adtScore->team_b_score : 00 }}">
@if(\Request::route()->getName() != 'adt-score.live')
<div class="d-flex btn-group">
    <button type="button" class="btn btn-primary rightScoreBtn rightScoreMinus mt-3 point-btn" id="" data-symbol="-" data-point="1" {{ $adtScore->team_b_score <=0 ? 'disabled' : '' }}>-1</button>
    <button type="button" class="btn btn-primary rightScoreBtn mt-3 point-btn" data-point="1"
            data-symbol="+">+1</button>
</div>
@endif

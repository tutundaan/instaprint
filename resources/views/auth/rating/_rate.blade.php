@for($i = 0; $i < (int) $rate; $i++)
    <i class="fas fa-star"></i>
@endfor
@if($rate != 5)
    @if(($rate - floor($rate)) > 0)
        <i class="fas fa-star-half-alt"></i>
    @else
        <i class="far fa-star"></i>
    @endif
@endif
@for($i = 0; $i < (4 - (int) $rate); $i++)
    <i class="far fa-star"></i>
@endfor

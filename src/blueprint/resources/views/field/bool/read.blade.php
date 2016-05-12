<?php $value = ($meta->inverse ? !$value : !!$value); ?>

@if($value)
    <span class="material-icons">done</span>
    Да
@else
    <span class="material-icons">clear</span>
    Нет
@endif
<!-- Endfix -->
<div id="{{ $fieldname }}" class="form-group{{ $errors->has($fieldname) ? ' has-error' : '' }}"{!!  (isset($style)) ? ' style="'.e($style).'"' : ''  !!}>

    {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7{{  ((isset($required) && ($required =='true'))) ?  ' required' : '' }}">
        <select class="format select2 form-control" data-endpoint="endfix" data-placeholder="Select an Endfix" name="{{ $fieldname }}" style="width: 100%" id="{{ $fieldname }}" aria-label="{{ $fieldname }}" {!!  ((isset($item)) && (Helper::checkIfRequired($item, $fieldname))) ? ' data-validation="required" required' : '' !!}>
            <option value="" role="option" role="option"></option>
            @php
                $arr_endfix = array("HQ","WH","WH-Buffered 3","WH-Buffered 4","WH-Buffered 5","FM","SH","AL");
            @endphp
            @foreach ($arr_endfix as $i => $val)
                @php
                    $endfix_id = old($fieldname, (isset($item)) ? $item->{$fieldname} : '')
                @endphp
                @if ($endfix_id == $i+1)
                    <option value="{{ $i+1 }}" selected="selected" role="option" aria-selected="true"  role="option">{{ $val }}</option>
                @else
                    <option value="{{ $i+1 }}" role="option" role="option">{{ $val }}</option>
                @endif
            @endforeach
        </select>
    </div>

    {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span></div>') !!}

    @if (isset($help_text))
    <div class="col-md-7 col-sm-11 col-md-offset-3">
        <p class="help-block">{{ $help_text }}</p>
    </div>
    @endif


</div>


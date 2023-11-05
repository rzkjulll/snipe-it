<!-- Sequence -->
<div id="{{ $fieldname }}" class="form-group{{ $errors->has($fieldname) ? ' has-error' : '' }}"{!!  (isset($style)) ? ' style="'.e($style).'"' : ''  !!}>

    {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7{{  ((isset($required) && ($required =='true'))) ?  ' required' : '' }}">
        <select class="format select2 form-control" data-endpoint="sequence" data-placeholder="Select a Sequence" name="{{ $fieldname }}" style="width: 100%" id="{{ $fieldname }}" aria-label="{{ $fieldname }}" {!!  ((isset($item)) && (Helper::checkIfRequired($item, $fieldname))) ? ' data-validation="required" required' : '' !!}>
            <option value="" role="option" role="option"></option>
            <option value="0" role="option" role="option">Auto Increment</option>
            @for ($i=1;$i<=999;$i++)
                @php
                $sequence_id = old($fieldname, (isset($item)) ? $item->{$fieldname} : '')
                @endphp
                @if ($sequence_id == $i)
                    <option value="{{ $sequence_id }}" selected="selected" role="option" aria-selected="true"  role="option">{{ $sequence_id }}</option>
                @else
                    <option value="{{ $i }}" role="option" role="option">{{ $i }}</option>
                @endif
            @endfor
        </select>
    </div>

    {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span></div>') !!}

    @if (isset($help_text))
    <div class="col-md-7 col-sm-11 col-md-offset-3">
        <p class="help-block">{{ $help_text }}</p>
    </div>
    @endif


</div>


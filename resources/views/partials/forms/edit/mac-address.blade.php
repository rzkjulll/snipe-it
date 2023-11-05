<!-- Mac Address -->
<div class="form-group {{ $errors->has('mac_address') ? ' has-error' : '' }}">
    <label for="mac_address" class="col-md-3 control-label">{{ $translated_name }}</label>
    <div class="col-md-7 col-sm-12{{  (Helper::checkIfRequired($item, 'mac_address')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="mac_address" aria-label="mac_address" id="mac_address" value="{{ old('mac_address', $item->mac_address) }}"{!!  (Helper::checkIfRequired($item, 'mac_address')) ? ' data-validation="required" required' : '' !!} />
        {!! $errors->first('mac_address', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

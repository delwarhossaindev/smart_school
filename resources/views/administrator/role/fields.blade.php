<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('name') }} <span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <input class="form-control col-md-7 col-xs-12" name="name" value="{{ $name }}" placeholder="{{ __('name') }}" required="required" type="text" autocomplete="off">
        <div class="help-block">@error('name')<div class="error-message" style="color: red;">{{ $message }}</div>@enderror</div>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('note') }}</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <textarea class="form-control col-md-7 col-xs-12" name="note" placeholder="{{ __('note') }}">{{ $note }}</textarea>
        <div class="help-block">@error('note')<div class="error-message" style="color: red;">{{ $message }}</div>@enderror</div>
    </div>
</div>

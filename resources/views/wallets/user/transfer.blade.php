@extends('layouts.master',['activeSideNav' => active_side_nav()])
@section('title', $title)
@section('content')
    <div class="container my-5">
        @component('components.profile', ['user' => $user])
            {{ Form::open(['route'=>['user.wallets.transfer.send'],'class'=>'form-horizontal validator','method'=>'put', 'id' => 'transferForm']) }}
            {{--password--}}
            <div class="form-group row">
                <label for="wallet_id" class="col-md-4 control-label pt-2 required">{{ __('Wallet') }}</label>
                <div class="col-md-8">
                    <select class="form-control" name="wallet_id">
                        <option></option>
                        @foreach($wallets as $item)
                            <option value="{{$item->id}}">{{$item->symbol}}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" data-name="sender">{{ $errors->first('wallet_id') }}</span>
                </div>
            </div>

            {{--new password--}}
            <div class="form-group row">
                <label for="sender" class="col-md-4 control-label pt-2 required">{{ __('Sender\'s email or wallet address') }}</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="sender" name="sender"/>
                    <span class="invalid-feedback" data-name="sender">{{ $errors->first('sender') }}</span>
                </div>
            </div>

            {{--email--}}
            <div class="form-group row">
                <label for="amount"
                       class="col-md-4 control-label pt-2 required">{{ __('Amount') }}</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" id="amount" name="amount"/>
                    <span class="invalid-feedback" data-name="sender">{{ $errors->first('amount') }}</span>
                </div>
            </div>
            {{--submit button--}}
            <div class="form-group">
                {{ Form::submit(__('Send'),['class'=>'btn btn-info lf-card-btn form-submission-button']) }}
                {{ Form::button('<i class="fa fa-undo"></i>',['class'=>'btn btn-danger reset-button lf-card-btn']) }}
            </div>
            {{ Form::close() }}
        @endcomponent
    </div>
@endsection

@section('style')
    @include('layouts.includes._avatar_and_loader_style')
@endsection

@section('script')
    <script src="{{ asset('plugins/cvalidator/cvalidator-language-en.js') }}"></script>
    <script src="{{ asset('plugins/cvalidator/cvalidator.js') }}"></script>
    <script>
        "use strict";

        $(document).ready(function () {
            var form = $('#passwordChangeForm').cValidate({
                rules: {
                    'password': 'required',
                    'new_password': 'required|between:6,32',
                    'new_password_confirmation': 'required|same:new_password',
                },
            });
        });
    </script>
@endsection

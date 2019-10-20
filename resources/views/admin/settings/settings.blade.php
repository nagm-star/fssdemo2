@extends('layouts.masterBK')

@section('content')

<div class="card card-default">

    <div class="card-header">
           Edit blog settings
    </div>
    <div class="card-body">

      <form action="{{ route('setting.update') }}" method="post">
          @csrf

          @method('PUT')

            <div class="form-group">
                <label for="name">Site name</label>
            <input required type="text" id="site_name" name="site_name" class="form-control" value="{{ $settings->site_name}}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input required type="text" id="address" name="address" class="form-control" value="{{ $settings->address}}">
            </div>

            <div class="form-group">
                    <label for="contact">Contact phone</label>
                    <input required type="text" id="contact_number" name="contact_number" class="form-control" value="{{ $settings->contact_number}}">
            </div>

            <div class="form-group">
                    <label for="contact">Contact email</label>
                    <input required type="text" id="contact_email" name="contact_email" class="form-control" value="{{ $settings->contact_email}}">
            </div>

            <div class="form-group">
                <button class="btn btn-success">
                    Update site settings
                </button>
            </div>
        </form>
    </div>

</div>

@endsection

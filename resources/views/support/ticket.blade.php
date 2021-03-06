@extends('layouts.panel')

@section('head')
<link href="{{ asset('plugins/bootstrap-sweetalert/sweet-alert.css') }}" rel="stylesheet">
<script src="{{ asset('plugins/bootstrap-sweetalert/sweet-alert.min.js') }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card-box">
            <h4 class="m-t-0">
                <b>{{ $ticket->subject }}</b>
            </h4>
            <hr>
        </div>
        @foreach ($ticketMessages as $ticketMessage)
        <div class="card-box">
            <div class="media m-b-30">
                <img alt="" src="{{ $ticketMessage->user->avatar }}" class="d-flex mr-3 rounded-circle thumb-sm">
                <div class="media-body">
                    <span class="media-meta pull-right">{{ $ticketMessage->updated_at->format('d/M/Y H:i') }}</span>
                    <h4 class="text-primary m-0">{{ $ticketMessage->user->regname . ' (' . $ticketMessage->user->xatid . ')' }}</h4>
                    <small class="text-muted">{{ $ticketMessage->role }}</small>
                </div>
            </div>
            <hr>

            {!! $ticketMessage->message !!}

        </div>
        @endforeach
        @if ($ticket->state == true)
        <div class="media m-b-0">
            <a href="#" class="pull-left">
                <img alt="" src="{{ Auth::user()->avatar }}" class="d-flex mr-3 rounded-circle thumb-sm">
            </a>
            <div class="media-body">
                <div class="card-box p-0">
                    <div class="summernote note-air-editor note-editable panel-body" id="note-editor-1" contenteditable="true" style="min-height: 150px; margin: 10px 0 0 10px;">

                    </div>
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-primary waves-effect waves-light w-md m-b-30" id="submit">Send</button>
        </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
    $('#submit').on('click', function() {
        var token     = "{{ csrf_token() }}";
        var message   = $('#note-editor-1').html();
        var ticket_id = "{{ $ticket->id }}";

        $.post("{{ route('support.replyticket') }}", { ticket_id: ticket_id, message: message, _token: token })
            .done(function(data) {
                swal(data.header, data.message, data.status);
                if (data.status == 'success') {
                    setTimeout(function(){
                        location.reload(true);
                    }, 2000);
                }
            });
    });
</script>

@endsection
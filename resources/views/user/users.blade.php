@extends('app')

@section('content')
    {!! link_to_route('login.logout', 'logout') !!}
    <ul class="list-group">
    @foreach($users as $user)
        <article>
            <li class="list-group-item">{{ $user->email }} :
            @if($user->is_active)
                <span class="label label-success">Active</span>

            @elseif(!$user->is_active)
                <span class="label label-danger">Not active</span>
            @endif
            </li>
        </article>
    @endforeach
    </ul>
@stop
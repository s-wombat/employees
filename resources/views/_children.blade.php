@foreach($users as $user)
<ul>
<li>
    {{ $delimiter ?? '' }}{{ $user->name ?? ''}} => <span style="color:green;">{{ $user->position ?? '' }}</span>
</li>
        @isset($user->children)
            @include('_children', [
                'users' => $user->children,
                'delimiter' => '-'.$delimiter,
            ])
        @endisset
</ul>
@endforeach

{{--    {{ dd($users) }}--}}

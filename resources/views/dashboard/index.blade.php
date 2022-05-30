@if ($user->type === 'student')
    @if (count($user->coursesStudent) == 0)
        @include('dashboard.courses')
    @else
        @include('dashboard.student')
    @endif
@elseif ($user->type === 'headDepartment')
    @include('dashboard.headDepartment')
@elseif ($user->type === 'super-admin')
    @include('dashboard.admin')
@elseif ($user->type === 'university')
    @include('dashboard.university')
@elseif ($user->type === 'deanDepartment')
    @include('dashboard.deanDepartment')
@endif

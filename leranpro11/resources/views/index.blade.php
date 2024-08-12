@include('layout/header')


<table id="courses-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Instructor</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
        <tr>
            <td>{{ $course->title }}</td>
            <td>{{ $course->category }}</td>
            <td>{{ $course->instructor->name }}</td>
            <td>
                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info">View</a>
                <!-- Add enroll/unenroll buttons based on role -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@include('layout/footer')

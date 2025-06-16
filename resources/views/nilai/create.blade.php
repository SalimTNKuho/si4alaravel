@extends('layout.main')
@section('title', 'Nilai')

@section('content')
<div class="container">
    <h1>Create Nilai</h1>
    <form action="{{ route('nilai.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" id="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="score">Score</label>
            <input type="number" name="score" id="score" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

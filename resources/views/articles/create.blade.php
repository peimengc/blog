@extends('layouts.app')

@section('content')
    <article-create :id="{{ $id ?? null }}"></article-create>
@endsection

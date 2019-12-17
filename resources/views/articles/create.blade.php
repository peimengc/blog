@extends('layouts.app')

@section('content')
    <article-create {{ isset($id) ? ':id='.$id : '' }}></article-create>
@endsection
